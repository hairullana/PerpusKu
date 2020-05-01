<?php
    //memulai session
    session_start();
    include 'connect_db.php';

    if ( isset($_COOKIE["pengguna"])){
        $_SESSION["login"] = true;
    }
    //jika sudah login kemudian ke halaman login.php
    if ( isset($_SESSION["login"]) ){
        header("Location : index.php");
        exit;
    }


    //jika tombol login dipencet
    if ( isset($_POST["login"]) ){
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $_SESSION["user"] = $user;

        //cek apakah ada username atau tidak
        $result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$user'");
        
        //jika ada username
        if ( mysqli_num_rows($result) === 1 ){   //fungsi menghitung jumlah baris di db
            
            //memasukkan data db ke array assosiative
            $data = mysqli_fetch_assoc($result);

            //cek apakah password sama
            if ( password_verify($pass, $data["password"]) ){
                //session login 
                $_SESSION["login"] = true;

                //jika remember me di checklist
                if ( isset($_POST["remember"]) ){
                    //buat cookie yg di hash
                    setcookie('id',$data['id'], time() + 60*60);
                    setcookie('pengguna',hash('sha256',$data['username']), time() + 60*60);
                }
                
            }
        }

        // if ( $_COOKIE['pengguna']){
        //     echo "
        //     <script>
        //         alert('cookie sdh dibuat');
        //         document.location.href = 'index.php';
        //     </script>
        // ";
        // }
        
        header("Location: index.php");
        exit;
        $error = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "_headtags.html"; ?>
    <title>Login Admin</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>

    <!-- navbar -->
    <?php include "_navbar.php"; ?>
    <!-- end navbar -->

    <!-- body -->
    <div class="row">
        <div class="card col s4 offset-s4">

            <h3 class="header light center">Login Admin</h3>
            <br>
    
    
        
            <?php if ( isset($error) ) : ?>
                <p style=" color:red;font-style:italic;">username atau password salah</p>
            <?php endif; ?>

            <form action="" method="post" class="center">
                <div class="input-field inline">
                    <ul>
                        <li>
                            <input size=40 type="text" name="username" id="username" placeholder="username">
                        </li>
                        <li>
                            <input size=40 type="password" name="password" id="password" placeholder="password">
                        </li>
                        <li>
                            <label for="remember">
                            <input class="checkbox" type="checkbox" name="remember" id="remember">
                            <span>Remember Me</span>
                            </label>
                        </li>
                        <br>
                        <li>
                            <div class="center">
                                <button class="btn-large red darken-1" type="submit" name="login">Login</button>
                            </div>
                        </li>
                    </ul>   
                </div>
            </form>
            <div class="center">Belum punya akun ? <a href="registrasi.php">Daftar Admin</a></div>
            <br>
        </div>
    </div>

    <!-- footer -->
    <?php include "_footer.php"; ?>
    <!-- end footer -->
</body>
</html>
