<?php
include_once("../../class/product_cat.php");
$procatObject = new product_cat();
//delete product category item 
if (isset($_GET["delete"])) {
    $procatObject->del($_GET["delete"]);
}
// Edit product category item
if (isset($_GET["pcr"])) {
    $product_cat = $procatObject->get_by_id($_GET["pcr"]);
} else
    $product_cat = (array)$procatObject;

if (isset($_POST["procat_name"])) {
    $procatObject->procat_name = $_POST["procat_name"];
    $procatObject->procat_descrip = $_POST["procat_descrip"];

    $procatObject->save();
}
$all = $procatObject->get_all();
// print_r($all);
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
                                                             <!-- condition ? value_if_true : value_if_false; -->
                    <h2 class="pageheader-title"><?= isset($_GET["pcr"]) ? "Edit" : "Add"?>Product Category  <?= isset($_GET["pcr"]) ? "ID:". isset($_GET["pcr"] ): "" ?></h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?=isset($_GET["pcr"]) ? "Edit" : "Add"?>Product Category</li>
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
                <form action="add_product_cat.php" method="post">
                    <?php if (isset($_GET['pcr'])) ?>

                    <h5 class="card-header">Product Category</h5>
                    <div class="">
                        <?php if (isset($_GET['pcr'])) { ?>
                            <input id="inputcategory" type="hidden" name="procat_id" value="<?= $_GET['pcr'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control"><?php } ?>
                        <div class="card">
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Product Category</label>
                                <div class=" col-lg-8">
                                    <input id="inputdescription" type="text" name="procat_name" value="<?= $product_cat['procat_name'] ?>" required="" data-parsley-type="change" placeholder="Category name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputdescription" class="col-lg-3 col-form-label text-right">Description</label>
                                <div class="col-lg-8">
                                    <!-- <input id="inputdescription" type="text" name="procat_descrip" value="<?= $product_cat['procat_descrip'] ?>" required="" data-parsley-type="description" placeholder="Description" class="form-control"> -->
                                    <textarea class="form-control " id="" name="procat_descrip" rows="1"> <?= $product_cat['procat_descrip'] ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-space btn-success"><?=isset($_GET["pcr"]) ? "Update" : "Add"?> Category</button>
                                                <button class="btn btn-space btn-danger" type="reset">Cancel</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">Category Table</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th style="width:150px;">Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["procat_id"] ?></td>
                                    <td><?= $item["procat_name"] ?></td>
                                    <td><?= $item["procat_descrip"] ?></td>
                                    <td class="action-tab"><a href="add_product_cat.php?pcr=<?= $item['procat_id'] ?>" class="btn btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit"></i> &nbsp;Edit</a>
                                        <a href="#" class="btn btn-outline-danger btn-xs" onclick="delcat(<?= $item['procat_id'] ?>)"> <i class="icon-trash"> </i>Delete</a>
                                    </td>

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
    function delcat(procat_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete category id  " + procat_id);
        if (x == true) {
            window.location.href = "add_product_cat.php?delete=" + procat_id;

        }
    }
</script>