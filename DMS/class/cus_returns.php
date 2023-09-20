<?php
include_once("config.php");

class cus_returns
{
	public $cus_returns_id;
	public $cus_returns_date;
	public $cus_returns_refno;
	public $cus_returns_note;
	public $cus_returns_total_bill;
	public $cus_returns_stt;
	public $fk_cus_id;
	public $fk_veh_id;
	public $fk_pro_id;
	public $fk_sales_id;
	public $fk_cus_returns_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO cus_returns(cus_returns_date,cus_returns_note,cus_returns_total_bill,fk_cus_id,fk_sales_id) values('$this->cus_returns_date','$this->cus_returns_note','$this->cus_returns_total_bill','$this->fk_cus_id','$this->fk_sales_id')";
		$this->db->query($sql);
		 echo $sql;
		 $oid = $this->db->insert_id;
		

		//$sql2 = "INSERT INTO cus_invoice(cus_invoice_date,cus_invoice_refno,cus_invoice_note,cus_invoice_total_amount,cus_invoice_type,fk_cus_returns_id,fk_sales_id) values('$this->cus_returns_date','$this->cus_returns_refno','$this->cus_returns_note','$this->cus_returns_total_bill','Return','$this->fk_cus_returns_id','$this->fk_sales_id')";
		//$this->db->query($sql2);
		//echo $sql2;
		//$oid = $this->db->insert_id;


		foreach ($_POST["product_id"] as $key=> $item) {
			if($_POST['return_qty'][$key]!=0){
				$fk_cus_returns_id = $oid;
				$cus_returnslt_qty = $_POST['return_qty'][$key];
				$cus_returnslt_issue_price = $_POST['issued_price'][$key];
				$cus_returnslt_item_amount = $_POST['issued_amount'][$key];
				$fk_pro_id = $_POST['product_id'][$key];

				$sql3 = "INSERT INTO cus_returns_list(cus_returnslt_qty,cus_returnslt_issue_price,cus_returnslt_item_amount,
				fk_cus_returns_id,fk_pro_id) 
				values('$cus_returnslt_qty','$cus_returnslt_issue_price','$cus_returnslt_item_amount',$fk_cus_returns_id,$fk_pro_id)";
				$this->db->query($sql3);
				echo $sql3;
				
				$sq3 = "INSERT INTO payment(cash,paid_amount,paid_date,fk_sales_id) values('$this->cus_returns_total_bill','$this->cus_returns_total_bill','$this->cus_returns_date','$this->fk_sales_id')";
				echo ($sq3);
				
				$this->db->query($sq3);

				$sql4="INSERT INTO stock(fk_pro_id,stock_in,fk_cus_return_id) values('$fk_pro_id','$cus_returnslt_qty','$fk_cus_returns_id')";
				$this->db->query($sql4);
				echo $sql4;
				

				// $sql4="INSERT INTO payment()";
			}

			// $a = $_POST["pro_code"][$count];product_id
			// $b = $_POST["cus_returnslt_qty"][$count];
			// // $c = $_POST["saleslt_descrip"][$count];
			// // $d = $_POST["saleslt_purchase_price"][$count];
			// $c = $_POST["cus_returnslt_issue_price"][$count];
			// $d = $_POST["cus_returnslt_item_amount"][$count];



			// $i = $_POST["cash"][$count];
			// $j = $_POST["cheque_amount"][$count];
			// $k = $_POST["cheque_no"][$count];
			// $l = $_POST["cheque_date"][$count];
			// $m = $_POST["cheque_bank"][$count];
			// $n = $_POST["credit"][$count];
			// $o = $_POST["paid_amount"][$count];

			//$h=$_POST["fk_sales_id"][$count];
			// $sql2 = "INSERT INTO cus_returns_list(	cus_returnslt_qty,cus_returnslt_issue_price,cus_returnslt_item_amount,
			// fk_cus_returns_id,fk_pro_id) 
			// values('$b','$c','$d',$oid,'$a')";
			// // echo $sql2;
			// $this->db->query($sql2);

			// $sql3 = "INSERT INTO payment (cash,cheque_amount,cheque_no,cheque_date,cheque_bank,credit,paid_amount,fk_sales_id,fk_cus_id) values('$i','$j','$k','$l','$m','$n','$o','$oid,'$this->fk_cus_id')";
			// echo $sql3;
			// $this->db->query($sql3);

			// $sql3="insert into stock (fk_pro_id,stock_in,fk_veh_id) values('$a',$b,$this->fk_veh_id)";
			// 	echo $sql3;
		// 	$this->db->query($sql3);

		}
		return $oid;
	}

	public function del($id)
	{
		$sql = "UPDATE cus_returns SET sales_stt='delete' WHERE sales_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{
		$sql = "SELECT * FROM sales WHERE sales_id=$id";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
		return $row;
	}

	public function get_sales_id_by_customer_id($customer_id)
	{
		$sql = "SELECT sales_id FROM sales WHERE fk_cus_id=$customer_id";
		$res = $this->db->query($sql);

		$sales = array();
		while ($row = $res->fetch_assoc()) {
			$sales[] = $row;
		}
		return $sales;
	}

	public function get_item_list_of_sales_id($sales_id)
	{
		$sql = "SELECT product.pro_name, sales_list.*
		FROM sales_list
		LEFT JOIN product 
		ON product.pro_id	= sales_list.saleslt_item
		where fk_sales_id=$sales_id";

		$res = $this->db->query($sql);

		$sales = array();
		while ($row = $res->fetch_assoc()) {
			$sales[] = $row;
		}
		return $sales;
	}

}
?>