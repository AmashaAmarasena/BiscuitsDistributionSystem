<?php
include_once "../pages/head.php";
include_once("../../class/cus_returns.php");
//initiate an object from the customer table
$cusReturnsObject = new cus_returns();
include_once("../../class/creturns_payment.php");
$cPaymentObject = new creturns_payment();



if (isset($_POST["cus_name"])) {
    $cusReturnsObject->cus_returns_date = $_POST["cus_returns_date"];
    $cusReturnsObject->fk_cus_id = $_POST["cus_name"];
    $cusReturnsObject->cus_returns_note = $_POST["cus_returns_note"];
    $cusReturnsObject->cus_returns_total_bill = $_POST["cus_returns_total_bill"];
    $cusReturnsObject->fk_sales_id = $_POST["fk_sales_id"];
    // Add sale to the stock under particular 
     $cusReturnsObject->fk_veh_id = $_SESSION["staff"]['fk_veh_id'];

     $cid = $cusReturnsObject->save();
}
/** check if the POST array contains any value for input box with
 *attribute name as paid_amount */
if (isset($_POST["creturns_pay_paid_amount"])) {
    $cpaymentObject->creturns_pay_cash = $_POST["creturns_pay_cash"];
    $cPaymentObject->creturns_pay_cheque_amnt = $_POST["creturns_pay_cheque_amnt"];
    $cPaymentObject->creturns_pay_cheque_no = $_POST["creturns_pay_cheque_no"];
    $cPaymentObject->creturns_pay_date = $_POST["creturns_pay_date"];
    $cPaymentObject->creturns_pay_cheque_bank = $_POST["creturns_pay_cheque_bank"];
    $cPaymentObject->creturns_pay_credit = $_POST["creturns_pay_credit"];
    $cPaymentObject->creturns_pay_paid_amount = $_POST["creturns_pay_paid_amount"];
    $cPaymentObject->cus_returnslt_id = $cid;

    $cPaymentObject->save();
}
// $allcusReturns = $cusReturnsObject->get_all();
//include the manufacture file 

include_once("../../class/customer.php");
$cusObject = new customer();
$acus = $cusObject->get_all();

include_once("../../class/product.php");
$proObject = new product();
$apro = $proObject->get_all();

include_once("../../class/sales.php");
$salesObject = new sales();
$sales = $salesObject->get_all();

