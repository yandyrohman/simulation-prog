<?php
	
	error_reporting(0);
	// get type of crud
	$type['post'] = $_POST['crud'];
	$type['get'] = $_GET['crud'];

	#================== CRUD PROCESSOR ==================

	if ($type['post'] == "login") {

		$user = $_POST['username'];
		$pass = $_POST['password'];
		session_start();
		$_SESSION['popup'] = "yes";
		login($user,$pass);

	} elseif ($type['get'] == "logout") {

		session_start();
		session_destroy();
		header("location:../login");

	} elseif ($type['post'] == "register") {

		$user = $_POST['username'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		register($user,$email,$pass);
		
	} elseif ($type['post'] == "update") {

		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$tmp = $_FILES['image']['tmp_name'];
		$name = dirname(__FILE__)."/../assets/images/users/";

		// copy paste function
		unlink($name.$id.".png");
		move_uploaded_file($tmp, $name.$id.".png");
		update($id,$username,$password);
		header("location:../user");

	} elseif ($type['post'] == "process") {

		$learn = $_POST['learn'];
		$id = $_POST['id'];
		$status = $_POST['status'];

		session_start();
		$_SESSION[$learn."@".$id] = $status; 

		echo $_SESSION[$learn."@".$id];


	} elseif ($type['post'] == "processResult") {

		session_start();
		$learn = $_POST['learn'];
		$total = 0;
		$one = 5; // 5 * 20 = 100
		for ($i=1; $i < 21; $i++) {
			if (isset($_SESSION[$learn."@".$i])) {
				$check = $_SESSION[$learn."@".$i];
				if ($check == "yes") {
					$total = $total + $one;
				}
			}
		}

		echo $total;

	} elseif ($type['post'] == "closePopup") {
		session_start();
		$_SESSION['popup'] = "no";
	}

	#====================================================

	// login
	function login($user,$pass) {
		include "connect.php";
		$sql = mysqli_query($db, "SELECT * FROM users WHERE username = '$user' AND password = '$pass'");
		$check = mysqli_fetch_array($sql);
		if ($check) {

			// for admin
			$role = $check['role'];
			if ($role == "admin") {
				session_start();
				$_SESSION['user'] = $check['username'];
				$_SESSION['pass'] = $check['password'];
				$_SESSION['admin'] = $check['id_user'];
				header("location:../admin");
			}

			// for user
			else {
				session_start();
				$_SESSION['id'] = $check['id_user'];
				$_SESSION['user'] = $check['username'];
				$_SESSION['pass'] = $check['password'];
				header("location:../user");
			}

		} else {
			header("location:../index.php?msg=error");
		}
	};

	// register
	function register($user,$email,$pass) {
		include "connect.php";

		// get last user id
		$sql = mysqli_query($db, "SELECT * FROM users ORDER BY id_user DESC");
		$id = mysqli_fetch_array($sql);
		$id = $id['id_user'];
		$id = explode("-", $id);
		$id = $id[1];
		$id = $id + 1;

		$newId = "USER-".nullInc("00000", $id);

		mysqli_query($db, "INSERT INTO users VALUES ('$newId','$user','$pass','$email','user')");
		mysqli_query($db, "INSERT INTO quest_passed VALUES ('$newId',0,0,0,0,0)");

		header("location:../login?msg=regsuccess");

	};

	// update user
	function update($id,$username,$password) {

		include "connect.php";
		$one = mysqli_query($db, "UPDATE users SET username = '$username' WHERE id_user = '$id'");
		$two = mysqli_query($db, "UPDATE users SET password = '$password' WHERE id_user = '$id'");

	}
	
// answer process
	function process($table,$id,$userAnswer) {

		include "connect.php";
		$sql = mysqli_query($db, "SELECT * FROM $table WHERE id_quest = '$id'");
		$data = mysqli_fetch_array($sql);
		$answer = $data['answer'];

		// [answer to answer type]
		if ($answer == $userAnswer) {
			echo "true";
		} else {
			echo "false";
		}
		
	}

	// send information user tutorial passed
	function tutorPassed($learn,$id){

		include "connect.php";
		$sql = mysqli_query($db, "SELECT * FROM quest_passed WHERE id_user = '$id'");
		$data = mysqli_fetch_array($sql);
		$countLearn = $data[$learn];
		$countLearn = $countLearn + 1;
		$update = mysqli_query($db, "UPDATE quest_passed SET $learn = '$countLearn' WHERE id_user = '$id'");

	}

	// null number increment
	function nullInc($pattern,$int) {

		$nullPattern = $pattern;
		$patternLen = strlen($nullPattern);
		$strLen = strlen($int);

		$null = substr($nullPattern, 0, $patternLen - $strLen);

		return $newInt = $null.$int;

	}

?>