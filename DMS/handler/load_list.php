<?php
	include_once("config.php");

class grn_list{
        public $packlt_id;
        public $packlt_itemcode;
		public $packlt_qty;
		public $packlt_stt;
		public $fk_pro_id;
		public $fk_pack_id;
	
	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
		
			}
		
		public function del($id){
			$sql = "delete from pack_list  where packlt_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "delete from grn_list set grnlt_stt='delete' where grnlt_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from pack_list where packlt_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from pack_list where packlt_stt='Active'"; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>



