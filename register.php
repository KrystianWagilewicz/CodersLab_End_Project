<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticeboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <div id="register">
      <form action="" method="post">
        Name: <br /> <input type="text" name="name" /> <br />
      	Surname: <br /> <input type="text" name="surname" /> <br />
        E-mail: <br /> <input type="text" name="email" /> <br />
        Password: <br /> <input type="password" name="password1" /> <br />
        Confirm Password: <br /> <input type="password" name="password2" /> <br />
        <input type="submit" name="submit" value="Register" /><br />
      </form><br />
    </div>
  </div>
</body>
</html>

<?php
include_once 'connection.php';

if ($connect->connect_errno!=0){
  echo "Error: ".$connect->connect_errno;
} else {

  if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['submit'])){

      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $mail = $_POST['email'];
      $pass1 = $_POST['password1'];
      $pass2 = $_POST['password2'];

      $sql_check_user = "SELECT email FROM user_account WHERE email = '".$mail."'";
      $check_user_result = mysqli_query($connect, $sql_check_user);
      $user_in_db = $check_user_result->num_rows;

      if ($user_in_db == 0){

        if($pass1 == $pass2){
          if( isset($name) && !empty($name) && isset($surname) && !empty($surname) &&
              isset($mail) && !empty($mail) && isset($pass1) && !empty($pass1) &&
              isset($pass2) && !empty($pass2) ) {

                $sql = "INSERT INTO `user_account` (`name`, `surname`, `email`, `password`)
                  VALUES ('".$name."', '".$surname."', '".$mail."', '".md5($pass1)."');";

                $result = mysqli_query($connect, $sql);
                echo 'Account created !!!';

          } else {
            echo 'Some fields are not filled !!!';
          }
       } else {
        echo 'Confirmation password do not match !!!';
       }
     } else {
      echo 'User with this e-mail alredy exist in database';
     }
   }
 }
}
$connect->close();
