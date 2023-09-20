<?php
include_once "../pages/head.php";
include_once("../../class/staff_role.php");

include_once("../../class/mod_functions.php");
$permission_object = new Mod_functions();

$stroleObject = new staff_role();

if (isset($_GET["str"])) {
    $staffRole = $stroleObject->get_by_id($_GET["str"]);
} else
    $staffRole = (array)$stroleObject;

if (isset($_GET["delete"])) {
    $stroleObject->del($_GET["delete"]);
}

if (isset($_POST["role_name"])) {
    $stroleObject->role_name = $_POST["role_name"];
    $stroleObject->role_descrip = $_POST["role_descrip"];

    $stroleObject->save();
}
$all = $stroleObject->get_all();




?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title"><?= isset($_GET["str"]) ? "Edit" : "Add"?> Staff Role  <?= isset($_GET["str"]) ? "ID:". isset($_GET["str"] ): "" ?> </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Staff role</li>
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
                <form action="add_staff_role.php" method="post">
                    <div class="card">
                        <h5 class="card-header"><?= isset($_GET["str"]) ? "Edit" : "Add"?> Staff Role</h5>
                        <div class="card-body">
                            <?php if (isset($_GET["str"])) { ?>
                                <input id="inputcategory" type="hidden" name="role_id" value="<?= $staffRole['role_id'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control" <?php } ?> <div class="invalid-feedback" style="display:block;">
                                <div class="form-group row">
                                    <label for="inputname" class=" col-lg-3 col-form-label text-right">Role Name</label>
                                    <div class=" col-lg-6">
                                        <input id="inputname" type="text" name="role_name" value="<?= $staffRole['role_name'] ?>" required="" data-parsley-type="change" placeholder="Role name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputdescription" class="col-lg-3 col-form-label text-right">Description</label>
                                    <div class="col-lg-6">
                                        <textarea id="inputdescription"  name="role_descrip" row="5" value="<?= $staffRole['role_descrip'] ?>" required="" data-parsley-type="change" placeholder="Description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit" class="btn btn-space btn-success"><?=isset($_GET["str"]) ? "Update" : "Add"?> Submit</button>
                                                    <button class="btn btn-space btn-danger">Cancel</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </form>
            </div>
       </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <h5 class="card-header">Role Table</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Role Id</th>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["role_id"] ?></td>
                                    <td><?= $item["role_name"] ?></td>
                                    <td><?= $item["role_descrip"] ?></td>
                                    <td>
                                        <a href="add_staff_role.php?str=<?= $item['role_id'] ?>" class="btn btn-sm btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit">Edit</a></i>
                                        <a href="#" class="btn btn-outline-danger btn-sm btn-xs" onclick="delrole(<?= $item["role_id"] ?>)"><i class="icon-trash">Delete</i></a>
                                        <?php if($permission_object->check_permision_for_currnt_user("Manage Role Permission")){ ?>
                                            <a href="manage_role_permission.php?role_id=<?= $item['role_id'] ?>" class="btn btn-sm btn-outline-warning btn-xs"><i class="icon-lock" title="Edit">Permission</a></i>
                                        <?php } ?>
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
    function delrole(role_id) {
        //  alert(role_id);
        x = confirm("Are you sure you want to delete" + role_id);
        if (x == true) {
            window.location.href = "add_staff_role.php?delete=" + role_id;

        }
    }
</script>