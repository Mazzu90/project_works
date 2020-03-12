<?php
require ('../xcrud/xcrud.php');
require ('html/pagedata.php');
/*
// PRODUZIONE
define('DB_SERVER', '89.46.111.32');
define('DB_USERNAME', 'Sql1035543');
define('DB_PASSWORD', 'b7115u4yy2');
define('DB_DATABASE', 'Sql1035543_1');
*/

// SVILUPPO
define('DB_SERVER', 'prod-mysql2');
define('DB_USERNAME', 'autounica');
define('DB_PASSWORD', '6ejZHsQwcX8795y5');
define('DB_DATABASE', 'autounica');

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

session_start();
$user_check=$_SESSION['login_user'];

$ses_sql=mysqli_query($db,"select username from admin where username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session=$row['username'];

if(!isset($login_session))
{
header("Location: ../");
}

$page = (isset($_GET['page']) && isset($pagedata[$_GET['page']])) ? $_GET['page'] : 'default';
extract($pagedata[$page]);

$file = dirname(__file__) . '/pages/' . $filename;
$code = file_get_contents($file);
include ('html/template.php');
