<?php
include_once("../pages/head.php");
include_once("../../class/vehicle.php");
include_once("../../class/damage.php");

$damageObject = new damage();
//$loadObject = new load();

if (isset($_GET["dr"])) {
    $damage = $damageObject->get_by_id($_GET["dr"]);
} else
    $damage = (array)$damageObject;


if (isset($_POST['store_id'])) {
    $damageObject->damage_date = $_POST["damage_date"];
    $damageObject->fk_store_id = $_POST["store_id"];
    $damageObject->damage_note = $_POST['damage_note'];


    $damageObject->save();
}

$alldamage = $damageObject->get_all();

//include the manufacture file 

$vehObject = new vehicle();
$adamage = $vehObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

// including the header part
?>
<div class="dashboard-wrapper">
    <form action="add_damage_list.php" method="post" id="adddamageForm">
        <?php
        if (isset($_GET["dr"])) { ?>
            <input id="inputcategory" type="text" name="damage_id" value="<?= $damage['damage_id'] ?>" required="" data-parsley-type="change" placeholder="" class="form-control"> <?php } ?>
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">

                        <h2 class="pageheader-title">Add damage</h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add damage</li>
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
                        <h5 class="card-header">Add Damage</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="form-label">Store</label>
                                        <select name="veh_id" class="form-control store_Number" id="veh_id">
                                            <option value="-2">Full stock</option>
                                            <?php
                                            foreach ($adamage as $item) {
                                            ?>
                                                <option value="<?= $item["veh_id"] ?>"><?= $item["veh_number"] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Damage Date</label>
                                        <input id="date" type="date" name="damage_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="note" class=" form-label">Note</label>
                                        <input id="note" type="text" name="damage_note" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div> <!--end row-->
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="form-label">Item Code</label>
                                        <select name="pro_code" class="form-control" id="pro_code">
                                            <?php
                                            foreach ($apro as $item) {
                                            ?>
                                                <option value="<?= $item["pro_id"] ?>"><?= $item["pro_name"] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="form-label">Quantity</label>
                                        <input id="qty" type="text" name="damage_qty" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <!--end carad body-->
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                        Please fill all the fields
                                    </div>
                                </div>
                                <div class="col-lg-6 pl-0">
                                    <p class="text-right">
                                        <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Damage</button>
                                    </p>
                                </div>
                                <div class="col-lg- 6 pl-0">
                                    <p class="text-right">
                                        <button class="btn btn-space btn-danger" type="reset" onclick="location.reset();">Cancel</button>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!--end col-12-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Damage</h5>
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered " name="ordListTable">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Quantity</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="td">

                                    </tbody>
                                    </tfoot>
                                </table>

                            </div>
                         </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-lg-12 pl-0">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                   
                </div> <!--end .row-->
            </div>
    </form>
</div>


<?php
include_once "../pages/foot.php";
?>

<script>
    $(document).ready(function() {
        $('#veh_id').select2();
    });

    function addrow() { //To add a product item

        a = $("#pro_code").val();
        b = $("#qty").val(); //quantity

        $("#td").append("<tr><td>" + a + "<input type='hidden'  name='pro_code[]' value='" + a + "'></td><td>" + b + "<input type='hidden'  name='damage_qty[]' value='" + b + "'></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='deldamage(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
        $("#item").val("");
        $("#qty").val("");

        $("#item").focus();
        addText();
    }
    //function to manufacture name and dateas text

    function deldamage(t) {
        $(t).parent().parent().parent().remove();
    }
</script>

<script>
    function delcat(damagelt_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + damagelt_id);
        if (x == true) {
            window.location.href = "add_loatlt.php?delete=" + damagelt_id;
        }
    }
</script>