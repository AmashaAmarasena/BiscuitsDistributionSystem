<?php
include_once("../../class/vehicle.php");
include_once("../pages/head.php");
//$loadObject = new load();


//include the manufacture file 

$vehObject = new vehicle();
$apack = $vehObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all_st();

// including the header part
?>
<div class="dashboard-wrapper">

    <form action="add_stock_report.php" method="post" id="addstockReport">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Stock Report </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Stock</li>
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
                        <h5 class="card-header">Stock Report</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Store</label>
                                        <select class="col-lg-5" name="store_id" id="store_id" class="store_number">
                                            <option value="-2">Full stock</option>
                                            <option value="0">Main stock</option>
                                            <?php
                                            foreach ($apack as $item) {
                                            ?>
                                                <option value="<?= $item["veh_id"] ?>"><?= $item["veh_number"] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                            Please fill all the fields
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Generate</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="container-fluid dashboard-content">
            <div class="card">
                <h5 class="card-header">Product Items Stock</h5>
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" name="ordListTable" id="table_id">
                            <thead>
                                <tr>
                                    <th>Product id</th>
                                    <th>Product category</th> 
                                    <th>Re order level</th>
                                    <th>Quantity</th>
                                  
                                    <!-- <th>Cost</th> -->

                                </tr>


                            </thead>
                            <tbody id="td">

                                <?php
                                foreach ($apro as $item) {
                                ?>

                                    <tr>
                                        <td><?= $item["pro_name"] ?></td>
                                        <td><?= $item["procat_name"] ?></td> 
                                        <td><?= $item["pro_reorder_level"] ?></td>
                                        <td><?= ($item["sumStIn"] - $item["sumStOut"]); ?></td>
                                       


                                        <!-- <td><i class="icon-pencil" title="Edit">Edit</i>&nbsp;&nbsp;&nbsp;
                                            <i class="icon-trash" style="color:red"><a href="#" onclick="delcat(<?= $item['pro_id'] ?>)" style="color:red">Delete</a></i>
                                        </td> -->
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                            </tfoot>
                        </table>
                    </div>
                        <!-- <p class="text-right">
                            <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                        </p> -->
                </div>
            </div>
        </div>
        </div>
    </form>
</div>




<?php
include_once "../pages/foot.php";
?>

<script>
    $(document).ready(function() {
        $('#store_id').select2();
    });

    function addrow() { //To add a product item

        a = $("#pro_id").val();
        b = $("#category").val(); //quantity
        c = $("#descrip").val();
        d = $("#qty").val();
        e = $("#cost").val();


        $("#td").append("<tr><td>" + a + "<input type='hidden'  name='pro_id[]' value='" + a + "'></td><td>" + b + "<input type='hidden'  name='category[]' value='" + b + "'></td><td>" + c + "</td><td class='d-none'>" + c + "<input type='hidden'  name='grndescrip[]' value='" + c + "'></td><td>" + d + "<input type='hidden'  name='grnlt_purchase_price[]' value='" + d + "'></td><td>" + e + "<input type='hidden'  name='ex_date[]' value='" + e + "'></td><td>" + f + "<input type='hidden'  name='sales_price[]' value='" + f + "'></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delstock(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
        $("#item").val("");
        $("#qty").val("");
        $("#descrip").val("");
        $("#purchase_price").val("");
        $("#ex_date").val("");
        $("#sales_price").val("");

        $("#item").focus();
        addText();
    }
    //function to manufacture name and dateas text

    function delstock(t) {
        $(t).parent().parent().parent().remove();
    }
</script>

<script>
    function delcat(product_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + product_id);
        if (x == true) {
            window.location.href = "add_stock_report.php?delete=" + product_id;
        }
    }
</script>