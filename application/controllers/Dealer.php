<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dealer_model');
	}
    public function index()
	{
		if($this->session->userdata('u_id'))
        {

            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('dealer/newDealer');
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to access your Admin Pannel','admin/login');
        }
	}
	public function AddDealer()
	{
		// $data['first_name'] = $this->input->post('firstName');
		// 	    $data['last_name'] = $this->input->post('lastName');
		// 	    $data['contact'] = $this->input->post('mobile');
		// 	    $data['email'] = $this->input->post('email');
		// 	    $data['address'] = $this->input->post('address');
		// 	    echo "<pre>";print_r($data);die();
	    if(admin_Login())
	    {
	    	$this->form_validation->set_rules('firstName','First Name','required|alpha');
	    	$this->form_validation->set_rules('lastName','Last Name','required|alpha');
	    	$this->form_validation->set_rules('mobile','Conatact Number','required|numeric|min_length[10]|max_length[10]');
	    	$this->form_validation->set_rules('email','Email','required|is_unique[customer.cus_email]|valid_email');
	    	$this->form_validation->set_rules('address','Address','required');
	    	if ($this->form_validation->run() == FALSE)
            {
                setFlashData('alert-warning','Please Check the required Fields.','Dealer/index');
            }
            else
            { 
            	$data['first_name'] = $this->input->post('firstName');
			    $data['last_name'] = $this->input->post('lastName');
			    $data['contact'] = $this->input->post('mobile');
			    $data['email'] = $this->input->post('email');
			    $data['address'] = $this->input->post('address');
            	
            	if (!empty($data['first_name']) && !empty($data['last_name']) && !empty($data['contact']) && !empty($data['email']) && !empty($data['address'])) 
            	{
	            	$data['added_by'] = get_adminId();
	            	
			    	$checkDealer = $this->Dealer_model->checkDealer($data);
			    	// echo $checkDealer;die;
			    	if (sizeof($checkDealer)) 
			    	{
			    		setFlashData('alert-warning','Dealer Already Exist.','Dealer/index');
			    	} 
			    	else 
			    	{
			    		$addDealer = $this->Dealer_model->addDealer($data);
			    		if ($addDealer) 
			    		{
			    			setFlashData('alert-success','You have successfully added Dealer.','Dealer/index');
			    		} 
			    		else 
			    		{
			    			setFlashData('alert-danger','You can not added Dealer right now.','Dealer/index');
			    		}			    		
			    	}			    	
            	} 
            	else 
            	{
            		setFlashData('alert-warning','Something is Wrong','Dealer/index');
            	}            	
            }
	    }
	    else
        {
            setFlashData('alert-danger','Please Login first to Add new Dealer.','admin/login');
        }
	}

	public function AllDealers()
    {
        if (admin_Login()) 
        {
            $totalRows = $this->Dealer_model->totalRows();
            $this->load->library('pagination');
            $config = array(
                        	'base_url'=>base_url('Dealer/AllDealers'),
                        	'total_rows'=>$totalRows,
                        	'per_page' => 3,
                        	'full_tag_open'=>'<ul class="pagination">',
                        	'full_tag_close'=>'</ul>',
                        	'next_tag_open'=>'<li>',
                        	'next_tag_close'=>'</li>',
                        	'prev_tag_open'=>'<li>',
                        	'prev_tag_close'=>'</li>',
                        	'num_tag_open'=>'<li>',
                        	'num_tag_close'=>'</li>',
                        	'cur_tag_open'=>'<li class="active"><a>',
                        	'cur_tag_close'=>'</a></li>',
                        	

            			   );
            
            $this->pagination->initialize($config);
            $data['dealers'] = $this->Dealer_model->viewAllDealer($config['per_page'],$this->uri->segment(3));
            $data['link'] = $this->pagination->create_links();
           // echo "<pre>";print_r($data);die;
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('dealer/allDealers',$data);
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to view your All Dealers.','admin/login');
        }
    }

     public function editDealer($dealer_id)
    {
    	// echo $dealer_id;die;
       
        if (get_adminId()) 
        {
            if(!empty($dealer_id) && isset($dealer_id))
            {
                $data['dealer'] = $this->Dealer_model->checkDealerById($dealer_id);
                // echo sizeof($data['dealer']);die;
                if (sizeof($data['dealer']) == 1) 
                {
                    // echo 123;die;
                    $this->load->view('admin/header');
                    $this->load->view('admin/navtop');
                    $this->load->view('admin/navleft');
                    $this->load->view('dealer/editDealer',$data);
                    $this->load->view('admin/footer');  
                } 
                else 
                {
                   setFlashData('alert-danger','Dealer not found','Dealer/AllDealers');
                }
                
            }
            else
            {
                setFlashData('alert-danger','Something went wrong.','Dealer/AllDealers');
            }

        } 
        else 
        {
            setFlashData('alert-danger','Please Login first to Edit your All Dealers.','admin/index');
        }
        
    }

     public function updateDealer()
    {

        if (get_adminId()) 
        {
          $dealer_id = $this->input->post('DealerId');
          $data['first_name'] = $this->input->post('firstName');
          $data['last_name'] = $this->input->post('lastName');
          $data['contact'] = $this->input->post('mobile');
          $data['email'] = $this->input->post('email');
          $data['address'] = $this->input->post('address');

          if (!empty($data['first_name']) && isset($data['first_name']) && !empty($data['last_name']) && isset($data['last_name']) && !empty($data['contact']) && isset($data['contact']) && !empty($data['email']) && isset($data['email']) && !empty($data['address']) && isset($data['address'])) 
          {
             $update = $this->Dealer_model->updateDealer($data,$dealer_id); 
             setFlashData('alert-success','Dealer successfully Updated.','Dealer/AllDealers');
          } 
          else 
          {
             setFlashData('alert-danger','All fields is required.','Dealer/AllDealers');
          }
          
        }  
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Update your All Dealers.','admin/index');
        }
    }
    public function deleteDealer($dealer_id)
    {
    	// echo $dealer_id;die;
        if (get_adminId()) 
        {
            if(!empty($dealer_id) && is_numeric($dealer_id) && isset($dealer_id))
            {
                $this->Dealer_model->deleteDealer($dealer_id);
                setFlashData('alert-success','Dealer Successfully Deleted.','Dealer/AllDealers');
            }
            else
            {
                setFlashData('alert-warning','Something went wrong','Dealer/AllDealers');
            }
        }
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Delete your All Dealers.','admin/index');
        }

    }
}