<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $process = $_REQUEST["edit-art-process"];
        $rate = $_REQUEST["edit-art-process-rate"];
        $article_name = $_REQUEST["article_name"];
        $category = $_REQUEST["category"];
        $size = $_REQUEST["size"];
        $bd = $_REQUEST["edit-art-process-bd"];
    }

     $sql ="UPDATE article_process SET process_rate = '$rate', breakdown = '$bd' WHERE processes = '$process' AND article_name = '$article_name' AND category = '$category' AND size = '$size'";
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../article-profile.php?view-profile='.$article_name.'+&select-size='.$size.'');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
?>