<?php

session_start();

if (!isset($_SESSION['logged'])){
  header('Location: default.php');
  exit();
}

require_once 'connection.php';

if ($connect->connect_errno!=0) {
  echo "Error: ".$connect->connect_errno;
} else {

  $sql = 'SELECT * FROM notice WHERE id=' .$_GET['id'];

  //wyniki zapytania
  $result = mysqli_query($connect, $sql);
  //teraz zwroci tablice asocjacyjna i mozna odniesc sie do nazw kolumn
  $notice = $result->fetch_assoc();

  //zapisz do poniższych zmiennych odpowiednie dane z bazy, formularz zostanie nimi automatycznie wypełniony
  $id = $notice['id'];
  $title = $notice['title'];
  $description = $notice['description'];
  $user_folder = $notice['user_id'];
  $foto = $notice['foto'];
  $name = $notice['name'];
  $surname = $notice['surname'];
  $email = $notice['email'];

}
?>

<!DOCTYPE html>
<html>
 <head>
  <title>serch</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/JavaScript" src="js/app.js"></script>
 </head>
 <body>
  <div id="notice_info">
    <form>
      <label><h2>Notice details</h2></label>
      <p>Notice number: <?= $id ?></p>
      <p>Title: <?= $title ?></p>
      <p>Details: <?= $description ?></p>
      <img src="/Projekt_koncowy/user_data/<?= $user_folder ?>/<?= $foto ?>" height="250" width="250">
      <p>Contact: <?= $name ?> <?= $surname ?></p>
      <p>E-mail: <a href="mailto:<?= $email ?>?subject=Want%20to%20buy&body=I%20want%20to%20buy%20your%20item!">Send mail!</a></p>

    </form>
  </div>
 </body>
</html>
