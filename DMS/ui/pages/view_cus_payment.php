<?php
include_once("../../class/customer.php");
include_once("../../class/payment.php");
include_once("../../class/store.php");
include_once("../../class/sales.php");

$cusPaymentObject = new customer();

  $all=$cusPaymentObject->get_all_customer_payment();
//   if(isset ($_POST["pay_id"]));
//   $all = $cusPaymentObject->get_customer_payment_by_id($_POST["pay_id"]);
//    print_r( $all);

// including the header part

include_once("../pages/head.php");


?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Customer Payment List </h2>
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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <h5 class="card-header">Customer Payment List</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Pay id</th>
                                <th>Customer</th>
                                <th>Store</th>
                                <th>Total amount</th>
                                <th>Cash</th>
                                <th>Cheque Amount</th>
                                <th>Cheque No</th>
                                <th>Cheque Date</th>
                                <th>Cheque Bank</th>
                                <th>Credit</th>
                                <th>Paid Amount</th>
                                <!-- <th>Invoice ID</th> -->
                                <!-- <th>Action</th> -->

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                <td><?= $item["pay_id"] ?></td>
                                    <td><?= $item["cus_name"] ?></td>
                                    <td><?= $item["store_name"] ?></td>
                                    <td><?= $item["sales_total_bill"] ?></td>
                                    <td><?= $item["cash"] ?></td>
                                    <td><?= $item["cheque_amount"] ?></td>
                                    <td><?= $item["cheque_no"] ?></td>
                                    <td><?= $item["cheque_date"] ?></td>
                                    <td><?= $item["cheque_bank"] ?></td>
                                    <td><?= $item["credit"] ?></td>
                                    <td><?= $item["pSum"]?> </td>
                                    <!-- <td><?= $item["sales_id"]?> </td> -->
                                    <!-- <td>
                                        <i <a href="#" class="btn btn-outline-warning"><a href="sales_item.php?sr=<?= $item['grn_id'] ?>" style="color:black">Item view</a></i>
                                        <i <a href="#" class="btn btn-outline-success"> <a href="sales_item.php?sr=<?= $item['grn_id'] ?>" style="color:black">Settle</a></i>
                                    </td>  -->




                                </tr>
                                </tr>
                            <?php } ?>




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