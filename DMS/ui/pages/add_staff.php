<?php

// session_start();
// $_SESSION['number'] = 1;
include_once("../../class/staff.php");
$staffObject = new staff();



if (isset($_GET["delete"])) {
    $staffObject->del($_GET["delete"]);
    $res2 = $staffObject->del($_GET["delete"]);
}

if (isset($_GET["sr"])) {
    $staff = $staffObject->get_by_id($_GET["sr"]);
} else
    $staff = (array)$staffObject;

if (isset($_POST["st_name"])) {

    if ($_POST['st_user_psswd'] != $_POST['st_user_psswd_repeat']) {
        $res3 = "Password Wrong";
    }

    if ($_POST['st_user_psswd'] != $_POST[''])

        $staffObject->st_name = $_POST["st_name"];
    $staffObject->st_gender = $_POST["st_gender"];
    // $staffObject->st_dob = $_POST["st_dob"];
    $staffObject->st_nic = $_POST["st_nic"];
    $staffObject->st_address = $_POST["st_address"];
    $staffObject->st_phone = $_POST["st_phone"];
    $staffObject->st_email = $_POST["st_email"];
    $staffObject->st_user_name = $_POST["st_user_name"];
    $staffObject->fk_role_id = $_POST["role_name"];
    $staffObject->fk_veh_id = $_POST["veh_number"];

    if (isset($_POST["st_user_psswd"])) {
        $staffObject->st_user_psswd = md5($_POST["st_user_psswd"]);
    } else {
        $staffObject->st_user_psswd = $staff['st_user_psswd'];
    }

    $res = $staffObject->save();
}




$all = $staffObject->get_all();

include_once("../../class/staff_role.php");
$stroleObject = new staff_role();
$ac = $stroleObject->get_all();

include_once("../../class/vehicle.php");
$vehstaffobject = new vehicle();
$vstaff = $vehstaffobject->get_all();

include_once "../pages/head.php";


?>

