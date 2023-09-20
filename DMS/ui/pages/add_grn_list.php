<?php
include_once ("../pages/head.php");
include_once("../../class/manufacture.php");
include_once("../../class/ordr.php");
include_once("../../class/grn_class.php");
include_once("../../class/supplier_payment.php");
include_once("../../class/mod_functions.php");


$permission_object = new Mod_functions();
echo $permission_object->check_permision_for_currnt_user("Add GRN",true);

$supPaymentObject = new supplier_payment;

$grnObject = new grn_class();
//$grnObject = new grn();

if (isset($_POST['mac_name'])) {
    // $grnObject->fk_order_id = $_POST["order_id"];
    $grnObject->grn_date = $_POST["grn_date"];
    $grnObject->fk_mac_id = $_POST["mac_name"];
    $grnObject->grn_refno = $_POST['grn_refno'];
    $grnObject->grn_note = $_POST['grn_note'];
    $grnObject->grn_total_bill = $_POST['grn_total_bill'];
    $grnObject->fk_veh_id = 0;

    $grnid = $grnObject->save();
    // $macid = $macObject  -> save();
    //echo "---->"+$grnid; 




    if (isset($_POST["sup_paid_amount"])) {
        $supPaymentObject->sup_cash = $_POST["sup_cash"];
        $supPaymentObject->sup_cheque_amount = $_POST["sup_cheque_amount"];
        $supPaymentObject->sup_cheque_no = $_POST["sup_cheque_no"];
        $supPaymentObject->sup_cheque_date = $_POST["sup_cheque_date"];
        $supPaymentObject->sup_cheque_bank = $_POST["sup_cheque_bank"];
        $supPaymentObject->sup_credit = $_POST["sup_credit"];
        $supPaymentObject->sup_paid_amount = $_POST["sup_paid_amount"];
        $supPaymentObject->fk_grn_id = $grnid;
        $supPaymentObject->fk_mac_id = $_POST["mac_name"];

        
        if($supPaymentObject->sup_paid_amount>0){
            $supPaymentObject->save();
        }
    }
}
$allgrn = $grnObject->get_all();



$supOrderObject = new ordr;
$asup = $supOrderObject->get_all();

$macObject = new manufacture();
$amac = $macObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

