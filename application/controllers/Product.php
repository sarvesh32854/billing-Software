
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
    	// AllProducts
        parent::__construct();
        $this->load->model('Product_model');
    }
    public function index()
    {
        if($this->session->userdata('u_id'))
        {
            $data['categories'] = $this->Product_model->allCategories();
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('product/newProduct',$data);
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Please Login first to access your Admin Pannel','admin/login');
        }
    }

    public function AddProduct()
    {

        if (admin_Login()) 
        {
            $data['p_name'] = $this->input->post('productName');
            $data['p_rate'] = $this->input->post('productPrice');
            $data['p_qty'] = $this->input->post('productQuantity');
            $data['categories_id'] = $this->input->post('category');
            $data['p_description'] = $this->input->post('ProductDescription');

           
            if (!empty($data['p_name']) && !empty($data['p_rate']) && !empty($data['p_qty']) && !empty($data['categories_id']) && !empty($data['p_description'])) 
            {
                $data['added_by']= get_adminId();
                
                $this->load->model('Product_model');
                $checkProduct = $this->Product_model->checkProduct($data);
                if (sizeof($checkProduct)) 
                {
                    setFlashData('alert-warning','The product already exist.','Product/index');
                } 
                else 
                {
                    $addProduct = $this->Product_model->addProduct($data);
                    // echo $addProduct;die;
                    if ($addProduct) 
                    {
                        setFlashData('alert-success','You have successfully added Product','Product/index');
                    } 
                    else 
                    {
                        setFlashData('alert-danger','You can not add your product right now','Product/index');  
                    }                                      
                }                            
            } 
            else 
            {
                setFlashData('alert-warning','Please Check the required field','Product/index');
            }
            
        } 
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Add your Products','admin/login');
        }
    }
    
    public function AllProducts()
    {
        if (admin_Login()) 
        {
            $totalRows = $this->Product_model->totalRows();
            // echo $totalRows;die;
            $this->load->library('pagination');
            $config = array(
                        'base_url'=>base_url('Product/AllProducts'),
                        'total_rows'=>$totalRows,
                        'per_page' => 8,
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

// echo 123;die;
            $data['products'] = $this->Product_model->viewAllProducts($config['per_page'],$this->uri->segment(3));
            // echo "<pre>"; print_r($data['products']);die;
            $data['link'] = $this->pagination->create_links();
            $this->load->view('admin/header');
            $this->load->view('admin/navtop');
            $this->load->view('admin/navleft');
            $this->load->view('product/allProducts',$data);
            $this->load->view('admin/footer');
        }
        else
        {
            setFlashData('alert-danger','Pleas Login first to view your All Products.','admin/login');
        }
    }

    public function editproduct($p_id)
    {
        // echo $p_id;die;
        if (get_adminId()) 
        {
            if(!empty($p_id) && isset($p_id))
            {
                $data['product'] = $this->Product_model->checkProductById($p_id);
                $data['categories'] = $this->Product_model->allCategories();
                // echo "<pre>";print_r($data['product']);die;
                if (sizeof($data['product']) == 1) 
                {
                    // echo 123;die;
                    $this->load->view('admin/header');
                    $this->load->view('admin/navtop');
                    $this->load->view('admin/navleft');
                    $this->load->view('product/editProduct',$data);
                    $this->load->view('admin/footer');  
                } 
                else 
                {
                   setFlashData('alert-danger','Product not found','product/AllProducts');
                }
                
            }
            else
            {
                setFlashData('alert-danger','Something went wrong.','product/AllProducts');
            }

        } 
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Edit your All Products.','admin/index');
        }
        
    }

    public function updateProduct()
    {
        // echo $this->input->post('productId'); die;
        if (get_adminId()) 
        {
          $p_id = $this->input->post('productId');
          $data['p_name'] = $this->input->post('productName');
          $data['p_rate'] = $this->input->post('productPrice');
          $data['p_qty'] = $this->input->post('productQuantity');
          $data['p_description'] = $this->input->post('ProductDescription');
          $data['categories_id'] = $this->input->post('category');
          // echo "<pre>";print_r($data);die;
          if (!empty($data['p_name']) && isset($data['p_name']) && !empty($data['p_rate']) && isset($data['p_rate']) && !empty($data['p_qty']) && isset($data['p_qty']) && !empty($data['p_description']) && isset($data['p_description']) && !empty($data['categories_id']) && isset($data['categories_id'])) 
          {
             $update = $this->Product_model->updateProduct($data,$p_id); 
             setFlashData('alert-success','Product successfully Updated.','product/AllProducts');
          } 
          else 
          {
             setFlashData('alert-danger','Product Name, Price, Quantity and Description are required.','product/AllProducts');
          }
          
        }  
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Update your All Category.','admin/index');
        }
    }
    public function deleteProduct($p_id)
    {
        // echo get_adminId();die;
        if (get_adminId()) 
        {
            if(!empty($p_id) && is_numeric($p_id) && isset($p_id))
            {
                $this->Product_model->deleteProduct($p_id);
                setFlashData('alert-success','Product Successfully Deleted.','Product/AllProducts');
            }
            else
            {
                setFlashData('alert-warning','Something went wrong','Product/AllProducts');
            }
        }
        else 
        {
            setFlashData('alert-danger','Pleas Login first to Delete your All Products.','admin/index');
        }

    }
   
}

?>