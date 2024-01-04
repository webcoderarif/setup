<?php 

$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Session.php");
Session::init();
include_once ($path . "/../lib/Database.php");
include_once ($path . "/../helper/Format.php");

class Common {
	public $db;
	public $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert($table, $data) {
		$sql = "INSERT INTO $table VALUES $data";
		$result = $this->db->insert($sql);
		
		return $result;
	}

	public function select($table, $cond = NULL) {
	    if ($cond != NULL) {
	        $sql = "SELECT * FROM $table WHERE $cond";
    		$result = $this->db->select($sql);
    		return $result;
	    } else {
	        $sql = "SELECT * FROM $table";
    		$result = $this->db->select($sql);
    		return $result;
	    }
	}

	public function sum($sum, $table, $cond) {
        $sql = "SELECT $sum FROM $table WHERE $cond";
		$result = $this->db->select($sql);
		return $result;
	}
	
	public function update($table, $data, $cond) {
		$sql = "UPDATE $table SET $data WHERE $cond";
		$result = $this->db->update($sql);
		return $result;
	}

	public function delete($table, $cond, $file = NULL) {
		$sql = "DELETE FROM $table WHERE $cond";
		$result = $this->db->delete($sql);
		
		if ($file != NULL) {
		    unlink($file);
		}
		return $result;
	}
    
}

?>