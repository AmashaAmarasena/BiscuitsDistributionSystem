<?php
include_once("config.php");
	class damage{
	public $damage_id;
	public $damage_date;
	public $damage_note;
	public $damage_stt;
	public $fk_veh_id;
	public $fk_store_id;
	
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){

			$sql = "insert into damage(damage_date,damage_note) values('$this->damage_date','$this->damage_note')";
            $this->db->query($sql);
			// echo $sql;

			$count=0;
			$oid=$this->db->insert_id;
			$damageid=$this->db->insert_id;
			
			foreach($_POST["pro_code"] as $item )
			{
				$p=$item[$count];
				$q=$_POST["damage_qty"][$count];
				
				//$r=$_POST["grndescrip"][$count];

				$sql1="insert into damage_list (damagelt_itemcode,damagelt_qty,fk_damage_id) values('$p',$q,$damageid)";
				$this->db->query($sql1);
				// echo $sql1;
				
				/*$sql2="insert into stock (fk_grnls_itmcode,stock_in,fk_grn_id,fk_veh_id) values('$p',$q,$packid,'$this->fk_veh_id')";
				echo $sql2;
				$this->db->query($sql2);*/

				$sql3="insert into stock (fk_grnls_itmcode,stock_out,fk_grn_id,store,fk_veh_id) values('$p',$q,$damageid,1,'$this->fk_veh_id')";
				
				$this->db->query($sql3);

				echo $sql3;
				$count++;

				if(isset($_POST["dr"])){
					$sql= "UPDATE damage set damage_date='$this->damage_date',damage_note='$this->damage_note',pro_code='$this->$p',damage_qty='$this->$q' where damage_id=".$_POST["damage_id"];
					echo($sql);
					
					$this->db->query($sql);
					return true;
				}
			}
				return true;
		}
		
		public function del($id){
			$sql = "delete from damage  where damage_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from damage where damage_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from damage where damage_stt='Active'"; 
			/*echo $sql;*/

			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>
