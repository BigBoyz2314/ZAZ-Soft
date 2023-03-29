<?php
    require_once('config.php');
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $article_name = $_REQUEST["article"];
        $size = $_REQUEST["size"];
        $color = $_REQUEST["color"];
        $plan = $_REQUEST["plan"];
        $lot = $_REQUEST["lot"];
        $pairs = $_REQUEST["pairs"];
        $radio = $_REQUEST["radio"];
        
        // if ($_REQUEST["radio"]  = "other") {
        //     $radio = $_REQUEST["other-text"];
        // } else {
        //     $radio = $_REQUEST["radio"];
        // }
    }

    $sql ="INSERT INTO plan_info VALUES ('','$plan', '$article_name', '$size', '$color', '$lot', '$pairs', '$radio')";
    
//     if ($conn->query($sqlquery) === TRUE) {
//         echo "record inserted successfully";
//     } else {
//         echo "Error: " . $sqlquery . "<br>" . $conn->error;
// }

if(mysqli_query($conn, $sql)){
    echo "<h3>data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";

    echo nl2br("\n$plan\n $article_name\n "
        . "$size\n $color\n $lot\n $lot\n $pairs\n $radio");
        header('Location: ../show-plan.php');
} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
}

?>