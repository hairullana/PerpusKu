<?php
    include 'connect_db.php';

    function upload(){
        //data cover
        $ukuranFile = $_FILES["cover"]["size"];
        $temp = $_FILES["cover"]["tmp_name"];
        $namaFile = $_FILES["cover"]["name"];
        $error = $_FILES["cover"]["error"];

        //CEK apakah gambar di upload ada gak
        if ( $error == 4 ) {
            echo "
            <script>
                alert('Silahkan inputkan gambar !');
                document.location.href = 'tambah_buku.php';
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
                    alert('yang anda masukkan bukan gambar');
                    document.location.href = 'tambah_buku.php';
                </script>
            ";
            return false;
        }

        //CEK ukuran file
        if ( $ukuranFile > 3000000 ) {
            echo "
                <script>
                    alert('ukuran gambar terlalu besar');
                    document.location.href = 'tambah_buku.php';
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

    //data buku
    //fungsi htmlspecialchars agar tags html tidak di jalankan browser
    $no_buku = htmlspecialchars($_POST["no_buku"]);
    $judul = htmlspecialchars($_POST["judul"]);
    $penulis = htmlspecialchars($_POST["penulis"]);
    $penerbit = htmlspecialchars($_POST["penerbit"]);
    $tahun = htmlspecialchars($_POST["tahun"]);

    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO buku VALUES ('','$no_buku','$judul','$penulis','$penerbit','$tahun','$gambar')";
    mysqli_query($connect,$query);

    if ( mysqli_affected_rows($connect) > 0 ){
        echo "
            <script>
                alert('Data Berhasil Ditambahkan Njing !');
                document.location.href = 'index.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('".mysqli_error($connect)."');
            </script>
        ";
    }
    
?>