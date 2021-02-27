<?php 
$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Session.php");
Session::init();
include_once ($path . "/../lib/Database.php");
include_once ($path . "/../helper/Format.php");

class Service {
	public $email;
	public $password;

	public $db;
	public $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addService($table_name, $key, $value) {
		$value = $this->fm->validation($value);
		if ($value != '') {

			$service_check = "SELECT * FROM `$table_name` WHERE `$key` = '$value'";
			$service_check_result = $this->db->select($service_check);
			if ($service_check_result == NULL) {
				$sql = "INSERT INTO `$table_name`(`$key`) VALUES ('$value')";
				$result = $this->db->insert($sql);
				if ($result) {
					return 'success';
				} else {
					return 'failed';
				}
			} else {
				return 'exist';
			}
		} else {
			return 'empty';
		}
	}

	public function singleService($table_name, $id) {
		$id = $this->fm->validation($id);

		$sql = "SELECT * FROM `$table_name` WHERE `id` = '$id'";
		$result = $this->db->select($sql);
		return $result;
	}
	public function seenService($table_name, $key, $value) {
		$key = $this->fm->validation($key);
		$value = $this->fm->validation($value);

		$sql = "SELECT * FROM `$table_name` WHERE `$key` = '$value'";
		$result = $this->db->select($sql);
		return $result;
	}
	public function updateSeenService($table_name, $key, $value) {
		$key = $this->fm->validation($key);
		$value = $this->fm->validation($value);

		$sql = "UPDATE `$table_name` SET `$key` = '$value'";
		$result = $this->db->select($sql);
		return $result;
	}
	public function allServices($table_name) {
		$sql = "SELECT * FROM `$table_name` ORDER BY `id` DESC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function updateService($table_name, $key, $value, $id) {
		$value = $this->fm->validation($value);
		$id = $this->fm->validation($id);

		if ($value) {
			$service_check = "SELECT * FROM `$table_name` WHERE `$key` = '$value'";
			$service_check_result = $this->db->select($service_check);
			$self_service_check = "SELECT * FROM `$table_name` WHERE `id` = '$id'";
			$self_service_checks = $this->db->select($self_service_check);
			if ($self_service_checks) {
				$self_service_checked = $self_service_checks->fetch_assoc();
			}
			if ($service_check_result == NULL || $self_service_checked[$key] == $value) {
				$sql = "UPDATE `$table_name` SET `$key`= '$value' WHERE `id` = '$id'";
				$result = $this->db->update($sql);
				if ($result) {
					return 'success';
				} else {
					return 'failed';
				}
			} else {
				return 'exist';
			}
		} else {
			return 'empty';
		}
	}
	public function deleteService($table_name, $delete_id) {
		$delete_id = $this->fm->validation($delete_id);

		$sql = "DELETE FROM `$table_name` WHERE `id` = '$delete_id'";
		$result = $this->db->delete($sql);
		return $result;
	}
}

?>