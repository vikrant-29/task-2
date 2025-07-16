<?php
session_start();
include('connect.php');
if (!isset($_SESSION['u_id'])) {
    header('Location:index.php');
    exit();
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $post_id = $_POST['id'];
    $query = "UPDATE posts SET title = ?,content = ? WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssii", $title, $content, $post_id, $_SESSION['u_id']);
    $stmt->execute();
    header("Location:dashboard.php");
}

$post_id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id=? AND user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii",$post_id,$_SESSION['u_id']);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Post</title>
</head>
<body>
<form method="post">
    <input type="hidden" name="id" value="<?=$post['id'];?>">
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']);?>" required>
    <textarea name="content" required><?= htmlspecialchars($post['content']); ?></textarea>
    <button type="submit" name="update">update post</button>
</form>
</body>
</html>