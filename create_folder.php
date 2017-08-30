<?php
if (!isset($_SESSION['logged'])){
  header('Location: default.php');
  exit();
}

$id = $_SESSION['id'];

$filePath = "/home/kris/Workspace/CodersLab_End_Project/user_data/$id/";

function createFolderIfNotExists ($filePath){
  if (is_dir($filePath) == false)
  {
      mkdir ($filePath, 0777, true);
      chmod($filePath, 0777);
  }
}

?>
