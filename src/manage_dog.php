<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: signIn.php"); 
    exit;
}

$timeout_duration = 600; 
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {

    session_unset();
    session_destroy();
    header("Location: signIn.php"); 
    exit;
}
$_SESSION['last_activity'] = time(); 


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Manage Dogs|| Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <style>
        .pet-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding-bottom: 100px;
        }
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .pet-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 300px;
        }
        .pet-card img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        h1{
            font-size: 24px;
            text-align: center;
            padding-top: 50px;
            
        }
        h2 {
            font-size: 20px;
            text-align: center;
            padding-top: 40px;
            
        }
        
    </style>
    

  </head>
    <body>
        
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">PawfectMatch</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
        
        <a class="nav-link px-3" href="logout.php">Sign out</a>
        </div>
    </div>
    </header>

    <div class="container-fluid">
    <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="manage_dog.php">
                <span data-feather="home"></span>
                Manage Pet Dog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_cat.php">
                <span data-feather="file"></span>
                Manage Pet Cat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_applications_dog.php">
                <span data-feather="shopping-cart"></span>
                Applicants For Dog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_applications_cat.php">
                <span data-feather="users"></span>
                Applicants For Cat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="upload_pet.php">
                <span data-feather="bar-chart-2"></span>
                Upload Dog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="upload_pet_cat.php">
                <span data-feather="bar-chart-2"></span>
                Upload Cat
                </a>
            </li>
            </ul>
        </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div>
                <h1>Pet List</h1>
                <h2>Manage Dogs</h2>

                <div class="pet-container">
                    <?php

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "pet_adoption";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM pet_dog";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($dog = $result->fetch_assoc()) {
                            echo '<div class="pet-card">';
                            echo '<h3>' . htmlspecialchars($dog['name']) . '</h3>';
                            echo '<p>Breed: ' . htmlspecialchars($dog['breed']) . '</p>';
                            echo '<p>Age: ' . htmlspecialchars($dog['age']) . ' years</p>';
                            echo '<p>Sex: ' . htmlspecialchars($dog['sex']) . '</p>';
                            $image_path = '../images/' . htmlspecialchars($dog['image']);
                            echo '<img src="' . htmlspecialchars($dog['image']) . '" alt="Cat Image">';
                            echo '<div class="carousel-images">';
                            for ($i = 1; $i <= 8; $i++) {
                                $image_field = 'image_' . $i;
                                if (!empty($dog[$image_field])) {
                                    echo '<img src="' . htmlspecialchars($dog[$image_field]) . '" alt="Dog Image">';
                                }
                            }
                            echo '</div>';
                            echo '<form method="POST" action="delete_pet.php">';
                            echo '<input type="hidden" name="pet_id" value="' . $dog['dog_id'] . '">';
                            echo '<input type="hidden" name="pet_type" value="dog">';
                            echo '<button type="submit" class="delete-btn">Delete</button>';
                            echo '</form>';

                            echo '<a href="edit_pet.php?pet_id=' . htmlspecialchars($dog['dog_id']) . '&pet_type=dog">
                                    <button>Edit</button>
                                </a>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No dogs found.</p>";
                    }
                    ?>
                </div>
            </div>       
        </main>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" 
    crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" 
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
   <script src="dashboard.js"></script>
  </body>
</html>
