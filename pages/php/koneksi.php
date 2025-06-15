<?php
    $server = "localhost";
    $username = "root";
    $password = "";

    $koneksi = mysqli_connect($server,$username,$password);

    $database = "sapres";
    mysqli_select_db($koneksi,$database) or die ("Database tidak ditemukan");


?>