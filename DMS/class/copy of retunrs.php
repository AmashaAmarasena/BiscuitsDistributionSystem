public function get_by_id_total($id)
	{
		$sql = "SELECT sales.sales_id,sales_total_bill, sum(payment.paid_amount) as paid_amount ,credit ,(Sales_total_bill - sum(paid_amount)) as balance
			FROM payment
			LEFT JOIN sales
			ON payment.fk_sales_id= sales.sales_id WHERE sales_id=$id
			GROUP BY (sales.sales_id)";
		// echo ($sql);


		$res = $this->db->query($sql);
		$tot = array();
		while ($row = $res->fetch_array()) {
			$tot[] = $row;
		}
		return $tot;
	}

	public function get_all()
	{

		$wh = "1=1"; //always true
		$hv = ""; //use for SUM , can't use WHERE for SUM
		if (isset($_POST['cus_name'])) {
			if ($_POST['cus_name'] != -1) {
				$wh .= " and customer.cus_id = " . $_POST['cus_name'];
			}

			// if($_POST['start_date'] != ""){
			// 	$wh .= " and date(sales.sales_date) >= '".$_POST['start_date']."'";
			// }
			//  if($_POST['end_date'] != ""){
			//  	$wh .= " and date(sales.sales_date) <= '".$_POST['end_date']."'";
			//  }
			if ($_POST['paid_amount'] == "Paid") {
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}
		}


		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount, 
		SUM(sales_total_bill - paid_amount)as credit, store.store_name,sum(paid_amount) as pSum 
 			From payment
 			LEFT JOIN sales
 			ON payment.fk_sales_id= sales.sales_id
 			LEFT JOIN customer
 			ON sales.fk_cus_id = customer.cus_id
			LEFT JOIN store
			ON store.fk_cus_id = customer.cus_id 
			where $wh
			GROUP BY (sales.sales_id) $hv";

		// $sql = " SELECT * FROM sales 
		// JOIN customer ON sales.fk_cus_id=customer.cus_id WHERE sales_stt='Active'"; 

		// echo $sql;

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		//print_r($a);
		return $a;


		// $sql1 = "SELECT payment.fk_saleslt_total_bill,paid_amount,credit,fk_cus_id
		// FROM payment
		// LEFT JOIN sales
		// ON payment.fk_cus_id = sales.fk_cus_id "; 


		// $res = $this->db->query($sql1);
		// $a=array();
		// while( $row = $res->fetch_array()){
		// 	$a[] =  $row;
		// }	
		// return $a;


	}
	public function get_view_by_sales_id($id)
	{
		$sql = "SELECT sales.sales_date,sales_note,sales_total_bill,sales_id , customer.cus_name,cus_address,cus_phone,cus_email,payment.paid_amount, 
		payment.credit, store.store_name,sum(paid_amount) as pSum
 			From payment
 			LEFT JOIN sales
 			ON payment.fk_sales_id= sales.sales_id
 			LEFT JOIN customer
 			ON sales.fk_cus_id = customer.cus_id
			LEFT JOIN store
			ON store.fk_cus_id = customer.cus_id 
			WHERE sales_id=$id
			GROUP BY (sales.sales_id)";

		// echo ($sql);

		$res = $this->db->query($sql);
		$sales = array();
		while ($row = $res->fetch_array()) {
			$sales[] = $row;
		}
		return $sales;
	}

	

	


}


<!-- 

sup_returns -->





public function get_all()
	{

		$wh = "1=1"; //always true
		$hv=""; //use for SUM , can't use WHERE for SUM
		if(isset($_POST['cus_name'])){
			if($_POST['cus_name'] != -1){
				$wh .= " and customer.cus_id = ".$_POST['cus_name'];
			}
			
			if($_POST['start_date'] != ""){
				$wh .= " and date(sales.sales_date) >= '".$_POST['start_date']."'";
			}
			 if($_POST['end_date'] != ""){
			 	$wh .= " and date(sales.sales_date) <= '".$_POST['end_date']."'";
			 }
			 if($_POST['paid_amount'] == "Paid"){
				$hv .= " having (sum(paid_amount) = sales_total_bill)";
			}

		}


		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount, 
		payment.credit, store.store_name,sum(paid_amount) as pSum 
 			From payment
 			LEFT JOIN sales
 			ON payment.fk_sales_id= sales.sales_id
 			LEFT JOIN customer
 			ON sales.fk_cus_id = customer.cus_id
			LEFT JOIN store
			ON store.fk_cus_id = customer.cus_id 
			where $wh
			GROUP BY (sales.sales_id) $hv";
	
		// $sql = " SELECT * FROM sales 
		// JOIN customer ON sales.fk_cus_id=customer.cus_id WHERE sales_stt='Active'"; 

		echo $sql;

		$res = $this->db->query($sql);
		$a = array();
		while ($row = $res->fetch_array()) {
			$a[] =  $row;
		}
		//print_r($a);
		return $a;


		// $sql1 = "SELECT payment.fk_saleslt_total_bill,paid_amount,credit,fk_cus_id
		// FROM payment
		// LEFT JOIN sales
		// ON payment.fk_cus_id = sales.fk_cus_id "; 


		// $res = $this->db->query($sql1);
		// $a=array();
		// while( $row = $res->fetch_array()){
		// 	$a[] =  $row;
		// }	
		// return $a;

			
	}
	public function get_view_by_sales_id($id)
	{
		$sql = "SELECT sales.sales_date,sales_note,sales_total_bill,sales_id , customer.cus_name,cus_address,cus_phone,cus_email,payment.paid_amount, 
		payment.credit, store.store_name,sum(paid_amount) as pSum
 			From payment
 			LEFT JOIN sales
 			ON payment.fk_sales_id= sales.sales_id
 			LEFT JOIN customer
 			ON sales.fk_cus_id = customer.cus_id
			LEFT JOIN store
			ON store.fk_cus_id = customer.cus_id 
			WHERE sales_id=$id
			GROUP BY (sales.sales_id)";

			// echo ($sql);
			
			$res = $this->db->query($sql);
			$sales = array();
			while ($row = $res->fetch_array()) {
				$sales[] = $row;
			}
			return $sales;
		}


		public function get_by_id_total($id)
	{
		$sql = "SELECT sales.sales_id,sales_total_bill, sum(payment.paid_amount) as paid_amount ,credit ,(Sales_total_bill - sum(paid_amount)) as balance
			FROM payment
			LEFT JOIN sales
			ON payment.fk_sales_id= sales.sales_id WHERE sales_id=$id
			GROUP BY (sales.sales_id)";
			echo ($sql);
			
			
		$res = $this->db->query($sql);
		$tot = array();
		while ($row = $res->fetch_array()) {
			$tot[] = $row;
		}
		return $tot;
	}