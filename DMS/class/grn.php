<?php
include_once("config.php");
	class grn{
	public $grn_id;
	public $grn_date;
	public $grn_refno;
	public $grn_note;
	public $grn_stt;
	public $fk_mac_id;
	public $fk_pro_id;
	public $fk_order_id;
	
	
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			$sql1 = "insert into grn(grn_date,grn_refno,grn_note,fk_mac_id) values('$this->grn_date','$this->grn_refno','$this->grn_note','$this->fk_mac_id');";
            $this->db->query($sql1);
			$oid =$this->db->insert_id; //grn_id

			$sql1 = "insert into sup_invoice(sup_invoice_date,sup_invoice_refno,sup_invoice_note,fk_grn_id) values('$this->grn_date','$this->grn_refno','$this->grn_note','$oid');";
            $this->db->query($sql1);

			$count=0;
			$oid=$this->db->insert_id;
			
			foreach($_POST["pro_code"] as $item )
			{
				$p=$_POST["pro_code"][$count];
				$q=$_POST["grnqty"][$count];
				$r=$_POST["grndescrip"][$count];
				$s=$_POST["grnlt_purchase_price"][$count];
				$t=$_POST["ex_date"][$count];
				$u=$_POST["sales_price"][$count];

				$sql="insert into grn_list (grnls_itmcode,grnls_qty,grnls_descip,grnls_purchase_price,grnls_ex_date,grnls_sales_price,fk_grn_id,fk_pro_id) values('$p',$q,'$r',$s,'$t',$u,$oid,'$this->fk_pro_id')";
				$this->db->query($sql);
				$grnid=$this->db->insert_id;
				
				$sql2="insert into stock (fk_grnls_itmcode,stock_in,fk_grn_id) values('$p',$q,$grnid)";
				$this->db->query($sql2);

				echo $sql;
				$count++;
			}
				return true;
		}
		
		public function del($id){
			$sql = "delete from grn  where grn_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from grn where grn_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from grn   
					JOIN manufacture on grn.fk_mac_id=manufacture.mac_id where grn_stt='Active'"; 
			// echo $sql;
			// exit;

			$res = $this->db->query($sql);
			$a=array();
			while( $row =$res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}

		public function get_by_id_item($id){
			$sql = "select from grn where grn_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}
		
	}
?>
