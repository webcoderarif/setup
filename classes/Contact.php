<?php 
$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Session.php");
Session::init();
include_once ($path . "/../lib/Database.php");
include_once ($path . "/../helper/Format.php");

class Contact {
	public $email;
	public $password;

	public $db;
	public $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insertContact($data) {
		$name = $this->fm->validation($data['name']);
		$email = $this->fm->validation($data['email']);
		$subject = $this->fm->validation($data['subject']);
		$message = $this->fm->validation($data['message']);

		$datetime = (gmstrftime("%Y-%m-%d %H:%M:%S"));

		
		if ($name && $email) {

			$sql = "INSERT INTO `tbl_contact`(`fld_name`, `fld_email`, `fld_subject`, `fld_message`, `fld_datetime`) VALUES ('$name', '$email', '$subject', '$message', '$datetime')";
			$result = $this->db->insert($sql);
			if ($result) {
				//---------------Email sender---------------

				$recipient = $db->recipient_email; //recipient 

				$Name = $name; //senders name 

				$mail_body  = "Name: $Name \r\n";
				$mail_body .= "Email: $email \r\n\n\n";
				$mail_body .= "$message \r\n";
				

				$subject = "$subject"; //subject 
				$header = "From: Contact_Mail"; //optional headerfields 

				mail($recipient, $subject, $mail_body, $header); //mail command :) 

				//-------------Email Sender Ends------------

				return '<div class="alert alert-success mt-3">Message sent successfully.</div>';
			} else {
				return '<div class="alert alert-warning">Message does not sent!</div>';
			}
		}
	}
	public function insertQuickQuery($data) {
		$name = $this->fm->validation($data['name']);
		$email = $this->fm->validation($data['email']);
		$message = $this->fm->validation($data['message']);

		$datetime = (gmstrftime("%Y-%m-%d %H:%M:%S"));

		
		if ($name && $email) {

			$sql = "INSERT INTO `tbl_quick_query`(`fld_name`, `fld_email`, `fld_message`, `fld_datetime`) VALUES ('$name', '$email', '$message', '$datetime')";
			$result = $this->db->insert($sql);
			if ($result) {
				//---------------Email sender---------------

				$recipient = $db->recipient_email; //recipient 

				$Name = $name; //senders name 

				$mail_body  = "Name: $Name \r\n";
				$mail_body .= "Email: $email \r\n\n\n";
				$mail_body .= "$message \r\n";
				

				$subject = "1 Quick query has been submitted"; //subject 
				$header = "From: Quick_Query"; //optional headerfields 

				mail($recipient, $subject, $mail_body, $header); //mail command :)

				//-------------Email Sender Ends------------

				return '<div class="alert alert-success mt-3">Message sent successfully.</div>';
			} else {
				return '<div class="alert alert-warning">Message does not sent!</div>';
			}
		}
	}
}

?>