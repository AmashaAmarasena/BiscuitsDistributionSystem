<?php
	include_once("config.php");

class vehicle{
        public $veh_id;
		public $veh_brand;
		public $veh_model;
		public $veh_number;
		public $veh_capacity;
		public $veh_fuel;
		public $veh_stt;
		public $fk_vehtype_id;
	
		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){
			if(isset($_POST["veh_id"])){
				$sql= "update vehicle set veh_brand='$this->veh_brand',veh_model='$this->veh_model',veh_number='$this->veh_number',veh_capacity='$this->veh_capacity',veh_fuel='$this->veh_fuel' where veh_id=".$_POST["veh_id"];
				echo($sql);
				
				
				$this->db->query($sql);
				return true;
				
			}
			else{
			$sql1 = "insert into vehicle(veh_brand,veh_model,veh_number,veh_capacity,veh_fuel,fk_vehtype_id) values( '$this->veh_brand','$this->veh_model','$this->veh_number','$this->veh_capacity','$this->veh_fuel','$this->fk_vehtype_id');";
			echo $sql1;
			
        
            $this->db->query($sql1);
			return true;
			} 
		}
		
		public function del($id){
			$sql = "update vehicle set veh_stt='delete' where veh_id=$id"  ;
			$this->db->query($sql);
			return true;
		}
		
		public function get_by_id($id){
			$sql = "select * from vehicle where veh_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from vehicle JOIN vehtype on vehicle.fk_vehtype_id=vehtype.vehtype_id where veh_stt='Active' "; 
			$res = $this->db->query($sql);
			$numRows = $res->num_rows; // this will output the number of rows slelected in the database
			$a=array();
			if($numRows)
			{
				
				while( $row = $res->fetch_array()){
					$a[] =  $row;
				}	
				
			}
			return $a;
		}

		public function get_by_veh_number($vehNumber,$id)
		{
			$sql = "SELECT * FROM staff WHERE veh_number='$vehNumber'";
			if(!empty($id)){
				$sql+= " AND pro_id != $id";
			}
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		
		}
	}
?>