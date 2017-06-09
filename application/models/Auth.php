<?php
class Auth extends CI_Model {

	public function is_user_password_right($username, $password)
	{
		$_pass = md5($username.$password);
		$query = $this->db->query("SELECT * FROM user where username = '{$username}'");
		$row   = $query->row();
		return isset($row) && $_pass === $row->password ? TRUE : FALSE;
	}
}
