<?php
	include_once("config.php");	
	class product{
        public $pro_id;
		public $pro_name;
        public $pro_code;
		public $pro_packsize;
		public $pro_items_in_pack;
		public $pro_weight;
		public $pro_reorder_level;
		public $pro_stt;
		public $fk_procat_id;		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
		}		
		
		public function save(){
			if(isset($_POST["pro_id"])){
				$sql= "UPDATE product SET pro_name='$this->pro_name',pro_code='$this->pro_code',pro_packsize='$this->pro_packsize',pro_items_in_pack='$this->pro_items_in_pack',pro_weight='$this->pro_weight',pro_reorder_level='$this->pro_reorder_level' where pro_id=".$_POST["pro_id"];
				// echo($sql);
				
				$this->db->query($sql);
				return true;
				
			}
				else{
					// echo($this->pro_reorder_level);exit;
				$sql1 = "insert into product(pro_name,pro_code,pro_packsize,pro_items_in_pack,pro_weight,pro_reorder_level,fk_procat_id) 
				values('$this->pro_name','$this->pro_code','$this->pro_packsize','$this->pro_items_in_pack','$this->pro_weight','$this->pro_reorder_level','$this->fk_procat_id');";
				// echo($sql1);
            	$this->db->query($sql1);
				return true;
				
			}
		}
		
		public function del($id){
			$sql = "UPDATE product SET pro_stt='delete' WHERE pro_id=$id";
			$this->db->query($sql);
			return true;
		}
		
		public function get_by_id($id){
			$sql = "SELECT * FROM product WHERE pro_id=$id";
			$res = $this->db->query($sql);
			$row = $res->fetch_array();
			return $row;
		}
		public function get_by_code($code,$id){
			
			$sql = "SELECT * FROM product WHERE pro_code='$code'";
			if(!empty($id)){
				$sql.= " AND pro_id != $id";
			}
			$res = $this->db->query($sql);
			$row = $res->fetch_array();

			return $row;

		}

		public function get_all(){			
			$sql = "SELECT * FROM product JOIN product_category ON product.fk_procat_id=product_category.procat_id WHERE pro_stt='Active' "; 
			$res = $this->db->query($sql);
			$a=array();
			while( $row = $res->fetch_array()){
				$a[] = $row;
			}	
			return $a;
		}

		public function get_all_st(){
			if(isset($_POST['store_id']) && $_POST['store_id']!=-2){
				$where='AND stock.fk_veh_id='.$_POST["store_id"];
			}
			else{
				$where = '';
			}
			$sql = "SELECT pro_name,pro_reorder_level, procat_name, SUM(stock_in) AS sumStIn, SUM(stock_out) AS sumStOut 
			FROM product 
			LEFT JOIN  product_category 
			ON product.fk_procat_id=product_category.procat_id 
			LEFT JOIN stock 
			ON stock.fk_pro_id=product.pro_id 
			WHERE pro_stt='Active' ".$where."
			GROUP BY product.pro_id "; 
			$res = $this->db->query($sql);
			// echo $sql;
			$a = array();
			while($row = $res->fetch_array()){
				$a[] = $row;
			}	
			return $a;
		}

		public function get_re_order_level_list()
		{
			$sql = "SELECT pro_name,pro_reorder_level, procat_name, SUM(stock_in) AS sumStIn, SUM(stock_out) AS sumStOut
			FROM product 
			LEFT JOIN  product_category 
			ON product.fk_procat_id=product_category.procat_id 
			LEFT JOIN stock 
			ON stock.fk_pro_id=product.pro_id 
			WHERE pro_stt='Active' 
			GROUP BY product.pro_id having pro_reorder_level > (sumStIn - sumStOut)"; 
			$res = $this->db->query($sql);
			echo $sql;
			$a = array();
			while($row = $res->fetch_array()){
				$a[] = $row;
			}	
			return $a;
		}
 
		/** accepts 2 arguments - product ID and vehicle ID
		 *  define the where clause in a variable using the parameters pased to the function ($pid,$vid)
		 *  write the sql query using the $where variable
		 *  run the query against the DB
		 *  create an empty array
		 *  store the result returns from the qeuery in the array
		 *  returns the array
		 */
		public function get_stk($pid,$vid){
		
			$where="AND product.pro_id=$pid and  stock.fk_veh_id=$vid " ;		
			$sql = "SELECT pro_name, procat_name, ifnull((SUM(stock_in)-SUM(stock_out)),0)  AS stk 
			FROM product 
			LEFT JOIN product_category 
			ON product.fk_procat_id=product_category.procat_id 
			LEFT JOIN stock 
			ON stock.fk_pro_id=product.pro_id 
			WHERE pro_stt='Active' ".$where."  "; 
			$res = $this->db->query($sql);
			$a = array();
			if($row = $res->fetch_array()){
				$a = $row;
			}	
			return $a;
		}
		//check quantity for product load
		public function get_stk_load($pid){
		
			$where="AND product.pro_id=$pid " ;		
			$sql = "SELECT pro_name, procat_name, ifnull((SUM(stock_in)-SUM(stock_out)),0)  AS stk 
			FROM product 
			LEFT JOIN product_category 
			on product.fk_procat_id=product_category.procat_id 
			LEFT JOIN stock 
			on stock.fk_pro_id=product.pro_id 
			WHERE pro_stt='Active' ".$where."  "; 
			$res = $this->db->query($sql);
			$a = array();
			if($row = $res->fetch_array()){
				$a = $row;
			}	
			return $a;
		}


		public function get_product_by_manufacture_id($manufacture_id)
	{
		$sql = "SELECT pro_id FROM product WHERE fk_mac_id=$manufacture_id";
		$res = $this->db->query($sql);

		$product = array();
		while ($row = $res->fetch_assoc()) {
			$product[] = $row;
		}
		return $product;
	}

		// public function get_exisitng_product_qty($pro_id){
		// 	$sql = "SELECT sum(grnls_qty) as grnls_qty FROM grn_list WHERE fk_pro_id=$pro_id";
		// $res = $this->db->query($sql);

		// $extQty = array();
		// while ($row = $res->fetch_assoc()) {
		// 	$extQty[] = $row;
		// }
		// return $extQty;
		// }
	}
?>