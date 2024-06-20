<?php

require_once '../config/conn.php';

if (isset($_SESSION['is_login'])) {
    header('Location: ' . BASEURL . '/view/dashboard.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>

<body>

    <h1>Login Akun</h1>
    <form action="../services/login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>


