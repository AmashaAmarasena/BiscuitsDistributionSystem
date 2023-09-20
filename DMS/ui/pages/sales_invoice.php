<?php
include_once("../../class/sales_list.php");
$salesltObject = new sales_list();
include_once("../../class/product.php");
include_once("../../class/sales.php");
$salesObject = new sales();
include_once("../../class/payment.php");
$paymentObject = new payment();
include_once("../../class/customer.php");
$cusObject = new customer();
include_once("../../class/cus_returns.php");
$cusReturnObject = new cus_returns();

if (isset($_GET["sr"])) {
    $all = $salesltObject->get_by_id($_GET['sr']);
    //print_r($all);

}
if (isset($_GET["sr"])) {
    $tot = $salesObject->get_view_by_sales_id($_GET['sr']);
    // print_r($tot);
}
if (isset($_GET["sr"])) {
    $call = $cusObject->get_customer_by_sales_id($_GET['sr']);
    // print_r($call);
}
if (isset($_GET["sr"])) {
    $cusReturn = $cusReturnObject->get_by_id($_GET['sr']);
    //print_r($all);

}
  
// $all = $salesObject->get_all();
include_once "../pages/headerWithoutSideBAr.php";
?>
  
<form action="print_sales.php" method="post" id="addOrderForm">
    <!-- <div class="container-fluid dashboard-content"> -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Sales Invoice </h2>
                    <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-coommerce</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sales Invoice</li>
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
                            <h3 class="mb-0">Invoice #<?= $item["sales_id"] ?></h3>
                           <div> <?= $item["sales_date"] ?></div>
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
                                    foreach ($call as $item) {
                                ?>
                            <div class="col-sm-6">
                            
                                <h5 class="mb-3">To:</h5>
                                <h3 class="text-dark mb-1"><?= $item["cus_name"] ?></h3>
                                <div><?= $item["cus_address"] ?></div>
                                <div><?= $item["cus_email"] ?></div>
                                <div><?= $item["cus_phone"] ?></div>
                            </div>
                            <?php }?>
                        </div> 
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th class="right">Unit Cost</th>
                                        <th class="center">Qty</th>
                                        <th class="center">Discount</th>
                                        <th class="center">Discount Amount</th>
                                        <!-- <th class="center">Return Amount</th> -->
                                        <th class="center">Free Item</th>
                                        <th class="center">Net Total</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $subTotal= 0;
                                    $discount = 0;
                                    $total = 0 ;
                                    foreach ($all as $item) {
                                        $x=( $item["saleslt_issue_price"] *  $item["saleslt_qty"]  * $item["saleslt_discount"] / 100);
                                        $y= $item["saleslt_total_bill"] - $item["saleslt_discount"];
                                        $netTot = ($item["saleslt_issue_price"] * $item["saleslt_qty"]);
			                        $subTotal += $x;
                                    $discount += $item["saleslt_discount"];
                                    $total += $y;
                                ?>
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"><?= $item["pro_name"] ?></td>
                                        <td class="left"></td>
                                        <td class="right"><?= $item["saleslt_issue_price"] ?></td>
                                        <td class="center"><?= $item["saleslt_qty"] ?></td>
                                        <td class="center"><?= $item["saleslt_discount"] ?>%</td>
                                        <td class="center"><?= $x ?></td>
                                        <!-- <td class="right">-<?= $item["cus_returns_total_bill"] ?></td> -->
                                        <td class="center"><?= $item["saleslt_free"] ?></td>
                                        <td class="center"><?= $netTot ?></td>
                                        <td class="right"><?= $item["saleslt_total_bill"] ?></td>
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
                                            <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right"><?= $item["sales_total_bill"] +$subTotal ?></td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Discount </strong>
                                            </td>
                                            <td class="right"><?= $subTotal ?></td>
                                        </tr>
                                        <tr>
                                            
                                            <td class="left">
                                                <strong class="text-dark">Grand Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark"><?= $item["sales_total_bill"] ?></strong>
                                            </td>
                                            
                                        </tr>
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