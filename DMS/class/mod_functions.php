<?php
	include_once("config.php");

class Mod_functions{
        public $function_id;
        public $function_name;
        public $function_status;
		
		public $db;

		//starting the db connetion
		
		function __construct(){
			$this->db = new mysqli(host,un,pw,db);
		}		
		

		public function get_all(){
			
			$sql = "select * from module_function where function_status='Active'";
			$res = $this->db->query($sql);
			$numRows = $res->num_rows; // this will output the number of rows slelected in the database
			if($numRows)
			{
				$a=array();
				while( $row = $res->fetch_array()){
					$a[] =  $row;
				}	
				return $a;
			}
		}

        public function get_granted_permission_by_role_id($role_id){
            $sql = "select * from module_staff_function where fk_role_id=$role_id";
			$res = $this->db->query($sql);
			$numRows = $res->num_rows; // this will output the number of rows slelected in the database
			if($numRows)
			{
				$a=array();
				while( $row = $res->fetch_array()){
					$a[] =  $row['fk_function_id'];
				}	
				return array_values($a);
			}
        }

        public function update_permission($request){
            $role_id = $request['role_id'];
            $sql = "DELETE FROM module_staff_function  WHERE fk_role_id=$role_id";
			$this->db->query($sql);

            if(isset($request['permission'])){
                foreach ($request['permission'] as $perm) {
                    $sql="INSERT INTO module_staff_function (fk_role_id,fk_function_id) VALUES('$role_id',$perm)";
				    $this->db->query($sql);
                }
            }
            return "Permission updated successfully";
        }

        function check_permision_for_currnt_user($permision_name, $need_to_redirect_to_unotharized_page=false){
            $logged_user_role = $_SESSION["staff"]['fk_role_id'];
            $sql = "SELECT * FROM module_staff_function WHERE fk_role_id ='$logged_user_role' AND `fk_function_id` = (SELECT function_id from module_function WHERE function_name='$permision_name')";
            $res = $this->db->query($sql);
            $row = $res->fetch_array();
            if(isset($row['staff_function_id'])){
                return true;
            }
            else{
                if($need_to_redirect_to_unotharized_page){
                    return '<script>  window.location.href="http://localhost/DMS/ui/pages/unotharized.php"; </script>';
                }
                return false;
            }
        }
	}
?>