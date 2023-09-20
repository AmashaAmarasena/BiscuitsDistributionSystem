<?php
include_once("config.php");
	class shop_order{
	public $sporder_id;
	public $sporder_date;
	public $sporder_refno;
	public $sporder_note;
	public $sporder_stt;
	public $fk_store_id;
	public $fk_pro_id;
	
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			$sql = "insert into shop_order(sporder_date,sporder_refno,sporder_note,fk_store_id) values('$this->sporder_date','$this->sporder_refno','$this->sporder_note','$this->fk_store_id')";
            $this->db->query($sql);
			// echo $sql;
			
			$count=0;
			$oid=$this->db->insert_id;
			$fk_shop_id=$this->db->insert_id;
			
			foreach($_POST["pro_code"] as $item )
			{
				$p=$_POST["pro_code"][$count];
				$q=$_POST["shop_orderlt_qty"][$count];
				
			

				$sql1="insert into shop_order_list (shop_orderlt_itemcode,shop_orderlt_qty,fk_sporder_id,fk_shop_id) values('$p',$q,$oid,'$fk_shop_id')";
				$this->db->query($sql1);
				// echo $sql1;
				/*$grnid=$this->db->insert_id;
				
				$sql2="insert into stock (fk_grnls_itmcode,stock_in,fk_grn_id) values('$p',$q,$grnid)";
				$this->db->query($sql2);

				echo $sql;
				$count++;*/
			}
				return true;
		}
		
		public function del($id){
			$sql = "delete from shop_order  where sporder_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from shop_order where sporder_id_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from shop_order where sporder_stt='Active'"; 
			echo $sql;

			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>
