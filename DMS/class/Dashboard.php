<?php
include_once("config.php");
class Dashboard
{ //atributes of the customer
	public $user_role_id;
    public $db;
	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}
	
    public function get_customer_count(){
        $sql = "SELECT count(*) as customer_count FROM customer";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
        return $row['customer_count']; //return only one value(customer_count)
    }

    public function get_grn_order_count(){
        $sql = "SELECT count(*) as order_count, SUM(grn_total_bill) as total_orders FROM grn WHERE grn_stt='Active'";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
        return $row;
    }

    public function get_sales_order_count(){
        $sql = "SELECT count(*) as sales_count, SUM(sales_total_bill) as total_sales FROM sales WHERE sales_stt='Active'";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
        return $row; // return full row(many values)

        // ["grn_count"=>"342","total_sales"=>242]
    }

    function get_last_6_month_order_sales(){

        //date("Y-m-d") 2023-06-25
        //date ("Y-m-d", strtotime("2023-03-20"))
        // if($_POST['frm_name']){
        //     $date1 = $_POST["date1"];
        // }
        // $date_formated = date("y-m-d",$date1); //2023-02-23

        // $given_date = "2023-03-20";
        // date ("Y-m-d", strtotime($date1." -1 month")); //2023-02-20
        
        // date("Y-m-t","2023-02-15"); output ==>2023-02-28
      

        $months_in_label = []; //["2023 june", "2023 may"]
        $order_data = []; // [0,2326]
        $sales_data = []; //[343,0]
        for ($i = 0; $i < 6; $i++) 
        {
            $date_from = date("Y-m-d 00:00:00", strtotime( date( 'Y-m-01' )." -$i months")); //date("Y-m-d 00:00:00", strtotime( date( 'Y-m-01' )." -0 months"));
            $date_to = date("Y-m-t 23:59:59", strtotime($date_from));  // y-m-t-  t->Last day of month  28,30,31

            $months_in_label[] = date("Y M", strtotime( date( 'Y-m-01' )." -$i months")); 

            $sql_order = "SELECT  SUM(grn_total_bill) as tot_orders FROM grn WHERE grn_stt='Active' 
            AND (grn_date BETWEEN '".$date_from."' AND '".$date_to."')";

            $res = $this->db->query($sql_order);
            $row = $res->fetch_array();

            $order_data[] = $row['tot_orders']?$row['tot_orders']:0;

            $sql_sales = "SELECT  SUM(sales_total_bill) as tot_sales FROM sales WHERE sales_stt='Active' 
            AND (sales_date BETWEEN '".$date_from."' AND '".$date_to."')";

            $res = $this->db->query($sql_sales);
            $row = $res->fetch_array();

            $sales_data[] = $row['tot_sales']?$row['tot_sales']:0;
        }
// date('Y-m-d') //2022-02-22
// date('Y-m-d', strtotime('Y-m-d') -2 month);

        // $arr = [];

        // $arr[] = "value1"; //0 
        // $arr[] = "value2"; //1

        // echo $arr[0]; // value1
        // echo $arr[1]; // value2

        // $arr[0] = "value1"; //0 
        // $arr[15665] = "value2"; //1

        // $arr['student_id'] = "dfsfsd" ; //print value2
        // $arr['student_marks'] = [12,34,56];

        // echo $arr['student_name'];
       
        $rtn = [];

        

        $rtn['labels'] = array_reverse(array_values($months_in_label));
        $rtn['order_data'] = array_reverse(array_values($order_data));
        $rtn['sales_data'] = array_reverse(array_values($sales_data));

        //Todays ernings 
        $today = date('Y-m-d'); //current date

        $sql_order = "SELECT  SUM(sales_total_bill) as tot_orders FROM sales WHERE sales_stt='Active' 
            AND sales_date LIKE '%".$today."%'"; //8&*&* 2023-03-53 *****(**)

        $res = $this->db->query($sql_order);
        $row = $res->fetch_array();

        $rtn['todays_ernings'] = $row['tot_orders']?$row['tot_orders']:0;

        //week ernings
        $first_day_of_week = date("Y-m-d 00:00:00", strtotime('monday this week', strtotime($today)));
        $last_day_of_week = date('Y-m-d 23:59:59', strtotime('sunday this week', strtotime($today)));

        $sql_sales = "SELECT  SUM(sales_total_bill) as tot_orders FROM sales WHERE sales_stt='Active' 
            AND (sales_date BETWEEN '".$first_day_of_week."' AND '".$last_day_of_week."')";


        $res = $this->db->query($sql_sales);
        $row = $res->fetch_array();

        $rtn['this_week_ernings'] = $row['tot_orders']?$row['tot_orders']:0;

        //previous week ernings
        $one_week_ago_from_today = date('Y-m-d', strtotime('-1 week'));
        $first_day_of_last_week = date('Y-m-d 00:00:00', strtotime('monday this week', strtotime($one_week_ago_from_today)));
        $last_day_of_last_week = date('Y-m-d 23:59:59', strtotime('sunday this week', strtotime($one_week_ago_from_today)));

        $sql_sales = "SELECT  SUM(sales_total_bill) as tot_orders FROM sales WHERE sales_stt='Active' 
            AND (sales_date BETWEEN '".$first_day_of_last_week."' AND '".$last_day_of_last_week."')";


        $res = $this->db->query($sql_sales);
        $row = $res->fetch_array();

        $rtn['last_week_ernings'] = $row['tot_orders']?$row['tot_orders']:0;

        return $rtn;
    }

