<?php

include_once("../../class/mod_functions.php");
$permission_object = new Mod_functions();

$logged_user_information = $_SESSION["staff"];
$role_id = $logged_user_information['fk_role_id'];

$manager_arr = [];//main array


$manager_arr[] = array('link'=>'dash_main.php', 'label'=>'Dashboard', 'icon'=>'fa fa-fw fa-user-circle');

$sub_menu_arr = []; //sub menu array


if($permission_object->check_permision_for_currnt_user("Add/Edit Product")){
    $sub_menu_arr[]= array('link'=>'add_product.php', 'label'=>'Add/Edit Product');
}
if($permission_object->check_permision_for_currnt_user("Add/Edit Product category")){
    $sub_menu_arr[]= array('link'=>'add_product_cat.php', 'label'=>'Add/Edit Product category');
}
if($permission_object->check_permision_for_currnt_user("Load Products")){
    $sub_menu_arr[]= array('link'=>'add_product_load_list.php', 'label'=>'Load Products');
}
if($permission_object->check_permision_for_currnt_user("Unload Product")){
    $sub_menu_arr[]= array('link'=>'add_product_unload_list.php', 'label'=>'Unload Product');
}

// if($permission_object->check_permision_for_currnt_user("Reorder List")){
    $sub_menu_arr[]= array('link'=>'re_order_table.php', 'label'=>'Reorder list');
// }

// if($role_id==1 || $role_id==2 || $role_id == 5){
    $manager_arr[] = array('label' =>'Product', 'sub_menu' => $sub_menu_arr, 'icon'=>'fab fa-fw fa-wpforms');
// }
//if_page_access_by_role("Add Sales")
//Sale navigation
$sub_menu_arr = [];
// if($permission_object->check_permision_for_currnt_user("Add Sales")){
    $sub_menu_arr[]= array('link'=>'add_sales_list.php', 'label'=>'Add Sales');
// }
// if($permission_object->check_permision_for_currnt_user("Sales List")){
    $sub_menu_arr[]= array('link'=>'sales_details.php', 'label'=>'Sales List');
// }
      $sub_menu_arr[]= array('link'=>'sales_list.php', 'label'=>'Customer Invoice');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Sales', 'sub_menu' => $sub_menu_arr, 'icon'=>'fas fa-fw fa-table');
// }

//Order navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_order_list.php', 'label'=>'Supplier Order');
$sub_menu_arr[]= array('link'=>'add_shop_orderlt.php', 'label'=>'Shop Order');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Orders', 'sub_menu' => $sub_menu_arr, 'icon'=>'fas fa-fw fa-chart-pie');
// }

//GRN navigation
$sub_menu_arr = [];
if($permission_object->check_permision_for_currnt_user("Add GRN")){
    $sub_menu_arr[]= array('link'=>'add_grn_list.php', 'label'=>'Add GRN');
}
$sub_menu_arr[]= array('link'=>'grn_list.php', 'label'=>'GRN List');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'GRN', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-file-invoice-dollar');
// }

//Stock navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_stock_report.php', 'label'=>'View Stock Report');


$manager_arr[] = array('label' =>'Stock', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-box-archive');

//Supplier navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_manufacture.php', 'label'=>'Add Supplier');


// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Supplier', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-users');
// }

//Customer navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_customer.php', 'label'=>'Add Customer');

if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Customer', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-user');
}

//Staff navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_staff.php', 'label'=>'Add/Edit Staff');
$sub_menu_arr[]= array('link'=>'add_staff_role.php', 'label'=>'Add/Edit Staff Role');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Staff', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-person');
// }

//Store navigation
$sub_menu_arr = [] ;

$sub_menu_arr[]= array('link'=>'add_root.php', 'label'=> 'Add Root');
$sub_menu_arr[]= array('link'=>'add_store.php', 'label'=>'Add Store');  

$manager_arr[] = array('label' =>'Store', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-store');
//  $manager_arr[] = array('label' =>'Customer', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-users');


//Vehicle navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_vehicle.php', 'label'=>'Add Vehicle');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Vehicle', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-truck');
// }   

//Damage navigation
// $sub_menu_arr = [];
// $sub_menu_arr[]= array('link'=>'add_damage_list.php', 'label'=>'Add Damage');

// if($role_id==1 || $role_id==2){
    // $manager_arr[] = array('label' =>'Damage', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-circle-exclamation');
// }

//payment navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'payment_list.php', 'label'=>'Payment');
$sub_menu_arr[]= array('link'=>'view_sup_payment.php', 'label'=>'View Supplier Payment');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Payment', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-sack-dollar');
// }

//Return navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'add_cus_returns_list.php', 'label'=>'Customer return Payment');
$sub_menu_arr[]= array('link'=>'add_sup_returns_list.php', 'label'=>'Supplier return Payment');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Returns', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-arrow-turn-down-left');
// }

//Manage Permission navigation
$sub_menu_arr = [];
$sub_menu_arr[]= array('link'=>'manage_role_permission.php', 'label'=>'Customer return Manage Role permission ');

// if($role_id==1 || $role_id==2){
    $manager_arr[] = array('label' =>'Role Permission', 'sub_menu' => $sub_menu_arr, 'icon'=>'fa-solid fa-arrow-turn-down-left');
// }


;?>