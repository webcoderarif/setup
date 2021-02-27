<?php 
$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Session.php");
Session::init();
include_once ($path . "/../lib/Database.php");
include_once ($path . "/../helper/Format.php");

class User {
	public $email;
	public $password;

	public $db;
	public $fm;

	public function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function userRegister($data) {
		$fld_fullname = $this->fm->validation($data['fld_fullname']);
		$fld_email = $this->fm->validation($data['fld_email']);
		$fld_password = $this->fm->validation($data['fld_password']);
		$reapet_password = $this->fm->validation($data['reapet_password']);
		$fld_source = $this->fm->validation($data['fld_source']);
		$fld_country = $this->fm->validation($data['fld_country']);
		$fld_ipaddress = $_SERVER['REMOTE_ADDR'];

		
		if ($fld_fullname && $fld_email && $fld_password && $reapet_password && $fld_country) {
			$email_check = "SELECT * FROM `tbl_user_info` WHERE `fld_email` = '$fld_email'";
			$email_check_result = $this->db->select($email_check);
			if ($email_check_result == NULL) {
				if ($fld_password == $reapet_password) {
					$fld_password = SHA1(MD5($fld_password));

					$sql = "INSERT INTO `tbl_user_info`(`fld_fullname`, `fld_email`, `fld_phone`, `fld_address`, `fld_country`, `fld_website`, `fld_password`, `fld_source`, `fld_ipaddress`) VALUES ('$fld_fullname', '$fld_email', '', '', '$fld_country', '', '$fld_password', '$fld_source', '$fld_ipaddress')";
					$result = $this->db->insert($sql);
					if ($result) {

						//---------------Email sender---------------

						$recipient = $db->recipient_email; //recipient 
						$email = $fld_email; //senders e-mail adress 
						
						$mail_body  = "New registered user details \r\n\n";
						$mail_body  = "--------------------------------------- \r\n";
						$mail_body  = "Name: $fld_fullname \r\n";
						$mail_body .= "Email: $fld_email \r\n";
						$mail_body .= "Country: $fld_country \r\n";
						$mail_body .= "Source: $fld_source \r\n\n";

						$subject = "1 New registration has been created"; //subject 
						$header = "From: New_Registration"; //optional headerfields 

						mail($recipient, $subject, $mail_body, $header); //mail command :) 

						//-------------Email Sender Ends------------
						
						
						//---------------Email sender - Client---------------

						$admin_mail = $this->db->recipient_email;

						$recipient = $fld_email; //recipient 
						$client_mail_body='';
						$client_mail_body .= "Dear $fld_fullname\r\n\n";
						$client_mail_body .= "Welcome to Clipping Path House (CPH) Graphics Ltd.\r\n";
						$client_mail_body .= "Your account has been created successfully with information given below.\r\n";
						$client_mail_body .= "Login Id: $fld_email\r\n";
						$client_mail_body .= "Password: $fld_password\r\n\n\n";
						$client_mail_body .= "There is no record of your password in our server.";
						$client_mail_body .= "So, keep it safe\r\n\n";
						$client_mail_body .= "Further information please contact\r\n";
						$client_mail_body .= "$admin_mail\r\n";
						$client_mail_body .= "Skype: cprh.graphics\r\n\n\n";
						$client_mail_body .= "------------------------------------------- \r\n";
						$client_mail_body .= "Thanks and regards\r\n";
						$client_mail_body .= "Clipping Path Retouching House Team\r\n";
						$client_mail_body .= "CPRH Graphics Ltd.\r\n\n";
						

						$subject = "Thanks for your registration at CPRH Graphics"; //subject 
						$header = "From: CPRH_Graphics"; //optional headerfields 
						mail($recipient, $subject, $client_mail_body, $header); //mail command :) 

						//-------------Email Sender - Client Ends------------

						return '<div class="alert alert-success">Account created successfully.</div>';
					} else {
						return '<div class="alert alert-warning">Account does not created!</div>';
					}
				} else {
					$this->password = '<div class="alert alert-warning mb-0">Reapet password does not match!</div>';
				}
			} else {
				$this->email = '<div class="alert alert-warning mb-0">This email has already been exist!</div>';
			}
		}

	}

