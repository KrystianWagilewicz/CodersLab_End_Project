<?php

	session_start();

	if ( (!isset($_POST['login']) ) || (!isset($_POST['password'])) ) {
		header('Location: index.php');
		exit();
	}

	require_once "connection.php";

		$login = $_POST['login'];
		$password = $_POST['password'];

		$verify_sql = 'SELECT password FROM user_account WHERE email="'.$login.'"';

	  //sql result
	  $verify_result = mysqli_query($connect, $verify_sql);
	  //associative table so now we can use table column names
	  $verify_password = $verify_result->fetch_assoc();

	  //place data from associative table to selected variable
	  $hash = $verify_password['password'];

		if (password_verify($password, $hash)) {
			$sql = 'SELECT id , email FROM user_account WHERE email = "'.$login.'" ';

			//result of db query
			$result = mysqli_query($connect, $sql);

			$_SESSION['logged'] = true;

			//associative table so now we can use table column names
			$user_table = $result->fetch_assoc();

			//place data from associative table to selected variable
			$_SESSION['id'] = $user_table['id'];
			$_SESSION['email'] = $user_table['email'];

			unset($_SESSION['error']);

			//clear
			$result->free_result();
			header('Location: index.php');

		} else {
			$_SESSION['error'] = '<span style="color:red">Wrong login or password!</span>';
			header('Location: index.php');
		}
		$connect->close();
?>
