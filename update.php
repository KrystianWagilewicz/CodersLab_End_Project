<?php
session_start();

	if (!isset($_SESSION['logged']))
	{
		header('Location: default.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticeboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
  <div id="update_form">

    <?php

    require_once "connection.php";

    $id = $_SESSION['id'];
    $serch_sql = "SELECT * FROM user_account WHERE id = '$id'";
    $result = mysqli_query($connect, $serch_sql);
    $row = $result->fetch_assoc();

			if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['submit'])){

          $user_name = $_POST['name'];
          $surname = $_POST['surname'];
	  		  $user_email = $_POST['email'];
          $password = $_POST['password'];

          $sql = "UPDATE user_account SET name = '$user_name' , surname = '$surname' , email = '$user_email' , password = '$password' WHERE id = '$id'";

          $result1 = mysqli_query($connect, $sql);

          if ($result1) {
            echo "Record updated successfully wait for data reload !";
						//refresh page for data reload on page view
						echo "<meta http-equiv='refresh' content='2'>";
          } else {
            echo "Error updating record: " . mysqli_error($connect);
          }
          mysqli_close($connect);
        }
			}
    ?>

    <form action="" method="post">
      <label><h2>Update your data</h2></label><br />
        Name: <br /> <input type="text" name="name" value="<?php echo $row['name'] ?>"  /> <br />
        Surname: <br /> <input type="text" name="surname" value="<?php echo $row['surname'] ?>"  /> <br />
				E-mail: <br /> <input type="text" name="email" style="width:210px;" value="<?php echo $row['email'] ?>"  /> <br />
        Password: <br /> <input type="password" name="password" placeholder="password" /> <br /><br />
        <input type="submit" name="submit" value="Update profile" /><br />
    </form><br />
  </div>
</body>
</html>
