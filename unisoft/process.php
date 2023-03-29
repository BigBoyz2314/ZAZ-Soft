<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assests/styles.css">
    <title>Processes</title>
</head>
<body class="bg-dark text-warning">
    <?php 
        require_once('./includes/config.php');
    ?>
    <?php
    include('navbar.php');
    ?>
    <div class="container mt-5">
        <div class="row mt-5">
            <form action="./includes/add-process.inc.php" method="post" class="input-group">
                <h3>Add Process</h3>
                <div class="col-md-4">
                    <input type="text" name="process" id="process" placeholder="Process..." class="form-control">
                </div>
                <div class="col-md-1">
                    <input type="submit" value="Add Process" class="btn btn-success">
                </div>
        </div>
            </form>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-bordered w-100 text-warning text-center font-weight-bold" id="table">
                    <thead class="font-weight-bolder">
                        <th>Sr.</th>
                        <th>Process</th>
                        <!-- <th>Edit</th> -->
                        <th>Delete</th>
                    </thead>
                    <tbody class="text-light">
                        <?php
                            $stmt = "SELECT * FROM processes";
                            $result = $conn->query($stmt);
                            $i = 1;
    
                            if ($result->num_rows > 0) {
                                // output data of each row
                                
                                while($row = $result->fetch_assoc()) {
                                    $process = $row['process'];
                                    echo "<tr>";
                                    echo "<td>". $i++ ."</td>";
                                    echo "<td>$process</td>";
                                    echo "<td><form action='' method='get'><input type='hidden' name='processToDel' id='processToDel' value='$process'><button onClick='confirmation(".'"'.$process.'"'.")' type='submit' class='btn btn-danger'>Delete</button></form></td>";

                                    echo "</tr>";
    
                                }
                              }
                        ?>
                    </tbody>
            </table>
            </div>
        </div>
    </div>
    <script>
        function conDel() {
            confirm('Please confirm Deletion');
        }
        function confirmation(delName){
            var del=confirm("Are you sure you want to delete this record?\n"+delName);
            if (del==true){
                window.location.href="./includes/delete-process.inc.php?processToDel="+delName;
            }
            return del;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>