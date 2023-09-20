<?php
include_once("config.php");
	class product_load{
	public $load_id;
	public $load_date;
	public $load_note;
	public $load_stt;
	public $fk_veh_id;
	public $fk_pro_id;
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			$sql = "insert into product_load(load_date,load_note,fk_veh_id) values('$this->load_date','$this->load_note','$this->fk_veh_id');";
            $this->db->query($sql);
			// echo($sql);
			
			$count=0;
			$oid=$this->db->insert_id;
			echo("GRN id ".$oid);
			$loadid=$this->db->insert_id;
			
			foreach($_POST["pro_code"] as $item )
			{
				$pro_code=$_POST["pro_code"][$count];
				$qty=$_POST["load_qty"][$count];
				
				//$r=$_POST["grndescrip"][$count];

				$sql1="insert into product_load_list (fk_pro_id,pro_loadlt_qty,fk_load_id) values('$pro_code',$qty,$oid)";
				$this->db->query($sql1);
				// echo($sql1);
				
				$sql2="insert into stock (fk_pro_id,stock_in,fk_grn_id,fk_veh_id) values('$pro_code',$qty,$loadid,'$this->fk_veh_id')";
				// echo $sql2;
				$this->db->query($sql2);

				$sql3="insert into stock (fk_pro_id,stock_out,fk_grn_id,store,fk_veh_id) values('$pro_code',$qty,$loadid,1,0)";
				// echo $sql3;
				$this->db->query($sql3);

				// echo $sql3;
				$count++;
			}
				return true;
		}
		
		public function del($id){
			$sql = "delete from product_load  where load_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from product_load where load_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from product_load where load_stt='Active'"; 
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
