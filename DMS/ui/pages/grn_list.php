<?php
include_once("../../class/grn_class.php");
include_once("../../class/manufacture.php");

$grnObject = new grn_class();
$supObject = new manufacture();

$supName = $supObject->get_all();


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

$all = $grnObject->get_all();
//  print_r( $all);

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

                    <h2 class="pageheader-title">GRN List </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">GRN_List</li>
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

    <form method="GET" action="">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Search GRN</h5>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="supplierName" class="col-form-label">Supplier</label>
                                <select name="mac_name" class="form-control" id="supplierName">
                                    <option value="-1"> all</option>
                                    <?php
                                    foreach ($supName as $item) {
                                    ?>
                                        <option value="<?= $item["mac_id"] ?>"><?= $item["mac_name"] ?> </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="form-group">
                                <label for="start_date" class="col-form-label">Date From</label>
                                <input id="start_date" type="date" class="form-control" placeholder="yyyy-mm-dd" name="start_date">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="form-group">
                                <label for="end_date" class="col-form-label">Date To</label>
                                <input id="end_date" type="date" name="end_date" data-parsley-type="change" placeholder="" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="col-md-2 col-sm-6">

                            <div class="form-group">
                                <label for="paid_amount" class="col-form-label">Paid Amount</label>
                                <select name="paid_amount" class="form-control" id="paid_amount">
                                    <option value="-1"> all</option>
                                    <option value="Paid"> Paid</option>
                                    <option value="-Unpaid"> Unpaid</option>

                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-2" style="padding-top: 38px;">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" checked="" class="custom-control-input" checked><span class="custom-control-label">Active</span>
                            </label>
                        </div> -->
                        <div class="col-md-1" style="padding-top: 29px;">
                            <button type="submit" class="btn btn-space btn-primary">Search</button>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </form>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">GRN List</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered second" id="example">
                        <thead>
                            <tr>
                                <th>GRN ID</th>
                                <th>Manufacture</th>
                                <th>Date/Reference No</th>
                                <th>Note</th>
                                <th>Total Bill</th>
                                <th>Paid Amount</th>
                                <th>Balance</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["grn_id"] ?></td>
                                    <td><?= $item["mac_name"] ?></td>
                                    <td><?= $item["grn_date"] ?><br><?= $item["grn_refno"] ?></td>
                                    <td><?= $item["grn_note"] ?></td>
                                    <td class="text-right"><?= number_format( $item["grn_total_bill"],2) ?></td>
                                    <td class="text-right"><?= number_format($item["total_sup_paid_amount"],2) ?></td>
                                    <td class="text-right"><?= number_format($item["grn_total_bill"] - $item["total_sup_paid_amount"],2)?></td>
                                    <td>
                                         <a class="btn btn-outline-warning btn-xs" href="grn_item.php?gr=<?= $item['grn_id'] ?>" style="color:black"><i class="fa fa-eye"></i>&nbsp;Item view</a>
                                         <a class="btn btn-outline-success  btn-xs" href="grn_item.php?gr=<?= $item['grn_id'] ?>" style="color:black"><i class="fa fa-money"></i>&nbsp;Settle</a>
                                         <a class="btn btn-outline-success btn-xs" href="grn_invoice.php?gr=<?= $item['grn_id'] ?>" style="color:black"><i class="fa fa-print"></i>&nbsp;Print</a>
                                    </td>
                                    <!-- <td><i class="icon-view" style="color:red"><a href="grn_item.php?gr=<?= $item['grn_id'] ?>" style="color:red">Item view</a></i></td> -->
                                    

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
    function delcat(grn_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + grn_id);
        if (x == true) {
            window.location.href = "add_grn.php?delete=" + grn_id;

        }
    }
</script>