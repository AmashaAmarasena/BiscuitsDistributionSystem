<?php
include_once("config.php");
	class grn_class{
	public $grn_id;
	public $grn_date;
	public $grn_refno;
	public $grn_total_bill;
	public $grn_note;
	public $grn_stt;
	public $fk_mac_id;
	public $fk_pro_id;
    public $grnlt_id;
    public $grnlt_qty;
    public $grnlt_descrip;
	public $grnlt_free_amount;
    public $grnlt_purchase_price;
    public $grnlt_ex_date;
    public $grnlt_sales_price;
	public $grnlt_item_amount;
    public $grnlt_stt;
	public $fk_veh_id;
	public $fk_order_id;
	 

	
	
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			$sql1 = "INSERT INTO grn(grn_date,grn_refno,grn_note,grn_total_bill,fk_order_id,fk_mac_id) VALUES('$this->grn_date','$this->grn_refno','$this->grn_note','$this->grn_total_bill','$this->fk_order_id','$this->fk_mac_id');";
            $this->db->query($sql1);
			 //echo($sql1);
			$gid = $this->db->insert_id;

			 $sql1 = "insert into sup_invoice(sup_invoice_date,sup_invoice_refno,sup_invoice_note,sup_invoice_total_bill,fk_grn_id) values('$this->grn_date','$this->grn_refno','$this->grn_note','$this->grn_total_bill','$gid');";
            $this->db->query($sql1);

			$count=0;
			

			// echo("oid=" . $gid);
			//exit;
			
			foreach($_POST["pro_code"] as $item )
			{
				$pro_code=$_POST["pro_code"][$count];
				$qty=$_POST["grnqty"][$count];
				// $r=$_POST["grndescrip"][$count];
				$purchase_price=$_POST["grnlt_purchase_price"][$count];
				$ex_date=$_POST["ex_date"][$count];
				$sales_price=$_POST["sales_price"][$count];
				$free_amount=$_POST["grnlt_free_items"][$count];
				$item_amount=$_POST["grnlt_item_amount"][$count];

				$sql="INSERT INTO grn_list (fk_pro_id,grnls_qty,grnls_purchase_price,grnls_ex_date,grnls_sales_price,grnls_free_amount,grnlt_item_amount,fk_grn_id) VALUES('$pro_code',$qty,$purchase_price,'$ex_date','$sales_price','$free_amount','$item_amount',$gid)";
				$this->db->query($sql);
				
				// echo $sql;
				
					
				$oid=$this->db->insert_id;// grn_list id
				$sql2="INSERT INTO stock (fk_pro_id,stock_in,fk_grn_id,fk_veh_id) VALUES('$pro_code',".($qty+$free_amount).",$gid,$this->fk_veh_id)";
				$this->db->query($sql2);

				// echo $sql2;
				$count++;
			}

			// echo "----".$gid;
				return $gid;
		}
		
		public function del($id){
			$sql = "DELETE FROM grn  WHERE grn_id=$id"  ;
			$this->db->query($sql);
		}

        /*Delete function for grn_list*/
		public function del_grnlt($id){
			$sql = "DELETE FROM grn_list  WHERE grnlt_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "SELECT * FROM grn WHERE grn_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

        /*Get by function for grn_list*/
		public function get_by_id_grnlt($id){
			$sql = "SELECT * FROM grn_list WHERE grnlt_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_GET['mac_name'])){
			if($_GET['mac_name'] != -1){
				$wh .= " and manufacture.mac_id = ".$_GET['mac_name'];
			}
			
			if($_GET['start_date'] != ""){
				$wh .= " and date(grn.grn_date) >= '".$_GET['start_date']."'";
			}
			 if($_GET['end_date'] != ""){
			 	$wh .= " and date(grn.grn_date) <= '".$_GET['end_date']."'";
			 }
			 if($_GET['paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = grn_total_bill)";
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
			
			$sql = "SELECT grn.grn_id,grn_date,grn_refno,grn_note,grn_total_bill , manufacture.mac_name , 
			ifnull(sum(supplier_payment.sup_paid_amount),0) as total_sup_paid_amount,SUM(grn_total_bill-sup_paid_amount) AS sup_credit
					FROM grn
					LEFT JOIN supplier_payment
					ON supplier_payment.fk_grn_id= grn.grn_id
					LEFT JOIN manufacture
					ON grn.fk_mac_id = manufacture.mac_id
					WHERE $wh
					GROUP BY (grn.grn_id) $hv";
					//JOIN manufacture on grn.fk_mac_id=manufacture.mac_id where grn_stt='Active'"; 
			// echo $sql;
			// exit;

			$res = $this->db->query($sql);
			$a=array();
			while( $row =$res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}

        /*Get all function for grn_list*/
		public function get_all_grnlt(){
			
			$sql = "select * from grn_list 
			JOIN product on grn_list.grnls_itmcode=product.pro_id where grnlt_stt='Active'"; 
			$res = $this->db->query($sql);
			// echo $sql;
			
			$a=array();
			while( $row = $res->fetch_array()){			
				$a[] =  $row;
			}	
			return $a;
		}

		public function get_by_id_item($id){
			$sql = "select * from grn where grn_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

        /*Get_by_id_item function for grn_list*/
		public function get_by_id_item_grnlt($id){
			$sql = "select * from grn_list where grnls_id=$id"  ;
			$res = $this->db->query($sql);
	    	$row = $res->fetch_array();
			return $row;
		}
		// 
		public function get_by_id_view($id){
			$sql= "SELECT grn_list.*, product.pro_name
			FROM grn_list
			LEFT JOIN product
			ON grn_list.fk_pro_id = product.pro_id 
			WHERE fk_grn_id=$id";
			// $sql = "select * from grn_list where fk_grn_id=$id";
			$res = $this->db->query($sql);
			$all=array();
			while($row = $res->fetch_array()){
				$all[] = $row;
			}
			return $all;
		}
		// select * from grn_list where fk_grn_id=$id
		public function get_by_id_total($id)
	{
		$sql = "SELECT grn.grn_id,grn_total_bill,grn_date, sum(supplier_payment.sup_paid_amount) as sup_paid_amount , (grn_total_bill - sum(sup_paid_amount)) as balance  
		-- deleted sup_credit
			FROM supplier_payment
			CROSS JOIN grn
			ON supplier_payment.fk_grn_id= grn.grn_id WHERE grn_id=$id
			GROUP BY (grn.grn_id)";
			// echo ($sql);
			
		$sql = "SELECT grn_id,grn_total_bill,grn_date, (SELECT SUM(sup_paid_amount) FROM `supplier_payment` WHERE fk_grn_id=$id) as sup_paid_amount FROM `grn` WHERE grn_id = $id";
			// echo $sql;
		$res = $this->db->query($sql);
		$tot = array();
		while ($row = $res->fetch_array()) {
			$tot[] = $row;
		}
		return $tot;
	}

	public function get_supplier_items_of_supOrder_id($order_id){
		$sql="SELECT product.pro_name, order_list.*
		FROM order_list
		LEFT JOIN product
		ON product.pro_id = order_list.fk_pro_id
		WHERE fk_order_id=$order_id";

		$res= $this->db->query($sql);

		$supplier= array();
		while($row= $res->fetch_assoc()){
			$supplier[] = $row;
		}
		return $supplier;

		
	}

	public function get_supplier_invoice_by_id($id){
		$sql="SELECT grn_list.grnls_qty,grnls_purchase_price,grnls_free_amount,
		grnlt_item_amount,grn_list.fk_grn_id,grn.grn_total_bill , product.pro_name 
		FROM grn_list
		LEFT JOIN product     
		ON grn_list.fk_pro_id = product.pro_id
	   LEFT JOIN grn
	   ON grn_list.fk_grn_id = grn.grn_id 
	   WHERE grn_list.fk_grn_id=$id";
	   $res = $this->db->query($sql);
	   $all = array();
	   while ($row = $res->fetch_array()) {
		   $all[] = $row;
		   
	   }
	   return $all;
	}

	public function get_supplier_by_grn_id($id){
		$sql="SELECT * FROM grn
		LEFT JOIN manufacture
		ON grn.fk_mac_id = manufacture.mac_id
		WHERE grn_id = $id";

		$res = $this->db->query($sql);
		$supplier = array();
		while($row = $res->fetch_array()){
			$supplier[] = $row;

		}
		return $supplier;
	}

		public function get_view_by_grn_id ($id){
			$sql = "SELECT grn.grn_date,grn_note,grn_total_bill,grn_id,manufacture.mac_name,supplier_payment.sup_paid_amount,(grn_total_bill - sum(sup_paid_amount)) AS credit,sum(sup_paid_amount) as pSum
 			From supplier_payment
 			LEFT JOIN grn
 			ON supplier_payment.fk_grn_id= grn.grn_id
 			LEFT JOIN manufacture
 			ON grn.fk_mac_id = manufacture.mac_id
			WHERE grn_id=$id
			GROUP BY (grn.grn_id)";

			$res = $this->db->query($sql);
			$grn = array();
			while ($row = $res->fetch_array()) {
				$grn[] = $row;
			}
			return $grn;
				
		}
}
?>
