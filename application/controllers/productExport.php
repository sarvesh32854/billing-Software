<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class productExport extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');

	}
	public function createXLS()
	{
		// echo 123;die;
		$this->load->library('Excel');
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);
		$table_columns = array('Product Name','Category Name','Product Price','Product Quantity','Product Description','Date Added','Date Updated');

		$column =0;
		foreach ($table_columns as $field) 
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column,1,$field);
			$column++;
		}

		$exportData =$this->product_model->exportAllProducts();
		// echo "<pre>";print_r($exportData);die;

		$excel_row = 2;

		foreach ($exportData as $row) 
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row,$row->p_name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row,$row->categories_id);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row,$row->p_rate);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row,$row->p_qty);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row,$row->p_description);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$row->p_date_added);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,$row->p_date_updated);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="feedbackData.xls"');
		$object_writer->save('php://output');
	}
}