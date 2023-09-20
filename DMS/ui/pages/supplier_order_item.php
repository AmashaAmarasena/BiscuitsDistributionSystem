<?php
include_once("../../class/grn_class.php");
include_once("../../class/supplier_payment.php");
$supPaymentObject = new supplier_payment();
include_once("../../class/product.php");
include_once("../../class/ordr.php");
include_once("../../class/order_list.php");

$supplierOrderObject = new ordr();

// $all=$supplierOrderObject->get_all_supplier();

// if(isset($_GET["delete"])){
// $grnObject->del($_GET["delete"]);
//}

// if(isset($_POST["mac_name"])){
//     $grnObject->grn_date=$_POST["grn_date"];
//     $grnObject->fk_mac_id=$_POST["mac_name"];
//     $grnObject->grn_refno=$_POST['grn_refno'];
//     $grnObject->grn_note=$_POST['grn_note'];


//     $grnObject->save();

// }

// if (isset($_POST["sup_cheque_bank"])) {
//     $supPaymentObject->sup_cash = $_POST["sup_cash"];
//     $supPaymentObject->sup_cheque_amount = $_POST["sup_cheque_amount"];
//     $supPaymentObject->sup_cheque_no = $_POST["sup_cheque_no"];
//     $supPaymentObject->sup_cheque_date = $_POST["sup_cheque_date"];
//     $supPaymentObject->sup_cheque_bank = $_POST["sup_cheque_bank"];
//     $supPaymentObject->sup_paid_amount = $_POST["sup_paid_amount"];
//     $supPaymentObject->fk_grn_id =  $_POST["fk_grn_id"];

//     $supPaymentObject->save();
// }

if (isset($_GET["sr"])) {
    $all = $supplierOrderObject->get_item_by_order_id($_GET['sr']);
    print_r($all);
}


// if (isset($_GET["sr"])) {
//     $tot = $grnObject->get_by_id_total($_GET['sr']);
//     print_r($tot);
// }


// print_r( $all);

// including the header part

include_once "../pages/head.php";


?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Supplier Order Items </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Supplier Items</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="main-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


            </div>
        </div>
    </div>
    <?php
    // foreach ($tot as $item) 
    {
    ?>
        <!-- <tr>
                                    
                                    <td><?= $item["sales_total_bill"] ?></td>
                                    <td><?= $item["pSum"] ?></td>
                                    <td><?= $item["sales_total_bill"] - $item["pSum"] ?> </td>
                                    <td>
                                        <i <a href="#" class="btn btn-outline-warning"><a href="sales_item.php?sr=<?= $item['sales_id'] ?>" style="color:black">Item view</a></i>
                                        <i <a href="#" class="btn btn-outline-success"> <a href="sales_item.php?sr=<?= $item['sales_id'] ?>" style="color:black">Settle</a></i>
                                    </td>
                                    
                                    
                                    
                                    
                                </tr>
                            </tr> -->
    <?php } ?>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Supplier Order Items</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Item Code</th> 
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($all as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item["fk_pro_id"] ?></td>
                                        <td><?= $item["pro_name"] ?></td>
                                        <td><?= $item["orderlt_qty"] ?></td>
                                    </tr>
                                    </tr>
                                <?php } ?>




                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <form action="grn_item.php" method="post" id="addOrderForm">
                <div class="container-fluid dashboard-content">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="card">
                            <h5 class="card-header">Payment</h5>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">GRN ID</label>
                                    <div class=" col-lg-2">
                                        <input id="fk_grn_id " type="text" name="fk_grn_id" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cash</label>
                                    <div class=" col-lg-2">
                                        <input id="sup_cash" type="text" name="sup_cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                    <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Cheque Amount</label>
                                    <div class=" col-lg-2">
                                        <input id="sup_cheque_amount" type="text" name="sup_cheque_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque No</label>
                                    <div class=" col-lg-2">
                                        <input id="sup_cheque_no" type="text" name="sup_cheque_no" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Date</label>
                                    <div class=" col-lg-2">
                                        <input id="sup_cheque_date" type="date" name="sup_cheque_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Amount</label>
                                    <div class=" col-lg-2">
                                        <input id="sup_paid_amount" type="text" name="sup_paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>


                                </div>
                                <div class="form-group row">
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Bank</label>
                                    <div class=" col-lg-2">
                                        <input id="sup_cheque_bank" type="text" name="sup_cheque_bank" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 pl-0">
                                        <p class="text-right">
                                            <!-- <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Items</button> -->
                                            <!-- <button type="submit" class="btn btn-space btn-success">Submit</button> -->

                                            <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                                        </p>
                                    </div>

                                    <div class="col-lg-1  pl-0">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
        </div>


    </div>
</div>



<?php
include_once "../pages/foot.php";
?>

<script>
    function delcat(grn_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + grn_id);
        if (x == true) {
            window.location.href = "add_grn.php?delete=" + grn_id;

        }
    }

    function calculateSupplierBill() {
        // var totalBill;
        var sup_cash = 0;
        var sup_cheque_amount = 0;
        var sup_paid_amount = 0;



        // var sup_paid_amount = $('#sup_paid_amount').val();
        var sup_cheque_amount = $('#sup_cheque_amount').val();
        var sup_cash = $('#sup_cash').val();


        console.log(sup_cash);
        console.log(sup_cheque_amount);

        // var paidAmount = $('#paidAmount').val();

        // console.log(cash);
        if (sup_cash != '' || sup_cheque_amount != '') {
            sup_paid_amount = (parseInt(sup_cash)) + (parseInt(sup_cheque_amount))
        } else {
            sup_paid_amount = 0;
        }
        document.getElementById('sup_paid_amount').value = parseInt(sup_paid_amount);
        console.log(sup_paid_amount);

    }
</script>