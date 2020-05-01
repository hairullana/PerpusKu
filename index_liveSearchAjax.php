<?php
    //session start
    session_start();    

    include 'connect_db.php';
    include 'functions.php';

    //konfirgurasi pagination
    $jumlahDataPerHalaman = 2;
    $jumlahData = count(query("SELECT * FROM buku"));
    //ceil() = pembulatan ke atas
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    //menentukan halaman aktif
    //$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
    if ( isset($_GET["page"])){
        $halamanAktif = $_GET["page"];
    }else{
        $halamanAktif = 1;
    }
    //data awal
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

    //fungsi memasukkan data di db ke array
    // $buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");
    $buku = query("SELECT * FROM buku");
    

    //ketika tombol cari ditekan
    if ( isset($_POST["cari"])) {
        $buku = cari($_POST["keyword"]);
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Selamat Datang di E-Perpus</title>
    </head>
    <body>
        <h1>Daftar Buku</h1>

        <?php
            //jika sdh login
            if ( isset($_COOKIE["id"]) && isset($_COOKIE["pengguna"]) || isset($_SESSION["login"])){
                echo "
                    <p><b><a href='logout.php'>Logout</a></b></p>
                ";
            }else {
                echo "
                    <p><b><a href='login.php'>Login</a></b></p>
                ";
            }
        ?>
        <p><a href="tambah_buku.php"><b>Tambah Data Buku</b></a></p>
        <br/><br/>
        <form action="" method="POST">
            <input type="text" size=40 name="keyword" placeholder="masukkan keyword pencarian" autofocus autocomplete="off" id="keyword">
            <button type="submit" name="cari" id="cariData">Cari Data</button>
        </form>
        <br/>
        
        <a href="?page=1">awal</a>

        <?php if( $halamanAktif > 1 ) : ?>
            <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?php endif; ?>

        <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
            <?php if( $i == $halamanAktif ) : ?>
                <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
            <?php else : ?>
                <a href="?page=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if( $halamanAktif < $jumlahHalaman ) : ?>
            <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
        <?php endif; ?>

        <a href="?page=<?= $jumlahHalaman; ?>">akhir</a>



        <div id="container">
        <table cellpadding=10 cellspacing=0 border=1>
            <tr>
                <th>No.</th>
                <th>Aksi</td>
                <th>Cover</th>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ( $buku as $data_buku ) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="update.php?no_buku=<?= $data_buku['no_buku'] ?>">Update</a> |
                    <!-- fungsi js yg berfungsi untuk mengkonfirmasi tindakan -->
                    <a href="hapus.php?no_buku=<?= $data_buku['no_buku'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')";>Hapus</a> </td>
                <td><img width=50   height=50    src=<?= "'cover/".$data_buku['cover']."'" ?> /></td>
                <td><?= $data_buku["no_buku"]; ?></td>
                <td><?= $data_buku["judul"]; ?></td>
                <td><?= $data_buku["penulis"]; ?></td>
                <td><?= $data_buku["penerbit"]; ?></td>
                <td><?= $data_buku["tahun"]; ?></td>
            </tr>
            <?php  $i++; endforeach; ?>
        </table>
        </div>
    </body>
    <script src="js/scriptAjax.js"></script>
</html>