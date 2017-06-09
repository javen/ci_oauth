<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/**
 * @author Chen Xiaodong
 */
class Token extends REST_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('auth');
		$this->load->library('session');
	}

	private function generate_token($username)
	{
		$token['username'] = $username;
		$date = new DateTime();
		$token['iat'] = $date->getTimestamp();
		$token['exp'] = $date->getTimestamp() + $this->config->item('jwt_token_expire');
		return $this->jwt_encode($token);
	}

	public function generate_post() 
	{
		header('Content-Type: application/json');
        $response['status'] = 'success';

        //Make sure that it is a POST request.
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0)
        {
           throw new Exception('Request method must be POST!');
        }

        //Make sure that the content type of the POST request has been set to application/json
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if(strcasecmp($contentType, 'application/json') != 0){
            throw new Exception('Content type must be: application/json');
        }

        //Receive the RAW post data.
        $raw_post = trim(file_get_contents("php://input"));

        //Attempt to decode the incoming RAW post data from JSON.
        $json_obj = json_decode($raw_post, true);
        // Array
        // (
        //     [username] => 18811066874
        //     [password] => 1234
        // )
        //If json_decode failed, the JSON is invalid.
        if(!is_array($json_obj)){
            throw new Exception('Received content contained invalid JSON!');
        }

        //Process the JSON.

        $username = $json_obj['username']; 
        $password = $json_obj['password'];

		if ($this->auth->is_user_password_right($username, $password))
		{

			$token = $this->generate_token($username);

			$array = [
				'username'  => $username,
				'token'     => $token
			];
			$this->session->set_userdata( $array );
			
			$this->response($array, REST_Controller::HTTP_OK);
		}
		else
		{
			$output_data['status'] = 'error';
			$output_data[$this->config->item('rest_status_field_name')] = "invalid_credentials";
			$output_data[$this->config->item('rest_message_field_name')] = "Invalid username or password!";
			$this->response($output_data, REST_Controller::HTTP_UNAUTHORIZED);
		}
	}
}
