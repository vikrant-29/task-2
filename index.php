<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unm = $_POST['unm'];
    $pass = $_POST['pass'];

    $query = "SELECT id , pass FROM users where username = ? ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $unm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['u_id'] = $user['id'];
            header("Location:dashboard.php");
        } else {
            echo "Invalid Password !";
        }
    } else {
        echo "user not Found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>

<body>
    <form method="post">
        <input type="text" name="unm" placeholder="Enter Username" required>
        <input type="password" name="pass" placeholder="Enter Password" required>
        <button type="submit"> Login</button>
        <a href="register.php">new User ?</a>
    </form>
</body>

</html>
