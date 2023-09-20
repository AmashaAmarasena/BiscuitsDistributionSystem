<?php
include_once("../../class/grn_class.php");
$grnObject = new grn_class();
include_once("../../class/product.php");
include_once("../../class/sales.php");
$salesObject = new sales();
include_once("../../class/payment.php");
$paymentObject = new payment();
include_once("../../class/grn_class.php");
$grnObject = new grn_class();

// if (isset($_GET["gr"])) {
//     $all = $grnObject->get_by_id_total($_GET['gr']);
//     //print_r($all);

// }
if (isset($_GET["gr"])) {
    $tot = $grnObject->get_view_by_grn_id($_GET['gr']);
    // print_r($tot);
}
if (isset($_GET["gr"])) {
    $call = $grnObject-> get_supplier_by_grn_id($_GET['gr']);
    // print_r($call);
}
if(isset($_GET["gr"])){
    $all = $grnObject->get_supplier_invoice_by_id($_GET['gr']);
}

  
// $all = $salesObject->get_all();
include_once "../pages/headerWithoutSideBAr.php";
?>
  
<form action="grn_invoice.php" method="post" id="addOrderForm">
    <!-- <div class="container-fluid dashboard-content"> -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">GRN Invoice </h2>
                    <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-coommerce</a></li>
                                <li class="breadcrumb-item active" aria-current="page">GRN Invoice</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header p-4">
                        <a class="pt-2 d-inline-block" href="index.html"></a>
                        <?php
                                                     
                            foreach ($tot as $item) {
                                
                        ?>

                        <div class="float-right">
                            <h3 class="mb-0">Invoice #<?= $item["grn_id"] ?></h3>
                           <div> <?= $item["grn_date"] ?></div>
                        </div>
                        <?php }?>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">From:</h5>
                                <h3 class="text-dark mb-1">S.Kumar</h3>

                                <div>2546 Rattota Street</div>
                                <div>Kaludawela, Matale</div>
                                <div>Email: ambaldis@gmail.com</div>
                                <div>Phone: 066-2220457</div>
                            </div>
                            <?php
                                    foreach ($tot as $item) {
                                ?>
                            <div class="col-sm-6">
                            
                                <h5 class="mb-3">To:</h5>
                                <h3 class="text-dark mb-1"><?= $item["mac_name"] ?></h3>
                            </div>
                            <?php }?>
                        </div> 
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <!-- <th>Description</th> -->
                                        <th class="right">Unit Cost</th>
                                        <th class="center">Qty</th>
                                        <!-- <th class="center">Discount</th> -->
                                        <!-- <th class="center">Discount Amount</th> -->
                                        <th class="center">Free Item</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    // $subTotal= 0;
                                    // $discount = 0;
                                    // $total = 0 ;
                                    foreach ($all as $item) {
                                    //     $x=( $item["grnls_purchase_price"] *  $item["grnls_qty"]  * $item["saleslt_discount"] / 100);
                                    //     $y= $item["saleslt_total_bill"] - $item["saleslt_discount"];
			                        // $subTotal += $x;
                                    // $discount += $item["saleslt_discount"];
                                    // $total += $y;
                                ?>
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"><?= $item["pro_name"] ?></td>
                                        <!-- <td class="left"></td> -->
                                        <td class="right"><?= $item["grnls_purchase_price"] ?></td>
                                         <td class="center"><?= $item["grnls_qty"] ?></td> 
                                        <!-- <td class="center"><?= $item["saleslt_discount"] ?>%</td> -->
                                        <!-- <td class="center"><?= $x ?></td> -->
                                        <td class="center"><?= $item["grnls_free_amount"] ?></td>
                                        <td class="right"><?= $item["grnlt_item_amount"] ?></td>
                                    </tr>
                                    
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                        <?php
                                    foreach ($tot as $item) {
                                ?>
                                            <!-- <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right"><?= $item["sales_total_bill"] +$subTotal ?></td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Discount </strong>
                                            </td>
                                            <td class="right"><?= $subTotal ?></td>
                                        </tr> -->

                                        <!-- <tr>
                                            <td class="left">
                                                <strong class="text-dark">VAT (10%)</strong>
                                            </td>
                                            <td class="right">$2,304,00</td>
                                        </tr> -->
                                        <tr>
                                            
                                            <td class="left">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark"><?= $item["grn_total_bill"] ?></strong>
                                            </td>
                                            
                                            <tr>
                                            
                                            <td class="left">
                                                <strong class="text-dark">Paid Amount</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark"><?= $item["pSum"] ?></strong>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td class="left">
                                                <strong class="text-dark">Due Amount</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark"><?= $item["credit"] ?></strong>
                                            </td>
                                            <?php }?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <p class="mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
</div>

<?php
include_once "../pages/foot.php";
?>