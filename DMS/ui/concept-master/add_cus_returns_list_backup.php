<?php
session_start();
include_once("../../class/cus_returns.php");
//initiate an object from the sales table
$cusReturnsObject = new cus_returns();
include_once("../../class/payment.php");
$paymentObject = new payment();

if (isset($_POST["cus_name"])) {
    $cusReturnsObject->cus_returns_date = $_POST["cus_returns_date"];
    $cusReturnsObject->fk_cus_id = $_POST["cus_name"];
    $cusReturnsObject->cus_returns_note = $_POST["cus_returns_note"];
    $cusReturnsObject->cus_returns_total_bill = $_POST["cus_returns_total_bill"];
    // Add sale to the stock under particular 
    // $cusReturnsObject->fk_veh_id = $_SESSION["staff"]['fk_veh_id'];

    $cid = $cusReturnsObject->save();
}
/** check if the POST array contains any value for input box with
 *attribute name as paid_amount */
// if (isset($_POST["paid_amount"])) {
//     $paymentObject->cash = $_POST["cash"];
//     $paymentObject->cheque_amount = $_POST["cheque_amount"];
//     $paymentObject->cheque_no = $_POST["cheque_no"];
//     $paymentObject->cheque_date = $_POST["cheque_date"];
//     $paymentObject->cheque_bank = $_POST["cheque_bank"];
//     $paymentObject->credit = $_POST["credit"];
//     $paymentObject->paid_amount = $_POST["paid_amount"];
//     $paymentObject->fk_sales_id = $sid;

//     $paymentObject->save();
// }
$allcusReturns = $cusReturnsObject->get_all();
//include the manufacture file 

include_once("../../class/customer.php");
$cusObject = new customer();
$acus = $cusObject->get_all();

include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();


// including the header part

