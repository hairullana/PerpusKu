<?php
    include '../functions.php';
    $keyword = $_GET["keyword"];
    $query = "SELECT * FROM buku WHERE 
            judul LIKE '%$keyword%' OR
            no_buku LIKE '%$keyword%' OR
            penulis LIKE '%$keyword%' OR
            penerbit LIKE '%$keyword%' OR
            tahun LIKE '%$keyword%'
            ";
    $buku = query($query);

?>

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