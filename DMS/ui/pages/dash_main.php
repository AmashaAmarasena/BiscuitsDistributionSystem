<?php
include_once "head.php";
// session_start();
include_once "../../class/Dashboard.php";
$logged_user_information = $_SESSION["staff"];


$dash_brd_obj = new Dashboard();

// echo "<pre>";
// print_r($dash_brd_obj->get_last_6_month_order_sales());
// echo "</pre>";
// die;


$last_6_month_sales = $dash_brd_obj->get_last_6_month_order_sales();
$top_5_selling_items = $dash_brd_obj->get_top_selling_items();

?>

<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pagehader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h3 class="mb-2">Dashboard</h3>
                            <!-- <p class="pageheader-text">Lorem ipsum dolor sit ametllam fermentum ipsum eu porta consectetur adipiscing elit.Nullam vehicula nulla ut egestas rhoncus.</p> -->
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <!-- <li class="breadcrumb-item active" aria-current="page">Sales Dashboard Template</li> -->
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- pagehader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- metric -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Customers</h2>
                                <div class="metric-value d-inline-block">
                                    <h3 class="mb-1 text-primary"><?php echo $dash_brd_obj->get_customer_count(); ?></h3>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success">
                                    <!-- <i class="fa fa-fw fa-caret-up"></i><span>5.27%</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. metric -->
                    <!-- metric -->
                    <?php
                        $sales_order_info = $dash_brd_obj->get_sales_order_count(); //decl
                    ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

                    
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Sales </h2>
                                <div class="metric-value d-inline-block"> 
                                    <h3 class="mb-1 text-primary"><?php echo number_format($sales_order_info['total_sales'],2); ?> </h3>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success">
                                    <span><?php  echo $sales_order_info['sales_count'];?> sales</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. metric -->
                    <!-- metric -->
                    <?php $grn_details = $dash_brd_obj->get_grn_order_count(); ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Orders</h2>
                                <div class="metric-value d-inline-block">
                                    <h3 class="mb-1 text-primary"><?php echo number_format($grn_details['total_orders'],2); ?></h3>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success">
                                    <span><?php  echo $grn_details['order_count'];?> orders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. metric -->
                    <!-- metric -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Revenue</h2>
                                <div class="metric-value d-inline-block">
                                    <h3 class="mb-1 text-primary"><?php echo number_format(($sales_order_info['total_sales']-$grn_details['total_orders']),2); ?></h3>
                                </div>
                                <?php
                                $revenue_percent = ($sales_order_info['total_sales']-$grn_details['total_orders'])/$grn_details['total_orders'];
                                ?>

                                <?php if($revenue_percent<0){ ?>
                                    <div class="metric-label d-inline-block float-right text-danger">
                                        <i class="fa fa-fw fa-caret-down"></i><span><?php echo number_format($revenue_percent,2); ?></span>
                                    </div>
                                <?php } else{ ?>

                                    <div class="metric-label d-inline-block float-right text-success">
                                        <i class="fa fa-fw fa-caret-up"></i><span><?php echo number_format($revenue_percent,2); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /. metric -->
                </div>
                <!-- ============================================================== -->
                <!-- revenue  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-8 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Sales History of Last Six Months</h5>
                            <div class="card-body">
                                <canvas id="revenue" width="400" height="150"></canvas>
                            </div>
                            <div class="card-body border-top">
                                <div class="row">
                                    <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                                        <h4> Today's Earning: Rs <?php echo number_format($last_6_month_sales['todays_ernings'],2) ?></h4>
                                    </div>
                                    <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                        <h4 class="font-weight-normal mb-3"><span>Rs <?php echo number_format($last_6_month_sales['this_week_ernings'],2) ?></span>  </h4>                                                  </h2>
                                        <div class="mb-0 mt-3 legend-item">
                                            <span class="fa-xs text-primary mr-1 legend-title "><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">Current Week</span></div>
                                    </div>
                                    <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                        <h4 class="font-weight-normal mb-3"> <span>Rs <?php echo number_format($last_6_month_sales['last_week_ernings'],2) ?></span> </h4>
                                        <div class="text-muted mb-0 mt-3 legend-item"> <span class="fa-xs text-secondary mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span><span class="legend-text">Previous Week</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end reveune  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- total sale  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Top Selling Items</h5>
                            <div class="card-body"> 
                                <canvas id="total-sale" width="220" height="155"></canvas>   <!-- Load pie chart  -->
                                <div class="chart-widget-list"> 
                                    <?php foreach ($top_5_selling_items['labels'] as $key => $label) { ?>  <!-- load product items and sales amount  -->
                                        <p>
                                        <span class="fa-xs text-primary mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span><span class="legend-text"> <?php echo $label; ?></span>
                                        <span class="float-right">Rs <?php echo  $top_5_selling_items['tot_sold_arr'][$key]?></span>
                                    </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end total sale  -->
                    <!-- ============================================================== -->
                </div>
                <?php
                    if($logged_user_information['fk_role_id']==1){
                        include_once "dash_manager.php";
                    }
                    else if($logged_user_information['fk_role_id']==2){
                        include_once "dash_cash_collector.php";
                    }
                    else if($logged_user_information['fk_role_id']==3){
                        include_once "dash_sales_rep.php";
                    }
                    else if($logged_user_information['fk_role_id']==4){
                        include_once "dash_stock_keeper.php";
                    }
                ?>
                
            </div>

<?php





include_once "foot.php";
?>
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
<script src="../assets/vendor/charts/charts-bundle/chartjs.js"></script>
<!-- <script src="../assets/libs/js/dashboard-sales.js"></script> -->
<script>
    
$(function() {
    "use strict";
    // ============================================================== 
    // Revenue
    // ============================================================== 
 var ctx = document.getElementById('revenue').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',

                data: {
                    labels: <?php echo json_encode($last_6_month_sales['labels']) ?>, // label key's value [labels]
                    datasets: [{
                        label: 'Orders',
                        data: <?php echo json_encode($last_6_month_sales['order_data']) ?>,  // order =_data key -> values ['']
                      backgroundColor: "rgba(89, 105, 255,0.5)",
                                    borderColor: "rgba(89, 105, 255,0.7)",
                                    borderWidth: 2
                        
                    }, {
                        label: 'Sales',
                        data: <?php echo json_encode($last_6_month_sales['sales_data']) ?>,
                          backgroundColor: "rgba(255, 64, 123,0.5)",
                                    borderColor: "rgba(255, 64, 123,0.7)",
                                    borderWidth: 2
                    }]
                },
                options: {
                        
                             legend: {
                        display: true,
                        position: 'bottom',

                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                    scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + value;
                    }
                }
            }]
        },


         scales: {
                                    xAxes: [{
                                        ticks: {
                                            fontSize: 14,
                                            fontFamily: 'Circular Std Book',
                                            fontColor: '#71748d',
                                        }
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            fontSize: 14,
                                            fontFamily: 'Circular Std Book',
                                            fontColor: '#71748d',
                                        }
                                    }]
                                }
        
                }
            });
   
    // ============================================================== 
    // Total Sale
    // ============================================================== 
 var ctx = document.getElementById("total-sale").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                
                data: {
                    labels: <?php echo json_encode($top_5_selling_items['labels']) ?>,
                    datasets: [{
                        backgroundColor: [
                            "#5969ff",
                            "#ff407b",
                            "#25d5f2",
                            "#ffc750",
                            "#71748d"
                        ],
                        data: <?php echo json_encode($top_5_selling_items['data_arr']) ?>
                    }]
                },
                options: {
                    legend: {
                        display: false

                    }
                }

            });
     
   




});
</script>