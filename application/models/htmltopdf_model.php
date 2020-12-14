<?php

class htmltopdf_model extends CI_Model
{
	function fetch()
	{
		$this->db->order_by('id','DESC');
		return $this->db->get('emp');
	}
	function get_single_details($employee_id)
	{
		$this->db->where('id',$id);
		$data = $this->db->get('emp');
		
	}
	function fetch_single_details($employee_id)
	{
		$this->db->where('id',$employee_id);
		$data = $this->db->get('emp');
		// print_r($data->result());die;
		$output = '<table>';

		foreach ($data->result() as $row) 
		{
			$output.='<tr>
						<td>'.$row->id.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->skills.'</td>
						<td>'.$row->address.'</td>
						<td>'.$row->designation.'</td>
						<td>'.$row->age.'</td>
					</tr>';
		}
		$output.='</table>';

		return $output;
	}
}

?>