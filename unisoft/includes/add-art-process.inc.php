<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $processes = $_REQUEST["add-art-process"];
        $article_name = $_REQUEST["article_name"];
        $category = $_REQUEST["category"];
        $size = $_REQUEST["size"];
        $rate = $_REQUEST["add-pro-rate"];
        $bd = $_REQUEST["add-pro-bd"];
    }

    $get_pro=mysqli_query($conn, "SELECT * from article_process WHERE article_name='$article_name' AND size='$size' AND category='$category' AND processes='$processes'");
    if(mysqli_num_rows($get_pro)>0)
    {
    echo "Details Are Already Submitted";
    }
    else {

     $sql ="INSERT INTO article_process VALUES ('', '$article_name', '$size','$category','$processes','$rate','$bd')";
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../article-profile.php?view-profile='.$article_name.'+&select-size='.$size.'');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
    }
?>