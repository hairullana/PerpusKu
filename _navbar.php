<nav class="red darken-1">
    <div class="container">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo"><i class="material-icons large">home</i> PerpusKu</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <?php
                        //jika sdh login
                        if ( isset($_COOKIE["id"]) && isset($_COOKIE["pengguna"]) || isset($_SESSION["login"])){
                            echo "
                                <i class='material-icons'>account_circle</i>
                            ";
                        }else {
                            echo "
                                <i class='material-icons'>account_circle</i>
                            ";
                        }
                    ?>
                </li>
                <li>
                    <?php
                        //jika sdh login
                        if ( isset($_COOKIE["id"]) && isset($_COOKIE["pengguna"]) || isset($_SESSION["login"])){
                            echo "
                                <a href='logout.php'>Logout</a>
                            ";
                        }else {
                            echo "
                                <a href='login.php'>Login</a>
                            ";
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>