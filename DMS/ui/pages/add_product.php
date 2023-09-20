<?php

// including the header part
include_once "../pages/head.php";
include_once("../../class/product.php");

include_once("../../class/mod_functions.php");
$permission_object = new Mod_functions();
echo $permission_object->check_permision_for_currnt_user("Add/Edit Product",true);

//$proObject = new product();
$proObject = new product();
if (isset($_GET["delete"])) {
    $res2 = $proObject->del($_GET["delete"]);
}
//get data from the product table to view onthe product form
if (isset($_GET["pr"])) {
    /**object call the function that gets data of a particular 
    id from product table */
    $product = $proObject->get_by_id($_GET["pr"]);
} else
    $product = (array)$proObject;
/*check if the post array contains any value
 for the input box with attribute name as pro_name*/
if (isset($_POST["pro_name"])) { 

    $proObject->pro_name = $_POST["pro_name"];
    $proObject->pro_code = $_POST["pro_code"];
    // $proObject->pro_packsize = $_POST["pro_packsize"].$_POST['proPackWeight'];
    // $proObject->pro_items_in_pack = $_POST["pro_items_in_pack"];
    $proObject->pro_weight = $_POST["pro_weight"] . $_POST['proWeight'];
    $proObject->pro_reorder_level = $_POST["pro_reorder_level"];
    $proObject->fk_procat_id = $_POST['procat_name'];
    $res = $proObject->save();
    
}
$all = $proObject->get_all();

//include the product_category file 
include_once("../../class/product_cat.php");
$procatObject = new product_cat();
$ac = $procatObject->get_all();

