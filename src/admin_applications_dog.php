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
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dog Applicants|| Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <style>
        <style>
        .pet-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
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
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        h2 {
            font-size: 24px;
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
        }

        th {
            background-color: #333; 
            color: white; 
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #fff;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #fff;
        }

        table {
            margin-top: 20px;
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
        <a class="nav-link px-3" href="#">Sign out</a>
        </div>
    </div>
    </header>

    <div class="container-fluid">
    <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="manage_dog.php">
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
                <a class="nav-link active" href="admin_applications_dog.php">
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
                <h2>Applicants For Dogs</h2>

                <?php
    
                $servername = "localhost";
                $username = "root"; 
                $password = "";
                $dbname = "pet_adoption";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT adoption_applications.*, pet_dog.name AS dog_name, pet_dog.breed, pet_dog.sex 
                        FROM adoption_applications
                        INNER JOIN pet_dog ON adoption_applications.dog_id = pet_dog.dog_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Pet Name</th><th>Breed</th><th>Sex</th><th>Applicant Name</th><th>Email</th><th>City</th><th>Country</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['dog_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['breed']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['country']) . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No applications found.";
                }

                $conn->close();
                ?>      
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
