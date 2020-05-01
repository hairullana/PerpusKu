<?php

include 'connect_db.php';

function query($query){
    global $connect;
    $result = mysqli_query($connect,$query);
    $rows = [];

    //memasukkan tiap data di db ke array sampai habis
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function cari($keyword){
    $query = "SELECT * FROM buku WHERE 
        judul LIKE '%$keyword%' OR
        no_buku LIKE '%$keyword%' OR
        penulis LIKE '%$keyword%' OR
        penerbit LIKE '%$keyword%' OR
        tahun LIKE '%$keyword%'
        ";
    return query($query);
}

?>