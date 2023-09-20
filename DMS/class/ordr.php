<?php
include_once("config.php");

class ordr
{
	public $order_id;
	public $order_date;
	public $order_refno;
	public $order_note;
	public $order_stt;
	public $fk_mac_id;
	public $orderlt_id;
	public $orderlt_qty;
	public $orderlt_descrip;
	public $orderlt_stt;
	public $fk_pro_id;
	public $fk_order_id;


	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		if (isset($_POST["order_id"])) {
			$sql = "update ordr set order_date='$this->order_date',order_refno='$this->order_refno',order_note='$this->order_note' where order_id=" . $_POST["order_id"];
			echo ($sql);

			$this->db->query($sql);
			return true;
		}

		$sql1 = "insert into ordr(order_date,order_refno,order_note,fk_mac_id) values('$this->order_date','$this->order_refno','$this->order_note','$this->fk_mac_id');";
		$this->db->query($sql1);


		$count = 0;
		$oid = $this->db->insert_id;

		foreach ($_POST["pro_name"] as $item) {
			$p = $_POST["pro_name"][$count];
			$q = $_POST["orderqty"][$count];
			$r = $_POST["orderdescrip"][$count];

			$sql = "insert into order_list (fk_pro_id,orderlt_qty,orderlt_descrip,fk_order_id) values('$p',$q,'$r',$oid)";



			$this->db->query($sql);
			$count++;
		}
		return true;
	}

	public function del($id)
	{
		$sql = "delete from ordr where order_id=$id";
		$this->db->query($sql);
	}
	public function del_orderlt($id)
	{
		$sql = "update order_list set orderlt_stt='delete' where orderlt_id=$id";
		$this->db->query($sql);
	}
	/*public function del($id){
			$sql = "update ordr set order_stt='delete' where order_id=$id"  ;
			$this->db->query($sql);
		}*/

	public function get_by_id($id)
	{
		$sql = "select * from ordr where order_id=$id";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
		return $row;
	}

	// public function get_by_id_view($id){
	// 	$sql = "select * from grn_list where fk_grn_id=$id";
	// 	$res = $this->db->query($sql);
	// 	$all=array();
	// 	while($row = $res->fetch_array()){
	// 		$all[] = $row;
	// 	}
	// 	return $all;
	// }

	public function get_item_by_order_id($id)
	{
		$sql = "SELECT order_list.orderlt_qty,orderlt_descrip,fk_pro_id, product.pro_name
		FROM order_list
		LEFT JOIN product
		ON order_list.fk_pro_id=product.pro_id
		where fk_order_id=$id";
		$res = $this->db->query($sql);
		$all=array();
		while($row = $res->fetch_array()){
			$all[] = $row;
		}
		return $all;
	}
// select * from order_list where fk_order_id=$id

	public function get_all()
	{

		$sql = "select * from ordr where order_stt='Active'";
		echo $sql;

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
	}

	public function get_all_orderlt()
	{

		$sql = "select * from order_list where orderlt_stt='Active'";
		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		return $a;
	}
	// public function get_supplier_order_by_id($id)
	// {
	// 	$sql = "SELECT manufacture.mac_name, ordr.order_id,order_date, order_list.orderlt_item_id,orderlt_qty
	// 			From ordr
	// 			LEFT JOIN order_list
	// 			ON order_list.fk_order_id = ordr.order_id
	// 			LEFT JOIN manufacture
	// 			ON ordr.fk_mac_id= manufacture.mac_id
	// 			WHERE fk_order_id=$id";
	// 	echo ($sql);

	// 	$res = $this->db->query($sql);
	// 	$ordr = array();
	// 	while ($row = $res->fetch_array()) {
	// 		$ordr[] = $row;
	// 	}
	// 	return $ordr;
	// }

	public function get_all_orders (){
		$sql="SELECT manufacture.mac_name, ordr.order_id,order_date,order_refno,order_note
				From ordr
				LEFT JOIN manufacture
				ON ordr.fk_mac_id= manufacture.mac_id";

			$res = $this->db->query($sql);
			$ordr = array();
			while ($row = $res->fetch_array()) {
			$ordr[] = $row;
		}

	}
	public function get_all_supplier ()
	{
		$sql = "SELECT manufacture.mac_name, ordr.order_id,order_date,order_refno,order_note, order_list.fk_pro_id,orderlt_qty,product.pro_name
				From ordr
				LEFT JOIN order_list
				ON order_list.fk_order_id = ordr.order_id
				LEFT JOIN manufacture
				ON ordr.fk_mac_id= manufacture.mac_id
				LEFT JOIN product
				ON order_list.fk_pro_id=product.pro_id";
				// WHERE fk_order_id=$id
		echo ($sql);

		$res = $this->db->query($sql);
		$ordr = array();
		while ($row = $res->fetch_array()) {
			$ordr[] = $row;
		}
		return $ordr;
		
	}
	//Get all supplier orders
	public function geta_all_supplier_orders(){
		$sql="SELECT manufacture.mac_name, ordr.order_id,order_date,order_refno,order_note
				From ordr				
				LEFT JOIN manufacture
				ON ordr.fk_mac_id= manufacture.mac_id";
				echo ($sql);

				$res = $this->db->query($sql);
				$ordr = array();
				while ($row = $res->fetch_array()) {
					$ordr[] = $row;
				}
				return $ordr;
	}

	// public function get_supplier_items_of_supOrder_id($order_id){
	// 	$sql="SELECT product.pro_name, order_list.*
	// 	FROM order_list
	// 	LEFT JOIN product
	// 	ON product.pro_id = order_list.fk_pro_id
	// 	WHERE fk_order_id=$order_id";

	// 	$res= $this->db->query($sql);

	// 	$supplier= array();
	// 	while($row= $res->fetch_assoc()){
	// 		$supplier[] = $row;
	// 	}
	// 	return $supplier;
	// }

}
