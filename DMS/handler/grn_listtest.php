<?php
include_once("../../class/grn.php");
$grnObject=new grn();

//$orderObject = new order();


if(isset($_POST['mac_name']))
{
   
    $grnObject->grn_date=date("Y-m-d");
    $grnObject->fk_mac_id=$_POST['mac_name'];
   
    $grnObject->save();
    
}


$allgrn=$grnObject->get_all();

//include the manufacture file 

include_once("../../class/manufacture.php");
$macObject=new manufacture();
$amac=$macObject->get_all();

//include the product file 
include_once("../../class/product.php");
$proObject=new product();
$apro=$proObject->get_all();




// including the header part

include_once "../pages/head.php";
?>
<div class="dashboard-wrapper">

<form action="add_grn_list.php" method="post" id="addgrnForm">
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
                                    
                                        
                                        <div class="form-group row">
                                        

                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">Manufacture</label>
                                            <div class=" col-lg-2">
                                                <select name="mac_name" class="form-control" id="manufactureName">
                                                    
                                                        
                                                        <?php
                                            foreach($amac as $item){
                                        ?>        
                                            <option value="<?=$item["mac_id"]?>"><?=$item["mac_name"]?> </option>           
                                            <?php }?>           
                                                       
                                                </select>
                                            </div>
                                            <label for="inputcategory" class=" col-lg-0 col-form-label text-right">grn Date</label>
                                            <div class=" col-lg-2">
                                                <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                                <input id="date" type="date"  name="grn_date"   data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                            <label for="refno" class=" col-lg-0 col-form-label text-right">REF NO.</label>
                                            <div class=" col-lg-2">
                                                
                                                <input id="refno" type="text"  name="grn_refno"   data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                            <label for="note" class=" col-lg-0 col-form-label text-right">Note</label>
                                            <div class=" col-lg-2">
                                                <!-- <input id="date" type="date" name="order_date"  required data-parsley-type="change" placeholder="" class="form-control"> -->
                                                <input id="note" type="text"  name="grn_note"   data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                                       

                                        <div class="form-group row">
                                            <label for="inputcategory" class=" col-lg-1 col-form-label text-right">Item Code</label>
                                            <div class=" col-lg-2">
                                            <select name="pro_code" class="form-control" id="pro_code">
                                                    
                                                        
                                                    <?php
                                        foreach($apro as $item){
                                    ?>        
                                        <option value="<?=$item["pro_name"]?>"><?=$item["pro_name"]?> </option>           
                                        <?php }?>           
                                                   
                                            </select>
                                                
                                            </div>
                                            <label for="inputcategory" class=" col-lg-2 col-form-label text-right">Quantity</label>
                                            <div class=" col-lg-2">
                                                <input id="qty" type="text" name="grnlt_qty" data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                            <label for="inputcategory"  class=" col-lg-2 col-form-label text-right">Description</label>
                                            <div class=" col-lg-2">
                                                <input id="descrip" type="text" name="grnlt_descrip"  data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                             
                                            <div class="form-group row">

                                            <label for="inputcategory"  class=" col-lg-2 col-form-label text-right">Purchase Price</label>
                                            <div class=" col-lg-2">
                                                <input id="purchase_price" type="text" name="grnlt_purchase_price"  data-parsley-type="change" placeholder="" class="form-control">
                                            </div>

                                            <label for="inputcategory"  class=" col-lg-2 col-form-label text-right">Expire Date</label>
                                            <div class=" col-lg-2">
                                                <input id="ex_date" type="text" name="grnlt_ex_date"  data-parsley-type="change" placeholder="" class="form-control">
                                            </div>

                                            <label for="inputcategory"  class=" col-lg-2 col-form-label text-right">Sales Price</label>
                                            <div class=" col-lg-2">
                                                <input id="sales_price" type="text" name="grnlt_sales_price"  data-parsley-type="change" placeholder="" class="form-control">
                                            </div>
                                            
                                            <!-- <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="button" class="btn btn-space btn-primary" onclick="addrow()">Add Items</button>
                                                    
                                                </p>
                                            </div> -->
                                        </div>
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
                            
                            <h5 class="card-header">GRN</h5>
                            <div class="card-body">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

                            <div class="h6 mb-3" style="color:black">Manufacture - <span id="manfNameText"></span></div>

                                
                               <div class="h6 mt-2 mb-2" style="color:black"> Date - <span id="ordDateText"></span></div>
                               

                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" name="ordListTable">
                                        <thead>
                                            <tr>

                                                <th>Item Code</th>
                                                <th>Quantity</th>
                                                <th>Description</th>
                                                <th>Purchase Price</th>
                                                <th>Ex Date</th>
                                                <th>Sales Price</th>
                                            
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
    
    function addrow(){

        

        a=$("#pro_name option:selected").val();
        
        b=$("#qty").val();
        c=$("#descrip").val();
        d=$("#ordDate").val();

        

        

        

            $("#td").append("<tr><td><input type='hidden'  name='orderitem[]' value='"+a+"'>"+e+"</td><td>"+b+"<input type='hidden'  name='orderqty[]' value='"+b+"'></td><td>"+c+"</td><td class='d-none'>"+d+"<input type='hidden'  name='orderdescrip[]' value='"+c+"'></td><td><i class='icon-pencil' title='Edit'>Edit</i>&nbsp;&nbsp;&nbsp;<i class='icon-trash' style='color:red'><a onclick='delorder(this)' href='#'  style='color:red'>Delete</a></i></td></tr>");
            $("#item").val("");
            $("#qty").val("");
            $("#descrip").val("");
            $("#ordDate").val("");

            $("#item").focus();
            addText();
        }

        

        


    

    //function to manufacture name and dateas text

    




    function delorder(t){
        
        $(t).parent().parent().parent().remove();
    }

   


    
    

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

