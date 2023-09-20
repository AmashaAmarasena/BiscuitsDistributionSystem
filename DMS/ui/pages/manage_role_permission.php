<?php
    include_once "../pages/head.php";
    include_once("../../class/mod_functions.php");
    include_once("../../class/staff_role.php");

    $permission_object = new Mod_functions();
    $staff_role_object = new staff_role();

    echo $permission_object->check_permision_for_currnt_user("Manage Role Permission",true);

    if(isset($_POST['role_id'])){
        $res = $permission_object->update_permission($_POST);
    }

    $permission_list = $permission_object->get_all();
    $role_information = $staff_role_object->get_by_id($_GET['role_id']);
    $already_granted_permissions = $permission_object->get_granted_permission_by_role_id($_GET['role_id']);
?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Manage Permission </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Permission</li>
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
                    <h5 class="card-header">Manage Role Permission</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="" method="post">
                                <input type="hidden" name="role_id" value="<?php echo $_GET['role_id'] ?>">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Role : <?php echo $role_information['role_name']; ?></th>
                                        </tr>
                                        <tr>
                                            <th>ID</th>
                                            <th>Function</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($permission_list as  $perm) { ?>
                                            <tr>
                                                <td><?php echo $perm['function_id'] ?></td>
                                                <td><?php echo $perm['function_name'] ?></td>
                                                <td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" <?php if(is_array($already_granted_permissions)){ if(in_array($perm['function_id'],$already_granted_permissions)){ ?>checked="" <?php }} ?> value="<?php echo $perm['function_id']?>" class="custom-control-input" name="permission[<?php echo $perm['function_id']?>]"><span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">
                                                <button type="submit" class="btn btn-sm btn-space btn-success">Update</button>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>


<?php 
$ARR = [2,3,45,5];
in_array(2,$ARR); //return true;
in_array(1,$ARR) ; //return false;


?>

<?php
include_once "../pages/foot.php";
?>