<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login Page</title>
<link href="./xcrud/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="./xcrud/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<style>
.form-signin {
    margin: 0 auto;
    max-width: 330px;
    padding: 15px;
}
</style>
</head>

<body>
<div class="container">

<?php

include('include_dir.php');
include($percorso.'include/include.php');

/*define('DB_SERVER', 'prod-mysql2');
define('DB_USERNAME', 'starnoleggio');
define('DB_PASSWORD', 'smHvCt8e8QEvWamW');
define('DB_DATABASE', 'starnoleggio');*/

$db = mysqli_connect(costanti::DB_HOST,costanti::DB_USER,costanti::DB_PASSWORD,costanti::DB_NAME);
?>
<?php
session_start();
$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$myusername=mysqli_real_escape_string($db,$_POST['username']);
$mypassword=mysqli_real_escape_string($db,$_POST['password']);

$sql="SELECT id FROM admin WHERE username='$myusername' and passcode='$mypassword'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$active=$row['active'];
$count=mysqli_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
//session_register("myusername");
$_SESSION['myusername'];
$_SESSION['login_user']=$myusername;

header("location: ./gestionale/");
}
else
{
$error="<h2 style=\"color:red\">Utente o password non validi</h2><br>";
}
}

?>
      <form class="form-signin" action="" method="post">
      	<?=$error?>
        <h2 class="form-signin-heading">Area riservata</h2>
        <label for="inputEmail" class="sr-only">Utente</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Utente" required autofocus name="username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Memorizza i dati
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entra</button>
      </form>

    </div> <!-- /container -->
</body>
</html>
