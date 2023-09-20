<?php
include_once ("../pages/head.php");
include_once("../../class/vehicle.php");
include_once("../../class/pack.php");

$packObject = new pack();
//$loadObject = new load();

if (isset($_POST['veh_number'])) {
    $packObject->pack_date = $_POST["pack_date"];
    $packObject->fk_veh_id = $_POST["veh_number"];
    $packObject->pack_note = $_POST['pack_note'];


    $packObject->save();
}

$allpack = $packObject->get_all();

//include the manufacture file 

$vehObject = new vehicle();
$apack = $vehObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

// including the header part
?>
<div class="dashboard-wrapper">

    <form action="add_load_list.php" method="post" id="addloadForm">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">

                        <h2 class="pageheader-title">Add Pack </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add list</li>
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
                        <h5 class="card-header">Add Pack</h5>
                        <div class="card-body">

                            <div class="form-group row">

                                <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Vehicle</label>
                                <div class=" col-lg-2">
                                    <select name="veh_number" class="form-control" id="veh_number">

                                        <?php
                                        foreach ($apack as $item) {
                                        ?>
                                            <option value="<?= $item["veh_id"] ?>"><?= $item["veh_number"] ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Pack Date</label>
                                <div class=" col-lg-2">
                                    <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                    <input id="date" type="date" name="pack_date" data-parsley-type="change" placeholder="" class="form-control">
                                </div>
                                <label for="note" class=" col-lg-0 col-form-label text-right">Note</label>
                                <div class=" col-lg-2">
                                    <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                    <input id="note" type="text" name="pack_note" data-parsley-type="change" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Item Code</label>
                                <div class=" col-lg-2">
                                    <select name="pro_code" class="form-control" id="pro_code">

                                        <?php
                                        foreach ($apro as $item) {
                                        ?>
                                            <option value="<?= $item["pro_id"] ?>"><?= $item["pro_name"] ?> </option>
                                        <?php } ?>

                                    </select>

                                </div>
                                <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Quantity</label>
                                <div class=" col-lg-2">
                                    <input id="qty" type="text" name="pack_qty" data-parsley-type="change" placeholder="" class="form-control">
                                </div>


                                <!-- <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="button" class="btn btn-space btn-primary" onclick="addrow()">Add Items</button>
                                                    
                                                </p>
                                            </div> -->
                            </div>
                        </div>
                        <div class="footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                        Please fill all the fields
                                    </div>
                                    <div class="col-lg-6 pl-0">
                                        <p class="text-right">
                                            <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Pack</button>
                                        </p>
                                    </div>
                                    <div class="col-lg-1  pl-0">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-danger" onclick="location.reload();">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">

                <h5 class="card-header">Pack</h5>
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
                    <div class="col-lg-12 pl-0">
                        <p class="text-right">
                            <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                        </p>
                    </div>
                </div>
            </div>


        </div>
</div>
</form>

</div>
</div>

<?php
include_once "../pages/foot.php";
?>

<script>
    $(document).ready(function() {
        $('#veh_number').select2();
    });

    function addrow() { //To add a product item

        a = $("#pro_code").val();
        b = $("#qty").val(); //quantity

        $("#td").append("<tr><td>" + a + "<input type='hidden'  name='pro_code[]' value='" + a + "'></td><td>" + b + "<input type='hidden'  name='pack_qty[]' value='" + b + "'></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delorder(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
        $("#item").val("");
        $("#qty").val("");

        $("#item").focus();
        //addText();
    }
    //function to manufacture name and dateas text

    function delpack(t) {
        $(t).parent().parent().parent().remove();
    }
</script>

<script>
    function delcat(packlt_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + packlt_id);
        if (x == true) {
            window.location.href = "add_loatlt.php?delete=" + packlt_id;
        }
    }
</script>