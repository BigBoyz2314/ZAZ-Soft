<?php
    require_once('config.php');
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $process = $_REQUEST["process"];
    }

    $stmt = "SELECT * FROM processes WHERE process='$process'";
    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();

    if ($process == $row['process']) {
        echo "Please Select New Process.";
    }
    else{

        $sql ="INSERT INTO processes VALUES ('', '$process')";
        
        if(mysqli_query($conn, $sql)){
            echo $category;
            header('Location: ../process.php');
        } else{
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }
    }
?>