?>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <?php if (isset($res) && $res == true)
            echo '<div class="alert alert-success" role="alert">
                Product Added successfully!
            </div>';
        if (isset($res2) && $res2 == true)
            echo '<div class="alert alert-warning" role="alert">
                Product Successfully Deleted!
            </div>';
        ?>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                                                         <!-- condition ? value_if_true : value_if_false; -->
                    <h2 class="pageheader-title"><?= isset($_GET["pr"]) ? "Edit" : "Add" ?> Product <?= isset($_GET["pr"]) ? " ID: " . $_GET["pr"] : "" ?></h2>
                    <!-- <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p> -->
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= isset($_GET["pr"]) ? "Edit" : "Add" ?> Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="add_product.php" method="post" id="f1">
                    <?php if (isset($_GET["pr"])) { ?>
                        <input id="pro_id" type="hidden" name="pro_id" value="<?= $product['pro_id'] ?>">
                    <?php } ?>
                    <div class="card">
                        <h5 class="card-header"><?= isset($_GET["pr"]) ? "Edit" : "Add" ?> Product</h5>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Product Name <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-5">
                                    <input id="inputcategory" type="text" name="pro_name" value="<?= $product['pro_name'] ?>" required pattern="[A-Za-z || 0-9_]{3,}" title="Required at least 3 letters" data-parsley-type="change" placeholder="Enter product name" class="form-control" oninvalid="this.style.borderColor='red';" class="invalid-feedback" style="display:block;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right" oninvalid="this.setCustomValidity('Select the category')" onvalid="this.setCustomValidity('')"> Product Category <span class="req" style="color: red;">* </span> </label>
                                <div class=" col-lg-5">
                                    <select name="procat_name" class="form-control" id="procat_id"  required oninvalid="this.style.borderColor='red';">
                                        <option value="all"> Select Category</option>
                                        <?php
                                        foreach ($ac as $item) {
                                        ?>
                                            <option value="<?= $item["procat_id"] ?>"><?= $item["procat_name"] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputdescription" class="col-lg-3 col-form-label text-right">Product Code <span class="req" style="color: red;">* </span></label>
                                <div class="col-lg-5">
                                    <input id="p_code" type="text" name="pro_code" value="<?= $product['pro_code'] ?>" required oninvalid="this.style.borderColor='red';" title="data-parsley-type=" change placeholder="Enter product code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom03" class=" col-lg-3 col-form-label text-right">Net Weight <span class="req" style="color: red;">* </span> </label>
                                <div class=" input-group col-lg-5">
                                    <input id="pro_weight" type="text" name="pro_weight" autocomplete="off" value="<?= $product['pro_weight'] ?>" required oninvalid="this.style.borderColor='red';" data-parsley-type="change" placeholder="Net Weight" class="form-control">
                                    <div class="input-group-append be-addon">
                                        <select class="btn btn-outline-dark text-center" name='proWeight'>
                                            <option value="kg">Kg</option>
                                            <option value="g">g</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom03" class=" col-lg-3 col-form-label text-right">Re Order level <span class="req" style="color: red;">* </span> </label>
                                <div class=" input-group col-lg-5">
                                    <input id="pro_reorder_level" type="number" name="pro_reorder_level" value="<?= $product['pro_reorder_level'] ?>" required oninvalid="this.style.borderColor='red';" data-parsley-type="change" placeholder="Re Order Level" class="form-control">
                                </div>
                            </div>
                         </div> <!-- end .card-body -->
                            <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-sm-6 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-success"><?= isset($_GET["pr"]) ? "Update" : "Add" ?> Product</button>
                                            <a href="add_product.php"><button class="btn btn-space btn-danger" type="reset">Cancel</button></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            </div>
                       
                    </div> <!-- end .card -->
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                <h5 class="card-header">Product List</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="table_id">
                                <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Code</th>
                                        <!-- <th>Product Pack Size</th>
                            <th>Items In pack</th> -->
                                        <th>Weight</th>
                                        <th>Re order Level</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody id="td">
                                    <?php
                                    foreach ($all as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $item["pro_id"] ?></td>
                                            <td><?= $item["pro_name"] ?></td>
                                            <td><?= $item["procat_name"] ?></td>
                                            <td><?= $item["pro_code"] ?></td>
                                            <!-- <td><?= $item["pro_packsize"] ?></td> -->
                                            <!-- <td><?= $item["pro_items_in_pack"] ?></td> -->
                                            <td><?= $item["pro_weight"] ?></td>
                                            <td><?= $item["pro_reorder_level"]?></td>
                                            <td class="action"><a href="add_product.php?pr=<?= $item['pro_id'] ?>" class="btn btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit"></i>&nbsp;Edit</a>
                                            <a href="#" class="btn btn-outline-danger btn-xs" onclick="delcat(<?= $item['pro_id'] ?>)"><i class="icon-trash" title="Delete"></i>Delete</a>
                                            </td>
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
    <?php
    include_once "../pages/foot.php";
    ?>
    <script>
        //If document ready
        $(document).ready(function() {
            $('#procat_id').select2();
        });

        
        $('#procat_id').val(<?=$product['fk_procat_id'] ?>);


        

        function delcat(pro_id) {
            //  alert(procat_id);
            x = confirm("Are you sure you want to delete product " + pro_id);
            if (x == true) {
                window.location.href = "add_product.php?delete=" + pro_id;

            }
        }
        $("#procat_id").val("<?= $item["procat_id"] ?>").trigger('change');
        // $("#pro_weight").val("<?= $item["pro_weight"] ?>").trigger('change');
        //
        $("#f1").submit(function(e) {
            e.preventDefault(); //prevent the default action of the form 
            var a = $(this);
            var pid = "";
            <?php if (isset($_GET["pr"])) { ?>
                pid = $("#pro_id").val();
            <?php } ?>
            $.ajax('/DMS/class/ajax.php?p_code=' + $("#p_code").val() + "&p_id=" + pid, {
                type: "GET"
            }).done(function(response) {
                if (response == 'No') {
                    a.unbind('submit').submit();
                } else
                    alert("Sorry,Product code is already in use.")
            });
        });
    </script>