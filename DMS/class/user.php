<?php
	include_once("config.php");

class user{
        public $user_id;
		public $user_name;
        public $user_psswd;
        public $user_stt;
		
		
		public $db;
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
            
            
		}		
        public function login(){
            $sql="select *from user where user_name='$this->user_name' and user_psswd='$this->user_psswd' and user_stt='Active' ";
            $rep=$this->db->query($sql);
            if($row=$rep->fetch_array()){
                session_start();
                $_SESSION["user"]=$row;
                return true;
            }
                return false;

        }



    }
        ?>