<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog";

$con = new mysqli($host , $user , $pass ,$db);
if($con->connect_error)
{
    die("connection failed");
}

?>