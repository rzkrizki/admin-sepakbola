<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('dd')) {
  function dd($var)
  {

    if (is_object($var) ||   is_array($var)) {
      echo '<pre>';
      print_r($var);
      echo '</pre>';
    } else {
      echo $var;
    }
    exit();
  }
}


if (!function_exists('list_bulan')){
  function list_bulan(){
    $bulan = array(
              1 => "January",
              2 => "February",
              3 => "March",
              4 => "April",
              5 => "May",
              6 => "June",
              7 => "July",
              8 => "August",
              9 => "September",
              10 => "October",
              11 => "November",
              12 => "Desember",
            );
    return $bulan;
  }
}

if(!function_exists('init_view')){
  function init_view($view, $data = array()){
    $CI = &get_instance();
    $CI->load->view('layout/head.php');
    $CI->load->view('layout/navbar.php',$data);
    $CI->load->view('layout/sidebar.php',$data);
    $CI->load->view($view, $data);
    $CI->load->view('layout/footer.php');
  }
}

if (!function_exists('set_active_menu')) {
  function set_active_menu($menu){
    $CI = &get_instance();
    $CI->session->set_userdata('menu_active', $menu);
  }
}