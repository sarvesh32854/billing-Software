<?php 
class Admin_Model extends CI_Model
{
    public function Check_admin($data)
    {
        return $this->db->get_where('users',$data)->result_array();
    }
}
?>