<?php
session_start();
include('connect.php');
if (!isset($_SESSION['u_id'])) {
    header('Location:index.php');
    exit();
}

//this is for create psot
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION["u_id"];

    $query = "INSERT INTO posts(title,content,user_id) VALUES (?,?,?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();
}

// now for fetch post
$query = "SELECT * FROM posts WHERE user_id = ? ";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $_SESSION['u_id']);
$stmt->execute();
$posts = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>

<body>
    <form method="post">
        <input type="text" name="title" placeholder="Post Title" required>
        <textarea name="content" placeholder="Post Content">write here</textarea>
        <button type="submit" name="create">Add Post</button>
    </form>
</body>

</html>

<?php
// now to display psot
while ($post = $posts->fetch_assoc()):
?>
    <div>
        <h3>
            <?= htmlspecialchars($post['title']); ?>
        </h3>
        <p>
            <?= htmlspecialchars($post['content']); ?>
        </p>
        <a href="edit.php?id=<?= $post['id']; ?>">edit</a>
        <a href="delete.php?id=<?= $post['id']; ?>">delete</a>
    </div>
<?php endwhile ?>