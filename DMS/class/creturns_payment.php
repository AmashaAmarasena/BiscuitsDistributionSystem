<?php
include_once("config.php");

class creturns_payment
{
	public $creturns_pay_id ;
	public $creturns_pay_cash;
	public $creturns_pay_cheque_amnt;
	public $creturns_pay_cheque_no;
	public $creturns_pay_date;
	public $creturns_pay_cheque_bank;
	public $creturns_pay_credit;
	public $creturns_pay_paid_amount;
	public $creturns_pay_stt;
	public $fk_cus_returns_id;
    public $cus_returnslt_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO creturns_payment(creturns_pay_cash,creturns_pay_cheque_amnt,creturns_pay_cheque_no,creturns_pay_date,creturns_pay_cheque_bank,creturns_pay_credit,creturns_pay_paid_amount,fk_cus_returns_id) values('$this->creturns_pay_cash','$this->creturns_pay_cheque_amnt','$this->creturns_pay_cheque_no','$this->creturns_pay_date','$this->creturns_pay_cheque_bank','$this->creturns_pay_credit','$this->creturns_pay_paid_amount','$this->fk_cus_returns_id')";
		echo ($sql);
		
		$this->db->query($sql);
		
		
	}

	public function del($id)
	{
		$sql = "UPDATE creturns_payment SET creturns_pay_stt='delete' WHERE creturns_pay_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{
		$sql = "SELECT * from creturns_payment WHERE cus_returnslt_id=$id";
		$res = $this->db->query($sql);
		$all = array();
		while ($row = $res->fetch_array()) {
			$all[] = $row;
		}
		return $all;
	}

	public function get_all()
	{

		$sql = "SELECT * FROM creturns_payment WHERE creturns_pay_stt='Active' 
		-- GROUP BY(fk_sales_id) ";
		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
	}
}

