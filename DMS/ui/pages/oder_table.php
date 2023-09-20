<?php

?>
<?php
include_once("../../class/ordr.php");
$ordr = new ordr();
$allordr = $ordr->get_all();

include_once "../pages/head.php";
?>
<div class="card">
                            
                            <h5 class="card-header">Orders</h5>
                            <div class="card-body">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

                            

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

<?php
 include_once "../pages/foot.php";
?>
