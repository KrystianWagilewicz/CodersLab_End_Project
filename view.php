<?php

session_start();

if (!isset($_SESSION['logged'])){
  header('Location: default.php');
  exit();
}

require_once 'connection.php';

  $sql = 'SELECT * FROM notice WHERE id=' .$_GET['id'];

  //sql result
  $result = mysqli_query($connect, $sql);
  //associative table so now we can use table column names
  $notice = $result->fetch_assoc();

  //place data from associative table to selected variable
  $id = $notice['id'];
  $title = $notice['title'];
  $description = $notice['description'];
  $user_folder = $notice['user_id'];
  $foto = $notice['foto'];
  $name = $notice['name'];
  $surname = $notice['surname'];
  $email = $notice['email'];

?>

<!DOCTYPE html>
<html>
 <head>
  <title>serch</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
  <div id="notice_info">
    <form>
      <label><h2>Notice details</h2></label>
      <p>Notice number: <?= $id ?></p>
      <p>Title: <?= $title ?></p>
      <p>Details: <?= $description ?></p>
      <img src="/Workspace/CodersLab_End_Project/user_data/<?= $user_folder ?>/<?= $foto ?>" height="250" width="250">
      <p>Contact: <?= $name ?> <?= $surname ?></p>
      <p>E-mail: <a href="mailto:<?= $email ?>?subject=Want%20to%20buy&body=I%20want%20to%20buy%20your%20item!">Send mail!</a></p>

    </form>
  </div>
 </body>
</html>
