<?php
    define('HOST','127.0.0.1');
    define('USER','root');
    define('PASS','');
    define('DB','barbearia');

    $conn = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_error($conn));

?>