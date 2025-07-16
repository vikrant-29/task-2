<?php
include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $unm = $_POST['unm'];
    $passw = password_hash($_POST['passw'],PASSWORD_DEFAULT);

    $query = "INSERT INTO users(username,pass) VALUES (?,?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss",$unm,$passw);

    if($stmt->execute())
    {
        header("Location:index.php");
    }
    else
    {
        echo "failer in registration";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form method="post">
        <input type="text" name="unm" placeholder="Enter Username" required>
        <input type="password" name="passw" placeholder="Enter Password" required>
        <a href="index.php">Login</a>
        <button type="submit">Register</button>
    </form>
</body>
</html>