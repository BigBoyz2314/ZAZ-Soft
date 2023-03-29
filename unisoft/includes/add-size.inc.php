<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $size = $_REQUEST["add-size"];
        $article_name = $_REQUEST["article_name"];
        $category = $_REQUEST["category"];
        $market = $_REQUEST["market_name"];
    }

    $stmt = "SELECT * FROM data WHERE article_name='$article_name'";
    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();

    if ($size == $row['size']) {
        echo "Please Select New Size";
    }
    else{

        $sql ="INSERT INTO data VALUES ('', '$article_name', '$size','$category','$market')";
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../article-profile.php');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
    }
?>