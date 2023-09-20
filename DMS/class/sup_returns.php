<?php
include_once("config.php");

class sup_returns
{
	public $sup_returns_id;
	public $sup_returns_date;
	public $sup_returns_refno;
	public $sup_returns_note;
	public $sup_returns_total_bill;
	public $sup_returns_stt;
	public $fk_sup_id;
	public $fk_veh_id;
	public $fk_pro_id;
	public $fk_grn_id;
	public $fk_sup_returns_id;
	public $fk_mac_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO sup_returns(sup_returns_date,sup_returns_note,sup_returns_total_bill,fk_sup_id,fk_grn_id) values('$this->sup_returns_date','$this->sup_returns_note','$this->sup_returns_total_bill','$this->fk_sup_id','$this->fk_grn_id')";
		$this->db->query($sql);
		echo $sql;
		//  exit;

		$sql2 = "INSERT INTO sup_invoice(sup_invoice_date,sup_invoice_refno,sup_invoice_note,sup_invoice_total_amount,sup_invoice_type,fk_sup_returns_id,fk_grn_id) values('$this->sup_returns_date','$this->sup_returns_refno','$this->sup_returns_note','$this->sup_returns_total_bill','Return','$this->fk_sup_returns_id','$this->fk_grn_id')";
		$this->db->query($sql2);
		// echo $sql2;
		$oid = $this->db->insert_id;

		$count = 0;
		$oid = $this->db->insert_id;

		
		foreach ($_POST["pro_code"] as $item) {
			$pro_code = $_POST["pro_code"][$count];
			$qty = $_POST["sup_returnslt_qty"][$count];
			// $c = $_POST["saleslt_descrip"][$count];
			 $purchase_price = $_POST["sup_returnslt_purchase_price"][$count];
			$item_amount = $_POST["sup_returnslt_item_amount"][$count];

			 

			// $i = $_POST["cash"][$count];
			// $j = $_POST["cheque_amount"][$count];
			// $k = $_POST["cheque_no"][$count];
			// $l = $_POST["cheque_date"][$count];
			// $m = $_POST["cheque_bank"][$count];
			// $n = $_POST["credit"][$count];
			// $o = $_POST["paid_amount"][$count];

			//$h=$_POST["fk_sales_id"][$count];
			$sql2 = "INSERT INTO sup_returns_list(	sup_returnslt_qty,sup_returnslt_purchase_price,sup_returnslt_item_amount,
			fk_sup_returns_id,fk_pro_id) 
			values('$qty',purchase_price,$item_amount,$oid,'$pro_code')";
			echo $sql2;
			$this->db->query($sql2);
				
			// $sql3 = "INSERT INTO payment (cash,cheque_amount,cheque_no,cheque_date,cheque_bank,credit,paid_amount,fk_sales_id,fk_cus_id) values('$i','$j','$k','$l','$m','$n','$o','$oid,'$this->fk_cus_id')";
			// echo $sql3;
			// $this->db->query($sql3);
			
			// $sql3="insert into stock (fk_pro_id,stock_out,fk_veh_id) values('$a',$b,$this->fk_veh_id)";
			// 	echo $sql3;
			// 	$this->db->query($sql3);
				
			$count++;

		}
		return $oid;
	}

	public function del($id)
	{
		$sql = "UPDATE sup_returns SET sup_returns_stt='delete' WHERE sup_returns_stt_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{
		$sql = "SELECT * FROM sup_returns WHERE sup_returns_id_id=$id";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
		return $row;
	}

	public function get_grn_id_by_supplier_id($sup_id){
		$sql = "SELECT grn_id FROM grn WHERE fk_mac_id = $sup_id";
		$res = $this->db->query($sql);
		
		$grn = array();
		while($row = $res->fetch_assoc()){
			$grn[] = $row;
		}
		return $grn;
	}

	public function get_item_list_of_grn_id($grn_id){
		$sql = "SELECT product.pro_name, grn_list.*
		FROM grn_list
		LEFT JOIN product 
		ON product.pro_id	= grn_list.fk_pro_id
		where fk_grn_id=$grn_id";

		$res = $this->db->query($sql);

		$sales = array();
		while ($row = $res->fetch_assoc()) {
			$sales[] = $row;
		}
		return $sales;
	}

	

}