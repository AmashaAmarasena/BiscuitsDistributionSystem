<?php
include_once("config.php");

class sales
{
	public $sales_id;
	public $sales_date;
	public $sales_refno;
	public $sales_note;
	public $sales_total_bill;
	public $sales_stt;
	public $fk_cus_id;
	public $fk_veh_id;
	public $fk_cus_returns_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO sales(sales_date,sales_refno,sales_note,sales_total_bill,fk_cus_id) values('$this->sales_date','$this->sales_refno','$this->sales_note','$this->sales_total_bill','$this->fk_cus_id')";
		 $this->db->query($sql);
		// echo $sql;
		$oid =$this->db->insert_id; //sales_id


		$sql2 = "INSERT INTO cus_invoice(cus_invoice_date,cus_invoice_refno,cus_invoice_note,cus_invoice_total_amount,cus_invoice_type,fk_cus_returns_id,fk_sales_id) values('$this->sales_date','$this->sales_refno','$this->sales_note','$this->sales_total_bill','Sale','$this->fk_cus_returns_id','$oid')";
		$this->db->query($sql2);
		 $sql2;

		
		$count = 0;
		
		foreach ($_POST["pro_code"] as $item) {
			$pro_code = $_POST["pro_code"][$count];
			$qty = $_POST["saleslt_qty"][$count];
			// $c = $_POST["saleslt_descrip"][$count];
			// $d = $_POST["saleslt_purchase_price"][$count];
			$issue_price = $_POST["saleslt_issue_price"][$count];
			$free = $_POST["saleslt_free"][$count];
			$discount = $_POST["saleslt_discount"][$count];
			$total_bill = $_POST["saleslt_total_bill"][$count];

			 

			// $i = $_POST["cash"][$count];
			// $j = $_POST["cheque_amount"][$count];
			// $k = $_POST["cheque_no"][$count];
			// $l = $_POST["cheque_date"][$count];
			// $m = $_POST["cheque_bank"][$count];
			// $n = $_POST["credit"][$count];
			// $o = $_POST["paid_amount"][$count];

			//$h=$_POST["fk_sales_id"][$count];
			$sql3 = "INSERT INTO sales_list (saleslt_item,saleslt_qty,saleslt_issue_price,saleslt_free,saleslt_discount,saleslt_total_bill,
			fk_sales_id) 
			values('$pro_code','$qty','$issue_price','$free','$discount','$total_bill',$oid)";
			// echo $sql3;
			$this->db->query($sql3);
				
			// $sql3 = "INSERT INTO payment (cash,cheque_amount,cheque_no,cheque_date,cheque_bank,credit,paid_amount,fk_sales_id,fk_cus_id) values('$i','$j','$k','$l','$m','$n','$o','$oid,'$this->fk_cus_id')";
			// echo $sql3;
			// $this->db->query($sql3);

			
			$sql4="INSERT INTO stock (fk_pro_id,stock_out,fk_veh_id) values('$pro_code','$qty',$this->fk_veh_id)";
				// echo $sql4;
				
				$this->db->query($sql4);
				
