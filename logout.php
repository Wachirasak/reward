<?php
		//clear sessions
		session_start();

		if(isset($_SESSION['usr_id'])) {
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_name']);
			unset($_SESSION['cart']);
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
?>
