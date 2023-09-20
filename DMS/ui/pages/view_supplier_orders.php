<?php
include_once("../../class/ordr.php");
include_once("../../class/manufacture.php");
include_once("../../class/order_list.php");

$supplierOrderObject = new ordr();

 $all=$supplierOrderObject->get_all_supplier();
//  if(isset ($_POST["fk_order_id"]));
//   $all = $supplierOrderObject->get_supplier_order_by_id($_POST["fk_order_id"]);
//    print_r( $all);

// including the header part

include_once ("../pages/head.php");


?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Supplier Order List </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order List</li>
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
            <h5 class="card-header">Supplier Order List</h5>
            <div class="card-body">
            <div class="table-responsive">
                        <table class="table table-striped table-bordered " name="supOrdListTable" id="table_id">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Supplier</th>
                                <th>Item name</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                                <!-- <th>Action</th> -->

                            </tr>
                        </thead>
                        <tbody id="td">

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["order_id"] ?></td>
                                    <td><?= $item["mac_name"] ?></td>
                                    <td><?= $item["pro_name"] ?></td>
                                    <td><?= $item["orderlt_qty"] ?></td>
                                    <td><?= $item["order_date"] ?></td>
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