			$count++;

		}
		return $oid;
	}

	public function del($id)
	{
		$sql = "UPDATE sales SET sales_stt='delete' WHERE sales_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{
		$sql = "SELECT * FROM sales WHERE sales_id=$id";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
		return $row;
	}

	public function get_by_id_total($id)
	{
		$sql = "SELECT sales.sales_id,sales_total_bill, sum(payment.paid_amount) as paid_amount ,(Sales_total_bill - sum(paid_amount)) as balance
			FROM payment
			LEFT JOIN sales
			ON payment.fk_sales_id= sales.sales_id WHERE sales_id=$id
			GROUP BY (sales.sales_id)";
			// echo ($sql);
			
			
		$res = $this->db->query($sql);
		$tot = array();
		while ($row = $res->fetch_array()) {
			$tot[] = $row;
		}
		return $tot;
	}

	public function get_all()
	{

		$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_GET['cus_name'])){
			if($_GET['cus_name'] != -1){
				$wh .= " and customer.cus_id = ".$_GET['cus_name'];
			}
			
			if($_GET['start_date'] != ""){
				$wh .= " and date(sales.sales_date) >= '".$_GET['start_date']."'";
			}
			 if($_GET['end_date'] != ""){
			 	$wh .= " and date(sales.sales_date) <= '".$_GET['end_date']."'";
			 }
			 if($_GET['paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}
			if(isset($_GET['amount_from']) && $_GET['amount_from']!='' ){
				$amnt = $_GET['amount_from'];
				$wh.=" and paid_amount > '$amnt'";
			}

			if(isset($_GET['active_status']) && $_GET['active_status']!='all' ){
				$status = $_GET['active_status'];
				$wh.=" and paid_amount = '$status'";
			}

		}

 		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount, 
		 	(sales_total_bill - sum( paid_amount))as credit, store.store_name,sum(paid_amount) as pSum 
 			From sales
 		 	LEFT JOIN payment
 		 	ON payment.fk_sales_id= sales.sales_id
 		 	LEFT JOIN customer
 		 	ON sales.fk_cus_id = customer.cus_id
		 	LEFT JOIN store
		 	ON store.fk_cus_id = customer.cus_id 
			LEFT JOIN cus_invoice
			ON sales.sales_id = cus_invoice.fk_sales_id
		 	where $wh
		 	GROUP BY (sales.sales_id) $hv";

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		//print_r($a);
		return $a;
	}

	public function get_sales_details()
	{

		$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_GET['cus_name'])){
			if($_GET['cus_name'] != -1){
				$wh .= " and customer.cus_id = ".$_GET['cus_name'];
			}
			
			if($_GET['start_date'] != ""){
				$wh .= " and date(sales.sales_date) >= '".$_GET['start_date']."'";
			}
			 if($_GET['end_date'] != ""){
			 	$wh .= " and date(sales.sales_date) <= '".$_GET['end_date']."'";
			 }
			 if($_GET['paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}
				// if(isset($_GET['amount_from']) && $_GET['amount_from']!='' ){
				// 	$amnt = $_GET['amount_from'];
				// 	$wh.=" and paid_amount > '$amnt'";
				// }
				// if(isset($_GET['invoice_id']) && $_GET['invoice_id']!='' ){
				// 	$inv_id = $_GET['invoice_id'];
				// 	$wh.=" and ionv_id = '$inv_id'";
				// }

			if(isset($_GET['active_status']) && $_GET['active_status']!='all' ){
				$status = $_GET['active_status'];
				$wh.=" and paid_amount = '$status'";
			}

		}

 		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount, 
		 	(sales_total_bill - sum( paid_amount))as credit, store.store_name,sum(paid_amount) as pSum 
 			From sales
 		 	LEFT JOIN payment
 		 	ON payment.fk_sales_id= sales.sales_id
 		 	LEFT JOIN customer
 		 	ON sales.fk_cus_id = customer.cus_id
		 	LEFT JOIN store
		 	ON store.fk_cus_id = customer.cus_id 
		 	where $wh
		 	GROUP BY (sales.sales_id) $hv";

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		//print_r($a);
		return $a;
	}


	public function get_cus_due_list()
	{

		$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_GET['cus_name'])){
			if($_GET['cus_name'] != -1){
				$wh .= " and customer.cus_id = ".$_GET['cus_name'];
			}
			
			if($_GET['start_date'] != ""){
				$wh .= " and date(sales.sales_date) >= '".$_GET['start_date']."'";
			}
			 if($_GET['end_date'] != ""){
			 	$wh .= " and date(sales.sales_date) <= '".$_GET['end_date']."'";
			 }
			 if($_GET['paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}
			if(isset($_GET['amount_from']) && $_GET['amount_from']!='' ){
				$amnt = $_GET['amount_from'];
				$wh.=" and paid_amount > '$amnt'";
			}

			if(isset($_GET['active_status']) && $_GET['active_status']!='all' ){
				$status = $_GET['active_status'];
				$wh.=" and paid_amount = '$status'";
			}

		}

 		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount, 
		 	(sales_total_bill - sum( paid_amount))as credit, store.store_name,sum(paid_amount) as pSum 
 			From sales
 		 	LEFT JOIN payment
 		 	ON payment.fk_sales_id= sales.sales_id
 		 	LEFT JOIN customer
 		 	ON sales.fk_cus_id = customer.cus_id
		 	LEFT JOIN store
		 	ON store.fk_cus_id = customer.cus_id 
			LEFT JOIN cus_invoice
			ON sales.sales_id = cus_invoice.fk_sales_id
		 	GROUP BY (sales.sales_id) 
			HAVING (sales_total_bill - sum( paid_amount)) > 0 ";

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		//print_r($a);
		return $a;
	}


		// $sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount
		//  ifnull(sum(payment.paid_amount),0) as pSum , SUM(sales_total_bill - sum( paid_amount))as credit, store.store_name
 		//  	From sales
 		//  	LEFT JOIN payment
 		//  	ON payment.fk_sales_id= sales.sales_id
 		// 	LEFT JOIN customer
 		// 	ON sales.fk_cus_id = customer.cus_id
		//  	LEFT JOIN store
		// 	ON store.fk_cus_id = customer.cus_id 
		//  	where $wh
		// 	GROUP BY (sales.sales_id) $hv";


	
	
		// $sql = " SELECT * FROM sales 
		// JOIN customer ON sales.fk_cus_id=customer.cus_id WHERE sales_stt='Active'"; 
// 
		// echo $sql;

		


		// $sql1 = "SELECT payment.fk_saleslt_total_bill,paid_amount,credit,fk_cus_id
		// FROM payment
		// LEFT JOIN sales
		// ON payment.fk_cus_id = sales.fk_cus_id "; 


		// $res = $this->db->query($sql1);
		// $a=array();
		// while( $row = $res->fetch_array()){
		// 	$a[] =  $row;
		// }	
		// return $a;

			
	

	//(use for sales invoice)
	public function get_view_by_sales_id($id)
	{
		$sql = "SELECT sales.sales_date,sales_note,sales_total_bill,sales_id , customer.cus_name,cus_address,cus_phone,cus_email,payment.paid_amount,(sales_total_bill - paid_amount) AS credit, store.store_name,sum(paid_amount) as pSum
 			From payment
 			LEFT JOIN sales
 			ON payment.fk_sales_id= sales.sales_id
 			LEFT JOIN customer
 			ON sales.fk_cus_id = customer.cus_id
			LEFT JOIN store
			ON store.fk_cus_id = customer.cus_id 
			WHERE sales_id=$id
			GROUP BY (sales.sales_id)";

			// echo ($sql);
			
			$res = $this->db->query($sql);
			$sales = array();
			while ($row = $res->fetch_array()) {
				$sales[] = $row;
			}
			return $sales;
		}

}