<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $material = $_REQUEST["add-art-material1"];
        $article_name = $_REQUEST["article_name"];
        $category = $_REQUEST["category"];
        $size = $_REQUEST["size"];
        $qty = $_REQUEST["add-mat-qty"];
        $rate = $_REQUEST["add-mat-rate"];
        $bd = $_REQUEST["add-mat-bd"];
    }

    $get_pro=mysqli_query($conn, "SELECT * from article_material1 WHERE article_name='$article_name' AND size='$size' AND category='$category' AND materials='$material'");
    if(mysqli_num_rows($get_pro)>0)
    {
    echo "Details Are Already Submitted";
    }
    else {

     $sql ="INSERT INTO article_material1 VALUES ('', '$article_name', '$size','$category','$material','','$rate','$bd','$qty')";
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../index.php?view-profile='.$article_name.'+&select-size='.$size.'');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
    }
?>