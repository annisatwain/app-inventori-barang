<?php 
session_start();

define('BASEURL', 'http://localhost/app-inventori-barang/src');

$host = "localhost";
$username = "root";
$password = "12345";
$database = "project_mci_inventory";

// koneksi ke database
$connection = new mysqli($host, $username, $password, $database);

// cek koneksi database
if ($connection->connect_errno) {
    echo "Gagal terkoneksi ke database: " . $connection->connect_error;
    exit();
}