<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <?php if (isset($res) && $res == true){
            echo '<div class="alert alert-success" role="alert">
            "Staff registered successfully!
            </div>';
        }
        if(isset($res) && $res == false){
            echo '<div class="alert alert-danger" role="alert">
            "Database error.!
            </div>';
        }
            
        if (isset($res2) && $res2 == true){
            echo '<div class="alert alert-warning" role="alert">
                Staff Successfully Deleted!
            </div>';
        }

        if(isset($res3)){
            echo '<div class="alert alert-warning" role="alert">
                ' . $res3 . '
            </div>';
        }
        ?>
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title"><?= isset($_GET["sr"]) ? "Edit" : "Add" ?> Staff <?= isset($_GET["sr"]) ? "ID:". isset($_GET["sr"]): "" ?> </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?=isset($_GET["sr"]) ? "Edit" : "Add"?>Add Staff</li>
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
                <form action="add_staff.php" method="post" id="stform">
                    <?php if (isset($_GET["sr"])) { ?>
                        <input id="st_id" type="hidden" name="st_id" value="<?= $staff['st_id'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control">
                    <?php } ?>
                    <div class="card">
                        <h5 class="card-header">Add Staff</h5>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputstname" class=" col-lg-3 col-form-label text-right"> Employee Name <span class="req" style="color: red;">*</span></label>
                                <div class=" col-lg-5">
                                    <input id="inputstname" type="text" name="st_name" value="<?= $staff['st_name'] ?>" required pattern="[A-Za-z || . || 0-9_]{3,}" title="Required at least 3 letters" oninvalid="this.style.borderColor='red';" data-parsley-type="change" placeholder="Enter employee name" class="form-control">
                                    <!-- <div class="invalid-feedback" style="display:block;">
                                        Input letters(a-z).
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputstcategory" class=" col-lg-3 col-form-label text-right">Staff Category <span class="req" style="color: red;">*</span> </label>
                                <div class=" col-lg-5">
                                    <select name="role_name" id="role_id" class="form-control" required oninvalid="this.style.borderColor='red';">

                                        <option value="all"> Select Employee </option>
                                        <?php
                                        foreach ($ac as $item) {
                                        ?>
                                            <option value="<?= $item["role_id"] ?>"><?= $item["role_name"] ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputstcategory" class=" col-lg-3 col-form-label text-right">Vehicle </label>
                                <div class=" col-lg-5">
                                    <select name="veh_number" id="veh_id" class="form-control" required oninvalid="this.style.borderColor='red';">

                                        <option value="all"> Select Vehicle </option>
                                        <?php
                                        foreach ($vstaff as $item) {
                                        ?>
                                            <option value="<?= $item["veh_id"] ?>"><?= $item["veh_number"] ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <!-- <label for="inputgender" class="col-lg-3 col-form-label text-right">Gender <span class="req" style="color: red;">*</span> </label>
                                <div class="col-lg-5">
                                    <input id="inputgender" type="text" name="st_gender" value="<?= $staff['st_gender'] ?>" required="" data-parsley-type="change" oninvalid="this.style.borderColor='red';" placeholder="" class="form-control">
                                </div>
                            </div> 
                            <label class="custom-control custom-radio"> 
                                                <input type="radio" name="radio-stacked"  class="custom-control-input"><span class="custom-control-label">Male</span>
                                            </label> <br>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="radio-inline" class="custom-control-input"><span class="custom-control-label">Female</span>
                                            </label> -->


                                <label for="inputgender" class="col-lg-3 col-form-label text-right">Gender <span class="req" style="color: red;">*</span></label>

                                <div class="col-lg-5">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="st_gender" value="Male" class="custom-control-input" required="" data-parsley-type="change" oninvalid="this.style.borderColor='red';">
                                        <span class="custom-control-label">Male</span>
                                    </label><br>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="st_gender" value="Female" class="custom-control-input" required="" data-parsley-type="change" oninvalid="this.style.borderColor='red';">
                                        <span class="custom-control-label">Female</span>
                                    </label>
                                </div>
                            </div>



                            <!-- <label class="custom-control custom-radio">
                                                <input type="radio" name="radio-stacked"  class="custom-control-input"><span class="custom-control-label">Default Radio</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="radio-inline" class="custom-control-input" disabled><span class="custom-control-label">Default Radio</span>
                                            </label>
                            <div class="form-group row">
                                <label for="inputdob" class=" col-lg-3 col-form-label text-right">Date of Birth</label>

                                <div class=" input-group col-lg-5">
                                    <input id="inputdob" type="date" name="st_dob" value="<?= $staff['st_dob'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control">

                                </div>
                            </div> -->
                        </div>

                        <div class="form-group row">
                            <label for="inputnic" class=" col-lg-3 col-form-label text-right">NIC Number <span class="req" style="color: red;">*</span> </label>
                            <div class=" col-lg-5">
                                <input id="st_nic" type="text" onkeyup="validate_nic()" name="st_nic" value="<?= $staff['st_nic'] ?>" maxlength="10" title="" required oninvalid="this.style.borderColor='red';" data-parsley-type="change" placeholder="Enter NIC Number" class="form-control">
                                <div class="invalid-feedback" id="st_nic_feedback" style="display:none;">
                                    NIC already in use.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <!-- <div class=" input-group col-lg-5">
                                                <input id="inputaddress" type="text" name="st_address"  required="" data-parsley-type="change" placeholder="" class="form-control">
                                            
                                        </div> -->
                            <label for="inputaddress" class=" col-lg-3 col-form-label text-right">Address </label>
                            <div class=" col-lg-5">
                                <textarea id="w3review" name="w3review" rows="3" value="<?= $staff['st_address'] ?>" oninvalid="this.style.borderColor='red';" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputphone" class=" col-lg-3 col-form-label text-right">Phone No </label>
                            <div class=" input-group col-lg-5">
                                <input id="inputphone" type="tel" name="st_phone" value="<?= $staff['st_phone'] ?>" required oninvalid="this.style.borderColor='red';" pattern="^(?:\+94|0)?[0-9]{9}$" title="Required 10 digits" data-parsley-type="change"  placeholder="Enter phone number" class="form-control">
                                <div class="invalid-feedback" style="display:block;">
                                    Input numbers(0-9)
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputemail" class=" col-lg-3 col-form-label text-right">E mail</label>
                            <div class=" input-group col-lg-5">
                                <input id="st_email" type="email" onkeyup="validate_email()" name="st_email" value="<?= $staff['st_email'] ?>" required oninvalid="this.style.borderColor='red';" placeholder="Enter e-mail address" class="form-control">
                                <div class="invalid-feedback" id="st_mail_feedback" style="display:none">
                                E mail already in use.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputemail" class=" col-lg-3 col-form-label text-right">User Name </label>
                            <div class=" input-group col-lg-5">
                                <input id="st_user_name" type="text" name="st_user_name" value="<?= $staff['st_user_name'] ?>" required oninvalid="this.style.borderColor='red';" data-parsley-type="change" placeholder="Enter user name" class="form-control">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputemail" class=" col-lg-3 col-form-label text-right">Password </label>
                            <div class=" input-group col-lg-5">
                                <input id="st_user_psswd" type="password" name="st_user_psswd" <?php if (!isset($_GET["sr"])) { ?> required="" <?php } ?> data-parsley-type="change" oninvalid="this.style.borderColor='red';" placeholder="Enter password" class="form-control">

                            </div>
                            <!-- <div class="form-group row">
                                    <label for="inputemail" class=" col-lg-3 col-form-label text-right">Re enter Password</label>
                                    <div class=" input-group col-lg-5">
                                        <input id="st_user_psswd" type="password" name="st_user_psswd" value="<?= $staff['st_user_psswd'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control">

                                    </div> -->
                        </div>

                        <div class="form-group row">
                            <label for="inputemail" class=" col-lg-3 col-form-label text-right">Repead Password <span id=""> </span></label>
                            <div class=" input-group col-lg-5">
                                <input id="st_user_psswd_repeat" type="password" name="st_user_psswd_repeat" <?php if (!isset($_GET["sr"])) { ?> required="" <?php } ?> data-parsley-type="change"  oninvalid="this.style.borderColor='red';" onkeyup="check_password()" placeholder="Enter password" class="form-control">

                            </div>
                            <p class="text-danger" id="password_error_msg" style="display :none">Password not matching</p>
                        </div>
                        <br>


                        <div class="col-sm-6 pl-0">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-success"><?=isset($_GET["sr"]) ? "Update" : "Add"?> 
                                Submit</button>
                                <button class="btn btn-space btn-danger" type="reset">Cancel</button>
                            </p>
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
            </div> <!--end of .col-md-12-->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Staff</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="table_id">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Vehicle Number</th>
                                        <th>Gender</th>
                                        <!-- <th>Date of Birth</th> -->
                                        <th>NIC Number</th>
                                        <th>Address</th>
                                        <th>Phone No</th>
                                        <th>E mail</th>
                                        <!-- <th>User Name</th>
                                        <th>Password</th> -->
                                        <th style="width: 500px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="td">

                                    <?php
                                    foreach ($all as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $item["st_id"] ?></td>
                                            <td><?= $item["st_name"] ?></td>
                                            <td><?= $item["role_name"] ?></td>
                                            <td><?= $item["veh_number"] ?></td>
                                            <td><?= $item["st_gender"] ?></td>
                                            <!-- <td><?= $item["st_dob"] ?></td> -->
                                            <td><?= $item["st_nic"] ?></td>
                                            <td><?= $item["st_address"] ?></td>
                                            <td><?= $item["st_phone"] ?></td>
                                            <td><?= $item["st_email"] ?></td>
                                            <!-- <td><?= $item["st_user_name"] ?></td>
                                            <td><?= $item["st_user_psswd"] ?></td> -->
                                            <td  style="width: 500px;">
                                                <a href="add_staff.php?sr=<?= $item['st_id'] ?>" class="btn btn-outline-primary btn-xs"><i class="icon-pencil" title="Edit" ></i> Edit</a>
                                                <a href="#"  onclick="delcat(<?= $item['st_id'] ?>)" class="btn btn-outline-danger btn-xs"><i class="icon-trash" title="Delete" ></i> Delete</a>
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


</div>
</div>




<?php
include_once "../pages/foot.php";
?>

<script>

    var is_error_on_pwd = false;
    var is_error_on_nic = false;
    var is_error_on_email = false;
    var is_error_on_username = false;

    function check_password() {
        let element = $('#password_error_msg');
        if ($('#st_user_psswd').val() != $('#st_user_psswd_repeat').val()) {
            element.css('display', "block");
            is_error_on_pwd = true;
        } else {
            element.css('display', "none");
            is_error_on_pwd = false;
        }
    }



    function delcat(st_id) {
        console.log(st_id);
        delStaff = confirm("Are you sure you want to delete staff no " + st_id);
        if (delStaff == true) {        
            window.location.href = "add_staff.php?delete=" + st_id;

        }
    }

    $("#role_id").val("<?= $item["role_id"] ?>").trigger('change');

    

    // function submit_form(){
        
    //     if(!is_error_on_nic && !is_error_on_email && !is_error_on_username){
    //         $("#stform").submit();
    //     }
    //     else{
    //         alert("Error in form");
    //     }
    // }

    $("#stform").submit(function(e) {
            e.preventDefault(); //prevent the default action of the form 
            var a = $(this);
            if(!is_error_on_nic && !is_error_on_email && !is_error_on_username){
                a.unbind('submit').submit();
            }
            else{
                alert("Error in form");
            }
     });

    function validate_nic() {
        var sid = "";
        <?php if (isset($_GET["sr"])) { ?>
            sid = $("#st_id").val();
        <?php } ?>
        $.ajax('/DMS/class/ajax.php?st_nic=' + $("#st_nic").val() + "&st_id=" + sid, {
            type: "GET"
        }).done(function(response) {
            if (response == 'No') {
                $('#st_nic_feedback').css('display', 'none');
                $('#st_nic').removeClass('is-invalid');
                is_error_on_nic = false;
            } else {
                $('#st_nic_feedback').css('display', 'block');
                $('#st_nic').addClass('is-invalid');
                is_error_on_nic = true;
            }
        });
    }

    function validate_email(){
        var sid = "";
        <?php if (isset($_GET["sr"])){ ?>
            sid = $("#st_id").val();
       <?php } ?>
       $.ajax('/DMS/class/ajax.php?st_email=' + $("#st_email").val() + "&st_id=" + sid,{
            type:"GET"
       }).done(function(response){
            if (response == 'No'){
                $('#st_mail_feedback').css('display', 'none'); //none-Not displying the error msg near txt box
                $('#st_email').removeClass('is-invalid'); // remove the class form st_email
                is_error_on_email = false;
            }
            else{
                $('#st_mail_feedback').css('display', 'block'); //block = disply the error msg
                $('#st_email').addClass('is-invalid'); 
                is_error_on_email = true;
            }
       });
    }
</script>