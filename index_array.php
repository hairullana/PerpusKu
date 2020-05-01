<!-- PAKAI MYSQLI_FETCH_ASSOC -->
<?php
    include 'connect_db.php';
    include 'functions.php';

    //fungsi memasukkan data di db ke array
    $buku = query("SELECT * FROM buku");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Selamat Datang di E-Perpus</title>
    </head>
    <body>
        <h1>Daftar Buku</h1>
        <a href="tambah_buku.php">Tambah Data Buku</a>
        <br/><br/>
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
            <?php
                $queryy = "SELECT * FROM buku";
                $query = mysqli_query($connect,$queryy);
            ?>
            <?php while ( $data_buku = mysqli_fetch_assoc($query) ) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="update.php?no_buku=<?= $data_buku['no_buku'] ?>">Update</a> |
                    <!-- fungsi js yg berfungsi untuk mengkonfirmasi tindakan -->
                    <a href="hapus.php?no_buku=<?= $data_buku['no_buku'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')";>Hapus</a> </td>
                <td><img width=50   height=50 src=<?= "'cover/".$data_buku['cover']."'" ?> /></td>
                <td><?= $data_buku["no_buku"]; ?></td>
                <td><?= $data_buku["judul"]; ?></td>
                <td><?= $data_buku["penulis"]; ?></td>
                <td><?= $data_buku["penerbit"]; ?></td>
                <td><?= $data_buku["tahun"]; ?></td>
            </tr>
            <?php  $i++; endwhile; ?>
        </table>
    </body>
</html>
