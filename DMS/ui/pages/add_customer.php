<?php
include_once("../../class/customer.php");
//initiate an object from the customer table
$cusObject = new customer();

if (isset($_GET["delete"])) {
    $cusObject->del($_GET["delete"]);
}

if (isset($_GET["cr"])) {
    $customer = $cusObject->get_by_id($_GET["cr"]);
} else
    $customer = (array)$cusObject;
/** check if the POST array contains any value for input box with
 *attribute name as cus_name */
if (isset($_POST["cus_name"])) {
    $cusObject->cus_name = $_POST["cus_name"];
    $cusObject->cus_phone = $_POST["cus_phone"];
    $cusObject->cus_email = $_POST["cus_email"];
    $cusObject->cus_address = $_POST["cus_address"];
    $cusObject->cus_regdate = $_POST["cus_regdate"];

    //save to the database
    $cusObject->save();
}
$all = $cusObject->get_all();


// including the header part

include_once "../pages/head.php";
?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- <?php if (isset($res) && $res == true)
            echo '<div class="alert alert-success" role="alert">
                Product Added successfully!
            </div>';
        if (isset($res1) && $res1 == true)
            echo '<div class="alert alert-warning" role="alert">
                Product Successfully Deleted!
            </div>';
        ?> -->
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Customer </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customer</li>
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
                <form action="add_customer.php" method="post">
                    <?php if (isset($_GET["cr"])) { ?>
                        <input id="inputcategory" type="text" name="cus_id" value="<?= $customer['cus_id'] ?>" required data-parsley-type="change" placeholder="" class="form-control" <?php } ?> <div class="card">
                        <h5 class="card-header">Customer</h5>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Customer Name</label>
                                <div class=" col-lg-8">
                                    <input id="inputcategory" type="text" name="cus_name" value="<?= $customer['cus_name'] ?>" required pattern="[A-Za-z || . || 0-9_]{3,}" title="Required at least 3 letters" data-parsley-type="change" placeholder="Enter customer name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputdescription" class="col-lg-3 col-form-label text-right">Customer Phone No</label>
                                <div class="col-lg-8">
                                    <input id="inputdescription" type="tel" name="cus_phone" value="<?= $customer['cus_phone'] ?>" required pattern="^(?:\+94|0)?[0-9]{9}$" title="Required 10 digits" data-parsley-type="change" placeholder="Enter phone number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Customer Email</label>
                                <div class=" col-lg-8">
                                    <input id="inputcategory" type="email" name="cus_email" value="<?= $customer['cus_email'] ?>" required data-parsley-type="change" placeholder="Enter email address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Customer Address</label>
                                <div class=" col-lg-8">
                                    <input id="inputcategory" type="text" name="cus_address" value="<?= $customer['cus_address'] ?>" required="" data-parsley-type="change" placeholder="Enter address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Customer Registerd Date</label>
                                <div class=" col-lg-8">
                                    <input id="inputcategory" type="date" name="cus_regdate" value="<?= $customer['cus_regdate'] ?>" required data-parsley-type="change" placeholder="Enter registered date" class="form-control">
                                </div>
                            </div>



                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <button class="btn btn-space btn-secondary" type="reset">Cancel</button>
                                </p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Customer Table</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered " name="cusListTable" id="table_id">
                        <thead>
                            <tr>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Registerd Date</th>
                                <th style="width: 115px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["cus_id"] ?></td>
                                    <td><?= $item["cus_name"] ?></td>
                                    <td><?= $item["cus_phone"] ?></td>
                                    <td><?= $item["cus_email"] ?></td>
                                    <td><?= $item["cus_address"] ?></td>
                                    <td><?= $item["cus_regdate"] ?></td>
                                    <td> 
                                       <a href="add_customer.php?cr=<?= $item['cus_id'] ?>" class="btn btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit"></i> Edit</a>                                     
                                        <a href="#" onclick="delcat(<?= $item['cus_id'] ?>)" class="btn btn-outline-danger btn-xs"><i class="icon-trash" title="Delete"></i> Delete</a>
                                                                           
                                    </td>
                                </tr>
                            <?php }; ?>
                        <tbody id="td">
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
 </div> <!--  End of dashboard-wrapper -->
<!-- </div>
</div>
</div>
</div> -->



<?php
include_once "../pages/foot.php";
?>

<script>
    function delcat(cus_id) {

        x = confirm("Are you sure you want to delete" + cus_id);
        if (x == true) {
            window.location.href = "add_customer.php?delete=" + cus_id;

        }
    }
</script>