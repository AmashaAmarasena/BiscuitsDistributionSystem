<?php
include_once("config.php");

class cus_invoice
{
	public $cus_invoice_id;
	public $cus_invoice_date;
	public $cus_invoice_note;
	public $cus_invoice_total_amount;
	public $cus_invoice_stt;
	public $cus_invoice_type;
	public $fk_cus_returns_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO cus_invoice(cus_invoice_date,cus_invoice_note,cus_invoice_total_amount,,cus_invoice_type,fk_cus_returns_id) values('$this->cus_invoice_date','$this->cus_invoice_note','$this->cus_invoice_total_amount','$this->cus_invoice_type','$this->fk_cus_returns_id')";
		$this->db->query($sql);
		// echo $sql;

    }

    // 		$count = 0;
    // 		$oid = $this->db->insert_id;

            
    // 		foreach ($_POST["pro_code"] as $item) {
    // 			$a = $_POST["pro_code"][$count];
    // 			$b = $_POST["saleslt_qty"][$count];
    // 			// $c = $_POST["saleslt_descrip"][$count];
    // 			// $d = $_POST["saleslt_purchase_price"][$count];
    // 			$e = $_POST["saleslt_issue_price"][$count];
    // 			$f = $_POST["saleslt_free"][$count];
    // 			$g = $_POST["saleslt_discount"][$count];
    // 			$h = $_POST["saleslt_total_bill"][$count];

                

    // 			// $i = $_POST["cash"][$count];
    // 			// $j = $_POST["cheque_amount"][$count];
    // 			// $k = $_POST["cheque_no"][$count];
    // 			// $l = $_POST["cheque_date"][$count];
    // 			// $m = $_POST["cheque_bank"][$count];
    // 			// $n = $_POST["credit"][$count];
    // 			// $o = $_POST["paid_amount"][$count];

    // 			//$h=$_POST["fk_sales_id"][$count];
    // 			$sql2 = "INSERT INTO sales_list (saleslt_item,saleslt_qty,saleslt_issue_price,saleslt_free,saleslt_discount,saleslt_total_bill,
    // 			fk_sales_id) 
    // 			values('$a','$b','$e','$f','$g','$h',$oid)";
    // 			echo $sql2;
    // 			$this->db->query($sql2);
                    
    // 			// $sql3 = "INSERT INTO payment (cash,cheque_amount,cheque_no,cheque_date,cheque_bank,credit,paid_amount,fk_sales_id,fk_cus_id) values('$i','$j','$k','$l','$m','$n','$o','$oid,'$this->fk_cus_id')";
    // 			// echo $sql3;
    // 			// $this->db->query($sql3);
                
    // 			$sql3="insert into stock (fk_pro_id,stock_out,fk_veh_id) values('$a',$b,$this->fk_veh_id)";
    // 				echo $sql3;
    // 				$this->db->query($sql3);
                    
    // 			$count++;

    // 		}
    // 		return $oid;
    // 	}

    // 	public function del($id)
    // 	{
    // 		$sql = "UPDATE sales SET sales_stt='delete' WHERE sales_id=$id";
    // 		$this->db->query($sql);
    // 	}

    // 	public function get_by_id($id)
    // 	{
    // 		$sql = "SELECT * FROM sales WHERE sales_id=$id";
    // 		$res = $this->db->query($sql);
    // 		$row = $res->fetch_array();
    // 		return $row;
    // 	}

    // 	public function get_by_id_total($id)
    // 	{
    // 		$sql = "SELECT sales.sales_id,sales_total_bill, sum(payment.paid_amount) as paid_amount ,credit ,(Sales_total_bill - sum(paid_amount)) as balance
    // 			FROM payment
    // 			LEFT JOIN sales
    // 			ON payment.fk_sales_id= sales.sales_id WHERE sales_id=$id
    // 			GROUP BY (sales.sales_id)";
    // 			echo ($sql);
                
                
    // 		$res = $this->db->query($sql);
    // 		$tot = array();
    // 		while ($row = $res->fetch_array()) {
    // 			$tot[] = $row;
    // 		}
    // 		return $tot;
    // 	}

    // 	public function get_all()
    // 	{

    // 		$wh = "1=1"; //always true
    // 		$hv=""; //use for SUM , can't use WHERE for SUM
    // 		if(isset($_POST['cus_name'])){
    // 			if($_POST['cus_name'] != -1){
    // 				$wh .= " and customer.cus_id = ".$_POST['cus_name'];
    // 			}
                
    // 			if($_POST['start_date'] != ""){
    // 				$wh .= " and date(sales.sales_date) >= '".$_POST['start_date']."'";
    // 			}
    // 			 if($_POST['end_date'] != ""){
    // 			 	$wh .= " and date(sales.sales_date) <= '".$_POST['end_date']."'";
    // 			 }
    // 			 if($_POST['paid_amount'] == "Paid"){
    // 				$hv .= " having (sum(paid_amount) = sales_total_bill)";
    // 			}

    // 		}


    // 		$sql = "SELECT sales.sales_date,sales_refno,sales_note,sales_total_bill,sales_id , customer.cus_name, payment.paid_amount, 
    // 		payment.credit, store.store_name,sum(paid_amount) as pSum 
    //  			From payment
    //  			LEFT JOIN sales
    //  			ON payment.fk_sales_id= sales.sales_id
    //  			LEFT JOIN customer
    //  			ON sales.fk_cus_id = customer.cus_id
    // 			LEFT JOIN store
    // 			ON store.fk_cus_id = customer.cus_id 
    // 			where $wh
    // 			GROUP BY (sales.sales_id) $hv";
        
    // 		// $sql = " SELECT * FROM sales 
    // 		// JOIN customer ON sales.fk_cus_id=customer.cus_id WHERE sales_stt='Active'"; 
    // // 
    // 		// echo $sql;

    // 		$res = $this->db->query($sql);
    // 		$a = array();
    // 		while ($row = $res->fetch_array()) {
    // 			$a[] =  $row;
    // 		}
    // 		//print_r($a);
    // 		return $a;


    // 		// $sql1 = "SELECT payment.fk_saleslt_total_bill,paid_amount,credit,fk_cus_id
    // 		// FROM payment
    // 		// LEFT JOIN sales
    // 		// ON payment.fk_cus_id = sales.fk_cus_id "; 


    // 		// $res = $this->db->query($sql1);
    // 		// $a=array();
    // 		// while( $row = $res->fetch_array()){
    // 		// 	$a[] =  $row;
    // 		// }	
    // 		// return $a;

                
    // 	}
    // 	public function get_view_by_sales_id($id)
    // 	{
    // 		$sql = "SELECT sales.sales_date,sales_note,sales_total_bill,sales_id , customer.cus_name,cus_address,cus_phone,cus_email,payment.paid_amount, 
    // 		payment.credit, store.store_name,sum(paid_amount) as pSum
    //  			From payment
    //  			LEFT JOIN sales
    //  			ON payment.fk_sales_id= sales.sales_id
    //  			LEFT JOIN customer
    //  			ON sales.fk_cus_id = customer.cus_id
    // 			LEFT JOIN store
    // 			ON store.fk_cus_id = customer.cus_id 
    // 			WHERE sales_id=$id
    // 			GROUP BY (sales.sales_id)";

    // 			// echo ($sql);
                
    // 			$res = $this->db->query($sql);
    // 			$sales = array();
    // 			while ($row = $res->fetch_array()) {
    // 				$sales[] = $row;
    // 			}
    // 			return $sales;
    // 		}

}
?>