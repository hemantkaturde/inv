<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_users');
	}

	/* 
		This function checks if the email exists in the database
	*/
	public function check_email($email, $company) 
	{
		if($email && $company) {
			$sql = 'SELECT * FROM users WHERE (email = ? AND company_id = ?)';
			$query = $this->db->query($sql, array($email, $company));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($company, $username, $password) {
		if($company && $username && $password) {
			$sql = "SELECT * FROM users  WHERE (company_id = ? AND username = ? AND `password`= ?)";
			$query = $this->db->query($sql, array($company, $username, $password));
			if($query->num_rows() == 1) {
				$result = $query->row_array();
                if($result){
					return $result;	
				}else{
					return false;
				}
			}
			else {
				return false;
			}
		}
	}


	public function get_company($id = null)
	{
		$sql = "SELECT * FROM company where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}


	public function SuperadminLogin($username, $password){
		$sql = "SELECT * FROM users where username = ? AND `password`= ? ";
		$query = $this->db->query($sql, array($username,$password));
		if($query->num_rows() == 1) {
			$result = $query->row_array();
			if($result) {
				return $result;
			}else{
				return false;
			}	
		}
		else {
			return false;
		}
	}

	public function getUserPermission($id){
		$user_data = $this->Model_users->getUserGroup($id);
		return $user_data;
	}
}