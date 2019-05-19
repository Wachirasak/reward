<?php
		//clear sessions
		session_start();

		if(isset($_SESSION['admin_id'])) {
			unset($_SESSION['admin_id']);
			unset($_SESSION['admin_usrname']);
			header("Location: admin_login.php");
		} else {
			header("Location: admin_login.php");
		}
?>