include_once "../pages/head.php";
?>
<div class="dashboard-wrapper">

    <form action="add_cus_returns_list.php" method="post" id="addOrderForm">
        <div class="container-fluid dashboard-content">


            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">

                        <h2 class="pageheader-title">Add Customer Sales Return </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Customer Sales Return</li>
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
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

                        <div class="card">
                            <h5 class="card-header">Add Customer Sales Return</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class=col-md-3>
                                        <div class="form-gorup">
                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Customer</label>

                                            <select name="cus_name" value="-1" class="form-control  dropdown-toggle-split" id="customerName">

                                                <option value="all"> Select Customer</option>
                                                <?php
                                                foreach ($acus as $item) {
                                                ?>
                                                    <option value="<?= $item["cus_id"] ?>"><?= $item["cus_name"] ?> </option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                    <label for="cus_returns_date" class=" col-lg-0 col-form-label text-right">Return Date</label>
                                        <input id="cus_returns_date" type="date" name="cus_returns_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                        </div>

                                    <!-- <div class="form-group row"> -->
                                    <!-- <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Ref Number</label>
                                <div class=" col-lg-2">
                                    <input id="refno" type="text" name="sales_ " data-parsley-type="change" placeholder="" class="form-control">
                                </div> -->
                                </div>
                    

                                    <label for="cus_returns_note" class=" col-lg-0 col-form-label text-right">Note</label>
                                    <textarea class="form-control col-lg-4" id="cus_returns_note" name="cus_returns_note" rows="2" cols="3">
                                </textarea>
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Return Item</label>
                                    <div class=" col-lg-4">
                                        <select name="pro_code" value="-1" class="form-control  js-example-basic-single" id="pro_code">
                                            <option value="all"> Select Product</option>
                                            <?php
                                            foreach ($apro as $item) {
                                            ?>
                                                <option value="<?= $item["pro_id"] ?>"><?= $item["pro_name"] ?> </option>
                                            <?php } ?>

                                        </select>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Quantity</label>
                                        <div class=" col-lg-4">
                                            <input id="qty" type="text" name="cus_returnslt_qty" data-parsley-type="change" placeholder="" class="form-control" onkeyup="calculateBillTotal()" oninvalid="this.style.borderColor='red';" class="invalid-feedback" style="display:block;">
                                        </div>
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Issue Price</label>
                                        <div class=" col-lg-4">
                                            <input id="issuePrice" type="number" name="cus_returnslt_issue_price" data-parsley-type="change" placeholder="" class="form-control" onkeyup="calculateBillTotal()" oninvalid="this.style.borderColor='red';" class="invalid-feedback" style="display:block;">
                                            <div class="invalid-feedback" style="display:block;">
                                                Input numbers(0-9)
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Description</label>
                                <div class=" col-lg-2">
                                    <input id="descrip" type="text" name="saleslt_descrip" data-parsley-type="change" placeholder="" class="form-control">
                                </div> -->

                                </div>
                                <div class="form-group row">

                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right" style="color: black;">Item Amount</label>
                                    <div>
                                        <div class=" col-lg-10">
                                            <input id="itemBill" type="text" name="cus_returnslt_item_amount" data-parsley-type="change" placeholder="" class="form-control" onkeyup="Addrow()">
                                        </div>
                                    </div>


                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                        <div class="form-group row">

                                        </div>
                                        <hr>



                                        <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                            Please fill all the fields
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-6 pl-0">
                                                <p class="text-right">
                                                    <button type="button" class="btn btn-space btn-primary" onclick="addrow();">Add Items</button>
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
                    <!-- Sales Details Form -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

                        <div class="card">
                            <h5 class="card-header">Sales Details</h5>
                            <div class="card-body">


                                <div class="form-group row">


                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right" style="color: black;">Sales ID</label>
                                    <div>
                                        <div class=" col-lg-6">
                                            <input id="itemBill" type="text" name="cus_returnslt_item_amount" data-parsley-type="change" placeholder="" class="form-control" onkeyup="Addrow()">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <!-- <h5 class="card-header">Customer Returns</h5> -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered " name="ordListTable" id="">
                                            <thead>
                                                <tr>
                                                    <th>Sales Item</th>
                                                    <th>Quantity</th>
                                                    <th>Issue Price</th>

                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="h6 mb-3" style="color:black">Customer - <span id="manfNameText"></span></div>
                <div class="h6 mt-2 mb-2" style="color:black"> Date - <span id="ordDateText"></span></div>
            </div>

            <label for="inputcategory" class=" col-lg-0 col-form-label text-right" style="color:black">Main Total Bill</label>
            <div class=" col-lg-2">
                <input id="Maintotbill" type="text" name="cus_returns_total_bill" data-parsley-type="change" placeholder="" class="form-control" onkeyup="Addrow()">
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Customer Returns</h5>
                    <div class="card-body">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered " name="ordListTable" id="">
                                <thead>
                                    <tr>
                                        <th>Return Item</th>
                                        <th>Quantity</th>
                                        <th>Issue Price</th>
                                        <th>Item Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="td">
                                </tbody>
                                <tfoot>
                                    <!--  -->
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                        <div class="form-group row">
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cash</label>
                            <div class=" col-lg-2">
                                <input id="cash" type="text" name="cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                            </div>
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Amount</label>
                            <div class=" col-lg-2">
                                <input id="chequeAmount" type="text" name="cheque_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                            </div>
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque No</label>
                            <div class=" col-lg-2">
                                <input id="chequeNo" type="text" name="cheque_no" data-parsley-type="change" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Date</label>
                            <div class=" col-lg-2">
                                <input id="chequeDate" type="date" name="cheque_date" data-parsley-type="change" placeholder="" class="form-control">
                            </div>
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Amount</label>
                            <div class=" col-lg-2">
                                <input id="paidAmount" type="text" name="paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                            </div>
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Credit</label>
                            <div class=" col-lg-2">
                                <input id="credit" type="text" name="credit" value="0" data-parsley-type="change" placeholder="" class="form-control">
                            </div>

                            <!-- </div> -->

                        </div>
                        <div class="form-group row">
                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Bank</label>
                            <div class=" col-lg-2">
                                <input id="chequeBank" type="text" name="cheque_bank" data-parsley-type="change" placeholder="" class="form-control">
                            </div>
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
    var billtotal = 0;

    function addrow() {
        aa = $("#pro_code option:selected").text();
        a = $("#pro_code").val();
        b = $("#qty").val();
        c = $("#issuePrice").val();
        // f = $("#free").val();
        // g = $("#discount").val();
        d = $("#itemBill").val();

        if (a == "all") {
            alert("Please insert atleast one item");
            return;
        }



        if (b.trim().length == 0) {
            alert("Enter amount for quantity");
            return;
        }

        if (c.trim().length == 0) {
            alert("Enter amount for Issue price");
            return;
        }

        // if (+e < +g) {
        //     alert("Discount value must be less than the issue price");
        //     return;
        // }

        $.ajax('/DMS/class/ajax.php?pro_id=' + a, {
            type: "GET",
            async: false
        }).done(function(response) {
            console.log('response');
            console.log(response);
            console.log(b);
            if (parseInt(response) < parseInt(b)) {
                alert("Stock is not available");
                return;

            } else {

                billtotal += parseFloat(d);
                $('#Maintotbill').val(parseFloat(billtotal).toFixed(2));
                console.log(billtotal);
                $("#td").append("<tr><td>" + aa + "<input type='hidden'  name='pro_code[]' value='" + a + "'></td><td>" + b + "<input type='hidden'  name='cus_returnslt_qty[]' value='" + b + "'></td><td>" + c + "<input type='hidden'  name='cus_returnslt_issue_price[]' value='" + c + "'></td><td>" + d + "<input type='hidden'  name='cus_returnslt_item_amount[]' value='" + d + "'></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delreturns(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
                $("#item").val("");
                $("#qty").val("");
                $("#issuePrice").val("");
                $("#itemBill").val("");


                $("#item").focus();
                //addText();
            }

        });




    }

    //function to manufacture name and dateas text

    function delreturns(t) {

        $(t).parent().parent().parent().remove();
    }



    // function additem(){
    //     let itemAmount = $("#totBill").val();
    //     if($("#mainTotBill").val() > 0 && itemAmount > 0){
    //         $("#mainTotBill").val( parseInt($("#mainTotBill").val()) + parseInt(itemAmount));
    //     }else{
    //         $("#mainTotBill").val(parseInt(itemAmount));
    //     }

    // }



    function delcat(orderlt_id) {
        //  alert(procat_id);
        x = confirm("Are you sure you want to delete" + cus_returnslt_id);
        if (x == true) {
            window.location.href = "add_orderlt.php?delete=" + cus_returnslt_id;

        }
    }

    function calculateBillTotal() {
        var totalBill;
        var credit;
        var paidAmount = 0;

        var quantity = $('#qty').val();
        var issuePrice = $('#issuePrice').val();
        // var discount = $('#discount').val();
        // var cash = $('#cash').val();
        // var chequeAmount = $('#chequeAmount').val();
        // var paidAmount = $('#paidAmount').val();

        cash = (cash == "" ? 0 : cash);
        //If cash is an empty string (""), then the expression evaluates to 0.
        //If cash is not an empty string, then the expression evaluates to ca   sh.
        chequeAmount = (chequeAmount == "" ? 0 : chequeAmount);
        var credit = $('#credit').val();

        totalBill = quantity * issuePrice;

        // if (discount && discount != null) {
        //     totalBill = totalBill / 100 * (100 - discount);
        //     //document.getElementById('totBill').value = discountedValue;
        // }

        $('#itemBill').val(parseInt(totalBill));

        credit = (billtotal - (parseInt(cash) + parseInt(chequeAmount)));
        document.getElementById('credit').value = parseInt(credit);

        console.log(credit);
        console.log(cash);
        paidAmount = (parseInt(billtotal) - parseInt(credit));
        document.getElementById('paidAmount').value = parseInt(paidAmount);

        // $('#bcvmcbv').attr('display','none'); // hide the element by id.

    }
</script>