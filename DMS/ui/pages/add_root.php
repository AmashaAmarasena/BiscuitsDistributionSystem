<?php
include_once("../../class/root.php");

$rootObject = new root();

if (isset($_GET["delete"])) {
    $rootObject->del($_GET["delete"]);
}

if (isset($_POST["root_name"])) {
    $rootObject->root_code = $_POST["root_code"];
    $rootObject->root_name = $_POST["root_name"];

    $rootObject->save();
}
$all = $rootObject->get_all();
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

                    <h2 class="pageheader-title">Root </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Root</li>
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
                <form action="add_root.php" method="post">
                    <div class="card">
                        <h5 class="card-header">Root</h5>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-3 col-form-label text-right">Root Code</label>
                                <div class=" col-lg-8">
                                    <input id="inputdescription" type="text" name="root_code" required="" data-parsley-type="change" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputdescription" class="col-lg-3 col-form-label text-right">Root Name</label>
                                <div class="col-lg-8">
                                    <input id="inputdescription" type="text" name="root_name" required="" data-parsley-type="description" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-success">Submit</button>
                                    <button class="btn btn-space btn-danger">Cancel</button>
                                </p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">Root Table</h5>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered second" id="example">
                        <thead>
                            <tr>
                                <th>Root Id</th>
                                <th>Root Code</th>
                                <th>Root Name</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["root_id"] ?></td>
                                    <td><?= $item["root_code"] ?></td>
                                    <td><?= $item["root_name"] ?></td>
                                    <td><i class="icon-pencil" title="Edit" style="color:blue">
                                        <a href="add_root.php?rt=<?= $item['root_id'] ?>" style="color:blue">Edit</i></a>

                                    <i class="icon-trash" title="Delete" style="color:red">
                                        <a href="#" style="color: red;" onclick="delcat(<?= $item['root_id'] ?>)">Delete</i></a>
                                    </td>
                                    <!-- <td><i class="icon-pencil" title="Edit">Edit</i>&nbsp;&nbsp;&nbsp;
                                                    <i class="icon-trash" ><a href="#" class="btn btn-outline-danger" onclick="delcat(<?= $item["root_id"] ?>)">Deactivate</a></i></td>
                                                     -->
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
    function delcat(root_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + root_id);
        if (x == true) {
            window.location.href = "add_root.php?delete=" + root_id;

        }
    }
</script>