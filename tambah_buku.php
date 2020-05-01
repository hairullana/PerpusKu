<?php

    //session start
    session_start();

    //belum login
    if ( !isset($_COOKIE["id"]) && !isset($_COOKIE["pengguna"])){
        if (  !isset($_SESSION["login"]) ){
            echo "
                <script>
                    alert('ANDA HARUS LOGIN TERLEBIH DAHULU !!!');
                    document.location.href = 'login.php';
                </script>
            ";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php include "_headtags.html"; ?>
        <title>Tambah Data Buku</title>
    </head>
    <body>

        <!-- navbar -->
        <?php include "_navbar.php"; ?>
        <!-- end navbar -->
        
        <!-- body -->
        <div class="row">
            <div class="col s6 offset-s3 card">
                <div class="col offset-s1">
                    <h3 class="header light center">Tambah Data buku</h3>
                    <br>
                    <form method="POST" action="save_data_buku.php" enctype="multipart/form-data" class="input-field inline">
                            <ul>
                                <li>
                                    <label for="no_buku">No Buku</label>
                                    <input type="text" size=60 name="no_buku" id="no_buku" required placeholder="No Buku">
                                </li>
                                <li>
                                    <label for="judul">Judul</label>
                                    <input type="text" size=60 name="judul" id="judul" required placeholder="Judul">
                                </li>
                                <li>
                                    <label for="penulis">Penulis</label>
                                    <input type="text" size=60 name="penulis" id="penulis" required placeholder="Penulis">
                                </li>
                                <li>
                                    <label for="penerbit">Penerbit</label>
                                    <input type="text" size=60 name="penerbit" id="penerbit" required placeholder="Penerbit">
                                </li>
                                <li>
                                    <label for="tahun">Tahun</label>
                                    <input type="text" size=60 name="tahun" id="tahun" required placeholder="Tahun">
                                </li>
                                <li>
                                    <div class="file-field input-field">
                                        <div class="btn red darken-1">
                                            <span>Cover</span>
                                            <input type="file" name="cover" id="cover">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="Upload Cover Buku">
                                        </div>
                                    </div>
                                <li>
                                    <div class="center">
                                        <button class="btn-large red darken-2" name="submit">Tambah Data</button>
                                    </div>
                                </li>
                            </ul>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- end body -->

        <!-- footer -->
        <?php include "_footer.php"; ?>
        <!-- end footer -->

    </body>
</html>
