<?php

	$host = "localhost";
	$db_user = "root";
	$db_password = "coderslab";
	$db_name = "noticeboard";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);

	//If connection with db is broken, show error number only
	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}

?>