	public function userLogin($data) {
		$email = $this->fm->validation($data['email']);
		$password = $this->fm->validation($data['password']);
		$fld_password = SHA1(MD5($password));

		if ($email !== '' && $password !== '') {
			$email_check = "SELECT * FROM `tbl_user_info` WHERE `fld_email` = '$email' && `fld_password` = '$fld_password'";
			$email_check_result = $this->db->select($email_check);
			if ($email_check_result != false) {
				$user_details = $email_check_result->fetch_assoc();
					Session::set('login', true);
					Session::set('user_id', $user_details['id']);
					Session::set('user_fullname', $user_details['fld_fullname']);
					Session::set('user_email', $user_details['fld_email']);
					Session::set('user_password', $user_details['fld_password']);
					header("Location: clients");
			} else {
				return '<div class="alert alert-warning">Email or Password is invalid!</div>';
			}
		}
	}

	public function passwordRecovery($data) {
		$email = $this->fm->validation($data['email']);

		if (!empty($email)) {
			$query = "SELECT * FROM `tbl_user_info` WHERE `fld_email` = '$email'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				$userId = $value['id'];
				$fullname = $value['fld_fullname'];

				$text = substr($email, 0, 5);
				$rand = rand(100000000, 999999999);
				$newpass = $text . $rand;
				$newhashpass = sha1(md5($newpass));



				$update_query = "UPDATE `tbl_user_info` SET `fld_password` = '$newhashpass' WHERE `id` = '$userId'";
				$update_result = $this->db->update($update_query);

				if ($update_result) {
					
					//---------------Email sender---------------

					$recipient = $email; //recipient 

					$Name = $fullname; //senders name 
					$admin_mail = $this->db->recipient_email;

					$mail_body  = "Dear $Name \r\n";
					$mail_body .= "Your new password: $newpass \r\n";
					$mail_body .= "Please change your password immediately after you get this mail. \r\n\n";
					$mail_body .= "If you face any problem about login to you account\r\n";
					$mail_body .= "Please contact us.\r\n";
					$mail_body .= "------------------------------------------- \r\n\n";
					$mail_body .= "Thanks and regards\r\n";
					$mail_body .= "Clipping Path Retouching House Team\r\n\n";
					$mail_body .= "CPRH Graphics Ltd.\r\n\n";
					$mail_body .= "Further information please contact\r\n";
					$mail_body .= "$admin_mail\r\n";
					$mail_body .= "Skype: cprh.graphics\r\n";
					
					$subject = "Password_Reset_(Confidential)"; //subject 
					$header = "From: CPRH_Graphics_Admin"; //optional headerfields 

					mail($recipient, $subject, $mail_body, $header); //mail command :) 

					//-------------Email Sender Ends------------


					$recoveryMsg = '<div class="alert alert-success mt-3">A new password has been sent to your email.</div>';
					return $recoveryMsg;
				} else {
					$recoveryMsg = '<div class="alert alert-warning mt-3">Failed to send recover password!</div>';
					return $recoveryMsg;
				}

				
			} else {
				$recoveryMsg = '<div class="alert alert-warning">Email Not Found!</div>';
				return $recoveryMsg;
			}
		} else {
			return '<div class="alert alert-warning">Please enter your email.</div>';
		}
	}

	public function userProfile($id) {
		$id = $this->fm->validation($id);
		$query = "SELECT * FROM `tbl_user_info` WHERE `id` = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function updateUser($data) {

		$user_id = Session::get('user_id');

		$fld_fullname = $this->fm->validation($data['fld_fullname']);
			
		$fld_phone = $this->fm->validation($data['fld_phone']);
		$fld_address = $this->fm->validation($data['fld_address']);
		$fld_website = $this->fm->validation($data['fld_website']);

		$old_file = $this->fm->validation($data['old_file']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $_FILES['image']['name'];
	    $file_size = $_FILES['image']['size'];
	    $file_temp = $_FILES['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $image = substr(md5(time()), 0, 10).'.'.$file_ext;

		if ($fld_fullname != '') {
			if ($file_name) {
				if ($file_size > 2097152) {
			     	return '<div class="alert alert-warning mb-0">Image Size should be less then 2MB!</div>';
			    } elseif (in_array($file_ext, $permited) === false) {
			     	return "<div class='alert alert-warning mb-0'>You can upload only:-"
			     .implode(', ', $permited)."</div>";
			    } else {
			    	$sql = "UPDATE `tbl_user_info` SET `fld_fullname`='$fld_fullname',`fld_phone`='$fld_phone',`fld_address`='$fld_address',`fld_website`='$fld_website',`fld_photo`='$image' WHERE `id` = '$user_id'";
			    	$result = $this->db->update($sql);
					if ($result) {
						if ($old_file > 0) {
							unlink("../uploadFiles/users/" . $old_file);
						}
				    	move_uploaded_file($file_temp, '../uploadFiles/users/' . $image);
						return '<div class="alert alert-success">Account updated successfully.</div>';
					} else {
						return '<div class="alert alert-warning">Account does not updated!</div>';
					}
			    }
			} else {
				$sql = "UPDATE `tbl_user_info` SET `fld_fullname`='$fld_fullname',`fld_phone`='$fld_phone',`fld_address`='$fld_address',`fld_website`='$fld_website' WHERE `id` = '$user_id'";
				$result = $this->db->update($sql);
				if ($result) {
					return '<div class="alert alert-success">Account updated successfully.</div>';
				} else {
					return '<div class="alert alert-warning">Account does not updated!</div>';
				}
			}
		}

	}


	public function changePassword($data) {
		$user_id = Session::get('user_id');
		$fld_password = Session::get('user_password');

		$old_password = $this->fm->validation($data['old_password']);

		$new_password = $this->fm->validation($data['new_password']);

		$confirm_password = $this->fm->validation($data['confirm_password']);


		if ($old_password && $new_password && $confirm_password) {
			$old_password = SHA1(MD5($old_password));
			if ($old_password == $fld_password) {
				if ($new_password == $confirm_password) {
					$new_password = SHA1(MD5($new_password));
					$query = "UPDATE `tbl_user_info` SET `fld_password` = '$new_password' WHERE `id` = '$user_id'";
					$result = $this->db->update($query);
					if ($result) {
						session_destroy();
						header("Location: ../authentication.php");
					} else {
						header("Location: profile.php?change_password=fail");
					}
				} else {
					header("Location: profile.php?change_password=confirm");
				}
			} else {
				header("Location: profile.php?change_password=old");
			}
		}
	}

	// all user list
	public function allUsers() {
		$sql = "SELECT * FROM `tbl_user_info` ORDER BY `id` DESC";
		$result = $this->db->select($sql);
		return $result;
	}
	public function deleteUser($delete_id) {
		$delete_id = $this->fm->validation($delete_id);
		$sql = "DELETE FROM `tbl_user_info` WHERE `id` = '$delete_id'";
		$result = $this->db->delete($sql);
		return $result;
	}

	// for administrator
	public $username;
	// public $password; already declared
	public function createAdministrator($data) {
		$fld_fullname = $this->fm->validation($data['fld_fullname']);
		$fld_username = $this->fm->validation($data['fld_username']);
		$fld_password = $this->fm->validation($data['fld_password']);
		$confirm_password = $this->fm->validation($data['confirm_password']);
		$fld_user_type = $this->fm->validation($data['fld_user_type']);

		if ($fld_fullname && $fld_username && $fld_password && $confirm_password && $fld_user_type) {
			$username_check = "SELECT * FROM `tbl_admin_user` WHERE `fld_username` = '$fld_username'";
			$username_check_result = $this->db->select($username_check);
			if ($username_check_result == NULL) {
				if ($fld_password == $confirm_password) {
					$fld_password = SHA1(MD5($fld_password));
					$sql = "INSERT INTO `tbl_admin_user`(`fld_fullname`, `fld_username`, `fld_password`, `fld_user_type`) VALUES ('$fld_fullname', '$fld_username', '$fld_password', '$fld_user_type')";
					$result = $this->db->insert($sql);
					if ($result) {
						return '<div class="alert alert-success mb-0">Account created successfully.</div>';
					} else {
						return '<div class="alert alert-warning mb-0">Account does not created!</div>';
					}
				} else {
					$this->password = '<div class="alert alert-warning mb-0">Confirm password does not mathc!</div>';
				}
			} else {
				$this->username = '<div class="alert alert-warning mb-0">This username has already been exist!</div>';
			}
		}

	}
	public function updateAdministrator($data) {
		$fld_fullname = $this->fm->validation($data['fld_fullname']);
		$fld_username = $this->fm->validation($data['fld_username']);
		$fld_user_type = $this->fm->validation($data['fld_user_type']);
		$id = $this->fm->validation($data['id']);

		if ($fld_fullname && $fld_username && $fld_user_type) {
			$username_check = "SELECT * FROM `tbl_admin_user` WHERE `fld_username` = '$fld_username'";
			$username_check_result = $this->db->select($username_check);
			$self_username_check = "SELECT * FROM `tbl_admin_user` WHERE `id` = '$id'";
			$self_username_checks = $this->db->select($self_username_check);
			if ($self_username_checks) {
				$self_username_checked = $self_username_checks->fetch_assoc();
			}
			if ($username_check_result == NULL || $self_username_checked['fld_username'] == $fld_username) {
				$sql = "UPDATE `tbl_admin_user` SET `fld_fullname` = '$fld_fullname', `fld_username` = '$fld_username', `fld_user_type` = '$fld_user_type' WHERE `id` = '$id'";
				$result = $this->db->update($sql);
				if ($result) {
					return '<div class="alert alert-success mb-0">Account updated successfully.</div>';
				} else {
					return '<div class="alert alert-warning mb-0">Account does not updated!</div>';
				}
			} else {
				$this->username = '<div class="alert alert-warning mb-0">This username has already been exist!</div>';
			}
		}

	}

	public function resetAdminPassword($reset_id) {
		$reset_id = $this->fm->validation($reset_id);

		if ($reset_id) {
			$password = SHA1(MD5('123456'));
			$sql = "UPDATE `tbl_admin_user` SET `fld_password` = '$password' WHERE `id` = '$reset_id'";
			$result = $this->db->update($sql);
			if ($result) {
				return '<hr><hr> <div class="alert alert-success mb-0">Password updated successfully.<br>New Password is 123456.</div> <hr><hr>';
			} else {
				return '<div class="alert alert-warning mb-0">Password does not updated!</div>';
			}
		}
	}

	public function adminLogin($data) {
		$fld_username = $this->fm->validation($data['fld_username']);
		$password = $this->fm->validation($data['fld_password']);
		$fld_password = SHA1(MD5($password));

		if ($fld_username !== '' && $password !== '') {
			$username_password_check = "SELECT * FROM `tbl_admin_user` WHERE `fld_username` = '$fld_username' && `fld_password` = '$fld_password'";
			$username_check_result = $this->db->select($username_password_check);
			if ($username_check_result != false) {
				$user_details = $username_check_result->fetch_assoc();
					Session::set('login', true);
					Session::set('admin_id', $user_details['id']);
					Session::set('admin_fullname', $user_details['fld_fullname']);
					Session::set('admin_username', $user_details['fld_username']);
					Session::set('admin_type', $user_details['fld_user_type']);
					Session::set('admin_password', $user_details['fld_password']);
					header("Location: index.php");
			} else {
				return '<div class="alert alert-warning">Username or Password is invalid!</div>';
			}
		}
	}

	public function adminChangePassword($data) {
		$user_id = Session::get('admin_id');
		$fld_password = Session::get('admin_password');

		$old_password = $this->fm->validation($data['old_password']);

		$new_password = $this->fm->validation($data['new_password']);

		$confirm_password = $this->fm->validation($data['confirm_password']);


		if ($old_password && $new_password && $confirm_password) {
			$old_password = SHA1(MD5($old_password));
			if ($old_password == $fld_password) {
				if ($new_password == $confirm_password) {
					$new_password = SHA1(MD5($new_password));
					$query = "UPDATE `tbl_admin_user` SET `fld_password` = '$new_password' WHERE `id` = '$user_id'";
					$result = $this->db->update($query);
					if ($result) {
						session_destroy();
						header("Location: login.php");
					} else {
						header("Location: change_password.php?change_password=fail");
					}
				} else {
					header("Location: change_password.php?change_password=confirm");
				}
			} else {
				header("Location: change_password.php?change_password=old");
			}
		}
	}

	public function checkexistuser(){

	$user_id = Session::get('user_id');

	$query = "SELECT * FROM `tbl_user_info` WHERE `id` = '$user_id'";
	        $result = $this->db->select($query);
	        if(mysqli_num_rows($result ) == 0){
	            session_destroy();
	            header("Location: ../authentication.php");
	        }
	}
}

?>