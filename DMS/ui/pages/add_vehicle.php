<?php
include_once("../../class/vehicle.php");
$vehObject = new vehicle();


if (isset($_GET["delete"])) {
    $res2 = $vehObject->del($_GET["delete"]);
    // var_dump($res2);
}

if (isset($_GET["vr"])) {
    $vehicle = $vehObject->get_by_id($_GET["vr"]);
} else
    $vehicle = (array)$vehObject;


if (isset($_POST["veh_brand"])) {
    $vehObject->veh_brand = $_POST["veh_brand"];
    $vehObject->veh_model = $_POST["veh_model"];
    $vehObject->veh_number = $_POST["veh_number"];
    $vehObject->veh_capacity = $_POST["veh_capacity"];
    $vehObject->veh_fuel = $_POST["veh_fuel"];
    $vehObject->fk_vehtype_id = $_POST["veh_type"];

    $res = $vehObject->save();
}
$all = $vehObject->get_all();

include_once("../../class/vehtype.php");
$vehtypeObject = new vehtype();
$ac = $vehtypeObject->get_all();

// including the header part

include_once "../pages/head.php";
?>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <?php if (isset($res) && $res == true)
            echo '<div class="alert alert-" role="alert">
            Vehicle Added successfully!
        </div>';
        if (isset($res2) && $res2 == true)
            echo '<div class="alert alert-warning" role="alert">
            Vehicle Successfully Deleted!
            </div>';
        if (isset($_GET["vr"]) && ($_GET["vr"]) == true)
            echo '<div class="alert alert-warning" role="alert">
            Vehicle Successfully updated!
            </div>';

        ?>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <h2 class="pageheader-title">Vehicle </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Vehicle</li>
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
                <form action="add_vehicle.php" method="post" id="vehForm">
                    <?php if (isset($_GET["vr"])) { ?>
                        <input id="inputcategory" type="text" name="veh_id" value="<?= $vehicle['veh_id'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control" <?php } ?> <div class="card">
                        <h5 class="card-header">Add Vehicle</h5>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Vehicle Brand <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-4">
                                    <input id="veh_brand" type="text" name="veh_brand" value="<?= $vehicle['veh_brand'] ?>" required="" data-parsley-type="change" placeholder="Enter vehicle brand" class="form-control" oninvalid="this.style.borderColor='red';">
                                </div>
                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Vehicle Model <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-4">
                                    <input id="veh_model" type="text" name="veh_model" value="<?= $vehicle['veh_model'] ?>" required="" data-parsley-type="change" placeholder="Enter vehicle model" class="form-control" oninvalid="this.style.borderColor='red';">
                                </div>



                            </div>
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Vehicle Number <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-4">
                                    <input id="veh_number" type="text" onkeyup="validate_veh_number()" name="veh_number" value="<?= $vehicle['veh_number'] ?>" required="" data-parsley-type="change" placeholder="Enter vehicle number" class="form-control" oninvalid="this.style.borderColor='red';">
                                    <div class="invalid-feedback" id="veh_number_feedback" style="display:none;">
                                    Vehicle Number already in use.
                                </div>
                                </div>
                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Capacity <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-4">
                                    <input id="inputcategory" type="text" name="veh_capacity" value="<?= $vehicle['veh_capacity'] ?>" required="" data-parsley-type="change" placeholder="Enter capacity" class="form-control" oninvalid="this.style.borderColor='red';">

                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Fuel Consumption <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-4">
                                    <div class="input-group-append">
                                        <input id="inputcategory" type="text" name="veh_fuel" value="<?= $vehicle['veh_fuel'] ?>" required="" data-parsley-type="change" placeholder="Enter fuel consumption" class="form-control" oninvalid="this.style.borderColor='red';">
                                        <span class="input-group-text">km/L</span>
                                    </div>
                                </div>

                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Type <span class="req" style="color: red;">* </span></label>
                                <div class=" col-lg-4">
                                    <select name="veh_type" class="form-control" id="veh_type">
                                        <option value="All">Select vehicle type </option>


                                        <?php
                                        foreach ($ac as $item) {
                                        ?>
                                            <option value="<?= $item["vehtype_id"] ?>"><?= $item["vehtype_name"] ?> </option>
                                        <?php } ?>
                                    </select>



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

                                        </div>--> </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="col-sm-6 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-success">Submit</button>
                                            <button class="btn btn-space btn-danger">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                       

                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">




        <div class="card">
            <h5 class="card-header">Vehicle</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Vehicle Id</th>
                                <th>Vehicle Brand</th>
                                <th>Vehicle Model</th>
                                <th>Vehicle Number</th>
                                <th>Vehicle Capacity</th>
                                <th>Vehicle Fuel</th>
                                <th>Vehicle Type</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($all as $item) {
                            ?>
                                <tr>
                                    <td><?= $item["veh_id"] ?></td>
                                    <td><?= $item["veh_brand"] ?></td>
                                    <td><?= $item["veh_model"] ?></td>
                                    <td><?= $item["veh_number"] ?></td>
                                    <td><?= $item["veh_capacity"] ?></td>
                                    <td><?= $item["veh_fuel"] ?></td>
                                    <td><?= $item["vehtype_name"] ?></td>

                                    <td>
                                        <i class="icon-pencil" title="Edit" style="color:blue">
                                            <a href="add_vehicle.php?vr=<?= $item['veh_id'] ?>" style="color:blue">Edit</i></a><br>

                                        <i class="icon-trash" title="Delete" style="color:red">
                                            <a href="#" style="color: red;" onclick="delcat(<?= $item['veh_id'] ?>)">Delete</i></a>
                                    </td>

                                    <!-- <td><i class="icon-pencil" title="Edit"><a href="add_vehicle.php?vr=<?= $item['veh_id'] ?>">Edit</i>&nbsp;&nbsp;&nbsp;
                                        <i class="icon-trash"><a href="#" onclick="delcat(<?= $item['veh_id'] ?>)">Delete</a></i>
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


</div>
</div>




<?php
include_once "../pages/foot.php";
?>

<script>
    $(document).ready(function() {
        $('#veh_type').select2();
    });

    is_error_on_veh_number = false;

    function delcat(veh_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete " + veh_id);
        if (x == true) {
            window.location.href = "add_vehicle.php?delete=" + veh_id;
            // alert("successfully Deleted");

        }
    }
    $("#vehtype_id").val("<?= $item["vehtype_id"] ?>").trigger('change');

    function submit_form() {
        if(!is_error_on_veh_number){
            $("#vehForm").submit();
        }
        else{
            alert("Error in form");
        }
    }

    function validate_veh_number(){
        var vid = "";
        <?php if (isset($_GET["sr"])) { ?>
            vid = $("#veh_id").val();
        <?php } ?>
        $.ajax('/DMS/class/ajax.php?veh_number=' + $("#veh_number").val() + "&veh_id=" + vid, {
            type: "GET"
        }).done(function(response) {
            if (response == 'No') {
                $('#veh_number_feedback').css('display', 'none');
                $('#veh_number').removeClass('is-invalid');
                is_error_on_veh_number = false;
            } else {
                $('#veh_number_feedback').css('display', 'block');
                $('#veh_number').addClass('is-invalid');
                is_error_on_veh_number = true;
            }
        });
    }
</script>