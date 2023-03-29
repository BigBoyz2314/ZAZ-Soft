<?php
    require_once('config.php');
?>

<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $article_name = $_REQUEST["add-article"];
        $category = $_REQUEST["category"];
        $size = $_REQUEST["size"];
        $market = $_REQUEST["add-market-name"];
        }

    $stmt = "SELECT * FROM data WHERE article_name='$article_name'";
    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();

    if ($category == "" || $size == "") {
        echo "Please Select a Category.";
    }
    elseif ($row['category'] == $category) {

        $sql ="INSERT INTO data VALUES ('','$article_name', '$size','$category','$market')";
        
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../article-profile.php?action=added');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
    }
    elseif ($row['category'] == '') {
        $sql ="INSERT INTO data VALUES ('', '$article_name', '$size','$category','$market')";
        
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../article-profile.php');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
    }
    else {
        echo "Please Select Correct Category.";
    }
?>