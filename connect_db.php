<?php
    $username = "root";
    $password = "";
    $server = "localhost";
    $db_name = "perpustakaan";

    $con = mysqli_connect($server, $username, $password);

    $database = "CREATE DATABASE IF NOT EXISTS perpustakaan";
    mysqli_query($con,$database);
    
    $connect = mysqli_connect($server, $username, $password, $db_name);

    $query = "CREATE TABLE IF NOT EXISTS buku (
        id_buku int AUTO_INCREMENT PRIMARY KEY,
        no_buku varchar(50) NOT NULL,
        judul varchar(50) NOT NULL,
        penulis varchar(50) NOT NULL,
        penerbit varchar(50) NOT NULL,
        tahun int NOT NULL,
        cover text NOT NULL
        )";

    mysqli_query($connect,$query);

    $query = "CREATE TABLE IF NOT EXISTS user (
        id int AUTO_INCREMENT PRIMARY KEY,
        username varchar(50) NOT NULL,
        password varchar(255) NOT NULL
        )";

    mysqli_query($connect,$query);
?>