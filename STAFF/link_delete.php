<?php
require('../fun.php');
if (!sessioncheck() or !$_SESSION['user']->isstaff) die('invalid authentication');
if (!isset($_GET['deleteid'])) die('invalid parameters');
$id = $_GET['deleteid'];
if (!is_numeric($id)) die('invalid input format');

$con = connect();
$q = "delete from `vids` where `id` = $id";
$res = mysqli_query($con, $q) or die("delete link query error");
mysqli_close($con);

if ($res){
    die("delete success");
}

?>$