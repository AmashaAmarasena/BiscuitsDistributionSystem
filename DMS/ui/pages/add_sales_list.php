<?php
include_once ("../pages/head.php");
include_once("../../class/sales.php");
//initiate an object from the sales table
$salesObject = new sales();
include_once("../../class/payment.php");
$paymentObject = new payment();
include_once("../../class/cus_invoice.php");
$cusInvoiceObject = new cus_invoice();



if(isset($_POST["cus_invoice_total_amount"])){
    $cusInvoiceObject->cus_invoice_date = $_POST["cus_invoice_date"];
    $salesOcusInvoiceObjectbject->fk_cus_id = $_POST["cus_name"];
    $salesObject->sales_refno = $_POST["sales_refno"];
    $cusInvoiceObject->cus_invoice_note = $_POST["cus_invoice_note"];
    $cusInvoiceObject->cus_invoice_total_amount = $_POST["cus_invoice_total_amount"];
    $cusInvoiceObject->fk_cus_returns_id = $_POST['fk_cus_returns_id'];

    $cusInvoiceObject->save();
}

if (isset($_POST["cus_name"])) {
    $salesObject->sales_date = $_POST["sales_date"];
    $salesObject->fk_cus_id = $_POST["cus_name"];
    // $salesObject->sales_refno = $_POST["sales_refno"];
    $salesObject->sales_note = $_POST["sales_note"];
    $salesObject->sales_total_bill = $_POST["sales_total_bill"];
    // Add sale to the stock under particular 
    $salesObject->fk_veh_id = $_SESSION["staff"]['fk_veh_id'];

    $sid = $salesObject->save(); 
    //print_r($sid);
 
}

/** check if the POST array contains any value for input box with
 *attribute name as paid_amount */
if (isset($_POST["paid_amount"])) {
    $paymentObject->cash = $_POST["cash"];
    $paymentObject->cheque_amount = $_POST["cheque_amount"];
    $paymentObject->cheque_no = $_POST["cheque_no"];
    $paymentObject->cheque_date = $_POST["cheque_date"];
    $paymentObject->cheque_bank = $_POST["cheque_bank"];
    // $paymentObject->credit = $_POST["credit"];
    $paymentObject->paid_amount = $_POST["paid_amount"];
    $paymentObject->paid_date = $_POST["paid_date"];
    $paymentObject->fk_sales_id = $sid;
    if($paymentObject->paid_amount>0){
        $paymentObject->save();
    }
}
$allsales = $salesObject->get_all();
//include the manufacture file 

include_once("../../class/customer.php");
$cusObject = new customer();
$acus = $cusObject->get_all();

include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();


// including the header part

