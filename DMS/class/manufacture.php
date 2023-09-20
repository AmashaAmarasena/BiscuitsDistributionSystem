<?php
	include_once("config.php");

class manufacture{
        public $mac_id;
		public $mac_name;
        public $mac_descrip;
        public $mac_stt;
		
		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){

			if(isset($_POST["mac_id"])){
				$sql= "UPDATE manufacture set mac_name='$this->mac_name',mac_name='$this->mac_name',mac_descrip='$this->mac_descrip'
				 where mac_id=".$_POST["mac_id"];
				echo($sql);
				
				$this->db->query($sql);
				return true;
			}
			else
			{
			$sql1 = "INSERT INTO manufacture(mac_name,mac_descrip) values('$this->mac_name','$this->mac_descrip');";
			// echo $sql1;
		
       		 $this->db->query($sql1);
            
			}
		}
		
		public function del($id){
			$sql = "DELETE from manufacture WHERE mac_id=$id ";
			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "SELECT * FROM manufacture WHERE mac_id=$id";
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "SELECT * FROM manufacture WHERE mac_stt='Active'"; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}

		
	}
?>