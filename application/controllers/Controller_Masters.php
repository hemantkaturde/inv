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

    // public function fetchDepartmentData(){

    //     $user_data = $this->Model_masters->getDepartmentData($_SESSION['company_id']);
	// 	$result = array();
	// 	foreach ($user_data as $k => $v) {

	// 		$result[$k]['user_info'] = $v;

	// 		$group = $this->Model_users->getUserGroup($v['id']);
	// 		$result[$k]['user_group'] = $group;
	// 	}
	// 	$this->data['user_data'] = $result;

	// 	$this->render_template('masters/department/index', $this->data);
    // }

}