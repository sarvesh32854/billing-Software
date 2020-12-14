<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customer_model');
	}
    public function index()
	{
		if($this->session->userdata('u_id'))
        {

            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('customer/newCustomer');
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to access your Admin Pannel','admin/login');
        }
	}
	public function AddCustomer()
	{
	    if(admin_Login())
	    {
	    	$this->form_validation->set_rules('firstName','First Name','required|alpha');
	    	$this->form_validation->set_rules('lastName','Last Name','required|alpha');
	    	$this->form_validation->set_rules('mobile','Conatact Number','required|numeric|min_length[10]|max_length[10]');
	    	$this->form_validation->set_rules('email','Email','required|is_unique[customer.cus_email]|valid_email');
	    	$this->form_validation->set_rules('address','Address','required');
	    	if ($this->form_validation->run() == FALSE)
            {
                setFlashData('alert-warning','Please Check the required Fields.','Customer/index');
            }
            else
            { 
            	$data['cus_firstName'] = $this->input->post('firstName');
			    $data['cus_laststName'] = $this->input->post('lastName');
			    $data['cus_mobile'] = $this->input->post('mobile');
			    $data['cus_email'] = $this->input->post('email');
			    $data['cus_address'] = $this->input->post('address');
            	
            	if (!empty($data['cus_firstName']) && !empty($data['cus_laststName']) && !empty($data['cus_mobile']) && !empty($data['cus_email']) && !empty($data['cus_address'])) 
            	{
	            	$data['added_by'] = get_adminId();
	            	
			    	$checkCustomer = $this->Customer_model->checkCustomer($data);
			    	// echo $checkCustomer;die;
			    	if (sizeof($checkCustomer)) 
			    	{
			    		setFlashData('alert-warning','Customer Already Exist.','Customer/index');
			    	} 
			    	else 
			    	{
			    		$addCustomer = $this->Customer_model->addCustomer($data);
			    		if ($addCustomer) 
			    		{
			    			setFlashData('alert-success','You have successfully added customer.','Customer/index');
			    		} 
			    		else 
			    		{
			    			setFlashData('alert-danger','You can not added customer right now.','Customer/index');
			    		}			    		
			    	}			    	
            	} 
            	else 
            	{
            		setFlashData('alert-warning','Something is Wrong','Customer/index');
            	}            	
            }
	    }
	    else
        {
            setFlashData('alert-danger','Please Login first to Add new Customer.','admin/login');
        }
	}
    public function AllCustomers()
    {
        if (admin_Login()) 
        {
            $totalRows = $this->Customer_model->totalRows();
            $this->load->library('pagination');
            $config = array(
                            'base_url'=>base_url('Customer/AllCustomers'),
                            'total_rows'=>$totalRows,
                            'per_page' => 3,
                            // it is used for where pagination is start( <ul> )
                            'full_tag_open' => '<ul class="pagination">',
                            'full_tag_close' => '</ul>',

                            'first_tag_open' =>'<li>',
                            'first_tag_close' =>'</li>',

                            'last_tag_open' =>'<li>',
                            'last_tag_close' =>'</li>',
                            // it is used for next link ( < )
                            'next_tag_open' => '<li>', 
                            'next_tag_close' => '</li>',
                            // it is used for previous link ( < )
                            'prev_tag_open' =>'<li>', 
                            'prev_tag_close' =>'</li>',
                            // it is used for pagination number link such as 1 2 3 etc
                            'num_tag_open' => '<li>', 
                            'num_tag_close' => '</li>',
                            // it is used for which pagination number should be active.
                            'cur_tag_open' => '<li class="active"><a>', 
                            'cur_tag_close' => '</a></li>'                          

                           );
            
            $this->pagination->initialize($config);
            $data['customers'] = $this->Customer_model->viewAllCustomer($config['per_page'],$this->uri->segment(3));
            $data['link'] = $this->pagination->create_links();
           // echo "<pre>";print_r($data);die;
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('customer/allCustomers',$data);
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to view your All Customers.','admin/login');
        }
    }

	// public function AllCustomers()
 //    {
 //        if (admin_Login()) 
 //        {
 //            $totalRows = $this->Customer_model->totalRows();
 //            $this->load->library('pagination');
 //            $config = array(
 //                        	'base_url'=>base_url('Customer/AllCustomers'),
 //                        	'total_rows'=>$totalRows,
 //                        	'per_page' => 3,
 //                        	'full_tag_open'=>'<ul class="pagination">',
 //                        	'full_tag_close'=>'</ul>',
 //                        	'next_tag_open'=>'<li>',
 //                        	'next_tag_close'=>'</li>',
 //                        	'prev_tag_open'=>'<li>',
 //                        	'prev_tag_close'=>'</li>',
 //                        	'num_tag_open'=>'<li>',
 //                        	'num_tag_close'=>'</li>',
 //                        	'cur_tag_open'=>'<li class="active"></li>',
 //                        	'cur_tag_close'=>'</li>',
                        	

 //            			   );
            
 //            $this->pagination->initialize($config);
 //            $data['customers'] = $this->Customer_model->viewAllCustomer($config['per_page'],$this->uri->segment(3));
 //            $data['link'] = $this->pagination->create_links();
 //           // echo "<pre>";print_r($data);die;
 //            $this->load->view('admin/header');
 //            $this->load->view('admin/navtop');
 //            $this->load->view('admin/navleft');
 //            $this->load->view('customer/allCustomers',$data);
 //            $this->load->view('admin/footer');
 //        }
 //        else
 //        {
 //            setFlashData('alert-danger','Pleas Login first to view your All Customers.','admin/login');
 //        }
 //    }

     public function editCustomer($cus_id)
    {
    	// echo $cus_id;die;
       
        if (get_adminId()) 
        {
            if(!empty($cus_id) && isset($cus_id))
            {
                $data['customer'] = $this->Customer_model->checkCustomerById($cus_id);
                if (sizeof($data['customer']) == 1) 
                {
                    // echo 123;die;
                    $this->load->view('admin/header');
                    $this->load->view('admin/navtop');
                    $this->load->view('admin/navleft');
                    $this->load->view('customer/editCustomer',$data);
                    $this->load->view('admin/footer');  
                } 
                else 
                {
                   setFlashData('alert-danger','Customer not found','Customer/AllCustomers');
                }
                
            }
            else
            {
                setFlashData('alert-danger','Something went wrong.','Customer/AllCustomers');
            }

        } 
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Edit your All Customers.','admin/index');
        }
        
    }

     public function updateCustomer()
    {

        if (get_adminId()) 
        {
          $cus_id = $this->input->post('CustomerId');
          $data['cus_firstName'] = $this->input->post('firstName');
          $data['cus_laststName'] = $this->input->post('lastName');
          $data['cus_mobile'] = $this->input->post('mobile');
          $data['cus_email'] = $this->input->post('email');
          $data['cus_address'] = $this->input->post('address');

          if (!empty($data['cus_firstName']) && isset($data['cus_firstName']) && !empty($data['cus_laststName']) && isset($data['cus_laststName']) && !empty($data['cus_mobile']) && isset($data['cus_mobile']) && !empty($data['cus_email']) && isset($data['cus_email']) && !empty($data['cus_address']) && isset($data['cus_address'])) 
          {
             $update = $this->Customer_model->updateCustomer($data,$cus_id); 
             setFlashData('alert-success','Customer successfully Updated.','Customer/AllCustomers');
          } 
          else 
          {
             setFlashData('alert-danger','All fields is required.','Customer/AllCustomers');
          }
          
        }  
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Update your All Customer.','admin/index');
        }
    }
    public function deleteCustomer($cus_id)
    {
        if (get_adminId()) 
        {
            if(!empty($cus_id) && is_numeric($cus_id) && isset($cus_id))
            {
                $this->Customer_model->deleteCustomer($cus_id);
                setFlashData('alert-success','Customer Successfully Deleted.','Customer/AllCustomers');
            }
            else
            {
                setFlashData('alert-warning','Something went wrong','Customer/AllCustomers');
            }
        }
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Delete your All Customers.','admin/index');
        }

    }
}