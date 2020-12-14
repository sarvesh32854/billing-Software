<?php
class Excel_model extends CI_Model
{
	public function Allmobilelist()
	{
		$query =  $this->db->select('model_no,mobile_name,company,mobile_category,price')
				->from('mobiles')
				->get();
				// echo "<pre>";print_r($query->result());die;
				return $query->result();
	}
}

?>