<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customer_model');
	}
	public function index()
	{
		$totalRows = $this->Customer_model->totalRows();
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('page/index'),
			'per_page' => 3,
			'total_rows' =>$totalRows,
		];
		
		$this->pagination->initialize($config);
		$parpage = $thiss->Customer_model->perpage($config['per_page'],$this->uri->segment(3));
	}

}
