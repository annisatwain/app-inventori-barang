<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
</head>

<body>

    <h1>Register Akun</h1>
    <form action="../services/register.php" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name"><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="password-konfirmasi">Password Konfirmasi</label>
        <input type="password" name="password-konfirmasi" id="password-konfirmasi"><br>
        <label for="roles">Pilih Role</label>
        <select name="roles" id="roles">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="kasir">Kasir</option>
            <option value="user">User</option>
        </select><br>
        <button type="submit" name="register">Register</button>
    </form>

</body>

</html>