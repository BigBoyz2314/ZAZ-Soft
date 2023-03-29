<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assests/styles.css">
    <title>Show Plans</title>
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
            <div class="col-md-6">
                <label for="seach">Search: </label>
                <input type="text" name="search" id="search" class="form-control w-50 d-inline ml-3" placeholder="Search Here...">
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="index.php"><button class="btn btn-info">Add Plan</button></a>
            </div>
        </div>
       <div class="row mt-5">
        <div class="col-md-12">
        <table class="table table-bordered w-100 text-warning text-center font-weight-bold" id="table">
                <thead class="font-weight-bolder">
                    <th>Sr.</th>
                    <th>Article Name</th>
                    <th>Plan No.</th>
                    <th>Lot No.</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Pairs</th>
                    <th>Warehouse</th>
                </thead>
                <tbody class="text-light">
                    <?php
                        $stmt = "SELECT * FROM plan_info";
                        $result = $conn->query($stmt);
                        $i = 1;

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>". $i++ ."</td>";
                                echo "<td>". $row["article_name"] ."</td>";
                                echo "<td>". $row["plan_no"] ."</td>";
                                echo "<td>". $row["lot_no"] ."</td>";
                                echo "<td>". $row["size"] ."</td>";
                                echo "<td>". $row["color"] ."</td>";
                                echo "<td>". $row["pairs"] ."</td>";
                                echo "<td>". $row["warehouse"] ."</td>";

                                echo "</tr>";

                            }
                          }
                    ?>
                </tbody>
        </table>
       </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
          $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table tbody tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
</body>
</html>