<?php
	include_once("config.php");

class root{
        public $root_id;
		public $root_code;
        public $root_name;
		public $root_stt;
		
		public $db;

		//starting the db connetion
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
		}		
		//save the product cat into the database
		
		public function save(){
			$sql = "insert into root(`root_code`,`root_name`) values('$this->root_code','$this->root_name' )";
            $this->db->query($sql);
            echo $sql;
		}
		
		public function del($id){
			$sql = "update root set root_stt='delete' where root_id=$id";
			$this->db->query($sql);
		}
		
		public function get_by_id($id){	// to get a single p cat
			$sql = "select * from root where root=$id";
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from root where root_stt='Active'";
			$res = $this->db->query($sql);
			$numRows = $res->num_rows; // this will output the number of rows slelected in the database
			if($numRows)
			{
				$a=array();
				while( $row = $res->fetch_array()){
					$a[] =  $row;
				}	
				return $a;
			}
			
		}
	}
?>