// including the header part


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
                        <!-- <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p> -->
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
            <div class="main-body"><!-- Start .main-body -->
                <div class="row"> <!-- Start Row -->
                    <form method="post" name="submit_frm">
                        <input type="hidden" id="tot_returns" name="tot_returns" value="0">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Add Customer Sales Return</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="customerName" class="col-form-label">Customer</label>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=saleId class=" col-form-label "> Sales ID </label>
                                                <select name="sales_id" class="form-control  dropdown-toggle-split" id="saleId">
                                                    <option value="all"> Select ID </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cus_returns_date" class=" col-lg-0 col-form-label text-right">Return Date</label>
                                                <input id="cus_returns_date" type="date" name="cus_returns_date" data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cus_returns_note" class="col-form-label">Note</label>
                                                <textarea class="form-control col-lg-12" id="cus_returns_note" name="cus_returns_note" rows="1"></textarea>
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
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered " name="ordListTable" id="">
                                            <thead>
                                                <tr>
                                                    <th>Sales ID</th>
                                                    <th>Item</th>
                                                    <th>Sold Quantity</th>
                                                    <th>Issue Price</th>
                                                    <th>Return Quantity</th>
                                                    <th>Return Amount</th>


                                                </tr>
                                            </thead>
                                            <tbody id="appended_td">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-center text-bold text-primary">Total Return Amount</td>
                                                    <td class="text-right"><span id="toal_rtn_amount">00.00</span></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                    <div class="form-group row">

                                        <!-- <label for="inputcategory"  class=" col-lg-0 col-form-label text-right" style="color: black;">Total Return Amount</label>
                                    <div>
                                        <div class=" col-lg-10">
                                            <input id="itemBill" type="text" name="cus_returnslt_item_amount" data-parsley-type="change" placeholder="" class="form-control" onkeyup="Addrow()">
                                        </div>
                                    </div> -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group row">
                                            </div>
                                            <hr>
                                            <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                                Please fill all the fields
                                            </div>
                                            <!-- <div class="form-group row">
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
                                        </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <div class="col-lg-12 pl-0">
                                            <p class="text-right">

                                                <button type="button" class="btn btn-space btn-success mt-4" name="allSubmit" id="allSubmit">Submit</button>
                                                 <!-- <input type="button" value="Save">  -->
                                            </p>
                                        </div>
                                    </div>
                                </div> 

                            </div>
                        </div> <!--end col-md-12 -->


                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Customer Returns</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Cash</label>
                                                <input id="cash" type="text" name="cash" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
                                            </div>
                                        </div>
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
                                                <input id="paidAmount" type="text" name="paid_amount" data-parsley-type="change" placeholder="" class="form-control" value="0" onkeyup="calculateBillTotal()">
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
                                </div>--> 
                                
                    </form>
                </div> <!-- end .row -->
            </div> <!-- end .main-div -->
        </div>

        <?php
        include_once "../pages/foot.php";
        ?>

        <script>
            $(document).ready(function() {

            });

            $("form").submit(function() {
                alert("form submit");
                var vals = $("form").serialize();
                console.log("form vals : ", vals);
            });

            $("form").on("submit", function(e) {
                alert("form submit");
                var dataString = $(this).serialize();
                console.log("form vals : ", dataString);
            });

            var item_list;
            var total_return_amount = 0;

            $("#customerName").change(function() {
                GetDropDownData();
            });

            $("#saleId").change(function() {
                GetSalesDataForTable();
            });

            function GetDropDownData() {
                let customer_id = $("#customerName").val();
                console.log("customer_id : ", customer_id);
                $.ajax('/DMS/class/ajax.php?customer_id=' + customer_id, {
                    type: "GET",
                    async: false
                }).done(function(response) {
                    $('#saleId').empty();
                    let dt = JSON.parse(response);
                    $("#saleId").append("<option value=''>Select Sale ID</option>");
                    for (var k in dt) {
                        $("#saleId").append("<option value='" + dt[k].sales_id + "'>" + dt[k].sales_id + "</option>");
                    }
                });
            }

            function GetSalesDataForTable() {
                let sales_id = $("#saleId").val();
                $.ajax('/DMS/class/ajax.php?sales_id=' + sales_id, {
                    type: "GET",
                    async: false,
                }).done(function(response) {

                    let html_string = '';


                    //        let sample_json = {"name":"amasha", "age" :"20", "phones":["023232","4394803"],
                    //          "parent_information":{
                    //             "father":{
                    //                 "name":"name1",
                    //                 "age":"24"
                    //             },
                    //             "mother":{
                    //                 "name":"fdsf",
                    //                 "phones" : ["434324","3423432"]
                    //             }
                    //          }
                    // };

                    // for(var k in sample_json){
                    //     console.log("k :", k);
                    //     if(k=="parent_information"){
                    //        var mothersname =  sample_json.parent_information.mother.name;
                    //     }
                    // }

                    item_list = JSON.parse(response); // decode to json format {"0":{fk_sales_name:"bbcvbv", saleslt_issue_price:5565}, "key2": {fk_sales_name:"bbcvbv", saleslt_issue_price:5565}}

                    $("#appended_td").html('');
                    // html_string += "<input type='hidden' value='"+sales_id+"' name='sales_id'>";
                    for (var k in item_list) {
                        let sales_price = parseFloat(item_list[k].saleslt_issue_price).toFixed(2);
                        html_string += "<tr>";
                        html_string += "<td class='text-center'>" + item_list[k].fk_sales_id;
                        html_string += "<input type='hidden' name='product_id[]'  value='" + item_list[k].saleslt_item + "'>";
                        html_string += "<input type='hidden' name='issued_price[]'  value='" + item_list[k].saleslt_issue_price + "'>";
                        html_string += "<input type='hidden' name='issued_amount[]'  value='" + item_list[k].saleslt_qty + "'>";
                        html_string += "</td>";
                        html_string += "<td>" + item_list[k].pro_name + "</td>";
                        html_string += "<td class='text-right'>" + item_list[k].saleslt_qty + "</td>";
                        html_string += "<td class='text-right'>" + sales_price + "</td>";
                        html_string += "<td><input max='" + parseInt(item_list[k].saleslt_qty) + "' onkeyup='change_item_qty(" + k + ")' id='rtn_qty_" + k + "' value='0' type='text' name='return_qty[]'></td>";
                        html_string += "<td class='text-right'><p id='toal_rtn_p_" + k + "'></p></td>";
                        html_string += "</tr>";
                    }

                    $("#appended_td").append(html_string);
                    calculate_total_returns();
                });
            }

            function change_item_qty(key) {
                // alert("qty changes on : "+k);
                let qty = $("#rtn_qty_" + key).val();
                let amount = parseFloat(item_list[key].saleslt_issue_price) * parseFloat(qty)
                $('#toal_rtn_p_' + key).html(amount.toFixed(2));

                item_list[key]['rtn_qty'] = qty;

                calculate_total_returns();

                console.log("item list : ", item_list);
            }

            function calculate_total_returns() {
                total_return_amount = 0;
                for (var k in item_list) {
                    let rtn_qty = $("#rtn_qty_" + k).val();
                    console.log("k qty : ", rtn_qty);
                    if (rtn_qty != '') {
                        item_list[k]['rtn_qty'] = rtn_qty;
                        total_return_amount += rtn_qty * parseFloat(item_list[k].saleslt_issue_price);
                    }
                }
                $('#toal_rtn_amount').html(total_return_amount.toFixed(2));
                $('#tot_returns').val(total_return_amount.toFixed(2));
            }

            $('#allSubmit').click(function() {
                $.ajax("/DMS/class/ajax.php", {
                    type: "POST", //GET, POST, PUT, DELETE
                    async: false,
                    data: $("form").serialize()

                }).done(function(response) {
                    console.log("response : ", response);
                }).fail(function(err) {

                });
            });

            //     function calculateBillTotal() {
            //     var totalBill;
            //     var credit;
            //     var paidAmount = 0;

            //     var quantity = $('#qty').val();
            //     var issuePrice = $('#issuePrice').val();
            //     // var discount = $('#discount').val();
            //     var cash = $('#cash').val();
            //     var chequeAmount = $('#chequeAmount').val();
            //     var paidAmount = $('#paidAmount').val();

            //     cash = (cash == "" ? 0 : cash);
            //     //If cash is an empty string (""), then the expression evaluates to 0.
            //     //If cash is not an empty string, then the expression evaluates to cash.
            //     chequeAmount = (chequeAmount == "" ? 0 : chequeAmount);
            //     var credit = $('#credit').val();

            //     totalBill = quantity * issuePrice;

            //     if (discount && discount != null) {
            //         totalBill = totalBill / 100 * (100 - discount);
            //         //document.getElementById('totBill').value = discountedValue;
            //     }

            //     $('#totBill').val(parseInt(totalBill));

            //     credit = (billtotal - (parseInt(cash) + parseInt(chequeAmount)));
            //     document.getElementById('credit').value = parseInt(credit);

            //     console.log(credit);
            //     console.log(cash);
            //     paidAmount = (parseInt(billtotal) - parseInt(credit));
            //     document.getElementById('paidAmount').value = parseInt(paidAmount);

            // }
        </script>