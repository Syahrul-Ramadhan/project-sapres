<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "db_sapres";

    // $koneksi = mysqli_connect($server,$username,$password);

    // mysqli_select_db($koneksi,$database) or die ("Database tidak ditemukan");

    try {
    $koneksi = new PDO("mysql:host=$server;dbname=$database;charset=utf8mb4", $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $koneksi->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>