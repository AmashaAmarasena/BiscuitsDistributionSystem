<?php
include_once("config.php");
class customer
{ //atributes of the customer
	public $cus_id;
	public $cus_name;
	public $cus_phone;
	public $cus_email;
	public $cus_address;
	public $cus_stt;
	public $cus_regdate;
	public $fk_store_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}
	//save a customer
	public function save()
	{
		if (isset($_POST["cus_id"])) {
			$sql = "UPDATE customer SET cus_name='$this->cus_name',cus_phone='$this->cus_phone',cus_email='$this->cus_email',cus_address='$this->cus_address',cus_regdate='$this->cus_regdate' WHERE cus_id=" . $_POST["cus_id"];
			// echo ($sql);

			$this->db->query($sql);

			// 	$sql = "update store set store_stt='delete' where store_id=$id"  ;

			// $this->db->query($sql);
			return true;
		} else {
			$sql = "INSERT INTO customer(cus_name,cus_phone,cus_email,cus_address,cus_regdate) values('$this->cus_name','$this->cus_phone','$this->cus_email','$this->cus_address','$this->cus_regdate' )";
			$this->db->query($sql);
		}

		$count = 0;
		$oid = $this->db->insert_id;

		foreach ($_POST["pro_code"] as $item) {
			$a = $_POST["pro_code"][$count];
			$b = $_POST["saleslt_qty"][$count];
			$c = $_POST["saleslt_descrip"][$count];
			$d = $_POST["saleslt_purchase_price"][$count];
			$e = $_POST["saleslt_issue_price"][$count];
			$f = $_POST["saleslt_free"][$count];
			$g = $_POST["saleslt_discount"][$count];
			$h = $_POST["saleslt_total_bill"][$count];

			$i = $_POST["cash"][$count];
			$j = $_POST["cheque_amount"][$count];
			$k = $_POST["cheque_no"][$count];
			$l = $_POST["cheque_date"][$count];
			$m = $_POST["cheque_bank"][$count];
			$n = $_POST["credit"][$count];
			$o = $_POST["paid_amount"][$count];

			//$h=$_POST["fk_sales_id"][$count];
			$sql2 = "INSERT INTO sales_list (saleslt_item,saleslt_qty,saleslt_descrip,saleslt_purchase_price,
				saleslt_issue_price,saleslt_free,saleslt_discount,saleslt_total_bill,fk_sales_id) values('$a','$b','$c','$d','$e','$f','$g','$h',$oid)";
			// echo $sql2;
			$this->db->query($sql2);
			$count++;

			$sql3 = "INSERT INTO payment (cash,cheque_amount,cheque_no,cheque_date,cheque_bank,credit,paid_amount,fk_sales_id,fk_saleslt_total_bill) values('$i','$j','$k','$l','$m','$n','$o',$oid,$h)";
			// echo $sql3;
			$this->db->query($sql3);
			$count++;

			//payment details

		}
	}
	//delete a customer 
	public function del($id)
	{
		$sql = "UPDATE customer SET cus_stt='delete' WHERE cus_id=$id";
		$this->db->query($sql);
	}
	//get customer by customer's id
	public function get_by_id($id)
	{
		$sql = "SELECT * FROM customer WHERE cus_id=$id";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
		return $row;
	}
	//get all customers
	public function get_all()
	{
		$sql = "SELECT * FROM customer WHERE cus_stt='Active'";
		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
	}
	public function get_customer_by_sales_id($id)
	{
		$sql = "SELECT * FROM customer 
		LEFT JOIN sales 
		ON sales.fk_cus_id = customer.cus_id 
		WHERE sales_id = $id";
		$res = $this->db->query($sql);
		//  $row = $res->fetch_array();
		// return $row;
		$customer = array();
		while ($row = $res->fetch_array()) {
			$customer[] =  $row;
		}
		return $customer;
	}

	public function get_customer_payment_by_id($id)
	{
			$sql = "SELECT customer.cus_name, sales.sales_id,store.store_name, payment.pay_id,cash,cheque_amount
			,cheque_no,cheque_date,cheque_bank,credit,paid_amount
				From payment
				LEFT JOIN sales
				ON payment.fk_sales_id= sales.sales_id
				LEFT JOIN customer
				ON sales.fk_cus_id = customer.cus_id
				LEFT JOIN store
				ON store.fk_cus_id = customer.cus_id 
				 WHERE pay_id=$id";
		echo ($sql);

		$res = $this->db->query($sql);
		$sales = array();
		while ($row = $res->fetch_array()) {
			$sales[] = $row;
		}
		return $sales;
	}

	public function get_all_customer_payment()
	// {
	// 		$sql = "SELECT customer.cus_name, sales.sales_id,sales_total_bill,store.store_name, payment.pay_id,cash,cheque_amount,cheque_no,cheque_date,cheque_bank,SUM(sales_total_bill - paid_amount)as credit,paid_amount
	// 			From payment
	// 			LEFT JOIN sales
	// 			ON payment.fk_sales_id= sales.sales_id
	// 			LEFT JOIN customer
	// 			ON sales.fk_cus_id = customer.cus_id
	// 			LEFT JOIN store
	// 			ON store.fk_cus_id = customer.cus_id ";
	// 			// WHERE pay_id=$id";
	// 	echo ($sql);

	// 	$res = $this->db->query($sql);
	// 	$sales = array();
	// 	while ($row = $res->fetch_array()) {
	// 		$sales[] = $row;
	// 	}
	// 	return $sales;
 {

	$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_POST['cus_name'])){
			if($_POST['cus_name'] != -1){
				$wh .= " and customer.cus_id = ".$_POST['cus_name'];
			}
			
			if($_POST['start_date'] != ""){
				$wh .= " and date(sales.sales_date) >= '".$_POST['start_date']."'";
			}
			 if($_POST['end_date'] != ""){
			 	$wh .= " and date(sales.sales_date) <= '".$_POST['end_date']."'";
			 }
			 if($_POST['paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}

		}


		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount,cash,cheque_amount,cheque_no,cheque_date,cheque_bank,pay_id,
		(sales_total_bill - sum( paid_amount))as credit, store.store_name,sum(paid_amount) as pSum 
 			From sales
 			LEFT JOIN payment
 			ON payment.fk_sales_id= sales.sales_id
 			LEFT JOIN customer
 			ON sales.fk_cus_id = customer.cus_id
			LEFT JOIN store
			ON store.fk_cus_id = customer.cus_id 
			where $wh
			GROUP BY (customer.cus_id) $hv";
	
		// $sql = " SELECT * FROM sales 
		// JOIN customer ON sales.fk_cus_id=customer.cus_id WHERE sales_stt='Active'"; 
// 
		// echo $sql;

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		//print_r($a);
		return $a;
	}
}
