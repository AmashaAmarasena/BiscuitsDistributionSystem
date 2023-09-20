<?php
	include_once("config.php");

class order_list{
        public $orderlt_id;
		public $orderlt_qty;
        public $orderlt_descrip;
		public $orderlt_stt;
		public $fk_pro_id;
		public $fk_mac_id;
		public $fk_order_id;

		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){
		
			

		}
		
		public function del($id){
			$sql = "update order_list set orderlt_stt='delete' where orderlt_id=$id"  ;
			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "select * from order_list where orderlt_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from order_list where orderlt_stt='Active'"; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
		
	}
?>



