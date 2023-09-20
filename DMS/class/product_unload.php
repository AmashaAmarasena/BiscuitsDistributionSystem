<?php
include_once("config.php");
	class product_unload{
	public $unload_id;
	public $unload_date;
	public $unload_note;
	public $unload_stt;
	public $fk_veh_id;
	public $fk_pro_id;
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			$sql = "insert into product_unload(unload_date,unload_note,fk_veh_id) values('$this->unload_date','$this->unload_note','$this->fk_veh_id');";
            $this->db->query($sql);
			// echo($sql);
			
			$count=0;
			$oid=$this->db->insert_id;
			$unloadid=$this->db->insert_id;
			
			foreach($_POST["pro_code"] as $item )
			{
				$pro_code=$_POST["pro_code"][$count];
				$qty=$_POST["unload_qty"][$count];
				
				//$r=$_POST["grndescrip"][$count];

				$sql1="insert into product_unload_list (fk_pro_id,unloadlt_qty,fk_unload_id) values('$pro_code',$qty,$oid)";
				$this->db->query($sql1);
				// echo($sql1);
				$sql2="insert into stock (fk_pro_id,stock_in,fk_grn_id,fk_veh_id) values('$pro_code',$qty,$unloadid,'$this->fk_veh_id')";
				echo $sql2;
				$this->db->query($sql2);

				$sql3="insert into stock (fk_pro_vieid,stock_out,fk_grn_id,store,fk_veh_id) values('$pro_code',$qty,$unloadid,1,'$this->fk_veh_id')";
				// echo $sql3;
				$this->db->query($sql3);
				$count++;
			}
				return true;
		}
		
		public function del($id){
			$sql = "update product_unload set unload_stt='delete' where unload_id=$id";
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from product_unload where unload_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from product_unload where unload_stt='Active'"; 
			// echo $sql;

			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>
