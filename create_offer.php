<?php

session_start();

if (!isset($_SESSION['logged'])){
  header('Location: default.php');
  exit();
}

require_once "connection.php";
require_once "create_folder.php";

    $serch_sql = "SELECT * FROM user_account WHERE id = '$id'";
    $result = mysqli_query($connect, $serch_sql);
    $row_user_data = $result->fetch_assoc();

    if($_SERVER['REQUEST_METHOD']=='POST'){

      if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $mail = $_POST['email'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $description = $_POST['description'];
        $file = $_FILES['fileToUpload']['name'];

        if( isset($name) && !empty($name) && isset($surname) && !empty($surname) &&
            isset($mail) && !empty($mail) && isset($category) && !empty($category) &&
            isset($subcategory) && !empty($subcategory) &&
            isset($description) && !empty($description) &&
            isset($_FILES['fileToUpload']) ) {

              $fileNewName = $name."_".$surname."_".$file; //zlepiamy nazwy z formularza w nową nazwę pliku
              $uploadfile = $filePath.basename($fileNewName); //tworzymy nową ścieżkę pliku, miejsce docelowe

              $sql = "INSERT INTO `notice` (`name`, `surname`, `email`, `title`, `category`, `subcategory`, `description`, `foto`, `user_id`)
                VALUES ('".$name."', '".$surname."', '".$mail."', '".$title."', '".$category."', '".$subcategory."', '".$description."', '".$fileNewName."', '".$id."');";

              $result = mysqli_query($connect, $sql);
              echo 'Notice created !!!';

              //use function for folder creating
              createFolderIfNotExists($filePath);

              //move file from temp folder to new one
              if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
                echo("File was successfully uploaded.\n");
              } else {
                echo("File was not uploaded !\n");
              }
        } else {
          echo '<span style="color:red">Some fields are not filled !!!</span>';
        }
      }
    }

$category = '';

$sql_category = "SELECT category FROM item_category GROUP BY category ORDER BY category ASC";
$result = mysqli_query($connect, $sql_category);

while($row = mysqli_fetch_array($result)){
 //this "." must be here for script working
 $category .= '<option value= "'.$row["category"].'" > '.$row["category"].' </option>';
}

?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <title>create</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/JavaScript" src="js/app.js"></script>
 </head>
 <body>
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
      <label><h2>Create new notice</h2></label><br/>
      Name: <br/> <input type="text" name="name" value="<?php echo $row_user_data['name']?>" /> <br/>
      Surname: <br/> <input type="text" name="surname" value="<?php echo $row_user_data['surname']?>" /> <br/>
      E-mail: <br/> <input type="text" name="email" style="width:210px;" value="<?php echo $row_user_data['email']?>" /> <br/><br/>
      Title: <br/> <input type="text" name="title" style="width:210px;" placeholder="short information about..." /> <br/><br/>
      Category: <select name="category" id="category" class="category_action">
        <option value="">Select Category</option>
        <?php echo $category; ?>
      </select><br/><br/>
      Subcategory: <select name="subcategory" id="subcategory" class="subcategory">
        <option value="">Select Subcategory</option>
      </select><br/><br/>
      Description: <br/> <input type="text" name="description" style="width:400px;" placeholder="information about your item" /> <br/><br/>
      <label>
          Add foto: <input type="file" name="fileToUpload">
      </label><br/><br/>
      <input type="submit" name="submit" value="Add your notice" /><br />
    </form>
  </div>
 </body>
</html>
