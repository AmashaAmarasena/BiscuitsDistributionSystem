<?php
	include_once("config.php");

class staff{
        public $st_id;
		public $st_name;
        public $st_gender;
        public $st_dob;
        public $st_nic;
        public $st_address;
        public $st_phone;
        public $st_email;
		public $st_stt;
		public $fk_role_id;
		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){
			$sql = "insert into staff(st_name,st_gender,st_dob,st_nic,st_address,st_phone,st_email,st_stt,fk_role_id) values('$this->st_name','$this->st_gender','$this->st_dob','$this->st_nic','$this->st_address','$this->st_phone','$this->st_email','Active','$this->fk_role_id' )";
			
        	 $this->db->query($sql);
			
            
		}
		
		public function del($id){
			$sql = "update staff set st_stt='delete' where st_id=$id"  ;

			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "select * from staff where st_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from staff s, staff_role sr where s.fk_role_id = sr.role_id and s.st_stt='Active';";
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>