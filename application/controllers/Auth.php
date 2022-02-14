<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_auth');
		$this->load->model('Model_company');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
		$this->logged_in();
		if($this->input->post()){
			$this->form_validation->set_rules('company', 'Company', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$login_response = 'please fill all required fields';
			}else{
				if($this->input->post('username')=='Superadmin'){
					$checkSuperadmin = $this->Model_auth->SuperadminLogin(trim($this->input->post('username')),trim($this->input->post('password')));
					//print_r($checkSuperadmin);exit;
					if($checkSuperadmin){
						$company_name = $this->Model_auth->get_company($this->input->post('company'));
						$permission = $this->Model_auth->getUserPermission($checkSuperadmin['id']);

						$logged_in_sess = array(
						    'id' => $checkSuperadmin['id'],
						    'company_name' => $company_name['company_name'],
							'company_id' => $company_name['id'],
							'permission' => $permission,
						    'username'  => trim($checkSuperadmin['username']),
							'email'     => $checkSuperadmin['email'],
							'logged_in' => TRUE);
							$this->session->set_userdata($logged_in_sess);
						    redirect('dashboard', 'refresh');

					}else{
						$login_response = 'Invalid Username And Password !';
					}
				}else{
                 		$login = $this->Model_auth->login($this->input->post('company'),$this->input->post('username'),$this->input->post('password'));
						 if($login){
							$company_name = $this->Model_auth->get_company($login['company_id']);
							$permission = $this->Model_auth->getUserPermission($login['id']);
						
							$logged_in_sess = array(
								'id' => $login['id'],
								'company_name' =>  $company_name['company_name'],
								'company_id' => $login['company_id'],
								'username'  => $login['username'],
								'permission' => $permission,
								'email'     => $login['email'],
								'logged_in' => TRUE);
								$this->session->set_userdata($logged_in_sess);
								redirect('dashboard', 'refresh');
						 }else{
							$login_response = 'Invalid Username And Password !';
						 }
				 }
			}

		
			$this->data['company_data'] = $this->Model_company->getCompanyData();
			$this->data['error'] = $login_response;
			$this->load->view('login', $this->data);

		}else{
			$this->data['error'] = '';
			$this->data['company_data'] = $this->Model_company->getCompanyData();
			$this->load->view('login', $this->data);
		}


        // if ($this->form_validation->run() == TRUE) {
        //     // true case

        //    	$email_exists = $this->Model_auth->check_email($this->input->post('username'), $this->input->post('company'));

        //    	if($email_exists == TRUE) {
        //    		$login = $this->Model_auth->login($this->input->post('company'), $this->input->post('username'), $this->input->post('password'));

        //    		if($login) {
        //         $company_name = $this->Model_auth->get_company($login['company_id']);

        //    			$logged_in_sess = array(
        //    				'id' => $login['id'],
        //           'company_name' => $company_name['company_name'],
		// 		          'company_id' => $login['company_id'],
        //           'username'  => $login['username'],
		// 		          'email'     => $login['email'],
		// 		          'logged_in' => TRUE
		// 			);

		// 			$this->session->set_userdata($logged_in_sess);
        //    			redirect('dashboard', 'refresh');
        //    		}
        //    		else {
        //    			$this->data['errors'] = 'Incorrect username/password combination';
        //    			$company_data = $this->Model_company->getCompanyData();
        // 			$this->data['company_data'] = $company_data;
        //    			$this->load->view('login', $this->data);
        //    		}
        //    	}
        //    	else {
        //    		$this->data['errors'] = 'Email does not exists';

        //    		$company_data = $this->Model_company->getCompanyData();
        // 		$this->data['company_data'] = $company_data;
        //    		$this->load->view('login', $this->data);
        //    	}	
        // }
        // else {
        //     // false case
        // 	$company_data = $this->Model_company->getCompanyData();
        // 	$this->data['company_data'] = $company_data;
        //     $this->load->view('login', $this->data);
        // }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