//Get data for 
    function get_top_selling_items(){
        $sql = "SELECT i.pro_name, i.pro_code, SUM(sd.saleslt_qty) AS total_sold, SUM(sd.saleslt_total_bill) AS total_sold_amount
        FROM sales_list sd
        JOIN product i ON sd.saleslt_item = i.pro_id
        GROUP BY sd.saleslt_item, i.pro_name
        ORDER BY total_sold DESC
        LIMIT 5";

        $res = $this->db->query($sql);
        $numRows = $res->num_rows; // this will output the number of rows slelected in the database
        if($numRows)
        {
            $label_arr=array();
            $data_arr=array();
            $tot_sold_arr = array();
            while( $row = $res->fetch_array()){
                $label_arr[] =  $row['pro_name']. "(".$row['pro_code'].")"; // show product items on the pie chart and list below 
                $data_arr[] =  number_format($row['total_sold'],0); // No of unit sold from the product , show on the pie chart
                $tot_sold_arr[] = number_format($row['total_sold_amount'],2); // no of unit * sales amount , list the total amount
            }	
            $rtn =[]; //create $rtn array
            $rtn['labels'] = array_values($label_arr);  //and add key called "labels " 
            $rtn['data_arr'] = array_values($data_arr);
            $rtn['tot_sold_arr'] = array_values($tot_sold_arr);

            return $rtn;

            // return array("labels"=>array_values($label_arr), "data_arr"=>array_values($data_arr), "tot_sold_arr"=>array_values($tot_sold_arr));
        }
    }


    function get_last_10_invoices(){
        $sql = "SELECT * from cus_invoice WHERE cus_invoice_stt='Active' ORDER BY cus_invoice_date desc LIMIT 10";
        $res = $this->db->query($sql);
        $numRows = $res->num_rows; // this will output the number of rows slelected in the database
        if($numRows)
        {   $arrr = array();
            while( $row = $res->fetch_array()){
                $arrr[] = $row;
            }
        }
        return $arrr;
    }

    function get_last_10_staff(){
        $sql = "SELECT * from staff WHERE st_stt='Active' ORDER BY st_id desc LIMIT 10";
        $res = $this->db->query($sql);
        $numRows = $res->num_rows; // this will output the number of rows slelected in the database
        if($numRows)
        {   $arrr = array();
            while( $row = $res->fetch_array()){
                $arrr[] = $row;
            }
        }
        return $arrr;
    }
	
}
