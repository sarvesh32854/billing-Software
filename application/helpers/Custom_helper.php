<?php
function setFlashData($class,$message,$url)
{   
    $CI = get_instance();
    $CI->load->library('session');
    $CI->session->set_flashdata('class',$class);
    $CI->session->set_flashdata('message',$message);
    redirect($url);
    
}

function admin_Login()
{
    $CI = get_instance();
    $CI->load->library('session');
    if ($CI->session->userdata('u_id')) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function get_adminId()
{
    $CI = get_instance();
    $CI->load->library('session');
    if ($CI->session->userdata('u_id')) {
        return $CI->session->userdata('u_id');
    }
    else {
        return FALSE;
    }
}
?>