<?php
	include_once("config.php");

class product_unload_list{
        public $unloadlt_id;
        public $unloadlt_itemcode;
		public $unloadlt_qty;
		public $unloadlt_stt;
		public $fk_pro_id;
		public $fk_unload_id;
	
	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
		
			}
		
		public function del($id){
			$sql = "delete from product_unload_list  where unloadlt_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "delete from grn_list set grnlt_stt='delete' where grnlt_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from product_unload_list where unloadlt_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from product_unload_list where unloadlt_stt='Active'"; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>



