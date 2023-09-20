<?php
	include_once("config.php");

class store{
        public $store_id;
		public $store_name;
        public $store_address;
        public $store_phone;
        public $store_email;
		public $store_stt;
		public $fk_root_id;
		public $fk_cus_id;
		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){
			$sql = "INSERT INTO store(store_name,store_address,store_phone,store_email,store_stt,fk_root_id,fk_cus_id) VALUES('$this->store_name','$this->store_address','$this->store_phone','$this->store_email','Active','$this->fk_root_id','$this->fk_cus_id' )";
			
        	 $this->db->query($sql);
			
			
            
		}
		
		public function del($id){
			$sql = "UPDATE store SET store_stt='delete' WHERE store_id=$id"  ;

			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "SELECT * FROM store WHERE store_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "SELECT * FROM store s,customer c, root r WHERE s.fk_root_id = r.root_id AND s.fk_cus_id = c.cus_id AND s.store_stt='Active'";
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>