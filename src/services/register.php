<?php

require_once '../config/conn.php';

// http://localhost/app_inventori_barang/src/register/
$href = "document.location.href = '" . BASEURL . "/view/register.php'";

// cek apakah tombol register ditekan
if (isset($_POST['register'])) {
    // ambil data dari inputan
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_konfirmasi = $_POST['password-konfirmasi'];
    $role = $_POST['roles'];

    // cek email apakah telah tersedia di database
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = $connection->query($sql);
    if ($result->num_rows) {
        echo "
        <script>
            alert('Data email telah teregister')
            $href
        </script>";
        exit;
    }

    // cek password konfirmasi
    if ($password !== $password_konfirmasi) {
        echo "
        <script>
            alert('Password konfirmasi tidak sama')
            $href
        </script>";
        exit;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan data ke database
    $sql = "INSERT INTO users VALUES (
        NULL,
        '$name',
        '$email',
        '$password',
        '$role',
        NOW(),
        NOW())
    ";

    // cek apakah data berhasil masuk
    if ($connection->query($sql)) {
        echo "
        <script>
            alert('User berhasil registrasi')
            $href
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('User gagal registrasi')
            $href
        </script>";
        exit;
    }
}
