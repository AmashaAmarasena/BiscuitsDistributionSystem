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
		public $st_user_name;
		public $st_user_psswd;
		public $st_stt;
		public $st_user_stt;
		public $fk_role_id;
		public $fk_veh_id;
		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){
			if(isset($_POST["st_id"]))
			{   
				
				// update the record with id
				$sql= "UPDATE staff SET st_name='$this->st_name',st_gender='$this->st_gender',st_nic='$this->st_nic',st_address='$this->st_address',st_phone='$this->st_phone',st_email='$this->st_email',st_user_name='$this->st_user_name',st_user_psswd='$this->st_user_psswd' WHERE st_id=".$_POST["st_id"];
				if($this->db->query($sql)){
					return true;
				}
				else{
					return false;
				}
			}
			else{
			$sql1 = "INSERT INTO staff(st_name,st_gender,st_nic,st_address,st_phone,st_email,st_user_name,st_user_psswd,st_stt,fk_role_id,fk_veh_id) VALUES('$this->st_name','$this->st_gender','$this->st_nic','$this->st_address','$this->st_phone','$this->st_email','$this->st_user_name','$this->st_user_psswd','Active','$this->fk_role_id','$this->fk_veh_id' )";
			
        	 if($this->db->query($sql1)){
				return true;
			 }
			 else{
				return false;
			 }
			// echo $sql1;
			}
            
		}

		public function login(){
            $sql="SELECT *,staff_role.role_name as role_name FROM staff
			LEFT JOIN staff_role 
			on staff_role.role_id = staff.fk_role_id
			WHERE st_user_name='$this->st_user_name' 
			AND st_user_psswd='$this->st_user_psswd'";
            $rep=$this->db->query($sql);
			
            if($row=$rep->fetch_array()){
				if($row['st_stt']=="Active"){
					session_start();
					$_SESSION["staff"]=$row;
					return ['status'=>true];
				}
				else if($row['st_stt']=="delete"){
					return ['status'=>false,'message'=>"User is already deleted."];
				}
				else{
					return ['status'=>false,'message'=>"User is not activated."];
				}
				return ['status'=>false,'message'=>"unotharized login."];
            }
			else{
				return ['status'=>false,'message'=>"Invalid user acount. Please ceck your email and password again."];
			}
		}

		public function del($id){
			$sql = "UPDATE staff SET st_stt='delete' WHERE st_id=$id";
			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "SELECT * FROM staff WHERE st_id=$id";
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}
		// public function get_by_code($code,$id){
		// 	$sql = "SELECT * FROM product WHERE pro_code='$code' AND pro_id != $id";
		// 	$res = $this->db->query($sql);
		// 	$row = $res->fetch_array();
		// 	return $row;
		// }
		public function get_by_nic($nic,$id){
			$sql = "SELECT * FROM staff WHERE st_nic='$nic'";
			if(!empty($id)){
				$sql.= " AND st_id <> '$id'";
			}
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			// return $sql;
			return $row;
		}

		public function get_by_email($semail,$id){
			$sql="SELECT * FROM staff WHERE st_email='$semail'";
			if(!empty($id)){
				$sql.= " AND st_id <> '$id'";
			}
			$res= $this->db->query($sql);
			$row=$res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "SELECT staff.*,vehicle.*,staff_role.*
			From staff
			LEFT JOIN staff_role
			ON staff.fk_role_id= staff_role.role_id
			LEFT JOIN vehicle
			ON staff.fk_veh_id = vehicle.veh_id
			WHERE st_stt='Active'";
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
