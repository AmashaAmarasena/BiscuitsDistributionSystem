<?php
include_once("config.php");
	class pack{
	public $pack_id;
	public $pack_date;
	public $pack_note;
	public $pack_stt;
	public $fk_veh_id;
		
	 	public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            }		
		
		public function save(){
			$sql = "insert into pack(pack_date,pack_note,fk_veh_id) values('$this->pack_date','$this->pack_note','$this->fk_veh_id');";
            $this->db->query($sql);
			echo "$sql";
			$count=0;
			$oid=$this->db->insert_id;
			
			foreach($_POST["pro_code"] as $item )
			{
				$p=$_POST["pro_code"][$count];
				$q=$_POST["packqty"][$count];
				//$r=$_POST["grndescrip"][$count];

				//$sql="insert into order_list (orderlt_item_id,orderlt_qty,orderlt_descrip,fk_order_id) values('$p',$q,'$r',$oid)";
				$sql2="insert into pack_list (packls_itmcode,packls_qty,fk_pack_id) values('$p',$q,$oid)";
				$this->db->query($sql2);
				/*$loadid=$this->db->insert_id;
				
				$sql2="insert into stock (fk_grnls_itmcode,stock_in,fk_grn_id) values('$p',$q,$grnid)";
				$this->db->query($sql2);*/

				echo $sql2;
				$count++;
			}
				return true;
		}
		
		public function del($id){
			$sql = "delete from pack  where pack_id=$id"  ;
			$this->db->query($sql);
		}

		/*public function del($id){
			$sql = "update grn set grn_stt='delete' where grn_id=$id"  ;
			$this->db->query($sql);
		}*/
		
		public function get_by_id($id){
			$sql = "select * from pack where pack_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from pack where pack_stt='Active'"; 
			echo $sql;

			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] =  $row;
			}	
			return $a;
		}
	}
?>
