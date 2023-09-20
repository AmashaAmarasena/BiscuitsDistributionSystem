<?php
	include_once("config.php");

class grn{
        public $grn_id;
		public $grn_date;
		public $grn_refno;
		public $grn_note;
		public $grn_stt;
		public $fk_mac_id;
		
	 

		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
		
		public function save(){
			$sql = "insert into grn(grn_date,grn_refno,grn_note,fk_mac_id) values('$this->grn_date','$this->grn_refno','$this->grn_note','$this->fk_mac_id');";
            $this->db->query($sql);
			echo $sql;
		
            $count=0;
			$gid=$this->db->insert_id;
			
			foreach($_POST["orderitem"] as $item ){
				$p=$_POST["orderitem"][$count];
				$q=$_POST["orderqty"][$count];
				$r=$_POST["orderdescrip"][$count];
				
				$sql="insert into order_list (pro_name,orderlt_qty,orderlt_descrip,fk_order_id) values('$p',$q,'$r',$gid)";
				echo $sql;
				exit;
				
				$this->db->query($sql);
				$count++;

			}
				return true;
		}
		
		public function del($id){
			$sql = "update ordr set order_stt='delete' where order_id=$id"  ;
			$this->db->query($sql);
		}
		
		public function get_by_id($id){
			$sql = "select * from ordr where order_id=$id"  ;
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}

		public function get_all(){
			
			$sql = "select * from ordr where order_stt='Active'"; 
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
