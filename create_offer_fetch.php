<?php

if(isset($_POST["action"])){
  require_once "connection.php";

  $output = '';

  if($_POST["action"] == "category"){
    $query = "SELECT subcategory FROM item_category WHERE category = '".$_POST["query"]."' GROUP BY subcategory";
    $result = mysqli_query($connect, $query);

    //ta kropka przed = musi być
    $output .= '<option value="">Select Subcategory</option>';

    while($row = mysqli_fetch_array($result)){
      //ta kropka przed = musi być
      $output .= '<option value="'.$row["subcategory"].'">'.$row["subcategory"].'</option>';
    }
  }
 echo $output;
}
?>
