<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

include "connect_db.php";
include "functions.php";
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
if ( isset($_GET["page"])){
    $halamanAktif = $_GET["page"];
}else{
    $halamanAktif = 1;
}
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;
$buku = query("SELECT * FROM buku ORDER BY id_buku DESC LIMIT $awalData, $jumlahDataPerHalaman");

$print = '
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <title>Selamat Datang di E-Perpus</title>';

$print .= include "_headtags.html";

$print .= '
    </head>
    <body>';

$print .= '
        <!-- body -->
        <h3 class="header light center">Database Buku Perpustakaan</h3>
            
        <!-- data buku -->
        <div id="container">
            <div class="container">
                <div class="center">
                    <table cellpadding=10 class="responsive-table centered" border="1">
                        <tr>
                            <td style="font-weight:bold">No.</td>
                            <td style="font-weight:bold">Cover</td>
                            <td style="font-weight:bold">ID Buku</td>
                            <td style="font-weight:bold">Judul</td>
                            <td style="font-weight:bold">Penulis</td>
                            <td style="font-weight:bold">Penerbit</td>
                            <td style="font-weight:bold">Tahun Terbit</td>
                        </tr>';

                        $i = 1;
                        foreach ( $buku as $data_buku ) {

                        $print .= '
                            <tr>
                                <td>' . $i++ . '</td>
                                <td><img width=50 height=50 class="circle responsive-img" src="cover/' . $data_buku["cover"] . '" /></td>
                                <td>' . $data_buku["no_buku"] . '</td>
                                <td>' . $data_buku["judul"] . '</td>
                                <td>' . $data_buku["penulis"] . '</td>
                                <td>' . $data_buku["penerbit"] . '</td>
                                <td>' . $data_buku["tahun"] . '</td>
                            </tr>';
                        }

$print .= '
                    </table>
                </div>
            </div>
        </div>
        <!-- end data buku -->
        <!-- end body -->

        
    </body>
</html>
';




$mpdf->WriteHTML($print);
$mpdf->Output();