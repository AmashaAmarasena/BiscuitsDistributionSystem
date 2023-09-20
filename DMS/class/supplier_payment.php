<?php
include_once("config.php");

class supplier_payment
{
	public $sup_pay_id;
	public $sup_cash;
	public $sup_cheque_amount;
	public $sup_cheque_no;
	public $sup_cheque_date;
	public $sup_cheque_bank;
	public $sup_credit;
	public $sup_paid_amount;
	public $sup_pay_stt;
	public $fk_grn_id;
	public $fk_grnlt_id;
	public $fk_mac_id;
			

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO supplier_payment(sup_cash,sup_cheque_amount,sup_cheque_no,sup_cheque_date,sup_cheque_bank,sup_paid_amount,fk_grn_id) values('$this->sup_cash','$this->sup_cheque_amount','$this->sup_cheque_no','$this->sup_cheque_date','$this->sup_cheque_bank','$this->sup_paid_amount','$this->fk_grn_id')";
		// echo ($sql);
		
		if($this->db->query($sql)){
			return true;
		}
		else{
			return false;
		}
		
	}

	public function del($id)
	{
		$sql = "UPDATE supplier_payment SET sup_pay_stt='delete' WHERE sup_pay_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{
		$sql = "SELECT * from suplier_payment WHERE fk_grnlt_id=$id";
		$res = $this->db->query($sql);
		$all = array();
		while ($row = $res->fetch_array()) {
			$all[] = $row;
		}
		return $all;
	}

	public function get_all()
	{

		$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_POST['mac_name'])){
			if($_POST['mac_name'] != -1){
				$wh .= " and manufacture.mac_id = ".$_POST['mac_name'];
			}
			
			if($_POST['start_date'] != ""){
				$wh .= " and date(supplier_payment.sup_cheque_date) >= '".$_POST['start_date']."'";
			}
			 if($_POST['end_date'] != ""){
			 	$wh .= " and date(supplier_payment.sup_cheque_date) <= '".$_POST['end_date']."'";
			 }
			 if($_POST['sup_paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}

		}


		$sql = "SELECT supplier_payment.sup_pay_id,sup_cash,sup_cheque_amount,sup_cheque_no,sup_cheque_date,sup_cheque_bank,sup_paid_amount,fk_grn_id,
			(grn_total_bill - sup_paid_amount) as credit,grn.grn_total_bill,manufacture.mac_name
			FROM supplier_payment
			LEFT JOIN grn
			ON supplier_payment.fk_grn_id= grn.grn_id
			LEFT JOIN 	manufacture
			ON grn.fk_mac_id=manufacture.mac_id ";
			 

				$res = $this->db->query($sql);
				$a = array();
				while ($row = $res->fetch_array()) {
					$a[] =  $row;
				}
				return $a;
				

		}

		public function get_all_by_grn_id ()
		{
			 $sql="SELECT SUM(sup_cash) sup_cash,SUM(sup_cheque_amount) sup_cheque_amount,SUM(sup_paid_amount) sup_paid_amount,fk_grn_id,
			 (grn_total_bill - sum(sup_paid_amount)) as credit, grn.grn_total_bill, manufacture.mac_name
			 FROM grn
			 LEFT JOIN supplier_payment
			ON grn.grn_id=supplier_payment.fk_grn_id	
			LEFT JOIN manufacture
			ON grn.fk_mac_id= manufacture.mac_id
			GROUP BY (grn.grn_id) ";
		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
		}

	// public function get_all_by_supplier()
	// {
	// 	$sql = "SELECT supplier_payment.sup_pay_id, sup_cash 
	// 	WHERE sup_pay_stt='Active' ";
	// 	$res = $this->db->query($sql);
	// 	$a = array();
	// 	while ($row = $res->fetch_array()) {
	// 		$a[] =  $row;
	// 	}
	// 	return $a;
	// }
	
}
?>
