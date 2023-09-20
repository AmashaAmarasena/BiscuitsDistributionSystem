<?php
include_once("config.php");

class sup_invoice
{
	public $sup_invoice_id;
	public $sup_invoice_date;
	public $sup_invoice_note;
	public $sup_invoice_total_amount;
	public $sup_invoice_stt;
	public $sup_invoice_type;
	public $fk_sup_returns_id;

	public $db;

	function __construct()
	{
		$this->db = new mysqli(host, un, pw, db);
	}

	public function save()
	{
		$sql = "INSERT INTO sup_invoice(sup_invoice_date,sup_invoice_note,sup_invoice_total_amount,sup_invoice_type,fk_sup_returns_id) values('$this->sup_invoice_date','$this->sup_invoice_note','$this->sup_invoice_total_amount','$this->sup_invoice_type','$this->fk_sup_returns_id')";
		$this->db->query($sql);
		echo $sql;

    }
}
?>