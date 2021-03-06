<?php 

class Controller_Members extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Members';
		$this->load->model('Model_users');
		$this->load->model('Model_groups');
		$this->load->model('Model_company');
	}

	
	public function index()
	{
		// if(!in_array('viewUser', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$user_data = $this->Model_users->getUserDataAsPerCompany($_SESSION['company_id']);
	

		$result = array();
		foreach ($user_data as $k => $v) {

			$result[$k]['user_info'] = $v;

			$group = $this->Model_users->getUserGroup($v['id']);
			$result[$k]['user_group'] = $group;
		}

		$this->data['user_data'] = $result;

		$this->render_template('members/index', $this->data);
	}

	public function create()
	{
	
       /* check if user alreday exits in database*/ 
		$this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            //$password = $this->password_hash($this->input->post('password'));
            // check if username alreday exits in database 
			$checkifalredayExits = $this->Model_users->checkifuserAlredayExits($this->input->post('username'), $_SESSION['company_id']);

			 if($checkifalredayExits >0){
				$this->session->set_flashdata('error', 'Username Already Exits');
        		redirect('Controller_Members/create', 'refresh');

			 }else{
				 // check if username alreday exits in database 
					$checkifalredayExitsemail = $this->Model_users->checkifalredayExitsemail($this->input->post('email'), $_SESSION['company_id']);
					if($checkifalredayExitsemail >0){
					$this->session->set_flashdata('error', 'Email Already Exits');
					redirect('Controller_Members/create', 'refresh');
					}else{
						$data = array(
							'username' => $this->input->post('username'),
							'password' => $this->input->post('password'),
							'company_id' => $_SESSION['company_id'],
							'email' => $this->input->post('email'),
							'firstname' => $this->input->post('fname'),
							'lastname' => $this->input->post('lname'),
							'phone' => $this->input->post('phone'),
							'mobile' => $this->input->post('mobile'),
							'emp_code' => $this->input->post('employee_code'),
							'designation' => $this->input->post('emp_designation'),
							'address' => $this->input->post('address'),
							'notes' => $this->input->post('notes'),
							'department_id'=> $this->input->post('department_id'),
						);

						$create = $this->Model_users->create($data, $this->input->post('groups'));
						if($create == true) {
							$this->session->set_flashdata('success', 'Successfully created');
							redirect('Controller_Members/', 'refresh');
						}
						else {
							$this->session->set_flashdata('error', 'Error occurred!!');
							redirect('Controller_Members/create', 'refresh');
						}
					}
		     }
        }
        else {
            // false case
        	$group_data = $this->Model_groups->getGroupData();
        	$department_data = $this->Model_company->getDepartmentData($id=null,$_SESSION['company_id']);
        	$this->data['group_data'] = $group_data;
        	$this->data['department_data'] = $department_data;
            $this->render_template('members/create', $this->data);
        }	
	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function edit($id = null)
	{
		if($id) {

			$this->form_validation->set_rules('groups', 'Group', 'required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');

			if ($this->form_validation->run() == TRUE) {


			$checkifalredayExitsedit = $this->Model_users->checkifuserAlredayExitsedit($this->input->post('username'),$this->input->post('email'),$_SESSION['company_id'],$id);
                
			if($checkifalredayExitsedit > 0){

							if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
								$data = array(
									'username' => $this->input->post('username'),
									'password' => $this->input->post('password'),
									'company_id' => $_SESSION['company_id'],
									'department_id' => $this->input->post('department_id'),
									'email' => $this->input->post('email'),
									'firstname' => $this->input->post('fname'),
									'lastname' => $this->input->post('lname'),
									'phone' => $this->input->post('phone'),
									'mobile' => $this->input->post('mobile'),
									'emp_code' => $this->input->post('employee_code'),
									'designation' => $this->input->post('emp_designation'),
									'address' => $this->input->post('address'),
									'notes' => $this->input->post('notes'),
								);

								$update = $this->Model_users->edit($data, $id, $this->input->post('groups'));
								if($update == true) {
									$this->session->set_flashdata('success', 'Successfully created');
									redirect('Controller_Members/', 'refresh');
								}
								else {
									$this->session->set_flashdata('error', 'Error occurred!!');
									redirect('Controller_Members/edit/'.$id, 'refresh');
								}
							}
							else {
								$this->form_validation->set_rules('password', 'Password', 'trim|required');
								$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

								if($this->form_validation->run() == TRUE) {

									//$password = $this->password_hash($this->input->post('password'));

									$data = array(
										'username' => $this->input->post('username'),
										'password' => $this->input->post('password'),
										'company_id' =>  $_SESSION['company_id'],
										'department_id' => $this->input->post('department_id'),
										'email' => $this->input->post('email'),
										'firstname' => $this->input->post('fname'),
										'lastname' => $this->input->post('lname'),
										'phone' => $this->input->post('phone'),
										'mobile' => $this->input->post('mobile'),
										'emp_code' => $this->input->post('employee_code'),
										'designation' => $this->input->post('emp_designation'),
										'address' => $this->input->post('address'),
										'notes' => $this->input->post('notes'),
									);

									$update = $this->Model_users->edit($data, $id, $this->input->post('groups'));
									if($update == true) {
										$this->session->set_flashdata('success', 'Successfully updated');
										redirect('Controller_Members/', 'refresh');
									}
									else {
										$this->session->set_flashdata('errors', 'Error occurred!!');
										redirect('Controller_Members/edit/'.$id, 'refresh');
									}
								}
								else {
									// false case
									$user_data = $this->Model_users->getUserData($id);
									$groups = $this->Model_users->getUserGroup($id);
							
									$this->data['user_data'] = $user_data;
									$this->data['user_group'] = $groups;
							
									$group_data = $this->Model_groups->getGroupData();
									$company_data = $this->Model_company->getCompanyData();
									$this->data['group_data'] = $group_data;
									$this->data['company_data'] = $company_data;

									$this->render_template('members/edit', $this->data);	
								}	

							}
			}else{
				$checkifalredayExitsusernameedit = $this->Model_users->checkifalredayExitsusernameedit($this->input->post('username'),$_SESSION['company_id'],$id);
				if($checkifalredayExitsusernameedit == 0){

					$checkifalredayExitsemailedit = $this->Model_users->checkifalredayExitsemailedit($this->input->post('username'),$_SESSION['company_id'],$id);
					if($checkifalredayExitsemailedit == 0){
                          
						$checkifalredayExitsusernameeditwithoutid = $this->Model_users->checkifalredayExitsusernameeditwithoutid($this->input->post('username'),$_SESSION['company_id'],$id);
					    if($checkifalredayExitsusernameeditwithoutid > 0){
							$this->session->set_flashdata('error', 'Username Already Exits!!');
					        redirect('Controller_Members/edit/'.$id, 'refresh');   


						}else{

							$checkifalredayExitsusernameeditwithoutid = $this->Model_users->checkifalredayExitsusernameeditwithoutid($this->input->post('username'),$_SESSION['company_id'],$id);
							if($checkifalredayExitsusernameeditwithoutid > 0){

								$this->session->set_flashdata('error', 'Email Already Exits!!');
								redirect('Controller_Members/edit/'.$id, 'refresh'); 
							}else{

								if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
									$data = array(
										'username' => $this->input->post('username'),
										'password' => $this->input->post('password'),
										'company_id' => $_SESSION['company_id'],
										'department_id' => $this->input->post('department_id'),
										'email' => $this->input->post('email'),
										'firstname' => $this->input->post('fname'),
										'lastname' => $this->input->post('lname'),
										'phone' => $this->input->post('phone'),
										'mobile' => $this->input->post('mobile'),
										'emp_code' => $this->input->post('employee_code'),
										'designation' => $this->input->post('emp_designation'),
										'address' => $this->input->post('address'),
										'notes' => $this->input->post('notes'),
									);
	
									$update = $this->Model_users->edit($data, $id, $this->input->post('groups'));
									if($update == true) {
										$this->session->set_flashdata('success', 'Successfully created');
										redirect('Controller_Members/', 'refresh');
									}
									else {
										$this->session->set_flashdata('error', 'Error occurred!!');
										redirect('Controller_Members/edit/'.$id, 'refresh');
									}
								}
								else {
									$this->form_validation->set_rules('password', 'Password', 'trim|required');
									$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
	
									if($this->form_validation->run() == TRUE) {
	
										//$password = $this->password_hash($this->input->post('password'));
	
										$data = array(
											'username' => $this->input->post('username'),
											'password' => $this->input->post('password'),
											'company_id' =>  $_SESSION['company_id'],
											'department_id' => $this->input->post('department_id'),
											'email' => $this->input->post('email'),
											'firstname' => $this->input->post('fname'),
											'lastname' => $this->input->post('lname'),
											'phone' => $this->input->post('phone'),
											'mobile' => $this->input->post('mobile'),
											'emp_code' => $this->input->post('employee_code'),
											'designation' => $this->input->post('emp_designation'),
											'address' => $this->input->post('address'),
											'notes' => $this->input->post('notes'),
										);
	
										$update = $this->Model_users->edit($data, $id, $this->input->post('groups'));
										if($update == true) {
											$this->session->set_flashdata('success', 'Successfully updated');
											redirect('Controller_Members/', 'refresh');
										}
										else {
											$this->session->set_flashdata('errors', 'Error occurred!!');
											redirect('Controller_Members/edit/'.$id, 'refresh');
										}
									}
									else {
										// false case
										$user_data = $this->Model_users->getUserData($id);
										$groups = $this->Model_users->getUserGroup($id);
								
										$this->data['user_data'] = $user_data;
										$this->data['user_group'] = $groups;
								
										$group_data = $this->Model_groups->getGroupData();
										$company_data = $this->Model_company->getCompanyData();
										$this->data['group_data'] = $group_data;
										$this->data['company_data'] = $company_data;
	
										$this->render_template('members/edit', $this->data);	
									}	
	
								}
								 

							}

						}
					}else{

						$this->session->set_flashdata('error', 'Email Already Exits!!');
					     redirect('Controller_Members/edit/'.$id, 'refresh');  
					}
			       
				}else{

					$this->session->set_flashdata('error', 'Username Already Exits!!');
					redirect('Controller_Members/edit/'.$id, 'refresh');       

				}
			  }
	        }
	        else {
	            // false case
	        	$user_data = $this->Model_users->getUserData($id);
	        	$groups = $this->Model_users->getUserGroup($id);

	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;
	        	
	            $group_data = $this->Model_groups->getGroupData();
	        	$department_data = $this->Model_company->getDepartmentData($id=null,$_SESSION['company_id']);
	        	$this->data['group_data'] = $group_data;
	        	$this->data['department_data'] = $department_data;

				$this->render_template('members/edit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		// if(!in_array('deleteUser', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->Model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('Controller_Members/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('Controller_Members/delete/'.$id, 'refresh');
		        	}

			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('members/delete', $this->data);
			}	
		}
	}

	public function profile()
	{
		// if(!in_array('viewProfile', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$user_id = $this->session->userdata('id');

		$user_data = $this->Model_users->getUserData($user_id);
		$this->data['user_data'] = $user_data;

		$user_group = $this->Model_users->getUserGroup($user_id);
		$this->data['user_group'] = $user_group;

        $this->render_template('members/profile', $this->data);
	}

	public function setting()
	{	
		// if(!in_array('updateSetting', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$id = $this->session->userdata('id');

		if($id) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'username' => $this->input->post('username'),
		        		'email' => $this->input->post('email'),
		        		'firstname' => $this->input->post('fname'),
		        		'lastname' => $this->input->post('lname'),
		        		'phone' => $this->input->post('phone'),
		        		'gender' => $this->input->post('gender'),
		        	);

		        	$update = $this->Model_users->edit($data, $id);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('Controller_Members/setting/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('Controller_Members/setting/', 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'username' => $this->input->post('username'),
			        		'password' => $password,
			        		'email' => $this->input->post('email'),
			        		'firstname' => $this->input->post('fname'),
			        		'lastname' => $this->input->post('lname'),
			        		'phone' => $this->input->post('phone'),
			        		'gender' => $this->input->post('gender'),
			        	);

			        	$update = $this->Model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('Controller_Members/setting/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('Controller_Members/setting/', 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->Model_users->getUserData($id);
			        	$groups = $this->Model_users->getUserGroup($id);

			        	$this->data['user_data'] = $user_data;
			        	$this->data['user_group'] = $groups;

			            $group_data = $this->Model_groups->getGroupData();
			        	$this->data['group_data'] = $group_data;

						$this->render_template('members/setting', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->Model_users->getUserData($id);
	        	$groups = $this->Model_users->getUserGroup($id);

	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;

	            $group_data = $this->Model_groups->getGroupData();
	        	$this->data['group_data'] = $group_data;

				$this->render_template('members/setting', $this->data);	
	        }	
		}
	}


}