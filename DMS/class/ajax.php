<?php 
//Adding new product code
if(isset($_GET["p_code"])){
    include_once("../class/product.php");
    $proObject = new product();
    $pid = $proObject->get_by_code($_GET["p_code"],$_GET["p_id"]);

    if(isset($pid['pro_id'])){
        echo ("Yes");
    }
    else{
        echo("No");
    }



//  echo json_encode($pid);

//     if($pid)
//         echo ("Yes");
//     else{
//         echo("No");
//     }
}
//Customer return sales validation
if(isset($_GET["pro_id"])){
    include_once("../class/product.php");
     $proObject = new product();

session_start();
    $vid = $proObject->get_stk($_GET["pro_id"],$_SESSION["staff"]['fk_veh_id']);

    echo($vid['stk']);
    //echo($_SESSION["staff"]['fk_veh_id']);
}
//product_load validation 
if(isset($_GET["pl_id"])){
    include_once("../class/product.php");
     $proObject = new product();

    $vid = $proObject->get_stk_load($_GET["pl_id"],1);

    echo($vid['stk']);
    //echo($_SESSION["staff"]['fk_veh_id']);
}

//staff NIC validation
if(isset($_GET["st_nic"])){
    include_once("../class/staff.php");
    $stObject= new staff();
    $stid = $stObject->get_by_nic($_GET["st_nic"],$_GET["st_id"]);
    // echo $stid;
    if(isset($stid['st_id'])){
        echo "Yes";
    }
    else{
        echo "No";
    }
}
//staff Email validation
if(isset($_GET["st_email"])){
    include_once("../class/staff.php");
    $stObject= new staff();
    $stid = $stObject->get_by_email($_GET["st_email"],$_GET["st_id"]);
    if(isset($stid['st_id'])){
        echo ("Yes");
    }
    else{
        echo("No");
    }
}
//Get customer id to customer return form
if(isset($_GET["customer_id"])){
    include_once("../class/cus_returns.php");
    $cus_rtn = new cus_returns();
    $sales_dt = $cus_rtn->get_sales_id_by_customer_id(trim($_GET["customer_id"]));
    echo json_encode($sales_dt);
}

//Get sales_id to cutomer return form
if(isset($_GET["sales_id"])){
    include_once("../class/cus_returns.php");
    $cus_rtn = new cus_returns();
    $sales_dt = $cus_rtn->get_item_list_of_sales_id(trim($_GET["sales_id"]));
    echo json_encode($sales_dt);
}

if(isset($_GET["order_id"])){
    include_once("../class/grn_class.php");
    $sup_order = new grn_class();
    $sup_dt = $sup_order->get_supplier_items_of_supOrder_id(trim($_GET["order_id"]));
    echo json_encode($sup_dt); 

}

if(isset($_POST['sales_id'])){
    // echo "sales";

    include_once("../class/cus_returns.php");
    // echo json_encode($_POST);
    $cusReturnsObject = new cus_returns();

    $cusReturnsObject->fk_sales_id = $_POST['sales_id'];
    $cusReturnsObject->cus_returns_date = $_POST["cus_returns_date"];
    $cusReturnsObject->fk_cus_id = $_POST["cus_name"];
    $cusReturnsObject->cus_returns_note = $_POST["cus_returns_note"];
    $cusReturnsObject->cus_returns_total_bill = $_POST["tot_returns"];

    $cusReturnsObject->save();
}

//Get supplier id to sup_returns form
if(isset($_GET['mac_id'])){
    include_once("../class/sup_returns.php");
    $sup_rtn = new sup_returns();
    $grn_dt =  $sup_rtn->get_grn_id_by_supplier_id(trim($_GET["sup_id"]));
    echo json_encode($grn_dt);
}

//Get grn id to supplier return form
    if(isset($_GET["grn_id"])){
    include_once("../class/sup_returns.php");
    $sup_rtn = new sup_returns();
    $grn_dt = $sup_rtn->get_item_list_of_grn_id(trim($_GET["grn_id"]));
    echo json_encode($grn_dt);
}
if(isset($_POST['grn_id'])){
include_once("../class/sup_returns.php");
    // echo json_encode($_POST);
    $supReturnsObject = new sup_returns();

    $supsReturnsObject->fk_grn_id = $_POST['grn_id'];
    $supReturnsObject->sup_returns_date = $_POST["cus_returns_date"];
    $supReturnsObject->fk_mac_id = $_POST["mac_name"];
    $cusReturnsObject->cus_returns_note = $_POST["sup_returns_note"];
    $cusReturnsObject->cus_returns_total_bill = $_POST["tot_returns"];

    $cusReturnsObject->save();
}

    // include_once("../class/sales.php");
    // $return_items = new cus_returns_list();

    // foreach ($_POST['product_id'] as $key => $value) {
    //     if($_POST['return_qty'][$key]!=0){

    //     }
    // }

// 
    // echo json_encode($_POST);

    if(isset($_GET["veh_number"])){
        include_once("../class/vehicle.php");
        $vehObject= new vehicle();
        $vehid = $vehObject->get_by_veh_number($_GET["veh_number"],$_GET["veh_id"]);
        if($vehid['veh_id']){
            echo "Yes";
        }
        else{
            echo "No";
        }
    }

   //Get product items from manufacture id
   if(isset($_GET["manufacture_id"])){
    include_once("../class/product.php");
    $pro = new product();
    $product_dt = $pro->get_product_by_manufacture_id(trim($_GET["manufacture_id"]));
    echo json_encode($product_dt);
}

?>