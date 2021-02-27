<?php 
$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Session.php");
Session::init();
include_once ($path . "/../lib/Database.php");
include_once ($path . "/../helper/Format.php");

class Job {
	public $email;
	public $password;

	public $db;
	public $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function updateRegisterJob($data) {
		$fld_payment_type = $this->fm->validation($data['fld_payment_type']);
		$fld_amount = $this->fm->validation($data['fld_amount']);
		$fld_total_files = $this->fm->validation($data['fld_total_files']);
		$fld_payment_status = $this->fm->validation($data['fld_payment_status']);

		$update_id = $this->fm->validation($data['update_id']);

		if ($fld_payment_type && $fld_amount) {
			$sql = "UPDATE `tbl_register_job` SET `fld_total_files` = '$fld_total_files', `fld_amount` = '$fld_amount', `fld_payment_type` = '$fld_payment_type', `fld_payment_status` = '$fld_payment_status' WHERE `id` = '$update_id'";
			$result = $this->db->update($sql);
			if ($result) {
				return '<div class="alert alert-success">Job updated successfully.</div>';
			} else {
				return '<div class="alert alert-warning">Job does not updated!</div>';
			}
		}
	}
	public function filteredJob($startdate, $enddate, $paymmentst) {
		$user_id = Session::get('user_id');
		if ($startdate == '' && $enddate == '' && $paymmentst == 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id'";
		} elseif ($startdate != '' && $enddate == '' && $paymmentst == 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_datetime` LIKE '$startdate%'";
		} elseif ($startdate == '' && $enddate != '' && $paymmentst == 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_datetime` LIKE '$enddate%'";
		} elseif ($startdate == '' && $enddate == '' && $paymmentst != 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_payment_status` = '$paymmentst'";
		} elseif ($startdate != '' && $enddate != '' && $paymmentst == 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_datetime` BETWEEN '$startdate' AND '$enddate'";
		} elseif ($startdate != '' && $enddate != '' && $paymmentst != 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_datetime` BETWEEN '$startdate' AND '$enddate' && `tbl_register_job`.`fld_payment_status` = '$paymmentst'";
		} elseif ($startdate != '' && $enddate == '' && $paymmentst != 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_datetime` LIKE '$startdate%' && `tbl_register_job`.`fld_payment_status` = '$paymmentst'";
		} elseif ($startdate == '' && $enddate != '' && $paymmentst != 'All') {
			$sql = "SELECT `tbl_register_job`.*, `tbl_main_services`.`fld_service_name`, `tbl_additional_services`.`fld_service_name` AS `fld_additional_service`
			FROM `tbl_register_job`
			LEFT JOIN `tbl_main_services` ON `tbl_register_job`.`fld_main_service` = `tbl_main_services`.`id`
			LEFT JOIN `tbl_additional_services` ON `tbl_register_job`.`fld_add_service` = `tbl_additional_services`.`id`
			WHERE `tbl_register_job`.`fld_user_id` = '$user_id' && `tbl_register_job`.`fld_datetime` LIKE '$enddate%' && `tbl_register_job`.`fld_payment_status` = '$paymmentst'";
		}
		$result = $this->db->select($sql);
		if ($result) {
			return $result;
		}
	}
}

?>