<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $process = $_REQUEST["del-pro"];
    }

    echo"$process";
?>