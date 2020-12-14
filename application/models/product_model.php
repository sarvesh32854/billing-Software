<?php
class Product_model extends CI_Model
{
	public function checkProduct($data)
	{
		return $this->db->get_where('products',$data)->result_array();
	}

	public function allCategories()
	{

		return $this->db->get_where('categories', array('c_status'=>1));
	}
	public function addProduct($data)
	{
		return $this->db->insert('products',$data);
	}
	public function totalRows()
	{
		return $this->db->get_where('products', array('p_status'=>1))->num_rows();
	}
	public function viewAllProducts($limit,$offset)
	{
		$this->db->select('p.*,c.c_title');
		$this->db->from('products as p');
		$this->db->join('categories as c','c.c_id=p.categories_id','left');
		$this->db->limit($limit,$offset);
		$this->db->where('p.p_status',1);
		$query= $this->db->get();
		return $output = $query->result();
		// echo "<pre>";print_r($output);die;

		// $this->db->select("*");
		// $this->db->from('categories');
		// $this->db->where('c_status',1);
		// $this->db->limit($limit,$offset);
		// $this->db->get();
		
		// return $this->db->get_where('products',array('p_status'=>1),$limit,$offset)->result();;
			
	}
	public function checkProductById($p_id)
	{
		return $this->db->get_where('products',array('p_id'=>$p_id))->result_array();
	}
	public function updateProduct($data,$p_id)
	{
		$this->db->where('p_id',$p_id);
		return $this->db->update('products',$data);
		// echo $this->db->last_query();die;
	}
	public function deleteProduct($p_id)
	{
		return $this->db->delete('products',array('p_id'=>$p_id));
	}

	public function exportAllProducts()
	{
		return $this->db->get_where('products',array('p_status'=>1))->result();
	}
	function fetch_single_details()
	{
		$this->db->select('p.*,c.c_title');
		$this->db->from('products as p');
		$this->db->join('categories as c','c.c_id=p.categories_id','left');
		// $this->db->limit($limit,$offset);
		$this->db->where('p.p_status',1);
		$query= $this->db->get();
		// return $output = $query->result();
		// $output = $query->result();
		// echo "<pre>";print_r($output);die;
		
		// $this->db->where('id',$employee_id);
		// $data = $this->db->get('emp');
		// // print_r($data->result());die;
		$output = '<table>';

		foreach ($query->result() as $row) 
		{
			$output.='<tr>
						<td>'.$row->p_id.'</td>
						<td>'.$row->p_name.'</td>
						<td>'.$row->c_title.'</td>
						<td>'.$row->p_rate.'</td>
						<td>'.$row->p_qty.'</td>
						<td>'.$row->p_description.'</td>
					</tr>';
		}
		$output.='</table>';

		return $output;
	}
}

?>