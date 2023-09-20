<?php
	include_once("config.php");

class shop_orderlt{
        public $shop_orderlt_id;
        public $shop_orderlt_itemcode;
		public $shop_orderlt_qty;
		public $shop_orderlt_stt;
		public $fk_shop_id;
		public $fk_store_id;
	
	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
		
			}
		
		public function del($id){
			$sql = "delete from shop_order_list  where shop_orderlt_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "delete from grn_list set grnlt_stt='delete' where grnlt_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from shop_order_list where shop_orderlt_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from shop_order_list where shop_orderlt_stt='Active'"; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>



