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

<!-- data buku -->
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
<!-- end data buku -->