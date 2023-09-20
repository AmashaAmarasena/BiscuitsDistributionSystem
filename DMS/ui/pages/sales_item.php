<?php

include_once "../pages/head.php";
include_once("../../class/sales_list.php");
$salesltObject = new sales_list();
include_once("../../class/product.php");
include_once("../../class/sales.php");
$salesObject = new sales();
include_once("../../class/payment.php");
$paymentObject = new payment();


if (isset($_POST["paid_amount"])) {
    $paymentObject->cash = $_POST["cash"];
    $paymentObject->cheque_amount = $_POST["cheque_amount"];
    $paymentObject->cheque_no = $_POST["cheque_no"];
    $paymentObject->cheque_date = $_POST["cheque_date"];
    $paymentObject->cheque_bank = $_POST["cheque_bank"];
    $paymentObject->paid_amount = $_POST["paid_amount"];
    $paymentObject->paid_date = $_POST["paid_date"];
    $paymentObject->fk_sales_id = $_POST["fk_sales_id"];

    $sid = $paymentObject->save();
}
if (isset($_GET["sr"])) {
    $all = $salesltObject->get_by_id($_GET['sr']);
    //print_r($all);

}
if (isset($_GET["sr"])) {
    $tot = $salesObject->get_by_id_total($_GET['sr']);
    print_r($tot);
}



// print_r( $all);

// including the header part




