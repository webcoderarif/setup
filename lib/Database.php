<?php 
$path = realpath(dirname(__FILE__));
include_once ($path . "/../config/config.php");

class Database {
	public $host = DB_HOST;
	public $user = DB_USER;
	public $password = DB_PASS;
	public $db_name = DB_NAME;

	public $recipient_email = RECIPIENT_EMAIL;

	public $link;
	public $error;

	public function __construct() {
		$this->dbConnect();
	}

	public function dbConnect() {
		$this->link = new mysqli($this->host, $this->user, $this->password, $this->db_name);
		if (!$this->link) {
			$this->error = "Connection fail " . $this->link->connect_error;
			return false;
		}
	}
	public function select($query) {
		$result = $this->link->query($query) or die($this->link->error . __LINE__);
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return false;
		}
	}
	public function insert($query) {
		$result = $this->link->query($query) or die($this->link->error . __LINE__);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
	public function update($query) {
		$result = $this->link->query($query) or die($this->link->error . __LINE__);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
	public function delete($query) {
		$result = $this->link->query($query) or die($this->link->error . __LINE__);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
}

?>