<?php 
$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Database.php");

class Format {
	public $db;

	public function __construct() {
		$this->db = new Database();
	}
	public function dateFormat($date) {
		return date("j-M-Y", strtotime($date));
	}
	public function textShorten($text, $limit) {
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, " "));
		$text = $text . "....";
		return $text;
	}
	public function validation($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($this->db->link, $data);
		return $data;
	}
	public function title() {
		$full_path = $_SERVER['SCRIPT_FILENAME'];
		$path = basename($full_path, ".php");
		$path = str_replace("_", " ", $path);
		$path = str_replace("-", " ", $path);
		if ($path = "index") {
			$title = "home";
		} else {
			$title = $path;
		}
		return ucwords($title);
	}
}

?>