<?php

class User extends CI_Model {

	private function encrypt_passwd($data) 
	{
		$_passwd = md5($data['username'].$data['password']);
		$data['password'] = $_passwd;
		return $data;
	}

	public function create_user($data) 
	{
    	$data = $this->encrypt_passwd($data);
    	return $this->db->insert('user', $data);
	}
}
