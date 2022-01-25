<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Masters extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Mastesr';

		$this->load->model('Model_masters');
        
		$this->load->model('Model_users');
	}


    public function index()
	{
		// $result = $this->Model_brands->getBrandData();
		// $this->data['results'] = $result;
		// $this->render_template('masters/index', $this->data);
	}

	public function department(){

		 $dapartdata_data = $this->Model_masters->getDepartmentData($_SESSION['company_id']);
		 $result = array();
		 foreach ($dapartdata_data as $k => $v) {
 
			 $result[$k]['user_info'] = $v;
 
			 //$group = $this->Model_users->getUserGroup($v['id']);
			 //$result[$k]['user_group'] = $group;
		 }
		 $this->data['depart_data'] = $result;
	    
		 $this->render_template('masters/department/index', $this->data);
	}


	public function createdepartment(){

		$post_submit = $this->input->post();
		if($post_submit){
			$this->form_validation->set_rules('department', 'Department', 'trim|required|is_unique[company.company_name]');

			if($this->form_validation->run() == TRUE)
            {
				$check_department = $this->Model_masters->CheckdepartmentAlreadyExist(trim($this->input->post('department')),$_SESSION['company_id']);
				
				if($check_department){
				   $this->session->set_flashdata('error', 'Department Alreday Exits!');
				  redirect('Controller_Masters/createdepartment', 'refresh');

				}else{
					$department = $this->input->post('department');
					$data = array(
						'department' => $this->input->post('department'),
						'company_id' => $_SESSION['company_id']
					);
					
					$create = $this->Model_masters->departmentCreate($data);

					if($create == true) {
						$this->session->set_flashdata('success', 'Successfully created');
						redirect('Controller_Masters/department', 'refresh');
					}
					else {
						$this->session->set_flashdata('error', 'Error occurred!!');
						redirect('Controller_Masters/createdepartment', 'refresh');
					}
		    	}
			}

		}else{
			$this->render_template('masters/department/create', $this->data);
		}
   }

   public function delete($id)
	{
	
		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->Model_masters->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('Controller_Masters/department', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('Controller_Masters/department'.$id, 'refresh');
		        	}
			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('masters/department/index', $this->data);
			}	
		}
	}

	public function edit($id){

		
		
	}

}