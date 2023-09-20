<?php
	include_once("config.php");

class staff_role{
        public $role_id;
		public $role_name;
		public $role_stt;
        public $role_descrip;
		
		public $db;

		//starting the db connetion
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		//save the staff role into the database
		
		public function save(){
			if(isset($_POST["role_id"])){
				$sql= "UPDATE staff_role SET role_name='$this->role_name',role_descrip='$this->role_descrip' WHERE role_id=".$_POST["role_id"];
				echo($sql);
				
				$this->db->query($sql);
				return true;
			}
			$sql = "INSERT INTO staff_role(`role_name`,`role_descrip`) values('$this->role_name','$this->role_descrip' )";
		
            $this->db->query($sql);
            
		}
		//delete the staff role from the database

		public function del($id){
			$sql = "UPDATE staff_role SET role_stt='deactivate' WHERE role_id=$id";
			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "SELECT * FROM staff_role WHERE role_id=$id";
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "SELECT * FROM staff_role WHERE role_stt='Active'";
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