?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Sales Items </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sales Items</li>
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


    <!-- <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                
                                <th>Total Bill</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Action</th>
                                
                                
                                
                                

                            </tr>
                        </thead>
                        <tbody>

                            <!-- <?php
                                    foreach ($tot as $item) {
                                    ?>
                                <tr>
                                    
                                    <td><?= $item["sales_total_bill"] ?></td>
                                    <td><?= $item["pSum"] ?></td>
                                    <td><?= $item["sales_total_bill"] - $item["pSum"] ?> </td>
                                    <td>
                                        <i <a href="#" class="btn btn-outline-warning"><a href="sales_item.php?sr=<?= $item['sales_id'] ?>" style="color:black">Item view</a></i>
                                        <i <a href="#" class="btn btn-outline-success"> <a href="sales_item.php?sr=<?= $item['sales_id'] ?>" style="color:black">Settle</a></i>
                                    </td>
                                    
                                    
                                    
                                    
                                </tr>
                            </tr>
                            <?php } ?> -->




    </tfoot>
    </table>


    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card" style="background:#77C3EC">
                <div class="card-body">
                    <p class="card-title border-bottom pb-2" style="color: black;">Total Bill</p>
                    <?php 
                if (isset($item["sales_total_bill"])) {
                    echo  "<h2>".($item["sales_total_bill"]). "</h2>";
                }  else{
                    echo "<h4>".("Supplier payment is still not settled") . "</h4>";
                }?>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card">
                <div class="card-body" style="background:#77C8EC">
                    <p class="card-title border-bottom pb-2" style="color: black;">Paid Amount</p>
                    <?php
                    if(isset($item["paid_amount"])) {
                        echo "<h2>".($item["paid_amount"]). "</h2>";
                    } else {
                        echo "<h4>".("Supplier payment is still not settled"). "</h4>";
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card">
                <div class="card-body" style="background:#77C3EC">
                    <p class="card-title border-bottom pb-2" style="color: black;">Balance<p>
                    <?php
                    if(isset($item["sales_total_bill"]) && isset($item["paid_amount"])){
                        echo "<h2>".($item["sales_total_bill"] - $item["paid_amount"]). "</h2>"; 
                      } else {
                        echo "<h4>".("Supplier payment is still not settled"). "</h4>";
                      }  ?>
                </div>
            </div>

        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Sales Items</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <!-- <th>Description</th> -->
                                <th>Quantity</th>
                                <!-- <th>Purchase Price</th> -->
                                <th>Issue Price</th>
                                <th>Free items</th>
                                <th>Discount</th>
                                <!-- <th>Cash</th>
                                                <th>Cheque No</th>
                                                <th>Cheque Date</th>
                                                <th>Cheque Bank</th> -->





                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["pro_name"] ?></td>
                                    <!-- <td><?= $item["saleslt_descrip"] ?></td> -->
                                    <td><?= $item["saleslt_qty"] ?></td>
                                    <!-- <td><?= $item["saleslt_purchase_price"] ?></td> -->
                                    <td class="text-right"><?= number_format($item["saleslt_issue_price"],2) ?></td>
                                    <td ><?= $item["saleslt_free"] ?></td>
                                    <td ><?= $item["saleslt_discount"] ?></td>

                                </tr>
                            <?php } ?>




                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <form action="sales_item.php" method="post" id="addOrderForm">
            <div class="container-fluid dashboard-content">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">
                        <h5 class="card-header">Payment for Sales Invoice No <?php if (isset($_REQUEST['sr'])) {
                                                                                    echo $_REQUEST['sr'];
                                                                                } ?></h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        $grn_id = isset($_REQUEST['sr']) ? $_REQUEST['sr'] : 0;
                                        ?>
                                        <input id="fk_sales_id " type="hidden" value="<?= $grn_id  ?>" name="fk_sales_id" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Cash</label>
                                        <input id="cash" type="text" name="cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Paid Date</label>
                                        <input id="paid_date" type="date" name="paid_date" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Cheque Amount</label>
                                        <input id="chequeAmount" type="text" name="cheque_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class="col-form-label ">Cheque No</label>
                                        <input id="chequeNo" type="text" name="cheque_no" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class="col-form-label">Cheque Date</label>
                                        <input id="chequeDate" type="date" name="cheque_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class="col-form-label">Paid Amount</label>

                                        <input id="paidAmount" type="text" name="paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                            
                           
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class="col-form-label">Cheque Bank</label>
                                        <input id="chequeBank" type="text" name="cheque_bank" data-parsley-type="change" placeholder="" class="form-control">
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
                                    <div class="col-md-1">
                                    <p class="text-right">
                                        <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include_once "../pages/foot.php";
                ?>
                <!-- <script>
            function addrow() {

                h = $("#totBill").val();
                i = $("#cash").val();
                j = $("#chequeAmount").val();
                k = $("#chequeNo").val();
                l = $("#chequeDate").val();
                m = $("#chequeBank").val();
                n = $("#credit").val();
                o = $("#paidAmount").val();

                $("#td").append("<tr><td>" + h + "<input type='hidden'  name='saleslt_total_bill[]' value='" + h + "'></td><td>" + i + "<input type='hidden'  name='cash[]' value='" + i + "'></td><td>" + j + "<input type='hidden'  name='cheque_amount[]' value='" + j + "'></td><td>" + k + "<input type='hidden'  name='cheque_no[]' value='" + k + "'></td><td>" + l + "<input type='hidden'  name='cheque_date[]' value='" + l + "'></td><td>" + m + "<input type='hidden'  name='cheque_bank[]' value='" + m + "'></td><td>" + n + "<input type='hidden'  name='credit[]' value='" + n + "'></td><td>" + o + "<input type='hidden'  name='paid_amount[]' value='" + o + "'></td></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delsales(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");

                $("#totBill").val("");
                $("#cash").val("");
                $("#chequeAmount").val("");
                $("#chequeNo").val("");
                $("#chequeDate").val("");
                $("#chequeBank").val("");
                $("#credit").val("");
                $('#paidAmount')

                $("#item").focus();
                addText();
            }
        </script> -->

                <script>
                    function calculateBillTotal() {
                        var totalBill;
                        var cash = 0;
                        var cheque_amount = 0;
                        var paidAmount = 0;


                        var cash = $('#cash').val();
                        var cheque_amount = $('#chequeAmount').val();
                        console.log(cash);
                        console.log(cheque_amount);

                        // var paidAmount = $('#paidAmount').val();

                        // console.log(cash);
                        if (cash != '' || chequeAmount != '') {
                            paidAmount = (parseInt(cash)) + (parseInt(cheque_amount))
                        } else {
                            paidAmount = 0;
                        }
                        document.getElementById('paidAmount').value = parseInt(paidAmount);
                        console.log(paidAmount);

                    }
                </script>