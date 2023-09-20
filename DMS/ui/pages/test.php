<?php
include_once("../../class/ordr.php");
$orderObject=new ordr();

//$orderObject = new order();


if(isset($_POST["orderlt_item"]))
{

    $orderObject->order_date=date("Y-m-d");
    $orderObject->fk_mac_id=$_POST['mac_name'];
   
    $orderObject->save();
    
}

    
    // if(isset($_POST['allSubmit']))
    // {
    
    //     if(isset($_POST["order_date"]) && isset($_POST['mac_name']) && isset($_POST['orderlt_item'])
    //     && isset($_POST['orderlt_qty'])  && isset($_POST['orderlt_descrip']) ){
       
    //    if(!empty($_POST["order_date"]) && !empty($_POST['mac_name']) && !empty($_POST['orderlt_item'])
    //    && !empty($_POST['orderlt_qty'] && !empty($_POST['orderlt_descrip'])))
    //    {
    //        $orderObject->order_date=$_POST['order_date'];
    //        $orderObject->fk_mac_id=$_POST['mac_name'];
          
    //        $orderObject->save();

           
    //    }
    //    else{
    //        echo('<script>alert("please fill all the fields")</script>');
           
    //    }
    //     }
    // }
    
   



$allorder=$orderObject->get_all();

//include the manufacture file 

include_once("../../class/manufacture.php");
$macObject=new manufacture();
$amac=$macObject->get_all();

//include the order file 




// including the header part

include_once "../pages/head.php";
?>
<div class="dashboard-wrapper">

<form action="add_order_list.php" method="post" id="addOrderForm">
            <div class="container-fluid dashboard-content">


                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                        
                            <h2 class="pageheader-title">Add Order </h2>
                            <p class="pageheader-text d-none">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Order</li>
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
                                <h5 class="card-header">Add Order</h5>
                                <div class="card-body">
                                    
                                        
                                        <div class="form-group row">
                                        

                                            <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Manufacture</label>
                                            <div class=" col-lg-2">
                                                <select name="mac_name" class="form-control" id="manufactureName">
                                                    
                                                        
                                                        <?php
                                            foreach($amac as $item){
                                        ?>        
                                            <option value="<?=$item["mac_id"]?>"><?=$item["mac_name"]?> </option>           
                                            <?php }?>           
                                                       
                                                </select>
                                            </div>
                                            <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Order Date</label>
                                            <div class=" col-lg-2">
                                                <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                                <input id="date" type="date"  name="order_date"   data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                                    

                                        <div class="form-group row">
                                            <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Order Item</label>
                                            <div class=" col-lg-2">
                                                <input id="item" type="text"  name="orderlt_item"  data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                            <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Quantity</label>
                                            <div class=" col-lg-2">
                                                <input id="qty" type="text" name="orderlt_qty" data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                            <label for="inputcategory"  class=" col-lg-2 col-form-label text-right">Description</label>
                                            <div class=" col-lg-2">
                                                <input id="descrip" type="text" name="orderlt_descrip"  data-parsley-type="change" placeholder="" class="form-control">
                                            </div>


                                            
                                            <!-- <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="button" class="btn btn-space btn-primary" onclick="addrow()">Add Items</button>
                                                    
                                                </p>
                                            </div> -->
                                        </div>

                                       

                                        <div class="alert alert-danger  text-center d-none" role="alert" id="errorMsg">
                                            Please fill all the fields

                                        </div>


                                        <div class= "form-group row">


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

                                        </div>-->
                                        
                                            <!-- <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    
                                                   
                                                    <button class="btn btn-space btn-danger">Cancel</button>
                                                </p>
                                            </div> -->
                                        </div>
                                    
                                </div>
                            </div>
</div>



<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                


   
                        <div class="card">
                            
                            <h5 class="card-header">Orders</h5>
                            <div class="card-body">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

                            <div class="h6 mb-3" style="color:black">Manufacture - <span id="manfNameText"></span></div>

                                
                               <div class="h6 mt-2 mb-2" style="color:black"> Date - <span id="ordDateText"></span></div>
                               

                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" name="ordListTable">
                                        <thead>
                                            <tr>

                                                <th>Order Item</th>
                                                <th>Quantity</th>
                                                <th>Description</th>
                                                
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
    let dtToday = new Date();
    let month = dtToday.getMonth() + 1;
    let day = dtToday.getDate();

    if(day < 10)
    {
        day = '0' + day.toString();
    }

    if(month < 10)
    {
        month = '0' + month.toString();
    }

    let todayDate = dtToday.getFullYear().toString()+'-'+month+'-'+ day;

   
    // $("#date").attr('max', maxDate);

   $("#ordDate").prop('disabled', true);
   $("#ordDate").attr('value',todayDate);

let ordDate;
    function addrow(){

        let flag = true;

        a=$("#item").val();
        b=$("#qty").val();
        c=$("#descrip").val();
        d=$("#ordDate").val();

        let manFacId =  $("#manufactureName").val();

        if(!a || !b || !c || !d || !manFacId)
        {
           // alert("please check all the fields !")
           $("#errorMsg").removeClass("alert alert-danger  text-center d-none");
           $("#errorMsg").addClass("alert alert-danger  text-center");
            flag = false;
        }else{
            if(!$.isNumeric(b))
            {
                alert("Quantity must be a number!")
                flag = false;

            }
        }

        // if(!b)
        // {
        //     alert("please fill quantity")
        //     flag = false;
        // }

        // if(!c)
        // {
        //     alert("please fill decription")
        //     flag = false;
        // }

        // if(!d)
        // {
        //     alert("please fill date")
        //     flag = false;
        // }

        // if(!manFacId)
        // {
        //     alert("please fill manufacture details")
        //     flag = false;
        // }

        if(flag)
        {
            ordDate = d;

            $("#td").append("<tr><td><input type='hidden'  name='orderitem[]' value='"+a+"'>"+a+"</td><td>"+b+"</td><td>"+c+"</td><td class='d-none'>"+d+"</td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delorder(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
            $("#item").val("");
            $("#qty").val("");
            $("#descrip").val("");
           // $("#ordDate").val("");

            $("#item").focus();
            addText();
        }

        

        


    }

    //function to manufacture name and dateas text

    function addText()
    {
        manfName = $("#manufactureName :selected").text();
        //place the text
        $("#manfNameText").text(manfName);
        $("#ordDateText").text(ordDate);
    }




    function delorder(t){
        
        $(t).parent().parent().parent().remove();
    }

    // $("#addOrderForm").submit(function(event){
    //     event.preventDefault();

    //     $.ajax({
    //         type:"POST",
    //         url:"add_order_list.php",
    //         data:{submitForm:1},
    //         success: function(data)
    //         {
    //             alert(data);
    //         }
    //     });


    // });
    

</script>

<script>
    function delcat (orderlt_id){
      //  alert(procat_id);
    x=confirm("Are you sure you want to delete"+orderlt_id);
    if(x==true){
            window.location.href="add_orderlt.php?delete="+ orderlt_id;

    }
    }
</script>

