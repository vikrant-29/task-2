<?php
session_start();
include('connect.php');
if (!isset($_SESSION['u_id'])) {
    header('Location:index.php');
    exit();
}

$post_id = $_GET['id'];
$query = "DELETE FROM posts WHERE id = ? AND user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $post_id, $_SESSION['u_id']);
$stmt->execute();
header("Location:dashboard.php");
?>
