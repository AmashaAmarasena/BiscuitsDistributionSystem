<?php
include_once("../../class/supplier_payment.php");
include_once("../../class/manufacture.php");
$supPaymentObject = new supplier_payment();
$manufactureObject = new manufacture();

$macName=$manufactureObject->get_all();
$all = $supPaymentObject->get_all();
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

                    <h2 class="pageheader-title">Supplier Payment List </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment List</li>
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

    <form method="POST" action="">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Search Payment</h5>
                <div class="card-body">

                    <div class="form-group row">

                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Supplier Payment List</label>
                        <div class=" col-lg-2">
                            <select name="mac_name" class="form-control" id="manufactureName">
                                <option value="-1"> all</option>
                                <?php
                                foreach ($macName as $item) {
                                ?>
                                    <option value="<?= $item["mac_id"] ?>"><?= $item["mac_name"] ?> </option>
                                <?php } ?>

                            </select>
                        </div>
                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Start date</label>
                        <div class=" col-lg-2">
                            <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                            <input id="date" type="date" name="start_date" data-parsley-type="change" placeholder="" class="form-control">
                        </div>
                        <label for="note" class=" col-lg-0 col-form-label text-right">End date</label>
                        <div class=" col-lg-2">
                            <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                            <input id="date2" type="date" name="end_date" data-parsley-type="change" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Paid Amount<br><br></label>
                        <div class=" col-lg-2">
                            <select name="sup_paid_amount" class="form-control" id="sup_paid_amount">
                                <option value="-1"> all</option>
                                <option value="Paid"> Paid</option>
                                <option value="-Unpaid"> Unpaid</option>

                            </select>

                        </div> -->

                        <!-- <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Cheque Bank </label> 
                        <div class=" col-lg-2">
                            <select name="sup_cheque_bank" class="form-control" id="sup_cheque_bank">
                            <option value="-1"> all</option>
                                <?php
                                foreach ($all as $item) {
                                ?>
                                    <option value="<?= $item["sup_pay_id"] ?>"><?= $item["sup_cheque_bank"] ?> </option>
                                <?php } ?>
                            </select>

                        </div> -->
                        <!-- <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Credit Balance<br><br></label>
                    <div class=" col-lg-2">
                        <select name="credit" class="form-control" id="credit">

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <option value="<?= $item["pay_id"] ?>"><?= $item["credit"] ?> </option>
                            <?php } ?>

                        </select>

                    </div> -->


                        <!-- <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Status</label>
                        <div class=" col-lg-2">
                            <input id="status" type="text" name="status" data-parsley-type="change" placeholder="" class="form-control">
                        </div> -->
                        <!-- <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="button" class="btn btn-space btn-primary" onclick="addrow()">Add Items</button>
                                                    
                                                </p>
                                            </div> -->
                    </div>
                </div>

                <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                    Please fill all the fields

                </div>

                <div class="form-group row">

                    <div class="col-lg-6 pl-0">
                        <p class="text-right">
                            <button type="submit" class="btn btn-space btn-primary">Search</button>
                        </p>
                    </div>

                    <!-- <div class="col-lg-1  pl-0">
                    <p class="text-right">
                        <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>
                    </p>
                </div> -->
                </div>


            </div>

        </div>
    </form>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <h5 class="card-header">Supplier Payment List</h5>
            <div class="card-body">
            <div class="table-responsive">
                        <table class="table table-striped table-bordered " name="ordListTable" id="table_id">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                 <th>Invoice No</th>
                                <th>Supplier Name</th> 
                                <th>Paid Date</th> 
                                <th>Paid Amount</th>
                                <th>Cash</th>
                                <th>Cheque Amount</th>
                                <th>Cheque No</th>
                               
                                <th>Cheque Bank</th>
                                <!-- <th>Credit</th> -->
                               
                               
                                <!-- <th>Invoice ID</th> -->
                                <!-- <th>Action</th> -->

                            </tr>
                        </thead>
                        <tbody id="td">

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["sup_pay_id"] ?></td> 
                                    <td><?= $item["fk_grn_id"] ?> </td>
                                    <td><?= $item["mac_name"] ?></td>
                                    <td><?= $item["sup_cheque_date"] ?></td>
                                    <td class="text-right"><?=number_format($item["sup_paid_amount"],2) ?> </td>
                                    <td class="text-right"><?=number_format($item["sup_cash"],2)?></td>
                                    <td class="text-right"><?=number_format($item["sup_cheque_amount"],2) ?></td>
                                    <td><?= $item["sup_cheque_no"] ?></td>                                  
                                    <td><?= $item["sup_cheque_bank"] ?></td>
                                    <!-- <td class="text-right"><?=number_format($item['credit'],2) ?></td> -->
                                   
                                   
                                    <!-- <td>
                                        <i <a href="#" class="btn btn-outline-warning"><a href="sales_item.php?sr=<?= $item['grn_id'] ?>" style="color:black">Item view</a></i>
                                        <i <a href="#" class="btn btn-outline-success"> <a href="sales_item.php?sr=<?= $item['grn_id'] ?>" style="color:black">Settle</a></i>
                                    </td>  -->




                                </tr>
                                </tr>
                            <?php } ?>



                        </tbody>
                            </tfoot>
                    </table>
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
    function delcat(pay_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + pay_id);
        if (x == true) {
            window.location.href = "sup_payment.php?delete=" + pay_id;

        }
    }
</script>