<?php
include_once("../../class/ordr.php");
include_once("../../class/manufacture.php");
include_once("../../class/order_list.php");

    $supplierOrderObject = new ordr();

    $all =  $supplierOrderObject->geta_all_supplier_orders();


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

// $all = $supplierObject->get_all();
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

                    <h2 class="pageheader-title">Supplier Order List </h2>
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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">Supplier Order List</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered second" id="example">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Supplier</th>
                                <th>Order refno</th>
                                <th>Order Note</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["order_id"] ?></td>
                                    <td><?= $item["mac_name"] ?></td>
                                    <td><?= $item["order_refno"] ?></td>
                                    <td><?= $item["order_note"] ?></td>
                                    
                                    <td>
                                    <a href="#" class="btn btn-outline-warning btn-xs" href="supplier_order_item.php?sr=<?= $item['order_id'] ?>" style="color:black"><i class="fa fa-eye"></i>&nbsp;Item view</a>                                       
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