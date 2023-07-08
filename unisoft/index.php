<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assests/styles.css">
    <title>Article Profile</title>
</head>

<body class="bg-dark text-warning">

    <?php
    require_once('./includes/config.php');
    ?>
    <?php
    include('navbar.php');
    ?>
    
    <div class="container-fluid mt-5">
        <div class="row px-5">
            <form action="./includes/add-article.inc.php" method="post" class="input-group">
                <h3 class="me-4" id="add-article-head">Add Article</h3>
                <div class="col-md-3 me-2">
                    <input type="text" name="add-article" id="add-article" placeholder="Article ID..." class="form-control">
                </div>
                <div class="col-md-3 me-2">
                    <input type="text" name="add-market-name" id="add-market-name" placeholder="Article Name..." class="form-control">
                </div>
                <div class="col-md-1 me-2">
                    <input type="text" name="size" id="size" placeholder="Size..." class="form-control">
                </div>
                <div class="col-md-1 me-2">
                    <select name="category" id="category" class="form-select">
                        <option value="">Select...</option>
                        <?php
                        $stmt = "SELECT category FROM categories";
                        $result = $conn->query($stmt);
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <input type="submit" value="Add Article" class="btn btn-success">
                </div>
            </form>
        </div>
        <div class="row px-5 mt-3 align-items-center">
            <div class="col-md-6 me-2">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" class="d-flex align-items-center">
                        <h3 class="me-3 text-nowrap">View Profile</h3>
                    <input type="text" name="view-profile" id="view-profile" placeholder="Article ID..." class="form-select" list="articles">
                    <datalist id="articles">
                        <?php
                        $stmt = "SELECT DISTINCT article_name FROM data";
                        $result = $conn->query($stmt);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['article_name'] . "'>" . $row['article_name'] . "</option>";
                            }
                        }
                        ?>
                    </datalist>
                    <input type="submit" value="View Profile" class="btn btn-success ms-2">
                </div>
            </form>
            <?php
        
        error_reporting(E_ERROR | E_PARSE | E_NOTICE);
        
        if (empty($_GET)) {
            
        }
        else {
            $article_name = $_GET['view-profile'];
            $stmt = "SELECT * FROM data WHERE article_name='$article_name'";
            $result = $conn->query($stmt);
            $row = $result->fetch_assoc();
            $category = $row["category"];
            $market = $row["market_name"];
            echo'
                <div class="col-md-5">
                    <form action="" method="get" class="d-flex align-items-center">
                    <h3 class="text-nowrap me-2">Select Size</h3>
                    <input type="hidden" name="view-profile" value="'. $_GET['view-profile'] . '">
                    <select name="select-size" id="select-size" class="form-select ms-4">
                        <option value="">Select...</option>';

                        $stmt = "SELECT size FROM data WHERE article_name = '$article_name'";
                        $result = $conn->query($stmt);
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '<option value=' . $row['size'] .'>' . $row['size'] . '</option>';
                            }
                        }

                    echo"
                    </select>
                    <input type='submit' value='Get Details' class='btn btn-success ms-2'>
                </div>
                </form>";
                }
              ?>
        </div>
        
        <?php
        
        error_reporting(E_ERROR | E_PARSE | E_NOTICE);
        
        if (empty($_GET)) {
            
        }
        else {
            $article_name = $_GET['view-profile'];
            $stmt = "SELECT * FROM data WHERE article_name='$article_name'";
            $result = $conn->query($stmt);
            $row = $result->fetch_assoc();
            $category = $row["category"];
            $market = $row["market_name"];
            
            echo "
            <div class='row px-5 mt-3 align-items-center justify-content-between'>
                <div class='col-md-4 bg-light bg-opacity-50 rounded-4 text-center text-dark'>
                    <h5>Article ID:</h5>
                    <h4 class='text-primary-emphasis bg-light rounded-3'>" . $_GET['view-profile'] . "</h4> 
                </div>
                <div class='col-md-1 bg-light bg-opacity-50 rounded-4 text-center text-dark'>
                    <h5>Size:<h4>
                    <h4 class='text-primary-emphasis bg-light rounded-3'>". $_GET['select-size'] .  "</h4>
                </div>
                <div class='col-md-2 bg-light bg-opacity-50 rounded-4 text-center text-dark'>
                    <h5>Category:<h4>
                    <h4 class='text-primary-emphasis bg-light rounded-3'>$category</h4>
                </div>
                <div class='col-md-4 bg-light bg-opacity-50 rounded-4 text-center text-dark'>
                    <h5>Article Name:<h4>
                    <h4 class='text-primary-emphasis bg-light rounded-3'>$market</h4>
                </div>";
                echo"
            </div>
                <div class='row justify-content-center mt-3'>
                    <div class='col-md-2'>
                        <table class='table  text-center table-light'>
                            <tbody>
                                <th scope='row' class='bg-light opacity-50' colspan='2'>Size</th>";
                                
                                $stmt = "SELECT size FROM data WHERE article_name='$article_name'";
                                $result = $conn->query($stmt);
                                
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row['size']. "</td><td class='px-0'><button class='btn btn-danger'>Delete</button></td></tr>";
                                    }
                                }

                        echo "
                        <tr><td colspan='2'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Size'>
                            Add Size
                        </button></td></tr>
                        </tbody>
                        </table>";
                        echo "
                        <!-- Modal -->
                        <div class='modal fade text-dark' id='Add-Size' tabindex='-1' aria-labelledby='Add-Size' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered modal-sm'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='Add-Size'>Add Size</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                        </button>
                                    </div>
                                    <form action='./includes/add-size.inc.php' method='post'>
                                    <div class='modal-body'>
                                        <input type='hidden' name='article_name' value='$article_name'>
                                        <input type='hidden' name='category' value='$category'>
                                        <input type='hidden' name='market_name' value='$market'>
                                        <input type='text' name='add-size' class='form-control' placeholder='Size...'>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='submit' class='btn btn-primary' value='Add'>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>";
                            }
                    if ($_GET['select-size'] != '') {
                        # code...
                    echo"

                    <div class='col-md-4 h-25'>
                        <table class='table table-light text-center table-striped table-bordered border-dark-subtle table-responsive-md align-baseline'>
                            <tbody>
                                <tr class='bg-light opacity-50'><th>Sr.</th><th>Process / Labour</th><th>Rate</th><th></th></tr>";
                                $size = $_GET['select-size'];
                                $stmt = "SELECT * FROM article_process WHERE article_name='$article_name' AND size = '$size'";
                                $result = $conn->query($stmt);

                                $i=1;
                                
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr id='process-". $i ."'><td>".$i."</td><td id='process-name-". $i ."' class='text-start'>" . $row['processes']. "</td><td id='process-rate-". $i ."' data-bs-toggle='tooltip' data-bs-custom-class='fs-6' data-bs-placement='top' title='" . $row['breakdown'] . "'>". $row['process_rate'] ."</td><td id='process-id-". $i ."' class='px-0'><button type='button' id='edit-pro-". $i ."' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Process'>
                                            Edit    
                                        </button><p class='d-none' id='process-bd-". $i ."'>" . $row['breakdown'] ."</p></td></tr>";
                                        $i++;
                                    }
                                }
                            echo"
                            <tr><td colspan='4'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Process'>
                                Add Process
                            </button></td></tr>
                            </tbody>
                        </table>";
                            echo "

                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Edit-Process' tabindex='-1' aria-labelledby='Edit-Process' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Edit-Process'>Edit Process</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/edit-art-process.inc.php' method='post' id='editPro'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <h6>Process</h6>
                                            <input type='text' name='edit-art-process' id='edit-art-process' class='form-control' disabled'>
                                            <h6>Rate</h6>
                                            <input type='text' name='edit-art-process-rate' id='edit-art-process-rate' class='form-control'>
                                            <h6>Breakdown</h6>
                                            <input type='text' name='edit-art-process-bd' id='edit-art-process-bd' class='form-control'>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Edit'>
                                        </form>
                                        <form action='includes/del-art-process.inc.php' method='post'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='hidden' name='del-pro' id='delPro' value='$process'>
                                            <button type='submit' class='btn btn-danger'>Delete</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                            echo"
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Process' tabindex='-1' aria-labelledby='Add-Process' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Process</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-process.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <h6>Process</h6>
                                            <input type='text' name='add-art-process' class='form-select' id='add-pro' placeholder='Process' list='processes'>";
                                            echo'
                                            <datalist id="processes">';
                                            $stmt = "SELECT * FROM processes";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['process'] . "'>" . $row['process'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </datalist>';
                                            echo"
                                            <h6>Rate</h6>
                                            <input type='text' name='add-pro-rate' class='form-control' id='add-pro-rate' value='0'>
                                            <h6>Breakdown</h6>
                                            <input type='text' name='add-pro-bd' class='form-control' id='add-pro-bd' placeholder=''>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                            
                    <div class='col-md-4'>
                        <table class='table table-light text-center table-striped table-bordered border-dark-subtle'>
                            <tbody>
                                <tr class='bg-light opacity-50'>
                                <th>Sr.</th>
                                <th>Cutting Dept.</th>
                                <th>Qty.</th>
                                <th>Rate</th>
                                <th></th>
                                </tr>";
                                $size = $_GET['select-size'];
                                $stmt = "SELECT * FROM article_material1 WHERE article_name='$article_name' AND size = '$size'";
                                $result = $conn->query($stmt);

                                $i=1;
                                
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr id='material1-". $i ."'><td>".$i."</td><td id='material1-name-". $i ."'>" . $row['materials']. "</td><td id='material1-qty-". $i ."'>" . $row['qty']. "</td><td id='material1-rate-". $i ."' data-bs-toggle='tooltip' data-bs-custom-class='fs-6' data-bs-placement='top' title='" . $row['breakdown'] . "'>". $row['rate'] ."</td><td id='material1-id-". $i ."' class='px-0'><button type='button' id='edit-mat1-". $i ."' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Material1'>
                                            Edit    
                                        </button><p class='d-none' id='material1-bd-". $i ."'>" . $row['breakdown'] ."</p></td></tr>";
                                        $i++;
                                    }
                                }
                            echo"
                            <tr><td colspan='5'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Material-1'>
                                Add Material
                            </button></td></tr>
                            </tbody>
                            </table>";

                                echo "

                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Edit-Material1' tabindex='-1' aria-labelledby='Edit-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Edit-Process'>Edit Material 1</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/edit-art-material.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='hidden' name='material' value='material1'>
                                            <h6>Material</h6>
                                            <input type='text' name='edit-art-material' id='edit-art-material1' class='form-control' disabled'>
                                            <h6>Rate</h6>
                                            <input type='text' name='edit-art-material-rate' id='edit-art-material1-rate' class='form-control'>
                                            <h6>Breakdown</h6>
                                            <input type='text' name='edit-art-material-bd' id='edit-art-material1-bd' class='form-control'>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Edit'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>";

                            echo "
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Material-1' tabindex='-1' aria-labelledby='Add-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Material 1</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-material1.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='text' name='add-art-material1' class='form-select' id='mat1' placeholder='Material' list='materials'>";
                                            echo'
                                            <datalist id="materials">';
                                            $stmt = "SELECT * FROM materials";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['material'] . "'>" . $row['material'] . "</option>";
                                                }
                                            } 

                                            echo'
                                            </datalist>';
                                            echo"
                                            <h6>Measure</h6>
                                            <input type='text' name='add-mat-m' class='form-control' id='add-mat1-m' value='' hidden>
                                            <input type='text' name='show-mat-m' class='form-control' id='show-mat1-m' value='' disabled>
                                            <h6>Amount by Measure</h6>
                                            <input type='number' name='add-mat-a-m' class='form-control' id='add-mat1-a-m' value='1'>
                                            <h6>Quantity</h6>
                                            <input type='text' name='add-mat-qty' class='form-control' id='add-mat1-qty' value='1'>
                                            <h6>Rate Per Pair</h6>
                                            <input type='text' name='show-mat-rate' class='form-control' id='show-mat1-rate' value='0' disabled>
                                            <input type='text' name='add-mat-rate' class='form-control' id='add-mat1-rate' value='0' hidden>
                                            <h6>Breakdown</h6>
                                            <input type='text' name='add-mat-bd' class='form-control' id='add-pro-bd' placeholder=''>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='row justify-content-center'>
                    <div class='col-md-4'>
                        <table class='table table-light text-center table-striped table-bordered border-dark-subtle'>
                            <tbody>
                                <tr class='bg-light opacity-50'>
                                <th>Sr.</th>
                                <th>Stitching Dept.</th>
                                <th>Qty.</th>
                                <th>Rate</th>
                                <th></th>
                                </tr>";
                                $size = $_GET['select-size'];
                                $stmt = "SELECT * FROM article_material2 WHERE article_name='$article_name' AND size = '$size'";
                                $result = $conn->query($stmt);
                                $i = 1;
                                
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr><td>$i</td><td>" . $row['materials']. "</td><td>" . $row['qty']. "</td><td>". $row['rate'] ."</td><td class='px-0'><button type='button' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Material2'>
                                            Edit
                                        </button></td></tr>";
                                        $i++;
                                    }
                                }
                            echo"
                            <tr><td colspan='5'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Material-2'>
                                Add Material
                            </button></td></tr>
                            </tbody>
                            </table>";

                                echo "

                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Edit-Material2' tabindex='-1' aria-labelledby='Edit-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Edit-Process'>Edit Material 2</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/edit-art-process.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <select name='edit-material2' id='edit-mat2' class='form-select'>";
                                            $stmt = "SELECT * FROM article_material2 WHERE article_name='$article_name' AND size = '$size'";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['materials'] . "'>" . $row['materials'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </select>';
                                            echo"

                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Edit'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>";

                            echo "
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Material-2' tabindex='-1' aria-labelledby='Add-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Material 2</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-material2.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='text' name='add-art-material' class='form-select' id='mat2' placeholder='Material' list='materials'>";
                                            echo'
                                            <datalist id="materials">';
                                            $stmt = "SELECT * FROM materials";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['material'] . "'>" . $row['material'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </datalist>';
                                            echo"
                                            <h6>Measure</h6>
                                            <input type='text' name='add-mat-m' class='form-control' id='add-mat2-m' value='' hidden>
                                            <input type='text' name='show-mat-m' class='form-control' id='show-mat2-m' value='' disabled>
                                            <h6>Amount by Measure</h6>
                                            <input type='number' name='add-mat-a-m' class='form-control' id='add-mat2-a-m' value='1'>
                                            <h6>Quantity</h6>
                                            <input type='text' name='add-mat-qty' class='form-control' id='add-mat2-qty' value='1'>
                                            <h6>Rate Per Pair</h6>
                                            <input type='text' name='show-mat-rate' class='form-control' id='show-mat2-rate' value='0' disabled>
                                            <input type='text' name='add-mat-rate' class='form-control' id='add-mat2-rate' value='0' hidden>
                                            <h6>Breakdown</h6>
                                            <input type='text' name='add-mat-bd' class='form-control' id='add-pro-bd' placeholder=''>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                <div class='col-md-4'>
                <table class='table table-light text-center table-striped table-bordered border-dark-subtle'>
                    <tbody>
                        <tr class='bg-light opacity-50'>
                        <th>Sr.</th>
                        <th>Packing Dept.</th>
                        <th>Qty.</th>
                        <th>Rate</th>
                        <th></th>
                        </tr>";
                        $size = $_GET['select-size'];
                        $stmt = "SELECT * FROM article_material3 WHERE article_name='$article_name' AND size = '$size'";
                        $result = $conn->query($stmt);
                        $i = 1;
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>$i</td><td>" . $row['materials']. "</td><td>" . $row['qty']. "</td><td>". $row['rate'] ."</td><td class='px-0'><button type='button' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Material3'>
                                    Edit
                                </button></td></tr>";
                                $i++;
                            }
                        }
                    echo"
                    <tr><td colspan='5'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Material-3'>
                        Add Material
                    </button></td></tr>
                    </tbody>
                    </table>";

                        echo "

                    <!-- Modal -->
                    <div class='modal fade text-dark' id='Edit-Material3' tabindex='-1' aria-labelledby='Edit-Material' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-sm'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='Edit-Process'>Edit Material 3</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                    </button>
                                </div>
                                <form action='./includes/edit-art-process.inc.php' method='post'>
                                <div class='modal-body'>
                                    <input type='hidden' name='article_name' value='$article_name'>
                                    <input type='hidden' name='category' value='$category'>
                                    <input type='hidden' name='size' value='$size'>
                                    <select name='edit-material3' id='edit-mat3' class='form-select'>";
                                    $stmt = "SELECT * FROM article_material3 WHERE article_name='$article_name' AND size = '$size'";
                                    $result = $conn->query($stmt);
                                    
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['materials'] . "'>" . $row['materials'] . "</option>";
                                        }
                                    } 
                                    echo'
                                    </select>';
                                    echo"

                                </div>
                                <div class='modal-footer'>
                                    <input type='submit' class='btn btn-primary' value='Edit'>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>";

                            echo "
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Material-3' tabindex='-1' aria-labelledby='Add-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Material 3</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-material3.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='text' name='add-art-material' class='form-select' placeholder='Material' list='materials'>";
                                            echo'
                                            <datalist id="materials">';
                                            $stmt = "SELECT * FROM materials";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['material'] . "'>" . $row['material'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </datalist>';
                                            echo"
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-4'>
                    <table class='table table-light text-center table-striped table-bordered border-dark-subtle'>
                    <tbody>
                        <tr class='bg-light opacity-50'>
                        <th>Sr.</th>
                        <th>Overhead</th>
                        <th>Qty.</th>
                        <th>Rate</th>
                        <th></th>
                        </tr>";
                        $size = $_GET['select-size'];
                        $stmt = "SELECT * FROM article_material4 WHERE article_name='$article_name' AND size = '$size'";
                        $result = $conn->query($stmt);
                        $i = 1;
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>$i</td><td>" . $row['materials']. "</td><td>" . $row['qty']. "</td><td>". $row['rate'] ."</td><td class='px-0'><button type='button' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Material4'>
                                    Edit
                                </button></td></tr>";
                                $i++;
                            }
                        }
                    echo"
                    <tr><td colspan='5'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Material-4'>
                        Add Material
                    </button></td></tr>
                    </tbody>
                    </table>";

                        echo "

                    <!-- Modal -->
                    <div class='modal fade text-dark' id='Edit-Material4' tabindex='-1' aria-labelledby='Edit-Material' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-sm'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='Edit-Process'>Edit Material 4</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                    </button>
                                </div>
                                <form action='./includes/edit-art-process.inc.php' method='post'>
                                <div class='modal-body'>
                                    <input type='hidden' name='article_name' value='$article_name'>
                                    <input type='hidden' name='category' value='$category'>
                                    <input type='hidden' name='size' value='$size'>
                                    <select name='edit-material4' id='edit-mat4' class='form-select'>";
                                    $stmt = "SELECT * FROM article_material4 WHERE article_name='$article_name' AND size = '$size'";
                                    $result = $conn->query($stmt);
                                    
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['materials'] . "'>" . $row['materials'] . "</option>";
                                        }
                                    } 
                                    echo'
                                    </select>';
                                    echo"

                                </div>
                                <div class='modal-footer'>
                                    <input type='submit' class='btn btn-primary' value='Edit'>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>";
                            echo "
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Material-4' tabindex='-1' aria-labelledby='Add-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Material 4</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-material4.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='text' name='add-art-material' class='form-select' placeholder='Material' list='materials'>";
                                            echo'
                                            <datalist id="materials">';
                                            $stmt = "SELECT * FROM materials";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['material'] . "'>" . $row['material'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </datalist>';
                                            echo"
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-4'>
                    <table class='table table-light text-center table-striped table-bordered border-dark-subtle'>
                    <tbody>
                        <tr class='bg-light opacity-50'>
                        <th>Sr.</th>
                        <th>PU & Lasting</th>
                        <th>Qty.</th>
                        <th>Rate</th>
                        <th></th>
                        </tr>";
                        $size = $_GET['select-size'];
                        $stmt = "SELECT * FROM article_material5 WHERE article_name='$article_name' AND size = '$size'";
                        $result = $conn->query($stmt);
                        $i = 1;
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>$i</td><td>" . $row['materials']. "</td><td>" . $row['qty']. "</td><td>". $row['rate'] ."</td><td class='px-0'><button type='button' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Material5'>
                                    Edit
                                </button></td></tr>";
                                $i++;
                            }
                        }
                    echo"
                    <tr><td colspan='5'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Material-5'>
                        Add Material
                    </button></td></tr>
                    </tbody>
                    </table>";

                        echo "

                    <!-- Modal -->
                    <div class='modal fade text-dark' id='Edit-Material5' tabindex='-1' aria-labelledby='Edit-Material' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-sm'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='Edit-Process'>Edit Material 5</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                    </button>
                                </div>
                                <form action='./includes/edit-art-process.inc.php' method='post'>
                                <div class='modal-body'>
                                    <input type='hidden' name='article_name' value='$article_name'>
                                    <input type='hidden' name='category' value='$category'>
                                    <input type='hidden' name='size' value='$size'>
                                    <select name='edit-material5' id='edit-mat5' class='form-select'>";
                                    $stmt = "SELECT * FROM article_material5 WHERE article_name='$article_name' AND size = '$size'";
                                    $result = $conn->query($stmt);
                                    
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['materials'] . "'>" . $row['materials'] . "</option>";
                                        }
                                    } 
                                    echo'
                                    </select>';
                                    echo"

                                </div>
                                <div class='modal-footer'>
                                    <input type='submit' class='btn btn-primary' value='Edit'>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>";
                            echo "
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Material-5' tabindex='-1' aria-labelledby='Add-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Material 5</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-material5.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='text' name='add-art-material' class='form-select' placeholder='Material' list='materials'>";
                                            echo'
                                            <datalist id="materials">';
                                            $stmt = "SELECT * FROM materials";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['material'] . "'>" . $row['material'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </datalist>';
                                            echo"
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-4'>
                    <table class='table table-light text-center table-striped table-bordered border-dark-subtle'>
                    <tbody>
                        <tr class='bg-light opacity-50'>
                        <th>Sr.</th>
                        <th>Special</th>
                        <th>Qty.</th>
                        <th>Rate</th>
                        <th></th>
                        </tr>";
                        $size = $_GET['select-size'];
                        $stmt = "SELECT * FROM article_material6 WHERE article_name='$article_name' AND size = '$size'";
                        $result = $conn->query($stmt);
                        $i = 1;
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>$i</td><td>" . $row['materials']. "</td><td>" . $row['qty']. "</td><td>". $row['rate'] ."</td><td class='px-0'><button type='button' class='btn btn-warning fs-6' data-bs-toggle='modal' data-bs-target='#Edit-Material6'>
                                    Edit
                                </button></td></tr>";
                                $i++;
                            }
                        }
                    echo"
                    <tr><td colspan='5'><button type='button' class='btn btn-primary w-100 fs-6' data-bs-toggle='modal' data-bs-target='#Add-Material-6'>
                        Add Material
                    </button></td></tr>
                    </tbody>
                    </table>";

                        echo "

                    <!-- Modal -->
                    <div class='modal fade text-dark' id='Edit-Material6' tabindex='-1' aria-labelledby='Edit-Material' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-sm'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='Edit-Process'>Edit Material 6</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                    </button>
                                </div>
                                <form action='./includes/edit-art-process.inc.php' method='post'>
                                <div class='modal-body'>
                                    <input type='hidden' name='article_name' value='$article_name'>
                                    <input type='hidden' name='category' value='$category'>
                                    <input type='hidden' name='size' value='$size'>
                                    <select name='edit-material6' id='edit-mat6' class='form-select'>";
                                    $stmt = "SELECT * FROM article_material6 WHERE article_name='$article_name' AND size = '$size'";
                                    $result = $conn->query($stmt);
                                    
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['materials'] . "'>" . $row['materials'] . "</option>";
                                        }
                                    } 
                                    echo'
                                    </select>';
                                    echo"

                                </div>
                                <div class='modal-footer'>
                                    <input type='submit' class='btn btn-primary' value='Edit'>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>";
                            echo "
                            <!-- Modal -->
                            <div class='modal fade text-dark' id='Add-Material-6' tabindex='-1' aria-labelledby='Add-Material' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered modal-sm'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='Add-Process'>Add Material 6</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                            </button>
                                        </div>
                                        <form action='./includes/add-art-material6.inc.php' method='post'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='article_name' value='$article_name'>
                                            <input type='hidden' name='category' value='$category'>
                                            <input type='hidden' name='size' value='$size'>
                                            <input type='text' name='add-art-material' class='form-select' placeholder='Material' list='materials'>";
                                            echo'
                                            <datalist id="materials">';
                                            $stmt = "SELECT * FROM materials";
                                            $result = $conn->query($stmt);
                                            
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['material'] . "'>" . $row['material'] . "</option>";
                                                }
                                            } 
                                            echo'
                                            </datalist>';
                                            echo"
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-primary' value='Add'>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                ";
            }
            ?>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script>

            const buttons = document.getElementsByTagName("button");
            var btn;
            const buttonPressed = e => {
            console.log(e.target.id);  // Get ID of Clicked Element
            var btn = e.target.id;
            //process edit
            if (btn.includes('edit-pro')) {

                let val = btn.slice(9);
                var proNameId = "process-name-"+ val;
                var proRateId = "process-rate-"+ val;
                var proBdId = "process-bd-"+ val;
                console.log(val);

                var proNameEdit = document.querySelector("#edit-art-process");
                var proNameDel = document.querySelector("#DelPro");
                var proName = document.querySelector("#"+proNameId);
                proNameEdit.setAttribute("value", proName.innerText);

                var proRateEdit = document.querySelector("#edit-art-process-rate");
                var proRate = document.querySelector("#"+proRateId);
                proRateEdit.setAttribute("value", proRate.innerText);

                var proBdEdit = document.querySelector("#edit-art-process-bd")
                var proBd = document.querySelector("#"+proBdId);
                proBdEdit.setAttribute("value", proBd.innerText);
                console.log(proBd);
            }
            //material1 edit
            else if (btn.includes('edit-mat1')) {
                let val = btn.slice(10);
                var mat1NameId = "material1-name-"+ val;
                var mat1RateId = "material1-rate-"+ val;
                var mat1BdId = "material1-bd-"+ val;
                console.log(val);

                var mat1NameEdit = document.querySelector("#edit-art-material1");
                var mat1Name = document.querySelector("#"+mat1NameId);
                mat1NameEdit.setAttribute("value", mat1Name.innerText);

                var mat1RateEdit = document.querySelector("#edit-art-material1-rate");
                var mat1Rate = document.querySelector("#"+mat1RateId);
                mat1RateEdit.setAttribute("value", mat1Rate.innerText);

                var mat1BdEdit = document.querySelector("#edit-art-material1-bd")
                var mat1Bd = document.querySelector("#"+mat1BdId);
                mat1BdEdit.setAttribute("value", mat1Bd.innerText);
                console.log(proBd);
            }
            }

            for (let button of buttons) {
            button.addEventListener("click", buttonPressed);
            }

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

            function confirmation(delName){
            var del=confirm("Are you sure you want to delete this record?\n"+delName);
            if (del==true){
                window.location.href="./includes/delete-process.inc.php?processToDel="+delName;
            }
            return del;
            }  
            
            $(document).ready(function(){
                // Material 1 data

                // $("#mat1").change(function(e){
                //     $mat = $("#mat1").val();
                //     $.ajax({    
                //         type: "POST",
                //         url: "includes/get-mat-info.inc.php",
                //         data: {
                //             "mat" : $mat 
                //         },       
                //         dataType: "html",                  
                //         success: function(data){                    
                //             $("#add-mat1-rate").val(data);
                //             $("#show-mat1-rate").val(data);
                            
                //             $("#add-mat1-qty").change(function(e){
                //                 $qty = $("#add-mat1-qty").val();
                //                 $newrate = $qty * data;
                //                 $("#add-mat1-rate").val($newrate);
                //                 $("#show-mat1-rate").val($newrate);
                //             });
                //         }
                //     });
                // });

                $("#mat1").change(function(e){
                    $mat = $("#mat1").val();
                    $.ajax({    
                        type: "POST",
                        url: "includes/get-mat-m.inc.php",
                        data: {
                            "mat" : $mat 
                        },       
                        dataType: "html",                  
                        success: function(data){                    
                            $("#add-mat1-m").val(data);
                            $("#show-mat1-m").val(data);
                            $("#add-mat1-a-m").val(1);

                            $.ajax({    
                                type: "POST",
                                url: "includes/get-mat-rate.inc.php",
                                data: {
                                    "mat" : $mat 
                                },       
                                dataType: "html",                  
                                success: function(data){
                                    $("#add-mat1-rate").val(data);
                                    $("#show-mat1-rate").val(data);
                                    $("#add-mat1-a-m").change(function(e){
                                        $rate = data;
                                        $amount = $("#add-mat1-a-m").val();
                                        $qty =  $rate / $amount / $rate;
                                        $price = $qty * $rate;

                                        $("#add-mat1-qty").val($qty);

                                        $("#add-mat1-rate").val($price);
                                        $("#show-mat1-rate").val($price);
                                    });
                                }
                            });
                        }
                    });
                });

                // Material 2 data old
                // $("#mat2").change(function(e){
                //     $mat = $("#mat2").val();
                //     $.ajax({    
                //         type: "POST",
                //         url: "includes/get-mat-info.inc.php",
                //         data: {
                //             "mat" : $mat 
                //         },       
                //         dataType: "html",                  
                //         success: function(data){                    
                //             $("#add-mat2-rate").val(data);
                //             $("#show-mat2-rate").val(data);
                //                 $("#add-mat2-qty").change(function(e){
                //                 $qty = $("#add-mat2-qty").val();
                //                 $newrate = $qty * data;
                //                 $("#add-mat2-rate").val($newrate);
                //                 $("#show-mat2-rate").val($newrate);
                //             });
                //         }
                //     });
                // });

                // Material 2 data
                $("#mat2").change(function(e){
                    $mat = $("#mat2").val();
                    $.ajax({    
                        type: "POST",
                        url: "includes/get-mat-m.inc.php",
                        data: {
                            "mat" : $mat 
                        },       
                        dataType: "html",                  
                        success: function(data){                    
                            $("#add-mat2-m").val(data);
                            $("#show-mat2-m").val(data);
                            $("#add-mat2-a-m").val(1);

                            $.ajax({    
                                type: "POST",
                                url: "includes/get-mat-rate.inc.php",
                                data: {
                                    "mat" : $mat 
                                },       
                                dataType: "html",                  
                                success: function(data){
                                    $("#add-mat2-rate").val(data);
                                    $("#show-mat2-rate").val(data);
                                    $("#add-mat2-a-m").change(function(e){
                                        $rate = data;
                                        $amount = $("#add-mat2-a-m").val();
                                        $qty =  $rate / $amount / $rate;
                                        $price = $qty * $rate;

                                        $("#add-mat2-qty").val($qty);

                                        $("#add-mat2-rate").val($price);
                                        $("#show-mat2-rate").val($price);
                                    });
                                }
                            });
                        }
                    });
                });

                
            });


        </script>
        

    </body>
    </html>