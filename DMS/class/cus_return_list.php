<?php
include_once("config.php");

class cus_returns_list
{
	public $cus_returnslt_id;
	// public $saleslt_item;
	public $cus_returnslt_qty;
	public $cus_returnslt_issue_price;
	public $cus_returnslt_item_amount;
	public $cus_returnslt_stt;
	public $fk_pro_id;
	public $fk_cus_returns_id;
	
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
		$sql = "UPDATE cus_returns_list SET cus_returnslt_stt='delete' WHERE cus_returnslt_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
{
		$sql = "SELECT * FROM cus_returns_list WHERE fk_cus_returns_id=$id";
		$res = $this->db->query($sql);
		$all = array();
		while ($row = $res->fetch_array()) {
			$all[] = $row;
		}
		return $all;
	}

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

		$sql = "SELECT * FROM cus_return_list WHERE cus_returnslt_id='Active'";
		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
	}
}
