<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $material = $_REQUEST["edit-art-material"];
        $rate = $_REQUEST["edit-art-material-rate"];
        $article_name = $_REQUEST["article_name"];
        $category = $_REQUEST["category"];
        $size = $_REQUEST["size"];
        $bd = $_REQUEST["edit-art-material-bd"];
        $mat = $_REQUEST["material"];
    }

    if ($mat = "material1") {

    
     $sql ="UPDATE article_material1 SET rate = '$rate', breakdown = '$bd' WHERE materials = '$material' AND article_name = '$article_name' AND category = '$category' AND size = '$size'";
        
    }
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../article-profile.php?view-profile='.$article_name.'+&select-size='.$size.'');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
?>