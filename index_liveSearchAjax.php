<?php
    //session start
    session_start();    

    include 'connect_db.php';
    include 'functions.php';

    //konfirgurasi pagination
    $jumlahDataPerHalaman = 3;
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
        <?php include "_headtags.html"; ?>
        <title>Selamat Datang di E-Perpus</title>
    </head>
    <body>

        <!-- navbar -->
        <?php include "_navbar.php"; ?>
        <!-- end navbar -->

        <!-- body -->
        <h3 class="header light center">Database Buku Perpustakaan</h3>

        <div class="row">
            <div class="col s4 offset-s4">
            <br>
            <div class="center">
                <form action="" method="POST" class="input-field inline">
                    <input type="text" size=40 name="keyword" placeholder="masukkan keyword pencarian" autofocus autocomplete="off" id="keyword">
                    <button class="btn red darken-1" type="submit" name="cari" id="cariData"><i class="material-icons">search</i></button>
                </form>
            </div>
            <br>
        </div>

        <div class="row center">
            <div class="col s4 offset-s4 center">
                <a class="btn-floating pulse red darken-1" href="tambah_buku.php"><i class="material-icons">add</i></a>  <span class="light">Tambah Data Buku</span>
            </div>
        </div>
            
        <!-- pagination -->
        <div class="row center">
            <ul class="pagination">
                <li class="waves-effect">
                    <?php if( $halamanAktif > 1 ) : ?>
                        <a href="?page=<?= $halamanAktif - 1; ?>"><i class="material-icons">chevron_left</i></a>
                    <?php endif; ?>
                </li>
                <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                    <?php if( $i == $halamanAktif ) : ?>
                        <li class="active">
                            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php else : ?>
                        <li class="waves-effect">
                            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>   
                    <?php endif; ?>
                <?php endfor; ?>
                <li class="waves-effect">
                    <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                        <a href="?page=<?= $halamanAktif + 1; ?>"><i class="material-icons">chevron_right</i></a>
                    <?php endif; ?>
                </li>
            </ul>
        <div>
        <!-- end pagination -->



        <!-- data buku -->
        <div id="container">
            <div class="container">
                <div class="center">
                    <table cellpadding=10 class="responsive-table centered">
                        <tr>
                            <td style="font-weight:bold">No.</td>
                            <td style="font-weight:bold">Cover</td>
                            <td style="font-weight:bold">ID Buku</td>
                            <td style="font-weight:bold">Judul</td>
                            <td style="font-weight:bold">Penulis</td>
                            <td style="font-weight:bold">Penerbit</td>
                            <td style="font-weight:bold">Tahun Terbit</td>
                            <td style="font-weight:bold">Aksi</td>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ( $buku as $data_buku ) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><img width=50 height=50 class="circle responsive-img" src=<?= "'cover/".$data_buku['cover']."'" ?> /></td>
                            <td><?= $data_buku["no_buku"]; ?></td>
                            <td><?= $data_buku["judul"]; ?></td>
                            <td><?= $data_buku["penulis"]; ?></td>
                            <td><?= $data_buku["penerbit"]; ?></td>
                            <td><?= $data_buku["tahun"]; ?></td>
                            <td>
                                <a class="btn red darken-1" href="update.php?no_buku=<?= $data_buku['no_buku'] ?>"><i class="material-icons">edit</i></a>
                                <!-- fungsi js yg berfungsi untuk mengkonfirmasi tindakan -->
                                <a class="btn red darken-1" href="hapus.php?no_buku=<?= $data_buku['no_buku'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')";><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                        <?php  $i++; endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- end data buku -->
        <!-- end body -->

        <!-- footer -->
        <?php include "_footer.php"; ?>
        <!-- end footer -->

    </body>
    <script src="js/scriptAjax.js"></script>
</html>