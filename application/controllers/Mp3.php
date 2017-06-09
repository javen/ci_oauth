<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
/**
 * Upload photo/images
 */
class Mp3 extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	function upload_post()
	{
		$username = $this->session->username;
		
		if( ! isset($_FILES['file']['tmp_name'])) 
		{
        	$this->response(['status' => 'error', 'message' => '没有要上传的文件！'], 400);
    	}

    	$config['upload_path'] = APPPATH.'../upload/'.$username;
		$config['allowed_types'] = 'mp3';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! is_dir($config['upload_path'])) 
		{
			mkdir($config['upload_path'], 0777, TRUE);
		}

		if ( ! $this->upload->do_upload('file')) 
		{
        	$this->response(array('error' => strip_tags($this->upload->display_errors())), 404);
    	} 
    	else 
    	{
	        $upload = $this->upload->data();

			$uploaded_url = $this->config->base_url().'upload/'.$username.'/'.$upload['file_name'];

	        // baseurl/controller/method?parameter=value
	        $get_url = $this->config->base_url()
	        							. strtolower(get_class($this))
	        							. '/uploaded'
	        							. '?file_name='.$upload['file_name'];

	        $this->response(['url' => $get_url, 'status' => 'success'], 200);
    	}
	}

	function uploaded_get()
	{
		$file_name = $this->input->get('file_name');
		redirect($this->config->base_url().'upload/'.$this->session->username.'/'.$file_name);
	}
}
