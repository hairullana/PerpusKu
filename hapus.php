<?php
    require 'connect_db.php';

    //belum login
    if ( !isset($_COOKIE["id"]) || !isset($_COOKIE["pengguna"])){
        if (  !isset($_SESSION["login"]) ){
            echo "
                <script>
                    alert('Kamu Belum Login !');
                    document.location.href = 'login.php';
                </script>
            ";
        }
    }

    $no_buku = $_GET["no_buku"];
    $query_delete =  "DELETE FROM buku WHERE no_buku = '$no_buku'";
    $hapus = mysqli_query($connect,$query_delete);
    
    if ( $hapus ){
        echo "
            <script>
                alert('Data Berhasil Di Hapus !');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Gagal Di Hapus !');
                document.location.href = 'index.php';
            </script>
        ";
    }
?>