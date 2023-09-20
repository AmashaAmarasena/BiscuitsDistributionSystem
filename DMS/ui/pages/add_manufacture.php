<?php
include_once ("../pages/head.php");
include_once("../../class/manufacture.php");
$macObject = new manufacture();

if (isset($_GET["delete"])) {
    $macObject->del($_GET["delete"]);
}

//Edit manufacture
if (isset($_GET["mr"])) {
    $manufacture = $macObject->get_by_id($_GET["mr"]);
} else
    $manufacture = (array)$macObject;

if (isset($_POST["mac_name"])) {
    $macObject->mac_name = $_POST["mac_name"];
    $macObject->mac_descrip = $_POST["mac_descrip"];

    $macObject->save();
}
$all = $macObject->get_all();

//include the product_category file 

// including the header part


?>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Add/Edit Supplier </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add/Edit Supplier</li>
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
                <form action="add_manufacture.php" method="post">
                    <?php if (isset($_GET["mr"]))  ?>
                    <div class="card">
                        <h5 class="card-header">Add/Edit Supplier</h5>
                        <div class="card-body">

                            <?php if (isset($_GET["mr"])) { ?>
                                <input id="inputcategory" type="text" name="mac_id" value="<?= $manufacture['mac_id'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control" <?php } ?> <div class="invalid-feedback" style="display:block;">

                                <div class="form-group row">
                                    <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Supplier Name</label>
                                    <div class=" col-lg-5">
                                        <input id="inputcategory" type="text" name="mac_name" value="<?= $manufacture['mac_name'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Description</label>
                                    <div class=" col-lg-5">
                                        <!-- <input id="inputcategory" type="text area" name="mac_descrip" value= "<?= $manufacture['mac_descrip'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control"> -->
                                        <textarea class="form-control " id="" name="mac_descrip" rows="5" cols="5"><?= $manufacture['mac_descrip'] ?></textarea>
                                    </div>
                                </div>

                                <!--
                                        <div class="form-group row">
                                            <label for="weightMeasure" class=" col-lg-3 col-form-label text-right">Please select (Kg / g)</label>
                                            <div class=" col-lg-5">
                                            <label class="custom-control custom-radio custom-control-inline">
    
                                            <input type="radio" name="weightMeasure" checked="" class="custom-control-input" id="weightMeasure">
                                        <span class="custom-control-label">Kg</span>
                                                                                    
                                        </label>
                                                                                    
                                        
                                            <label class="custom-control custom-radio custom-control-inline">
                                                
                                                <input type="radio" name="weightMeasure" class="custom-control-input">
                                        <span class="custom-control-label">g</span>
                                                                                    
                                            </label>
                                            
                                                                                    
                                        
                                           
                                            </div>

                                        </div>-->

                                <div class="col-sm-6 pl-0">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-success">Submit</button>
                                        <button class="btn btn-space btn-danger" type="reset" onclick="location.reset();">Cancel</button>
                                    </p>
                                </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">Manufacture</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Supplier id</th>
                                <th>Supplier Name</th>
                                <th>Supplier Description</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["mac_id"] ?></td>
                                    <td><?= $item["mac_name"] ?></td>
                                    <td><?= $item["mac_descrip"] ?></td>

                                    <td>
                                        <a href="add_manufacture.php?mr=<?= $item['mac_id'] ?>" class="btn btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit">Edit</a></i>
                                        <a href="#" class="btn btn-outline-danger btn-xs" onclick="delcat(<?= $item['mac_id'] ?>)"><i class="icon-trash">Delete</i></a>
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
</div>




<?php
include_once "../pages/foot.php";
?>

<script>
    function delcat(mac_id) {
        //  alert(mac_id);
        x = confirm("Are you sure you want to delete" + mac_id);
        if (x == true) {
            window.location.href = "add_manufacture.php?delete=" + mac_id;

        }
    }
</script>