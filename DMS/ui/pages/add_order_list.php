<?php
include_once ("../pages/head.php");
include_once("../../class/ordr.php");
$orderObject = new ordr();

if (isset($_GET["or"])) {
    $order = $orderObject->get_by_id($_GET["or"]);
} else
    $order = (array)$orderObject;

//$orderObject = new order();
if (isset($_POST['mac_name']))  // save if data available
{
    $orderObject->order_date = $_POST["order_date"];
    $orderObject->fk_mac_id = $_POST["mac_name"];
    $orderObject->order_refno = $_POST['order_refno'];
    $orderObject->order_note = $_POST['order_note'];

    $orderObject->save();
}

$allorder = $orderObject->get_all();  // all orders to display

//include the manufacture file 
require_once("../../class/manufacture.php");
$macObject = new manufacture();
$amac = $macObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

// including the header part

?>
<div class="dashboard-wrapper">

    <form action="add_order_list.php" method="post" id="addOrderForm">
        <div class="container-fluid dashboard-content">
            <?php if (isset($_GET["or"])) { ?>
                <input id="inputcategory" type="text" name="order_id" value="<?= $order['order_id'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control" <?php } ?> <!--==============================================================-->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">

                            <h2 class="pageheader-title">Supplier Order </h2>
                            <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Order</li>
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
                            <h5 class="card-header">Add Order</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="manufacture" class="col-form-label">Manufacture</label>
                                            <select name="mac_name" class="form-control" id="manufactureName">
                                                <?php
                                                foreach ($amac as $item) {
                                                ?>
                                                    <option value="<?= $item["mac_id"] ?>"><?= $item["mac_name"] ?> </option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="orderDate" class="col-form-label">Order Date</label>
                                            <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                            <input id="date" type="date" name="order_date" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="refno" class="col-form-label">REF NO.</label>
                                            <input id="refno" type="text" name="order_refno" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="note" class="col-form-label ">Note</label>
                                            <textarea class="form-control col-lg-11" id="note" name="order_note" rows="1"></textarea>
                                        </div>
                                    </div> 
                                </div><hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class="col-form-label">Order Item</label>
                                            <select name="pro_name" class="form-control" id="pro_name">
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
                                            <input id="qty" type="text" name="orderlt_qty" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputcategory" class="col-form-label">Description</label>
                                            <input id="descrip" type="text" name="orderlt_descrip" data-parsley-type="change" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                    Please fill all the fields
                                </div>
                                <div class="form-group row">
                                   <div class="col-lg-6 pl-0">
                                        <p class="text-right">
                                            <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Items</button>
                                        </p>
                                    </div>
                                    <div class="col-lg-1  pl-0">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-danger" type="reset" onclick="location.reload();">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Orders</h5>
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered " name="ordListTable">
                                    <thead>
                                        <tr>
                                            <th>Order Item</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="td">
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-lg-12 pl-0">
                                <p class="text-right">
                                  <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                                </p>
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

$(document).ready(function() {
        $('#manufactureName').select2();
        $('#pro_name').select2();
    });
    function addrow() { //To add a product item
        var aa = $("#pro_name option:selected").text();
        a = $("#pro_name").val();
        b = $("#qty").val(); //quantity
        c = $("#descrip").val();
        d = $("#ordDate").val(); //order date

        $("#td").append("<tr id='pro_name " + a + "'><td>" + aa + "<input type='hidden'  name='pro_name[]' value='" + a + "'></td><td>" + b + "<input type='hidden'  name='orderqty[]' value='" + b + "'></td><td>" + c + "</td><td class='d-none'>" + d + "<input type='hidden'  name='orderdescrip[]' value='" + c + "'></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delorder(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
        $("#item").val("");
        $("#qty").val("");
        $("#descrip").val("");
        $("#ordDate").val("");


        $("#item").focus();
        addText();
    }

    //function to manufacture name and dateas text
    function delorder(t) {

        $(t).parent().parent().parent().remove();
    }
</script>

<script>
    function del(orderlt_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + orderlt_id);
        if (x == true) {
            window.location.href = "add_orderlt.php?delete=" + orderlt_id;

        }
    }
</script>