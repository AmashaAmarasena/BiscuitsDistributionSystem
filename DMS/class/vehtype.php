<?php
	include_once("config.php");

class vehtype{
        public $vehtype_id;
		public $vehtype_name;
		public $vehtype_stt;
	
		public $db;

		//starting the db connetion
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		//save the product cat into the database
		
		public function save(){
			$sql = "insert into vehtype(`vehtype_name`,`vehtype_stt`) values('$this->vehtype_name','$this->vehtype_stt' )";
		
            $this->db->query($sql);
            
		}
		
		public function del($id){
			$sql = "update vehtype set vehtype_stt='delete' where vehtype_id=$id"  ;
			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "select * from vehtype where vehtype_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from vehtype where vehtype_stt='Active'";
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