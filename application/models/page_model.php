<?php 
class Page_model extends CI_Model
{

	public function totalRows()
	{
		return $this->db->get_where('customer', array('cus_status'=>1))->num_rows();
	}
	public function perpage($limit,$offset)
	{// return $this->db->get_where('customer',array('cus_status'=>1),$limit,$offset)->result();;		
		
		$query = $this->db->select("*")
				 ->form('customer')
				 ->where('cus_status',1)
				 ->limit($limit,$offset)
				 ->get();
		return $query->result();
		
	}
	
}


?>