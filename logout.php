<?php

    session_start();

    //dalam bbrp kasus session masih jika diberi session_desroy() saja
    $_SESSION = [];
    session_unset();
    session_destroy();

    //hapus cookie
    setcookie('pengguna', '', time() - 3600);
    setcookie('id', '', time() - 3600);

    echo "
        <script>
            document.location.href = 'index.php';
        </script>
    ";
    //header("Location: login.php");

?>