// including the header part
?>
<div class="dashboard-wrapper">

    <form action="add_grn_list.php" method="post" id="addGrnForm">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">

                        <h2 class="pageheader-title">Add GRN </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add GRN</li>
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
                        <h5 class="card-header">Add GRN</h5>
                        <div class="card-body">
                            <!-- <div class="row"> -->
                                <!-- <div class="col-md-8"></div> -->
                                <!-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-form-label" style="padding-bottom:12px;">Supplier Order</label>
                                        <input type="text" name="supOrder" id="supId" data-parsley-type="change" placeholder="" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-2 text-left">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-space btn-primary btn-sm" onclick="GetSupplierDataForTable();" style="margin-top: 41px;"><i class=" fas fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div> -->
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mac_name" class="col-form-label ">Manufacture</label>
                                        <select name="mac_name" class="form-control" id="mac_name">

                                            <option value="all"> Select Supplier</option>
                                            <?php
                                            foreach ($amac as $item) {
                                            ?>
                                                <option value="<?= $item["mac_id"] ?>"><?= $item["mac_name"] ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">grn Date</label>
                                        <input id="date" type="date" name="grn_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="refno" class="col-form-label ">REF NO.</label>

                                        <input id="refno" type="text" name="grn_refno" data-parsley-type="change" placeholder="" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="note" class=" col-form-label">Note</label><textarea class="form-control" id="note" name="grn_note" rows="1"></textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Product Item </label>
                                        <select name="pro_code" class="form-control" id="pro_code" required>
                                            <option value="all"> Select Item</option>
                                            <?php
                                            foreach ($apro as $item) {
                                            ?>
                                                <option value="<?= $item["pro_id"] ?>"><?= $item["pro_name"], ' ', $item["pro_weight"] ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=proCode class=" col-form-label "> Product Name </label>
                                                <select name="pro_code" class="form-control  dropdown-toggle-split" id="proCode">
                                                    <option value="all"> Product Name </option>
                                                </select>
                                            </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="inputcategory" class="form-label text-right">Existing Quantity</label>
                                        <input id="existingQty" type="text" name="existingQty" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="form-label text-right">Quantity</label>
                                        <input id="qty" type="text" name="grnlt_qty" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Expire Date</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="ex_date" type="date" name="grnlt_ex_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="col-form-label">Purchase Price</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="purchase_price" type="text" name="grnlt_purchase_price" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="  col-form-label">Sales Price</label>
                                        <input id="sales_price" type="text" name="grnlt_sales_price" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class="  col-form-label">Free items</label>
                                        <input id="free_items" type="text" name="grnlt_free_items" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-form-label">Item Amount</label>
                                        <input id="item_amount" type="text" name="grnlt_item_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div>
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
                                        <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Items</button>
                                    </p>
                                </div>
                                <div class="col-lg-1  pl-0">
                                    <p class="text-right">
                                        <a href="#">
                                        <button class="btn btn-space btn-danger" type="reset" >Cancel</button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5>GRN</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="totalBill"  class="col-4 col-lg-4 col-form-label text-right" style="color: black;">Total Amount</label>
                                        <div class="col-8 col-lg-8">
                                            <input id="totalBill" type="text" readonly name="grn_total_bill" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="addrow()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered " name="ordListTable" id="">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <!-- <th>Description</th> --> 
                                            <th>Ex Date</th>
                                            <th>Purchase Price</th>                                          
                                            <th>Sales Price</th>
                                            <th>Items Amount</th>
                                            <th>Free Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="td">

                                    </tbody>
                                    </tfoot>
                                </table>

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cash</label>
                                        <input id="sup_cash" type="text" name="sup_cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Amount</label>
                                        <input id="sup_cheque_amount" type="text" name="sup_cheque_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque No</label>
                                        <input id="sup_cheque_no" type="text" name="sup_cheque_no" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Date</label>
                                        <input id="sup_cheque_date" type="date" name="sup_cheque_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Amount</label>
                                        <input id="sup_paid_amount" type="text" name="sup_paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateSupplierBill()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Credit</label>
                                        <input id="sup_credit" type="text" name="sup_credit" value="0" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <!-- </div> -->

                            

                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Bank</label>
                                        <input id="sup_cheque_bank" type="text" name="sup_cheque_bank" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12 pl-0 text-right">
                                <button type="submit" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

</div>
</div>
</form>

</div>


<?php
include_once "../pages/foot.php";
?>

<script>
    // $("#pro_code").change(function(){
    // alert($("#pro_code option:selected").text());})
    $(document).ready(function() {
        $('#order_id').select2();
        $('#mac_name').select2();
        $('#pro_code').select2();
    });



    function addrow(po = false) { //To add a product item

        var pro_name = $("#pro_code option:selected").text();
        var pro_code = $("#pro_code").val();
        var qty = $("#qty").val(); //quantity
        // c = $("#descrip").val();
        var purchase_price = $("#purchase_price").val();
        var ex_date = $("#ex_date").val();
        var sales_price = $("#sales_price").val();
        var free_amount = $("#free_items").val();
        var item_amount = $("#item_amount").val();



        // if (po) {
        //     aa = po.pro_name;
        //     b = po.orderlt_qty;
        //     d = po.orderlt_descrip;
        //     e = po.orderlt_stt;
        // }

        $("#mac_name").change(function() {
                GetProductData();
            });
         
            function GetProductData() {
                let manufacture_id = $("#mac_name").val();
                console.log("manufacture_id : ", manufacture_id);
                $.ajax('/DMS/class/ajax.php?manufacture_id=' + manufacture_id, {
                    type: "GET",
                    async: false
                }).done(function(response) {
                    $("#proCode").empty();
                    let dt = JSON.parse(response);
                    $("#proCode").append("<option value=''>Select product Name</option>");
                    for (var k in dt) {
                        $("#proCode").append("<option value='" + dt[k].pro_code + "'>" + dt[k].pro_code + "</option>");
                    }
                });
            }

            
            // function GetExistingProQty() {
            //     let pro_code = $("#pro_code").val();
            //     console.log("pro_code : ", pro_code);
            //     $.ajax('/DMS/class/ajax.php?pro_code=' + pro_code, {
            //         type: "GET",
            //         async: false
            //     }).done(function(response) {
            //         $('#existingQty').empty();
            //         let dt = JSON.parse(response);
            //         $("#existingQty").append('product_dt');
                   
            //     });
            // }

            // function GetSalesDataForTable() {
            //     let existing_qty = $("#existingQty").val();
            //     $.ajax('/DMS/class/ajax.php?existing_qty=' + existing_qty, {
            //         type: "GET",
            //         async: false,
            //     }).done(function(product_dt) ;
            // }

            




         var totalBill = $('#totalBill').val();


        console.log("B : ",parseInt(qty.trim()));
        //         if(b == "" || b == "0" ){return;}
        //         if(d == "" || d == "0" ){return;}
        //         if(f== ""  ){return;}

        // if (pro_code == "all") {
        //     alert("Please insert atleast one item");
        //     return;
        // }


        if (parseInt(qty.trim())<=0) {
            alert("Enter amount for quantity");
            return;
        }

        if (parseInt(purchase_price.trim()) <= 0) {
            alert("Enter amount for purchase price");
            return;
        }

        if(sales_price.trim().length == 0){
            alert("Enter amount for sales price");
            return;
        }

        //check free quantity 
        if (parseFloat(qty.trim()) < parseFloat(free_amount)) {
            alert("Free quantity must be less than current quantity ");
            return;
        }


        // if ($('#pro_code' + a).length > 1) {
        //     alert("Product is already added");
        //     return;

        // }

        if (parseFloat(purchase_price) >= parseFloat(sales_price)) {
            alert("Sales price must be greater than the purchase price");
            return;
        }

        // if(+d < +f){
        //     alert("Sales price must be greater than the purchase price");
        //     return;
        // }

        $("#td").append("<tr id='pro_code" + pro_code + "'><td>" + pro_name + "<input type='hidden'  name='pro_code[]' value='" + pro_code + "'></td><td>" + qty + "<input type='hidden'  name='grnqty[]' value='" + qty + "'></td><td>" + ex_date + "<input type='hidden'  name='ex_date[]' value='" + ex_date + "'></td><td>" + purchase_price + "<input type='hidden'  name='grnlt_purchase_price[]' value='" + purchase_price + "'></td><td>" + sales_price + "<input type='hidden'  name='sales_price[]' value='" + sales_price + "'></td><td>" + item_amount + "<input type='hidden'  name='grnlt_item_amount[]' value='" + item_amount + "'></td><td>" + free_amount + "<input type='hidden' name='grnlt_free_items[]' value='" + free_amount + "'></td><td><a onclick='editGrn("+ pro_code +","+ qty +","+ purchase_price +",`"+ ex_date +"`," + free_amount +","+ sales_price +")' href='#' class='btn btn-outline-primary btn-xs'><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;</a><button onclick='delgrn(this)' type='button'  class='btn btn-outline-danger btn-xs'><i class='icon-trash' style='color:re'>Delete</button></i></td></tr>");
        $("#item").val("");
        $("#qty").val("");
        // $("#descrip").val("");
        $("#purchase_price").val("");
        $("#ex_date").val("");
        $("#free_items").val("");
        $("#sales_price").val("");
        $("#item_amount").val("");

        calTotAmount();
        $("#pro_code").val("all");
        $("#pro_code").trigger('change');
        $("#item").focus();
        //addText();
    }

    // function GetSupplierDataForTable() {
    //     let order_id = $("#supId").val();
    //     $.ajax('/DMS/class/ajax.php?order_id=' + order_id, {
    //         type: "GET",
    //         async: false
    //     }).done(function(response) {
    //         var dta = JSON.parse(response);
    //         $.each(dta, function(i) {
    //             addrow(dta[i]);
    //         });

    //         console.log(response);
    //     })
    // }
    //function to manufacture name and dateas text

    function delgrn(t) {
        $(t).parent().parent().remove();
        calTotAmount()
    }

    // function delcat(grnlt_id) {
    //     //  alert(procat_id);
    //     x = confirm("Are you sure you want to delete" + grnlt_id);
    //     if (x == true) {
    //         window.location.href = "add_grnlt.php?delete=" + grnlt_id;
    //     }
    // }
    
    function editGrn(pro_code,qty,purchase_price,ex_date,free_amount,sales_price) {

        var row = document.getElementById("pro_code"+pro_code);
        row.parentNode.removeChild(row);

        $("#pro_code").val(pro_code).trigger('change');
        $("#qty").val(qty);
        $("#purchase_price").val(purchase_price);
        $("#ex_date").val(ex_date);
          $("#free_items").val(free_amount);
        $("#sales_price").val(sales_price);
      

        calculateSupplierBill();
    }

    //reset the total amount to the previous value
    function calTotAmount() { 
        let totalBill = 0;
        $("input[name='grnlt_item_amount[]']").each(function() {
            totalBill += parseFloat($(this).val());
        });
        console.log('avb');
        console.log(totalBill);
        $('#totalBill').val(parseFloat(totalBill).toFixed(2));
    }

    function calculateSupplierBill() {
        // var item_amount;
        // var purchase_price;
        // var qty;
        // var sup_cash;
        // var sup_cheque_amount;
        // var sup_paid_amount= 0;
        // var sup_credit;

        var totalBill = $('#totalBill').val();

        var qty = $('#qty').val();
        var purchase_price = $('#purchase_price').val();
        var sup_paid_amount = $('#sup_paid_amount').val();
        var item_amount = $('#item_amount').val();
        var sup_cheque_amount = $('#sup_cheque_amount').val();
        var sup_cash = $('#sup_cash').val();
        var sup_credit = $('#sup_credit').val();

        sup_cash = (sup_cash == "" )? 0 : sup_cash;
        sup_cheque_amount = (sup_cheque_amount == "" ? 0 : sup_cheque_amount);

        item_amount = qty * purchase_price;
        console.log('qty', qty);
        console.log('purchase_price',purchase_price);
        console.log('item_amount',item_amount);
        $('#item_amount').val(parseInt(item_amount));

        sup_credit = (parseFloat(totalBill) - (parseFloat(sup_cash) + parseFloat(sup_cheque_amount)));
        document.getElementById('sup_credit').value = parseInt(sup_credit);
        //  $('#credit').val(parseInt(credit));
        console.log('sup_credit',sup_credit);
        console.log('sup_cash',sup_cash);
        console.log('sup_cheque_amount',sup_cheque_amount);
        console.log('total_bill',totalBill);

        sup_paid_amount = (parseInt(totalBill) - parseInt(sup_credit));
        document.getElementById('sup_paid_amount').value = parseInt(sup_paid_amount);
    }
</script>