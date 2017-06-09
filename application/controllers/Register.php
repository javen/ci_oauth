<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user');
        $this->load->config('rest');
    }

    private function user_ocupied($user)
    {
        $query = $this->db->query("SELECT username FROM user WHERE username ='{$user}'");
        $row   = $query->row();
        return isset($row) ? TRUE : FALSE;
    }

    private function http_response_code($newcode = NULL)
    {
        static $code = 200;
        if($newcode !== NULL)
        {
            header('X-PHP-Response-Code: '.$newcode, true, $newcode);
            if(!headers_sent())
                $code = $newcode;
        }
        return $code;
    }

    private function response_error()
    {
        $response['status'] = 'error';
        $response['msg'] = 'The username is occubied.';

        $this->http_response_code(500);
        echo json_encode($response);
    }

    public function create()
    {
        header('Content-Type: application/json');
        $response['status'] = 'success';

        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0)
        {
           throw new Exception('Request method must be POST!');
        }

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if(strcasecmp($contentType, 'application/json') != 0){
            throw new Exception('Content type must be: application/json');
        }

        $raw_post = trim(file_get_contents("php://input"));

        $json_obj = json_decode($raw_post, true);
        // Array
        // (
        //     [username] => 18811066874
        //     [password] => 1234
        // )

        if(!is_array($json_obj)){
            throw new Exception('Received content contained invalid JSON!');
        }

        $_username = $json_obj['username'];
        $_password = $json_obj['password'];

        $data = array(
            'username' => $_username,
            'password' => $_password
        );
        if ($this->user_ocupied($_username))
        {
            $this->response_error();
        }
        else
        {
            $this->user->create_user($data);

            $this->output->set_status_header(201);
            $_output = array('status' => 'success');
            $this->output->set_output(json_encode($_output));
        }
    }
}
