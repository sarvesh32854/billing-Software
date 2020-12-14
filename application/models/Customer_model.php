<?php 
class Customer_model extends CI_Model
{
	public function checkCustomer($data)
	{
		// $number = $this->db->get_where('customer',array('cus_mobile'=>$data['cus_mobile'])->num_row();
		// if()
		// return $this->db->get_where('customer',array('cus_mobile'=>$data['cus_mobile'],'cus_email'=>$data['cus_email']));
	}
	public function addCustomer($data)
	{
		return $this->db->insert('customer',$data);
	}

	public function totalRows()
	{
		return $this->db->get_where('customer', array('cus_status'=>1))->num_rows();
	}
	public function viewAllCustomer($limit,$offset)
	{
		return $this->db->get_where('customer',array('cus_status'=>1),$limit,$offset)->result();;		
	}
	public function checkCustomerById($cus_id)
	{
		return $this->db->get_where('customer',array('cus_id'=>$cus_id))->result_array();
	}
	public function updateCustomer($data,$cus_id)
	{
		$this->db->where('cus_id',$cus_id);
		return $this->db->update('customer',$data);
	}
	public function deleteCustomer($cus_id)
	{
		return $this->db->delete('customer',array('cus_id'=>$cus_id));
	}
}


?>