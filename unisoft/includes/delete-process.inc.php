<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $process = $_REQUEST["processToDel"];
    }

    $sql = "DELETE FROM processes WHERE process='$process'";

    if(mysqli_query($conn, $sql)){
        echo $category;
        header('Location: ../process.php?action=Deleted');
    } else{
        echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
    }

?>