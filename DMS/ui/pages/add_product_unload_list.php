<?php
include_once("../../class/vehicle.php");
include_once("../../class/product_unload.php");
include_once("../pages/head.php");
$productUnloadObject = new product_unload();
//$loadObject = new load();

if (isset($_POST['veh_number'])) {
    $productUnloadObject->unload_date = $_POST["unload_date"];
    $productUnloadObject->fk_veh_id = $_POST["veh_number"];
    $productUnloadObject->unload_note = $_POST['unload_note'];


    $productUnloadObject->save();
}

$allload = $productUnloadObject->get_all();

//include the manufacture file 

$vehObject = new vehicle();
$aload = $vehObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

// including the header part
?>
<div class="dashboard-wrapper">

    <form action="add_product_unload_list.php" method="post" id="addUnloadForm">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">

                        <h2 class="pageheader-title">Add Unload </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Unload</li>
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
                    <div class="card">
                        <h5 class="card-header">Add Unload</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Vehicle</label>
                                        <select name="veh_number" class="form-control" id="veh_number">
                                            <option value="all"> Select Vehicle</option>
                                            <?php
                                            foreach ($aload as $item) {
                                            ?>
                                                <option value="<?= $item["veh_id"] ?>"><?= $item["veh_number"] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Unload Date</label>
                                        <input id="date" type="date" name="unload_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="note" class="col-form-label">Unlode Note</label>

                                        <input id="note" type="text" name="unload_note" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Product Item</label>
                                        <select name="pro_code" class="form-control" id="pro_code">
                                            <option value="all"> Select Item </option>
                                            <?php
                                            foreach ($apro as $item) {
                                            ?>
                                                <option value="<?= $item["pro_id"] ?>"><?= $item["pro_name"], ' ', $item["pro_weight"] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Quantity</label>
                                        <input id="qty" type="text" name="unload_qty" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                        <div class="card-footer">
                            <div class="row">
                                <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                    Please fill all the fields
                                </div>
                                <div class="col-lg-6 pl-0">
                                    <p class="text-right">
                                        <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Load</button>
                                    </p>
                                </div>
                                <div class="col-lg-1  pl-0">
                                    <p class="text-right">
                                        <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>
                                    </p>
                                </div>
                            </div>
                        </div><!--end card footer-->
                    </div><!--end card-->
                 </div><!--end col-12-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Unload</h5>
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered " name="ordListTable">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="td">
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
            </div><!--end .row-->
        </div>
    </form>
</div>

<?php
include_once "../pages/foot.php";
?>

<script>
    //select2 plugin
    $(document).ready(function() {
        $('#veh_number').select2();
        $('#pro_code').select2();
    });

    function addrow() { //To add a product item
        pro_name = $("#pro_code option:selected").text();
        pro_code = $("#pro_code").val();
        qty = $("#qty").val(); //quantity

        if (pro_code == "all") {
            alert("Please insert at least one item")
            return;
        }

        if (qty.trim().length == 0)
        {
            alert("Enter amount for quantity")
            return;
        }

        $("#td").append("<tr><td>" + pro_name + "<input type='hidden'  name='pro_code[]' value='" + pro_code + "'></td><td>" + qty + "<input type='hidden'  name='unload_qty[]' value='" + qty + "'></td><td><a href='#' class='btn btn-outline-primary btn-xs'><i class='icon-pencil' title='Edit'>Edit</i></a>&nbsp;&nbsp;&nbsp;<button onclick='delunload(this)' type='button' href='#'  class='btn btn-outline-danger btn-xs'><i class='icon-trash' style='color:red'>Delete</i></button></td></tr>");
        $("#item").val("");
        $("#qty").val("");

        $("#item").focus();
        // addText();
    }
    //function to manufacture name and dateas text

    function delunload(t) {
        $(t).parent().parent().parent().remove();
    }
</script>

<!-- <script>
    function delcat(unloadlt_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + unloadlt_id);
        if (x == true) {
            window.location.href = "add_product_unload_list.php?delete=" + unloadlt_id;
        }
    }
</script> -->