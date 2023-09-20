<?php

// session_start();
// $_SESSION['number'] = 1;
include_once("../../class/store.php");
$storeObject = new store();

if (isset($_GET["delete"])) {
    $storeObject->del($_GET["delete"]);
}

if (isset($_POST["store_name"])) {
    $storeObject->store_name = $_POST["store_name"];
    $storeObject->store_address = $_POST["store_address"];
    $storeObject->store_phone = $_POST["store_phone"];
    $storeObject->store_email = $_POST["store_email"];
    $storeObject->fk_root_id = $_POST["root_name"];
    $storeObject->fk_cus_id = $_POST["cus_name"];


    $storeObject->save();
    // $_SESSION['flag'] = false;
    // $_SESSION['number'] = 2;

}




$all = $storeObject->get_all();

include_once("../../class/root.php");
$rootObject = new root();
$ar = $rootObject->get_all();

include_once("../../class/customer.php");
$cusObject = new customer();
$ac = $cusObject->get_all();

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

                    <h2 class="pageheader-title">Add Store </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Store</li>
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
                <form action="add_store.php" method="post">
                    <div class="card">
                        <h5 class="card-header">Add Store</h5>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputstorename" class=" col-lg-3 col-form-label text-right">Store Name</label>
                                <div class=" col-lg-5">
                                    <input id="storename" type="text" name="store_name" required="" data-parsley-type="change" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">


                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right" oninvalid="this.setCustomValidity('Select the category')" onvalid="this.setCustomValidity('')"> Store Owner</label>
                                <div class=" col-lg-5">
                                    <select name="cus_name" class="form-control" id="cus_id" required="">
                                        <option value=""></option>
                                        <?php
                                        foreach ($ac as $item) {
                                        ?>

                                            <option value="<?= $item["cus_id"] ?>"><?= $item["cus_name"] ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputstroot" class=" col-lg-3 col-form-label text-right">Root</label>
                                <div class=" col-lg-5">
                                    <select name="root_name" class="form-control" id="root_name" required oninvalid="this.style.borderColor='red';">
                                        <option value="all"> Select Root</option>

                                        <?php
                                        foreach ($ar as $item) {
                                        ?>
                                            <option value="<?= $item["root_id"] ?>"><?= $item["root_name"] ?> </option>
                                        <?php }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputaddress" class="col-lg-3 col-form-label text-right">Address</label>
                                <div class=" input-group col-lg-5">
                                    <textarea class="form-control col-lg-12" id="address" name="store_address" rows="1"></textarea>  
                                </div>        
                                <!-- <div class=" input-group col-lg-5">
                                                <input id="" type="text" name="" required="" data-parsley-type="change" placeholder="" class="form-control">
                                            
                                            </div>  -->
                            </div>

                            <div class="form-group row">
                                <label for="inputphone" class="col-lg-3 col-form-label text-right">Phone No</label>
                                <div class=" input-group col-lg-5">
                                    <input id="sotrephone" type="text" name="store_phone" required="" data-parsley-type="change" placeholder="" class="form-control">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputemail" class=" col-lg-3 col-form-label text-right">E mail</label>
                                <div class=" input-group col-lg-5">
                                    <input id="storeemail" type="text" name="store_email" data-parsley-type="change" placeholder="" class="form-control">

                                </div>
                            </div>
                           
                        </div>
                            <div class="card-footer">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-sm-6 pl-0">
                                                    <p class="text-right">
                                                        <button type="submit" class="btn btn-space btn-success">Submit</button>
                                                    </p>
                                                </div>
                                                <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-lg-1  pl-0">
                                                    <p class="text-right">
                                                        <button class="btn btn-space btn-danger">Cancel</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                            //    if(isset($_SESSION['flag']) && $_SESSION['flag']== false )
                            //    {
                            //        echo("<script>alert('hello')</script>");
                            //        unset($_SESSION['flag']);
                            //       // header('Location:add_staff.php');
                            //    }else if($_SESSION['number'] == 2){
                            //     $_SESSION['flag'] = true;
                            //    }

                            ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">Store</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Store Id</th>
                                <th>Name</th>
                                <th>Owner Name</th>
                                <th>Root Name</th>
                                <th>Address</th>
                                <th>Phone No</th>
                                <th>E mail</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["store_id"] ?></td>
                                    <td><?= $item["store_name"] ?></td>
                                    <td><?= $item["cus_name"] ?></td>
                                    <td><?= $item["root_name"] ?></td>
                                    <td><?= $item["store_address"] ?></td>
                                    <td><?= $item["store_phone"] ?></td>
                                    <td><?= $item["store_email"] ?></td>
                                    <td>
                                        <a href="add_store.php?cr=<?= $item['store_id'] ?>" class="btn btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit" ></i>Edit</a>
                                        <a href="#" style="color: red;" onclick="delcat(<?= $item['store_id'] ?>)" class="btn btn-outline-danger btn-xs"><i class="icon-trash" title="Delete"></i>Delete</a>                                         
                                    </td>
                                    <!-- <td><i class="icon-pencil" title="Edit">Edit</i>&nbsp;&nbsp;&nbsp;
                                        <i class="icon-trash"><a href="#" onclick="delcat(<?= $item['store_id'] ?>)">Delete</a></i>
                                    </td> -->
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





<?php
include_once "../pages/foot.php";
?>

<script>
    function delcat(store_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete " + store_id);
        if (x == true) {
            window.location.href = "add_store.php?delete=" + store_id;

        }
    }
</script>