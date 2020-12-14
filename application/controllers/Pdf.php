<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller
{
    public function __construct()
    {
    	// AllProducts
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('pdf');
    }
   public function index()
   {
    echo 123;
   }
   
}

?>