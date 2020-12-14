<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_AllProduct extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->library('pdf');
	}
	// public function index()
	// {
	// 	// echo base_url();die;
	// 	$data['employees_data'] = $this->htmltopdf_model->fetch();
	// 	// echo("<pre>");print_r($data['employees_data']);die;
	// 	$this->load->view('htmltopdf',$data);

	// }
	// public function details()
	// {
	// 	if($this->uri->segment(3))
	// 	{
	// 		$employee_id = $this->uri->segment(3);	
			
	// 		$data['employee_details'] =$this->htmltopdf_model->fetch_single_details($employee_id);
	// 		// echo "<pre>";print_r($data['employee_details']); die;
	// 		$this->load->view('htmltopdf',$data);
	// 	}		
	// }
	public function pdfdetails()
	{
		$data = 'Allproduct'.date("dmy-his");
			
		$html_content = '<h3 align="center">Convert HTML to PDF in codeigniter using Dompdf</h3>';
		$html_content .= $this->product_model->fetch_single_details();
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$data.".pdf",array("Attachment"=>0));			
	}
}