?>
<div class="dashboard-wrapper">

    <form action="add_sales_list.php" method="post" id="addOrderForm">
        <div class="container-fluid dashboard-content">


            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">

                        <h2 class="pageheader-title">Add Sale </h2>
                        <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Sale</li>
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
                        <h5 class="card-header">Add Sale</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Customer</label>

                                        <select name="cus_name" value="-1" class="form-control  dropdown-toggle-split" id="cus_name">

                                            <option value="all"> Select Customer</option>
                                            <?php
                                            foreach ($acus as $item) {
                                            ?>
                                                <option value="<?= $item["cus_id"] ?>"><?= $item["cus_name"] ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Sales Date</label>
                                        <input id="date" type="date" name="sales_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Note</label>
                                        <textarea class="form-control" id="sales_note" name="sales_note" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row"> -->
                            <!-- <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Ref Number</label>
                                        <div class=" col-lg-2">
                                            <input id="refno" type="text" name="sales_ " data-parsley-type="change" placeholder="" class="form-control">
                                        </div> -->

                            <!-- <div class=" col-lg-2">
                                            <input id="note" type="text" name="sales_note" data-parsley-type="change" placeholder="" class="form-control">
                                        </div> -->

                            <hr>
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Sales Item</label>
                                        <select name="pro_code" value="-1" class="form-control  js-example-basic-single" id="pro_code">
                                            <option value="all"> Select Product</option>
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
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Quantity</label>
                                        <input id="qty" type="text" name="saleslt_qty" data-parsley-type="change" placeholder="" class="form-control" onkeyup="calculateBillTotal()" oninvalid="this.style.borderColor='red';" class="invalid-feedback" style="display:block;">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Issue Price</label>
                                        <input id="issuePrice" type="number" name="saleslt_issue_price" data-parsley-type="change" placeholder="" class="form-control" onkeyup="calculateBillTotal()" oninvalid="this.style.borderColor='red';" class="invalid-feedback" style="display:block;">
                                        <div class="invalid-feedback" style="display:block;">
                                            Input numbers(0-9)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Free</label>
                                        <input id="free" type="text" name="saleslt_free" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <!-- <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Description</label>
                                <div class=" col-lg-2">
                                    <input id="descrip" type="text" name="saleslt_descrip" data-parsley-type="change" placeholder="" class="form-control">
                                </div> -->
                                <div class="col-md-3">
                                    <!-- <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Discount</label>
                                        <div class="input-group-append">
                                            <input id="discount" type="text" name="saleslt_discount" data-parsley-type="change" placeholder="" class="form-control" onkeyup="calculateBillTotal()">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                    <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Discount</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <input id="discount" type="text" name="saleslt_discount" data-parsley-type="change" placeholder="" class="form-control" onkeyup="calculateBillTotal()">
                         
                                        <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right" style="color: black;">Item Amount</label>
                                        <div>
                                            <input id="totBill" type="text" name="saleslt_total_bill" data-parsley-type="change" placeholder="" class="form-control" onkeyup="Addrow()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                        Please fill all the fields
                                    </div>
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
                    <!--end card-->
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 style="color: black;">Sales</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right" style="color:black">Main Total Bill</label>
                                        <div class="col-8 col-lg-8">
                                            <input id="salesTotBill" type="text" name="sales_total_bill" data-parsley-type="change" readonly placeholder="" class="form-control" onkeyup="Addrow()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered " name="ordListTable" id="">
                                    <thead>
                                        <tr>
                                            <th>Sales Item</th>
                                            <th>Quantity</th>
                                            <th>Issue Price</th>
                                            <th>Free items</th>
                                            <th>Discount</th>
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

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cash</label>
                                        <input id="cash" type="text" name="cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Date</label>
                                        <input id="paid_date" type="date" name="paid_date" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                            </div> 
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Amount</label>
                                        <input id="chequeAmount" type="text" name="cheque_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque No</label>
                                        <input id="chequeNo" type="text" name="cheque_no" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                            
                          
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Date</label>
                                        <input id="chequeDate" type="date" name="cheque_date" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Paid Amount</label>
                                        <input id="paidAmount" type="text" readonly name="paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Credit</label>
                                        <input id="credit" type="text" name="credit" value="0" data-parsley-type="change" placeholder="" class="form-control">
                                    </div>
                                </div>
                           
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cheque Bank</label>
                                        <input id="chequeBank" type="text" name="cheque_bank" data-parsley-type="change" placeholder="" class="form-control">
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
    </form>
</div>


<?php
include_once "../pages/foot.php";
?>

<script>

    $(document).ready(function(){
        $('#cus_name').select2();
        $('#pro_code').select2();
    });
    var billtotal = 0;

    function addrow() {
        pro_name = $("#pro_code option:selected").text();
        pro_code = $("#pro_code").val();
        qty = $("#qty").val();
        issue_price = $("#issuePrice").val();
        free = $("#free").val();
        discount = $("#discount").val();
        total_bill = $("#totBill").val();

        if (pro_code == "all") {
            alert("Please insert atleast one item");
            return;
        }


        console.log(qty);
        if (qty.trim().length == 0) {
            alert("Enter amount for quantity");
            return;
        }

        if (issue_price.trim().length == 0) {
            alert("Enter amount for Issue price");
            return;
        }

        if (+issuePrice < +qty) {
            alert("Discount value must be less than the issue price");
            return;
        }

        $.ajax('/DMS/class/ajax.php?pro_id=' + pro_code, {
            type: "GET",
            async: false
        }).done(function(response) {
            console.log('response');
            console.log(response);
            console.log(qty);
            if (parseInt(response) < parseInt(qty)) {
                alert(" Product is currently out of stock");
                return;

            } else {

                billtotal += parseFloat(total_bill);
                $('#salesTotBill').val(parseFloat(billtotal).toFixed(2)); //toFixed2-display 2 decimal points 100.00
                console.log(billtotal);
                console.log('Discount :', discount);
                if(discount==''){
                    discount=0;
                }
                if(free==''){
                    free=0;
                }
                // $('#pro_code' + pro_code).remove();
                $("#td").append("<tr id='pro_code" + pro_code + "'><td>" + pro_name + "<input type='hidden'  name='pro_code[]' value='" + pro_code + "'></td><td>" + qty + "<input type='hidden'  name='saleslt_qty[]' value='" + qty + "'></td><td>" + issue_price + "<input type='hidden'  name='saleslt_issue_price[]' value='" + issue_price + "'></td><td>" + free + "<input type='hidden'  name='saleslt_free[]' value='" + free + "'></td><td>" + discount + "<input type='hidden'  name='saleslt_discount[]' value='" + discount + "'></td><td>" + total_bill + "<input type='hidden'  name='saleslt_total_bill[]' value='" + total_bill + "'></td><td><a onclick='editSales(" + pro_code + "," + qty + "," + issue_price + "," + total_bill + "," + discount + "," + free + ")' href='#'  class='btn btn-outline-primary btn-xs'><i class='icon-pencil' title='Edit'>Edit</i></a>&nbsp;&nbsp;&nbsp;<button onclick='delsales(this)'type='button' href='#'  class='btn btn-outline-danger btn-xs'><i class='icon-trash' style='color:red'>Delete</button></i></td></tr>");
                $("#item").val("");
                $("#qty").val("");
                $("#issuePrice").val("");
                $("#free").val("");
                $("#discount").val("");
                $("#totBill").val("");


                $("#item").focus();
                // addText();
            }

        });
    }
    //function to manufacture name and dateas text

    function delsales(t) {
        $(t).parent().parent().parent().remove();
    }

    function editSales(pro_code, qty, issue_price,  total_bill,discount=" ",free = "") {
        
        var row = document.getElementById("pro_code" + pro_code);
        row.parentNode.removeChild(row);

        $("#pro_code").val(pro_code).trigger('change');
        $("#qty").val(qty);
        $("#issuePrice").val(issue_price);
        $("#free").val(free);
        $("#discount").val(discount);
        $("#totBill").val(total_bill);

        billtotal -= parseFloat(total_bill);
        $("#salesTotBill").val(billtotal)

        // calculateBillTotal();
        
    }

    function calculateBillTotal() {
        var totalBill;
        var credit;
        var paidAmount = 0;

        var quantity = $('#qty').val();
        var issuePrice = $('#issuePrice').val();
        var discount = $('#discount').val();
        var cash = $('#cash').val();
        var chequeAmount = $('#chequeAmount').val();
        var paidAmount = $('#paidAmount').val();

        cash = (cash == "" )? 0 : cash;
        //If cash is an empty string (""), then the expression evaluates to 0.
        //If cash is not an empty string, then the expression evaluates to cash.
        chequeAmount = (chequeAmount == "" ? 0 : chequeAmount);
        var credit = $('#credit').val();

        totalBill = quantity * issuePrice;

        if (discount && discount != null) {
            totalBill = totalBill / 100 * (100 - discount);
            //document.getElementById('totBill').value = discountedValue;
        }

        $('#totBill').val(parseInt(totalBill));

        credit = (billtotal - (parseInt(cash) + parseInt(chequeAmount)));
        document.getElementById('credit').value = parseInt(credit);

        console.log(credit);
        console.log(cash);
        paidAmount = (parseInt(billtotal) - parseInt(credit));
        document.getElementById('paidAmount').value = parseInt(paidAmount);

    }
</script>