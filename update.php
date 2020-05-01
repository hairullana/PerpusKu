<?php

//session start
session_start();

//jika tidak set cookie
if ( !isset($_COOKIE["id"]) && !isset($_COOKIE["pengguna"])){
    //jika tidak ada session
    if ( !isset($_SESSION["login"])){
        echo "
            <script>
                alert('Kamu Belum Login');
                document.location.href = 'login.php';
            </script>
        ";
        exit;
    }
}

//jika diakses dari index.php
if (isset($_GET['no_buku'])){

    include 'connect_db.php';
    include 'functions.php';

    //ambil data di URL (GET)
    $no_buku = $_GET["no_buku"];
    //var_dump($no_buku);

    //fungsi memasukkan database ke array
    //outputnya array 2 dimensi dg indeks 0, jadi kasi [0] supaya otomatis menampilkan indeks ke-0
    $buku = query("SELECT * FROM buku WHERE no_buku = '$no_buku'")[0];
    //var_dump($buku["judul"]);
    //var_dump($buku[0]["judul"]); //kalau tanpa dikasi indeks di $buku = query()

    //fungsi upload
    function upload(){
        //data cover
        $size = $_FILES["cover"]["size"];
        $temp = $_FILES["cover"]["tmp_name"];
        $namaFile = $_FILES["cover"]["name"];
        $error = $_FILES["cover"]["error"];

        //CEK apakah gambar di upload ada gak
        if ( $error == 4 ) {
            echo "
            <script>
                alert('Masukkan Cover !');
            </script>
            ";
            return false;
        }

        //cek apakah file adalah gambar
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        // explode = memecah string menjadi array (dg pemisah delimiter)
        $ekstensiGambar = explode('.',$namaFile);
        //mengambil ekstensi gambar yg paling belakang dg strltolower (mengecilkan semua huruf)
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        //CEK $ekstensiGambar ada di array $ekstensiGambarValid
        if ( !in_array($ekstensiGambar,$ekstensiGambarValid) ){
            echo "
                <script>
                    alert('Cover Harus Gambar !');
                </script>
            ";
            return false;
        }

        //CEK ukuran file
        if ( $size > 3000000 ) {
            echo "
                <script>
                    alert('Ukuran Cover Terlalu Besar !');
                </script>
            ";
            return false;
        }

        //LOLOS CEK BROOO
        //generate nama baru random
        $namaFileBaru = uniqid().'.'.$ekstensiGambar;
        move_uploaded_file($temp,'cover/'.$namaFileBaru);

        return $namaFileBaru;
    }

    //FUNGSI UBAH
    function ubah($data){
        global $connect;

        $no_buku = htmlspecialchars($data["no_buku"]);
        $judul = htmlspecialchars($data["judul"]);
        $penulis = htmlspecialchars($data["penulis"]);
        $penerbit = htmlspecialchars($data["penerbit"]);
        $tahun = htmlspecialchars($data["tahun"]);
        $coverLama = htmlspecialchars($data["coverLama"]);

        //karena ditampung oleh $_FILES
        $cover = $_FILES["cover"];
        
        //cek apakah user update cover ???
        if ( $_FILES['cover']['error'] == 4 ){
            $cover = $coverLama;
        }else {
            $cover = upload();
        }
        

        $query = "UPDATE buku SET
            no_buku = '$no_buku',
            judul = '$judul',
            penulis = '$penulis',
            penerbit = '$penerbit',
            tahun = '$tahun',
            cover = '$cover'
            WHERE no_buku = '$no_buku'
            ";

        mysqli_query ($connect,$query);

        //return nilai (jumlah row database yg berubah)
        return mysqli_affected_rows($connect);
    }
    
    //cek apakah tombol submit sudah di klik atau belum
    if ( isset($_POST["submit"]) ){
        //cek apakah data berhasil diubah atau belum
        if ( ubah($_POST) > 0 ){

            echo "
                <script>
                    alert('Data Berhasil Diupdate !');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data Gagal Diupdate !');
                </script>
            ";
        }
    }
}

?>

<html>
    <head>
        <?php include "_headtags.html"; ?>
        <title>Update Data Buku</title>
    </head>
    <body>

        <!-- navbar -->
        <?php include "_navbar.php"; ?>
        <!-- end navbar -->

        <!-- body -->
        <div class="row">
            <div class="col s6 offset-s3 card">
                <div class="col offset-">

                    <h3 class="header light center">Update Data Buku</h3>
                    
                    <form method="POST" action="" enctype="multipart/form-data" class="input-field inline">
                        <input type="hidden" name="coverLama" value="<?= $buku["cover"] ?>">
                        <ul>
                            <li>
                                <div class="center">
                                    <img class="circle responsive-img" src="cover/<?= $buku['cover'] ?>" width=20% /> 
                                </div>
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
                            </li>
                            <li>
                                <label for="no_buku">ID Buku</label>
                                <input type="text" size=60 name="no_buku" id="no_buku" value="<?= $buku['no_buku'] ?>" required>
                            </li>
                            <li>
                                <label for="judul">Judul</label>
                                <input type="text" size=60 name="judul" id="judul" value="<?= $buku['judul'] ?>" required>
                            </li>
                            <li>
                                <label for="penulis">Penulis</label>
                                <input type="text" size=60 name="penulis" id="penulis" value="<?= $buku['penulis'] ?>" required>
                            </li>
                            <li>
                                <label for="penerbit">Penerbit</label>
                                <input type="text" size=60 name="penerbit" id="penerbit" value="<?= $buku['penerbit'] ?>" required>
                            </li>
                            <li>
                                <label for="tahun">Tahun Terbit</label>
                                <input type="text" size=60 name="tahun" id="tahun" value="<?= $buku['tahun'] ?>" required>
                            </li>
                            <li>
                                <div class="center">
                                    <button class="btn-large red darken-1" type="submit" name="submit">Tambah Data</button>
                                </div>
                            </li>
                        </ul>
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