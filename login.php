<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connection.php";

		$login = $_POST['login'];
		$password = $_POST['password'];

	  $sql = 'SELECT * FROM user_account WHERE email = "'.$login.'" AND password = "'.$password.'"';

		//result of db query
		if ($result = mysqli_query($connect, $sql))
		{
			//check how many records db will return
			$user_ammount = $result->num_rows;
			if($user_ammount>0){
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
		}
		$connect->close();
?>
