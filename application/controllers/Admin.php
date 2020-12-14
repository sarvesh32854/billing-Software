<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function demo()
	{
	    $this->session->unset_userdata('u_id');
// 	    $this->load->helper('Custom');
// 	    get_adminId();
	}
    public function index()
	{
        if($this->session->userdata('u_id'))
        {
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('admin/mainHome');
            $this->load->view('admin/footer');
        }
        else 
        {
            setFlashData('alert-danger','Pleas Login first to access your Admin Pannel','admin/login');
        }
		
		
	}
	public function login()
	{
	    if($this->session->userdata('u_id'))
	    {
	       redirect('admin/index');
	    }
	    else 
	    {
	        $this->load->view('admin/login');
	    }
	}
	
	public function Check_admin()
	{
	   $data['u_email'] = $this->input->post('email');
	   $data['u_password'] = $this->input->post('password'); 
	   if(!empty($data['u_email'])&& !empty($data['u_password']))
	   {
	       $this->load->model('Admin_model');
	       $adminData = $this->Admin_model->Check_admin($data);
	       
	       if(count($adminData)== 1)
	       {
	           $for_session = array(
	               'u_id'=>$adminData[0]['u_id'],
	               'u_first_name'=>$adminData[0]['u_first_name'],
	               'u_email'=>$adminData[0]['u_email']
	             );  
	           $this->session->set_userdata($for_session);
	           if($this->session->userdata('u_id'))
	           {
	               redirect('admin/index');
	           }
	           else {
	               echo "session is not created";
	           }
	           
	       }
	       else{
	           setFlashData('alert-warning','Email or Password is not matched Please Check Your Email and Password','admin/login');
	           
	       }
	           
	   }
	   else 
	   {
	       setFlashData('alert-warning','Please check the required Filed','admin/login');
	       redirect('admin/login','refresh');
	   }
	   
	    
	}
	
	public function logout(){
	    if($this->session->userdata('u_id'))
	    {
	        $this->session->set_userdata('u_id','');
	        setFlashData('alert-warning','You have Succesfully Logged out','admin/login');
	    }
	    else
	    {
	        setFlashData('alert-warning','Please Log in now','admin/login');
	    }
	}
	
	
	
	
	
	
	
	
	
	
	
}
