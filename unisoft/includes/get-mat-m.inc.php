<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $material = $_REQUEST["mat"];
    }
    
    $sql = "SELECT * FROM materials WHERE material = '$material'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $measure = $row['measure'];

    echo $measure;

    // // $sql ="UPDATE article_process SET process_rate = '$rate', breakdown = '$bd' WHERE processes = '$process' AND article_name = '$article_name' AND category = '$category' AND size = '$size'";
        
    //     if(mysqli_query($conn, $sql)){
    //         echo $category;
    //         header('Location: ../article-profile.php?view-profile='.$article_name.'+&select-size='.$size.'');
    //     } else{
    //         echo "ERROR: Hush! Sorry $sql. "
    //         . mysqli_error($conn);
    //     }
?>