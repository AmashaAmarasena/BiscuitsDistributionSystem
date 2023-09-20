<?php
include_once("config.php");

class sales_list
{
	public $saleslt_id;
	public $saleslt_item;
	public $saleslt_qty;
	// public $saleslt_descrip;
	// public $saleslt_purchase_price;
	public $saleslt_issue_price;
	public $saleslt_free;
	public $saleslt_discount;
	public $saleslt_total_bill;
	public $saleslt_stt;
	public $fk_pro_id;
	public $fk_sales_id;
	// public $saleslt_cash;
	// public $saleslt_cheque_no;
	// public $saleslt_cheque_date;
	// public $saleslt_cheque_bank;


	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
	}

	public function del($id)
	{
		$sql = "UPDATE sales_list SET saleslt_stt='delete' WHERE saleslt_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
{	
	// SELECT * FROM sales_list WHERE fk_sales_id=$id   
		$sql = "SELECT sales_list.saleslt_qty,saleslt_issue_price,saleslt_free,saleslt_discount,
	 	saleslt_total_bill,sales_list.fk_sales_id , product.pro_name , cus_returns.cus_returns_total_bill
	 	FROM sales_list
	 	LEFT JOIN product
	 	ON sales_list.saleslt_item = product.pro_id
		LEFT JOIN cus_returns
		ON sales_list.fk_sales_id = cus_returns.fk_sales_id 
		WHERE sales_list.fk_sales_id=$id";
		$res = $this->db->query($sql);
		$all = array();
		while ($row = $res->fetch_array()) {
			$all[] = $row;
			
		}
		return $all;
	}

// 	public function get_by_id($id)
// {	
// 	// SELECT * FROM sales_list WHERE fk_sales_id=$id
// 		$sql = "SELECT sales_list.saleslt_qty,saleslt_issue_price,saleslt_free,saleslt_discount,
// 	 	saleslt_total_bill,sales_list.fk_sales_id , product.pro_name , cus_returns.cus_returns_total_bill
// 	 	FROM sales_list
// 	 	LEFT JOIN product
// 	 	ON sales_list.saleslt_item=product.pro_id
// 		LEFT JOIN cus_returns
// 		ON sales_list.fk_sales_id=cus_returns.fk_sales_id
// 		WHERE sales_list.fk_sales_id=$id";
// 		$res = $this->db->query($sql);
// 		$all = array();
// 		while ($row = $res->fetch_array()) {
// 			$all[] = $row;
			
// 		}
// 		return $all;
// 	}

	

	 

	public function get_by_id_tot($id)
	{
		$sql = "SELECT sales_list.saleslt_total_bill , payment.paid_amount, payment.credit
			FROM payment
			LEFT JOIN sales_list
			ON payment.fk_saleslt_id= sales_list.saleslt_id";
		$res = $this->db->query($sql);
		$all = array();
		while ($row = $res->fetch_array()) {
			$all[] = $row;
		}
		return $all;
	}


	public function get_all()
	{

		$sql = "SELECT * FROM sales_list WHERE saleslt_stt='Active'";
		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
	}
}
