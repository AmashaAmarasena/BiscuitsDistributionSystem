<?php
include_once("config.php");

	class stock{
	public $stock_id;
	public $stock_in;
	public $stock_out;
	public $date;
    public $store;
	public $stock_stt;
	public $fk_grnls_itmcode;
	
	public $db;
		
    function __construct(){
        $this->db = new mysqli(host,un,pw,db);
        }		
    }
?>
