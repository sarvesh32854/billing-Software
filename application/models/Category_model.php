<?php
class Category_model extends CI_Model
{
	public function checkCategory($data)
	{
		return $this->db->get_where('categories',$data)->result_array();
	}
	public function addCategory($data)
	{
		return $this->db->insert('categories',$data);
	}
	public function totalRows()
	{
		return $this->db->get_where('categories', array('c_status'=>1))->num_rows();
	}
	public function viewAllCategory($limit,$offset)
	{
		// $this->db->select("*");
		// $this->db->from('categories');
		// $this->db->where('c_status',1);
		// $this->db->limit($limit,$offset);
		// $this->db->get();
		
		return $this->db->get_where('categories',array('c_status'=>1),$limit,$offset)->result();;
			
	}
	public function checkCategoryById($c_id)
	{
		return $this->db->get_where('categories',array('c_id'=>$c_id))->result_array();
	}
	public function updateCategory($data,$c_id)
	{
		$this->db->where('c_id',$c_id);
		return $this->db->update('categories',$data);
		// echo $this->db->last_query();die;
	}
	public function deleteCategory($c_id)
	{
		return $this->db->delete('categories',array('c_id'=>$c_id));
	}
}

?>