<?php
    //jika tidak set cookie atau cookie
    if ( isset($_COOKIE["id"]) && isset($_COOKIE["pengguna"]) || isset($_SESSION["login"])){
        echo "
            <script>
                alert('ANDA SUDAH LOGIN !!!');
                document.location.href = 'login.php';
            </script>
        ";
        //header("Location: login.php");
        exit;
    }

    include 'connect_db.php';

    function registrasi ($data) {
        global $connect;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($connect , $data["password"]);
        $password2 = mysqli_real_escape_string($connect , $data["password2"]);

        //cek username apakah ada yg sama
        $result = mysqli_query($connect, "SELECT username FROM user WHERE username = '$username'");
        if ( mysqli_fetch_assoc($result) ){ //jika ada (TRUE)
            echo "
                <script>
                    alert('username sudah terdaftar. CARI YANG LAIN !!');
                </script>
            ";
            return false; 
        }

        //cek konfirmasi password
        if ($password != $password2) {
            echo "
                <script>   
                    alert('password tidak sesuai !);
                </script>
            ";
            return false;
        }

        //enskripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        //var_dump($password); die;

        //masukkan data user ke db
        mysqli_query($connect, "INSERT INTO user VALUES ('','$username','$password')");

        return mysqli_affected_rows($connect);
    }

    if ( isset($_POST["registrasi"]) ){

        if ( registrasi($_POST) > 0 ) {
            echo "
                <script>
                    alert('Pendaftaran Berhasil !');
                    document.location.href = 'login.php';
                </script>
            ";
        }else {
            echo mysqli_error($connect);
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "_headtags.html" ?>
    <title>Registrasi Admin</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>

    <!-- navbar -->
    <?php include "_navbar.php" ?>
    <!-- end navbar -->

    <!-- body -->
    <div class="row">
        <div class="col s4 offset-s4 card">
            <h3 class="header light center">Registrasi Admin</h3>
            <br>
            <form action="" method="post">
                <ul>
                    <li>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </li>
                    <li>
                        <label for="password2">Re-type Password</label>
                        <input type="password" name="password2" id="password2" placeholder="Re-type Password">
                    </li>
                    <li>
                        <div class="center">
                            <button class="btn-large red darken-1" type="submit" name="registrasi">Sign Up</button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <!-- end body -->

    <!-- footer -->
    <?php include "_footer.php" ?>
    <!-- end footer -->
</body>
</html>