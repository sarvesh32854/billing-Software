<?php 
class Dealer_model extends CI_Model
{
	public function checkDealer($data)
	{
		// $number = $this->db->get_where('customer',array('cus_mobile'=>$data['cus_mobile'])->num_row();
		// if()
		// return $this->db->get_where('customer',array('cus_mobile'=>$data['cus_mobile'],'cus_email'=>$data['cus_email']));
	}
	public function addDealer($data)
	{
		return $this->db->insert('dealer',$data);
	}

	public function totalRows()
	{
		return $this->db->get_where('dealer', array('status'=>1))->num_rows();
	}
	public function viewAllDealer($limit,$offset)
	{
		return $this->db->get_where('dealer',array('status'=>1),$limit,$offset)->result();;		
	}
	public function checkDealerById($dealer_id)
	{
		return $this->db->get_where('dealer',array('id'=>$dealer_id))->result_array();
	}
	public function updateDealer($data,$dealer_id)
	{
		$this->db->where('id',$dealer_id);
		return $this->db->update('dealer',$data);
	}
	public function deleteDealer($dealer_id)
	{
		return $this->db->delete('dealer',array('id'=>$dealer_id));
	}
}


?>