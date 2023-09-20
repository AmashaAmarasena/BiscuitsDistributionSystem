<?php
include_once("../../class/store.php");
include_once("../../class/shop_order.php");
include_once "../pages/head.php";
$shoporderObject = new shop_order();
//$grnObject = new grn();

if (isset($_POST['sporder_date'])) {
    $shoporderObject->sporder_date = $_POST["sporder_date"];
    $shoporderObject->fk_store_id = $_POST["store_name"];
    $shoporderObject->sporder_refno = $_POST['sporder_refno'];
    $shoporderObject->sporder_note = $_POST['sporder_note'];

    $shoporderObject->save();
}

$allshoporder = $shoporderObject->get_all();

//include the manufacture file 

$storeObject = new store();
$astore = $storeObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

// including the header part
?>
<div class="dashboard-wrapper">

    <form action="add_shop_orderlt.php" method="post" id="addshoporderltForm">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Add Shop Order </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Shop Order</li>
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
                        <h5 class="card-header">Add Shop Order</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Store</label>
                                        <select name="store_name" class="form-control" id="manufactureName">
                                            <?php
                                            foreach ($astore as $item) {
                                            ?>
                                                <option value="<?= $item["store_id"] ?>"><?= $item["store_name"] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Order Date</label>

                                        <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                        <input id="date" type="date" name="sporder_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="refno" class="col-form-label">REF NO.</label>

                                        <input id="refno" type="text" name="sporder_refno" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="note" class="col-form-label">Note</label>

                                        <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                        <input id="note" type="text" name="sporder_note" data-parsley-type="change" placeholder="" class="form-control">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Item Name</label>

                                        <select name="pro_code" class="form-control" id="pro_code">

                                            <?php
                                            foreach ($apro as $item) {
                                            ?>
                                                <option value="<?= $item["pro_id"] ?>"><?= $item["pro_name"] ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Quantity</label>
                                        <input id="qty" type="text" name="shop_orderlt_qty" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                        Please fill all the fields
                                    </div>
                                    <div class="col-lg-6 pl-0">
                                        <p class="text-right">
                                            <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Items</button>
                                        </p>
                                    </div>
                                    <div class="col-lg-1  pl-0">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Shop Order</h5>
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" name="ordListTable">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="td">
                            </tbody>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-3">
                            <div class="form-group">
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


        </div>
</div>
</form>

</div>
</div>

<?php
include_once "../pages/foot.php";
?>

<script>
    function addrow() { //To add a product item
        var aa = $("#pro_code option:selected").text();
        a = $("#pro_code").val();
        b = $("#qty").val(); //quantity
        $('#pro_code' + a).remove();
        $("#td").append("<tr id='pro_code" + a + "'><td>" + aa + "<input type='hidden'  name='pro_code[]' value='" + a + "'></td><td>" + b + "<input type='hidden'  name='shop_orderlt_qty[]' value='" + b + "'><td><i class='icon-pencil' title='Edit' style='color:blue'><a onclick='editShopOdr(" + a + "," + b + ")' href='#' style='color:blue'>Edit</a></i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delorder(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
        $("#item").val("");
        $("#qty").val("");


        $("#item").focus();
        addText();
    }
    //function to manufacture name and dateas text

    function delsporder(t) {
        $(t).parent().parent().parent().remove();
    }
</script>

<script>
    function delsporderlt(shop_orderltlt_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + shop_orderlt_id);
        if (x == true) {
            window.location.href = "add_shop_orderlt.php?delete=" + shop_orderlt_id;
        }
    }

    function editShopOdr(a, b) {
        $("#pro_code").val(a).trigger('change');
        $("#qty").val(b);
    }
</script>