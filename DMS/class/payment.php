<?php
include_once("config.php");

class payment
{
	public $pay_id;
	public $cash;
	public $cheque_amount;
	public $cheque_no;
	public $cheque_date;
	public $cheque_bank;
	public $paid_amount;
	public $paid_date;
	public $pay_stt;
	public $fk_sales_id;
	public $fk_saleslt_id;
	public $fk_cus_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO payment(cash,cheque_amount,cheque_no,cheque_date,cheque_bank,paid_amount,paid_date,fk_sales_id) values('$this->cash','$this->cheque_amount','$this->cheque_no','$this->cheque_date','$this->cheque_bank','$this->paid_amount','$this->paid_date','$this->fk_sales_id')";
		echo ($sql);
		
		$this->db->query($sql);
		
		
	}

	public function del($id)
	{
		$sql = "UPDATE payment SET pay_stt='delete' WHERE pay_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{
		$sql = "SELECT * from payment WHERE fk_saleslt_id=$id";
		$res = $this->db->query($sql);
		$all = array();
		while ($row = $res->fetch_array()) {
			$all[] = $row;
		}
		return $all;
	}

	public function get_all_customer_due_payment()
	{
		
	}

	// public function get_all()
	// {

	// 	$sql = "SELECT * FROM payment WHERE pay_stt='Active' 
	// 	-- GROUP BY(fk_sales_id) ";
	// 	$res = $this->db->query($sql);
	// 	$a = array();
	// 	while ($row = $res->fetch_array()) {
	// 		$a[] =  $row;
	// 	}
	// 	return $a;
	// }	

	public function get_all()
	{
		$sql="SELECT payment.pay_id,cash,cheque_amount,cheque_no,cheque_date,cheque_bank,paid_date,
			paid_amount,fk_sales_id,(sales_total_bill- (paid_amount)) AS credit, customer.cus_name
			FROM payment
			LEFT JOIN sales
			ON payment.fk_sales_id = sales.sales_id
			LEFT JOIN customer
			ON sales.fk_cus_id = customer.cus_id 
			WHERE paid_amount > 0";

			$res = $this->db->query($sql);
			$a = array();
			while($row = $res->fetch_array()){
				$a[] = $row;
			}
			return $a;
	}

	public function get_payment_by_sales_id ()
	{
		$sql="SELECT  SUM(cash)cash,SUM(cheque_amount)cheque_amount,SUM(paid_amount) AS paid_amount ,fk_sales_id,(sales_total_bill - sum(paid_amount)) as credit,
		sales.sales_total_bill,customer.cus_name
	   FROM sales
	   LEFT JOIN payment
	   ON sales.sales_id=payment.fk_sales_id
	   LEFT JOIN customer
	   ON sales.fk_cus_id=customer.cus_id
	   GROUP BY (sales.sales_id)";
			 $res = $this->db->query($sql);
			 $a = array ();
			 while ($row = $res->fetch_array()){
				$a [] = $row; 
			 }
			 return $a;
	}

	// "SELECT SUM(cash) cash,SUM(cheque_amount) cheque_amount,payment.paid_amount,fk_sales_id(sales_total_bill - sum(paid_amount)) as credit,
	// 		 sales.sales_total_bill,customer.cus_name
	// 		FROM sales
	// 		LEFT JOIN payment
	// 		ON sales.sales_id=payment.fk_sales_id
	// 		LEFT JOIN customer
	// 		ON sales.fk_cus_id=customer.cus_id
	// 		GROUP BY (sales.sales_id)

	public function customers_list_with_due()
	 {
		$sql="SELECT  SUM(cash)cash,SUM(cheque_amount)cheque_amount,SUM(paid_amount) AS paid_amount ,fk_sales_id,(sales_total_bill - sum(paid_amount)) as credit,
		sales.sales_total_bill,customer.cus_name
	   FROM sales
	   LEFT JOIN payment
	   ON sales.sales_id=payment.fk_sales_id
	   LEFT JOIN customer
	   ON sales.fk_cus_id=customer.cus_id
	   GROUP BY (customer.cus_id)";
			 $res = $this->db->query($sql);
			 $a = array ();
			 while ($row = $res->fetch_array()){
				$a [] = $row; 
			 }
			 return $a;
	}
}
?>
