<?php
include_once("config.php");
class product_cat
{
	public $procat_id;
	public $procat_name;
	public $procat_descrip;
	public $procat_stt;

	public $db;

	//starting the db connetion
	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}
	//save the product cat into the database

	public function save()
	{
		if (isset($_POST["procat_id"])) {
			$sql = "UPDATE product_category SET procat_name='$this->procat_name',procat_descrip='$this->procat_descrip'
			WHERE procat_id=" . $_POST["procat_id"];
			echo ($sql);

			$this->db->query($sql);
			return true;
		} else {
			$sql1 = "INSERT INTO product_category(`procat_name`,`procat_descrip`) 
			VALUE('$this->procat_name','$this->procat_descrip' )";
			$this->db->query($sql1);
			return true;
			exit;
		}
	}
	public function del($id)
	{
		$sql = "UPDATE product_category SET procat_stt='delete' WHERE procat_id=$id";
		$this->db->query($sql);
	}

	public function get_by_id($id)
	{	// to get a single p cat
		$sql = "SELECT * FROM product_category WHERE procat_id=$id";
		$res = $this->db->query($sql);
		$row = $res->fetch_array();
		return $row;
	}

	public function get_all()
	{

		$sql = "SELECT * FROM product_category WHERE procat_stt='Active'";
		$res = $this->db->query($sql);
		$numRows = $res->num_rows; // this will output the number of rows slelected in the database
		$a = array();
		if ($numRows) {
			
			while ($row = $res->fetch_array()) {
				$a[] =  $row;
			}
			
		}
		return $a;
	}
}
?>