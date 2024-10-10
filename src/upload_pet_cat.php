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
    <title>Upload Pet Cat|| Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <styl>
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
            padding-top: 30px;
            padding-bottom: 40px;
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

        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px; 
            width: 100%;
            max-width: 600px; 
            margin: 20px auto; 
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); 
            font-family: Arial, sans-serif; 
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="file"] {
            margin: 5px 0;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        h4 {
            margin-top: 20px;
            font-size: 18px;
            color: #333; 
        }
        



        .subbtn {
            background-color: #4CAF50; 
            border: none; 
            color: white; 
            padding: 10px 20px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            margin: 10px 2px; 
            cursor: pointer; 
            border-radius: 8px; 
            transition-duration: 0.4s; 
            width: 100%; 
        }

        .subbtn:hover {
            background-color: white; 
            color: black; 
            border: 2px solid #4CAF50; 
        }

        @media screen and (max-width: 600px) {
            form {
                width: 100%; 
            }
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
                <a class="nav-link " href="upload_pet.php">
                <span data-feather="bar-chart-2"></span>
                Upload Dog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="upload_pet_cat.php">
                <span data-feather="bar-chart-2"></span>
                Upload Cat
                </a>
            </li>
            </ul>
        </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="form-container">
                <h2>Upload Pet Information</h2>
                <form action="process_upload_cat.php" method="POST" enctype="multipart/form-data">
                    <input type="text" placeholder="Name" name="name" required>
                    <select name="breed" required>
                        <option value="">Select Breed</option>
                        <option value="Persian">Persian</option>
                        <option value="Maine Coon">Maine Coon</option>
                        <option value="Siamese">Siamese</option>
                        <option value="Ragdoll">Ragdoll</option>
                        <option value="Bengal">Bengal</option>
                        <option value="British Shorthair">British Shorthair</option>
                    </select>
                    <select name="sex" required>
                        <option value="">Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <select name="age_group" required>
                        <option value="">Select Age Group</option>
                        <option value="Senior">Senior</option>
                        <option value="Adult">Adult</option>
                        <option value="Babies">Babies</option>
                    </select>
                    <input type="number" placeholder="Age (in years)" name="age" required>
                    <input type="number" placeholder="Weight (in kg)" name="weight" step="0.01" required>
                    <input type="number" placeholder="Adoption Fee (in $)" name="adoption_fee" step="0.01" required>

                    <h4>Select Attributes:</h4>
                    <label><input type="checkbox" name="attributes[]" value="Good with dogs"> Good with dogs</label><br>
                    <label><input type="checkbox" name="attributes[]" value="Good with cats"> Good with cats</label><br>
                    <label><input type="checkbox" name="attributes[]" value="Good with kids"> Good with kids</label><br><br>

                    <h4>Upload Images:</h4>
                    <label for="image">Main Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required><br>

                    <label for="image_2">Additional Image 1:</label>
                    <input type="file" id="image_2" name="image_2" accept="image/*"><br>

                    <label for="image_3">Additional Image 2:</label>
                    <input type="file" id="image_3" name="image_3" accept="image/*"><br>

                    <label for="image_4">Additional Image 3:</label>
                    <input type="file" id="image_4" name="image_4" accept="image/*"><br>

                    <label for="image_5">Additional Image 4:</label>
                    <input type="file" id="image_5" name="image_5" accept="image/*"><br>

                    <label for="image_6">Additional Image 5:</label>
                    <input type="file" id="image_6" name="image_6" accept="image/*"><br>

                    <label for="image_7">Additional Image 6:</label>
                    <input type="file" id="image_7" name="image_7" accept="image/*"><br>

                    <label for="image_8">Additional Image 7:</label>
                    <input type="file" id="image_8" name="image_8" accept="image/*"><br>
                    <button class="subbtn" type="submit">Upload Pet</button>
                </form>
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
