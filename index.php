<?php
	session_start();

  $session_status='';

	if (isset($_SESSION['logged']))
	{
    $session_status = $_SESSION['logged'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noticeboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script
			  src="https://code.jquery.com/jquery-3.2.1.js"
			  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
			  crossorigin="anonymous">
			</script>
		<script type="text/JavaScript" src="js/app.js"></script>
</head>
<body>
  <div id="container">

    <div id="title">
      <h1>Your Noticeboard</h1>
    </div>

    <div id="header">
      <div id="header1">
        <?php
          if($session_status==true){
        	  echo "<p>Welcome ".$_SESSION['email'].'! [ <a href="logout.php">Logout!</a> ]</p>';
          }
        ?>
      </div>
      <div id="header2">
        <a href="register.php" target="iframe_a">REGISTER</a>
      </div>
    </div>

    <div id="menu">
      <?php
        if($session_status==false){
          echo '<form action="login.php" method="post">
      		      Login: <br /> <input type="text" name="login" /> <br />
      		      Hasło: <br /> <input type="password" name="password" /> <br />
      		      <input type="submit" value="Login" /><br />
      	      </form><br />';
              if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
              }	else {
                echo '<br/>';
              }
          echo '<img src="img/17565425723383787465.jpg" alt="CodersLab" style="width:175px;height:450px;">';
        } else {
          echo '<p>YOUR MENU</p>
                <ul id="menu_list">
                  <li><a href="update.php" target="iframe_a">Update Profile</a></li>
                  <li><a href="user_offer.php" target="iframe_a">Your Offert</a></li>
                  <li><a href="create_offer.php" target="iframe_a">Add Offert</a></li>
                  <li><a href="serch.php" target="iframe_a">Serch Offerts</a></li>
                </ul>';
					echo '<img src="img/17565425723383787465.jpg" alt="CodersLab" style="width:175px;height:385px;">';
        }
      ?>
    </div>

    <div id="content">

			<iframe height="580px" width="780px" frameborder="0" src="default.php" name="iframe_a"></iframe>

    </div>

    <div id="footer">
      Noticeboard &copy; All rights reserved.
    </div>

  </div>
</body>
</html>
