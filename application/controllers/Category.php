<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    }
    public function index()
    {
        if($this->session->userdata('u_id'))
        {
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('category/newCategory');
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to access your Admin Pannel','admin/login');
        }
    }

    public function AddCategory()
    {
        if (admin_Login()) 
        {
            $data['c_title'] = $this->input->post('categoryName');
            $data['c_description'] = $this->input->post('description');
            if (!empty($data['c_title']) && !empty($data['c_description'])) 
            {
                $data['added_by']= get_adminId();
                $this->load->model('Category_model');
                $checkCategory = $this->Category_model->checkCategory($data);
                // echo count($checkCategory);die;
                if (sizeof($checkCategory)) 
                {
                    setFlashData('alert-warning','The product already exist.','category/index');
                } 
                else 
                {
                    $addCategory = $this->Category_model->addCategory($data);
                    if ($addCategory) 
                    {
                        setFlashData('alert-success','You have successfully added category','Category/index');
                    } 
                    else 
                    {
                        setFlashData('alert-danger','You can not add your category right now','Category/index');  
                    }                                      
                }                            
            } 
            else 
            {
                setFlashData('alert-warning','Please Check the required field','Category/index');
            }
            
        } 
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Add your Category','admin/login');
        }
    }
    
    public function AllCategory()
    {
        if (admin_Login()) 
        {
            $totalRows = $this->Category_model->totalRows();
            $this->load->library('pagination');
            // $config['base_url'] = base_url('Category/AllCategory');
            // $config['total_rows'] = $totalRows;
            // $config['per_page'] = 2;
            $config = array(
                        'base_url'=>base_url('Category/AllCategory'),
                        'total_rows'=>$totalRows,
                        'per_page' => 3,
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


            $data['categories'] = $this->Category_model->viewAllCategory($config['per_page'],$this->uri->segment(3));
            $data['link'] = $this->pagination->create_links();
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('category/allCategory',$data);
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to view your All Categories.','admin/login');
        }
    }

    public function editCategory($c_id)
    {
       
        if (get_adminId()) 
        {
            if(!empty($c_id) && isset($c_id))
            {
                $data['category'] = $this->Category_model->checkCategoryById($c_id);
                if (sizeof($data['category']) == 1) 
                {
                    // echo 123;die;
                    $this->load->view('admin/header');
                    $this->load->view('admin/navtop');
                    $this->load->view('admin/navleft');
                    $this->load->view('category/editCategory',$data);
                    $this->load->view('admin/footer');  
                } 
                else 
                {
                   setFlashData('alert-danger','Category not found','Category/AllCategory');
                }
                
            }
            else
            {
                setFlashData('alert-danger','Something went wrong.','Category/AllCategory');
            }

        } 
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Edit your All Category.','admin/index');
        }
        
    }

    public function updateCategory()
    {

        if (get_adminId()) 
        {
          $c_id = $this->input->post('CategoryId');
          $data['c_title'] = $this->input->post('categoryName');
          $data['c_description'] = $this->input->post('description');
          if (!empty($data['c_title']) && isset($data['c_title']) && !empty($data['c_description']) && isset($data['c_description'])) 
          {
             $update = $this->Category_model->updateCategory($data,$c_id); 
             setFlashData('alert-success','Category successfully Updated.','Category/AllCategory');
          } 
          else 
          {
             setFlashData('alert-danger','Category Title and Category Description name is required.','Category/AllCategory');
          }
          
        }  
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Update your All Category.','admin/index');
        }
    }
    public function deleteCategory($c_id)
    {
        if (get_adminId()) 
        {
            if(!empty($c_id) && is_numeric($c_id) && isset($c_id))
            {
                $this->Category_model->deleteCategory($c_id);
                setFlashData('alert-success','Category Successfully Deleted.','Category/AllCategory');
            }
            else
            {
                setFlashData('alert-warning','Something went wrong','Category/AllCategory');
            }
        }
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Delete your All Category.','admin/index');
        }

    }
}

?>