
<!DOCTYPE html>
<html>
 <head>
  <title>serch</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/JavaScript" src="js/app.js"></script>
 </head>
 <body>
  <div id="serch_form">
    <?php

    require_once "connection.php";

    $category = '';

    $sql_category = "SELECT category FROM item_category GROUP BY category ORDER BY category ASC";
    $result = mysqli_query($connect, $sql_category);

    while($row = mysqli_fetch_array($result)){
     //ta kropka przed = musi być
     $category .= '<option value= "'.$row["category"].'" > '.$row["category"].' </option>';
    }
    ?>

    <form action="" method="post">
      <label><h2>Serch Notice</h2></label><br />
      Category: <select name="category" id="category" class="category_action">
        <option value="">Select Category</option>
        <?php echo $category; ?>
      </select><br /><br />
      Subcategory: <select name="subcategory" id="subcategory" class="subcategory">
        <option value="">Select Subcategory</option>
      </select><br /><br />
      <input type="submit" name="submit" value="Serch notice" /><br /><br/>
    </form>

    <?php

    require_once "connection.php";

    if ($connect->connect_errno!=0) {
      echo "Error: ".$connect->connect_errno;
    } else {

        if($_SERVER['REQUEST_METHOD']=='POST'){

          if(isset($_POST['submit'])){

            $category = $_POST['category'];
            $subcategory = $_POST['subcategory'];

            if( isset($category) && !empty($category) && empty($subcategory) ) {

              $serch_sql = "SELECT * FROM notice WHERE category = '$category'";
              $result_serch = mysqli_query($connect, $serch_sql);

              foreach ($result_serch as $row){
                $item_id = $row['id'];
                $item_title = $row['title'];

                echo'<a href="view.php?id='.$item_id.'" target="iframe_b">ID: '.$item_id.' Title: '.$item_title.'</a><br/>';
              }
            }

            if(isset($category) && !empty($category) && isset($subcategory) && !empty($subcategory)) {

              $serch_sql = "SELECT * FROM notice WHERE category = '$category' AND subcategory = '$subcategory' ";
              $result_serch = mysqli_query($connect, $serch_sql);

              foreach ($result_serch as $row){
                $item_id = $row['id'];
                $item_title = $row['title'];

                echo'<a href="view.php?id='.$item_id.'" target="iframe_b">ID: '.$item_id.' Title: '.$item_title.'</a><br/>';
              }
            }
          }
        }
    }
    ?>
  </div>
  <div id="view_form">
    <iframe height="560px" width="405px" frameborder="1" src="" name="iframe_b"></iframe>
  </div>
 </body>
</html>
