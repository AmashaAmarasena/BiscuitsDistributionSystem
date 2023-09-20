<?php
	include_once("config.php");

class product_load_list{
        public $pro_loadlt_id;
		public $fk_pro_id;
		public $pro_loadlt_qty;
		public $pro_loadlt_stt;
		public $fk_load_id;
	
	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			if(isset($_POST["loadlt_id"])){
				$sql= "update product_load_list set fk_pro_id='$this->fk_pro_id',pro_loadlt_qty='$this->pro_loadlt_qty' where pro_loadlt_id=".$_POST["pro_loadlt_id"];
				// echo($sql);
				
				$this->db->query($sql);
				return true;
				
			}
			}
		
		public function del($id){
			$sql = "delete from product_load_list  where pro_loadlt_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "delete from grn_list set grnlt_stt='delete' where grnlt_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from product_load_list where pro_loadlt_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from product_load_list where loadlt_stt='Active'"; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>



