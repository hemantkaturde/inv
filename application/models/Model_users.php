<?php 

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id != ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getUserDataAsPerCompany($company_id = null, $userId = null) 
	{
		if($company_id && $userId) {
			$sql = "SELECT * FROM users WHERE company_id = ? && id = ?";
			$query = $this->db->query($sql, array($company_id, $userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE company_id = ?";
		$query = $this->db->query($sql, array($company_id));
		return $query->result_array();
	}

	public function getUserGroup($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM user_group WHERE user_id = ?";
			$query = $this->db->query($sql, array($userId));
			$result = $query->row_array();

			$group_id = $result['group_id'];
			$g_sql = "SELECT * FROM groups WHERE id = ?";
			$g_query = $this->db->query($g_sql, array($group_id));
			$q_result = $g_query->row_array();
			return $q_result;
		}
	}
	

	public function create($data = '', $group_id = null)
	{

		if($data && $group_id) {
			$create = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();

			$group_data = array(
				'user_id' => $user_id,
				'group_id' => $group_id
			);

			$group_data = $this->db->insert('user_group', $group_data);

			return ($create == true && $group_data) ? true : false;
		}
	}

	public function edit($data = array(), $id = null, $group_id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		if($group_id) {
			// user group
			$update_user_group = array('group_id' => $group_id);
			$this->db->where('user_id', $id);
			$user_group = $this->db->update('user_group', $update_user_group);
			return ($update == true && $user_group == true) ? true : false;	
		}
			
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalUsers()
	{
		$sql = "SELECT * FROM users";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function countTotalUsersAsPerComp($company_id = null)
	{
		$sql = "SELECT * FROM users where company_id = ?";
		$query = $this->db->query($sql, array($company_id));
		return $query->num_rows();
	}

	public function checkifuserAlredayExits($username,$company_id)
	{
		$this->db->where('username', $username);
       // $this->db->where('type_id', $type_id);
		$this->db->where('company_id', $company_id);
        $this->db->from('users');
        return $this->db->count_all_results();
	}

	public function checkifalredayExitsemail($email,$company_id)
	{
		$this->db->where('email', $email);
       // $this->db->where('type_id', $type_id);
		$this->db->where('company_id', $company_id);
        $this->db->from('users');
        return $this->db->count_all_results();
	}

	public function checkifuserAlredayExitsedit($username,$email,$company_id,$id)
	{
		$this->db->where('username', $username);
		$this->db->where('email', $email);
        $this->db->where('id', $id);
		$this->db->where('company_id', $company_id);
        $this->db->from('users');
        return $this->db->count_all_results();
	}


	public function checkifalredayExitsusernameedit($username,$company_id,$id)
	{
		$this->db->where('username', $username);
		$this->db->where('company_id', $company_id);
		$this->db->where('id', $id);
        $this->db->from('users');
        return $this->db->count_all_results();
	}

	public function checkifalredayExitsemailedit($email,$company_id,$id)
	{
		$this->db->where('email', $email);
		$this->db->where('company_id', $company_id);
		$this->db->where('id', $id);
        $this->db->from('users');
        return $this->db->count_all_results();
	}

	public function checkifalredayExitsusernameeditwithoutid($username,$company_id)
	{
		$this->db->where('username', $username);
		$this->db->where('company_id', $company_id);
        $this->db->from('users');
        return $this->db->count_all_results();

	}

	public function checkifalredayExitsemaileditwithoutid($email,$company_id)
	{
		$this->db->where('email', $email);
		$this->db->where('company_id', $company_id);
        $this->db->from('users');
        return $this->db->count_all_results();

	}


	
	
	
}