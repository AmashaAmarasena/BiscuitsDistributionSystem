<?php
include_once("../../class/grn_class.php");
include_once("../../class/supplier_payment.php");
$supPaymentObject = new supplier_payment();
include_once("../../class/product.php");
$grnltObject = new grn_class();
$grnObject = new grn_class();

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

if (isset($_POST["sup_paid_amount"])) {
    $supPaymentObject->sup_cash = $_POST["sup_cash"];
    $supPaymentObject->sup_cheque_amount = $_POST["sup_cheque_amount"];
    $supPaymentObject->sup_cheque_no = $_POST["sup_cheque_no"];
    $supPaymentObject->sup_cheque_date = $_POST["sup_cheque_date"];
    $supPaymentObject->sup_cheque_bank = $_POST["sup_cheque_bank"];
    $supPaymentObject->sup_paid_amount = $_POST["sup_paid_amount"];
    $supPaymentObject->fk_grn_id =  $_POST["fk_grn_id"];

    $supPaymentObject->save();
}

if (isset($_GET["gr"])) {
    $all = $grnltObject->get_by_id_view($_GET['gr']);
    // print_r($all);
}

if (isset($_GET["gr"])) {
    $tot = $grnObject->get_by_id_total($_GET['gr']);
    // echo "<pre>";
    // print_r($tot);
    // echo "</pre>";die;
}


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

                    <h2 class="pageheader-title">GRN Items </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">GRN Items</li>
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
    foreach ($tot as $item) {
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
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card" style="background:#77C3EC">
                <div class="card-body">
                    <p class="card-title border-bottom pb-2" style="color: black;">Total Bill</p>
                    <?php
                    if (isset($item["grn_total_bill"])) {
                        echo "<h2>". ($item["grn_total_bill"]). "</h2>" ;
                    } else {
                        echo "<h4>". ("Order payment is still not settled"). "</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card">
                <div class="card-body" style="background:#77C8EC">
                    <p class="card-title border-bottom pb-2" style="color: black;">Paid Amount</p>
                    <?php
                    if (isset($item["sup_paid_amount"])) {
                        echo "<h2>". ($item["sup_paid_amount"]). "</h2>";
                    } else {
                        echo"<h4>". ("Order payment is still not settled"). "</h4>";
                    }
                    // <?= $item["sup_paid_amount"] 
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card">
                <div class="card-body" style="background:#77C3EC">
                    <p class="card-title border-bottom pb-2" style="color: black;">Balance</p>
                    <?php
                    if (isset($item["grn_total_bill"])) {
                        echo "<h2>". ($item["grn_total_bill"] - $item["sup_paid_amount"]) . "</h2>";
                    } else {
                        echo"<h4>". ("Order payment is still not settled") . "<h3>";
                    }
                    // <?= $item["grn_total_bill"] - $item["sup_paid_amount"] 
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="container-fluid dashboard-content">
            <div class="card">
                <h5 class="card-header">GRN Items</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <!-- <th>Description</th> -->
                                    <th>Quantity</th>
                                    <th>Purchase Price</th>
                                    <th>Expiry Date</th>
                                    <th>Sales Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($all as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item["pro_name"] ?></td>
                                        <!-- <td><?= $item["grnls_descip"] ?></td> -->
                                        <td><?= $item["grnls_qty"] ?></td>
                                        <td class="text-right"><?= number_format($item["grnls_purchase_price"], 2); ?></td>
                                        <td><?= $item["grnls_ex_date"] ?></td>
                                        <td class="text-right"><?= number_format($item["grnls_sales_price"],2) ?></td>
                                    </tr>
                                    </tr>
                                <?php } ?>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <form action="grn_item.php?gr=<?php echo $_GET['gr'] ?>" method="post" id="addOrderForm">
                <!-- <div class="container-fluid dashboard-content"> -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="card">
                            <h5 class="card-header">Payment for GRN ID <?php if (isset($_REQUEST['gr'])) {
                                                                            echo $_REQUEST['gr'];
                                                                        } ?></h5>
                            <div class="card-body">
                                <?php
                                $grn_id = isset($_REQUEST['gr']) ? $_REQUEST['gr'] : 0;
                                ?>
                                <input id="fk_grn_id " type="hidden" name="fk_grn_id" value="<?php echo $grn_id; ?>" data-parsley-type="change" placeholder="" class="form-control">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class=" col-lg-02 col-form-label text-right">Cash</label>
                                            <input id="sup_cash" type="text" name="sup_cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class=" col-lg-02 col-form-label text-right">Cheque Amount</label>
                                            <input id="sup_cheque_amount" type="text" name="sup_cheque_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque No</label>
                                            <input id="sup_cheque_no" type="text" name="sup_cheque_no" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Date</label>
                                            <input id="sup_cheque_date" type="date" name="sup_cheque_date" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Amount</label>
                                            <input id="sup_paid_amount" type="text" name="sup_paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Bank</label>
                                            <input id="sup_cheque_bank" type="text" name="sup_cheque_bank" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-success" name="allSubmit" id="allSubmit">Submit</button>
                                        </p>
                                    </div>
                                    <div class="col-md-1 ">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <!-- </div> -->
            </form>
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