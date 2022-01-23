<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Company extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Company';

		$this->load->model('Model_company');
	}

    public function index()
    {
        // if(!in_array('viewCompany', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $this->render_template('company/index', $this->data);
    }

    public function fetchCompanyData()
    {
        $result = array('data' => array());

        $data = $this->Model_company->getCompanyData();
        foreach ($data as $key => $value) {

            // $store_data = $this->model_stores->getStoresData($value['store_id']);
            // button
            $buttons = '';
            //if(in_array('updateCompany', $this->permission)) {
                $buttons .= ' <a href="'.base_url('Controller_Company/attachment/'.$value['id']).'" class="btn btn-info btn-sm"><i class="fa fa-upload"></i></a>';
                $buttons .= ' <a href="'.base_url('Controller_Company/update/'.$value['id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>';
            // }

            // if(in_array('deleteCompany', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            // }
            if ($value['logo']) {
                $img = '<img src="'.base_url($value['logo']).'" alt="'.$value['company_name'].'" class="img-circle" width="50" height="50" />';
            }
            else
            {
                $img = "";
            }
            $result['data'][$key] = array(
                $img,
                $value['company_name'],
                $value['phone'],
                $value['email1'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }


    public function create()
    {
        // if(!in_array('createCompany', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $this->form_validation->set_rules('company_name', 'Company name', 'trim|required|is_unique[company.company_name]');
    
        if ($this->form_validation->run() == TRUE) {
            // true case
            $upload_image = $this->upload_image();

            $data = array(
                'company_name' => $this->input->post('company_name'),
                'mobile' => $this->input->post('phone'),
                'phone' => $this->input->post('tel_no'),
                'email1' => $this->input->post('company_email1'),
                'email2' => $this->input->post('company_email2'),
                'address' => $this->input->post('address'),
                'pan_no' => $this->input->post('pan_no'),
                'gst_no' => $this->input->post('gst_no'),
                'factory_address' => $this->input->post('factory_address'),
                'notes' => $this->input->post('notes'),
                'prefix' => $this->input->post('prefix'),
                'count' => $this->input->post('count'),
                'sufix' => $this->input->post('sufix'),
                'logo' => $upload_image
            );

            $create = $this->Model_company->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('Controller_Company/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Controller_Company/create', 'refresh');
            }
        }
        else {
            // false case
            $this->render_template('company/create', $this->data);
        }   
    }

    public function upload_image()
    {
        // assets/images/cust_attach
        $config['upload_path'] = 'assets/images/company_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000000000';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('company_logo'))
        {
            $error = $config['upload_path'].'/5fc5cf759483c.png';
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['company_logo']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }
    /* 
    * It redirects to the company page and displays all the company information
    * It also updates the company information into the database if the 
    * validation for each input field is successfully valid
    */
	public function update($id)
	{  
        // if(!in_array('updateCompany', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		
        if(!$id) {
            redirect('dashboard', 'refresh');
        }
        if ($this->form_validation->run() == TRUE) {
            // true case
            $name = $this->input->post('company_name');
            $comp_data = $this->Model_company->getcompanydata_isunique($id, $name);
            
            if($comp_data > 0)
            {
                $this->session->set_flashdata('error', 'Company name is already exist');
                redirect('Controller_Company/update/'.$id, 'refresh');

            }else{

            	$data = array(
            		'company_name' => $this->input->post('company_name'),
            		'mobile' => $this->input->post('phone'),
            		'phone' => $this->input->post('tel_no'),
                    'email1' => $this->input->post('company_email1'),
                    'email2' => $this->input->post('company_email2'),
            		'address' => $this->input->post('address'),
            		'pan_no' => $this->input->post('pan_no'),
            		'factory_address' => $this->input->post('factory_address'),
                    'notes' => $this->input->post('notes'),
                    'prefix' => $this->input->post('prefix'),
                    'count' => $this->input->post('count'),
                    'sufix' => $this->input->post('sufix')
            	);

                if($_FILES['company_logo']['size'] > 0) {
                            $upload_image = $this->upload_image();
                            $upload_image = array('logo' => $upload_image);
                            
                            $this->Model_company->update($upload_image, $id);
                        }

            	$update = $this->Model_company->update($data, $id);
            	if($update == true) {
            		$this->session->set_flashdata('success', 'Successfully updated');
            		redirect('Controller_Company/', 'refresh');
            	}
            	else {
            		$this->session->set_flashdata('errors', 'Error occurred!!');
            		redirect('Controller_Company/index', 'refresh');
            	}

            }
        }
        else {

            // false case
        	$this->data['company_data'] = $this->Model_company->getCompanyData($id);
			$this->render_template('company/edit', $this->data);			
        }		
	}

    public function remove()
    {
        // if(!in_array('deleteCompany', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        
        $id = $this->input->post('id');

        $response = array();
        if($id) {
            $delete = $this->Model_company->remove($id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    // === ADD ATTACHMENT TRANSACTION

    public function attachment($id = null)
    {
        if($id)
        {
            // print_r($id);
            $this->data['id'] = $id;
            $this->render_template('company/company_attachment', $this->data);
        }
    }

    public function fetchCompanyAttachments($id = null)
    {
        $result = array('data' => array());
        $data = $this->Model_company->getCompanyAttachments($id);
        // print_r($data);

        foreach ($data['comp_trans'] as $key => $value) {
                $buttons = '';
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeTransFunc('.$value['id'].')" data-toggle="modal" data-target="#removeTransModal"><i class="fa fa-trash"></i></button>';
            
                if(!empty($value['attach_img']))
                {
                    $substring = substr($value['attach_img'], strpos($value['attach_img'], '_image/')+7);
                }
                else
                {
                    $substring = "";
                }
                // $attachments = "";
                $attachments = '<a href="'.base_url().$value['attach_img'].'" target="_blank" download><i class="fa fa-eye"></i></a>';
       
                $result['data'][$key] = array(
                    $value['attach_name'],
                    // $value['attach_img'],
                    $substring,
                    $attachments,
                    $buttons
                );
        } // /foreach
        
        echo json_encode($result);
    }
    
    public function add_attachment()
    {
        $upload_image = $this->upload_trans_image();

        $comp_id = $this->input->post('id');
        $attach_name = $this->input->post('attach_name');

        $response = array();
        if($comp_id) {
            $data = array(
                'comp_id' => $comp_id,
                'attach_name' => $attach_name,
                'attach_img' => $upload_image
            );
            $insert_trans = $this->Model_company->create_trans($data);
            if($insert_trans == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully Uploaded"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    public function upload_trans_image()
    {
        // assets/images/cust_attach
        $config['upload_path'] = 'assets/images/company_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('attach_img'))
        {
            $error = '';
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['attach_img']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    public function removeTrans()
    {        
        $id = $this->input->post('id');

        $response = array();
        if($id) {
            $delete = $this->Model_company->removeTrans($id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    // ===============================
}