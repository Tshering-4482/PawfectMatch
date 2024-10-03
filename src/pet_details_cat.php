<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Pet Detail</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css"/>
    <style>
        /* .carousel-container {
            position: relative;
            max-width: 100%; 
            margin: auto;
            overflow: hidden;
            
        }

        .carousel-images {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-images img {
            width: 25%; 
            height: auto;
            
        } */
        .carousel-container {
            position: relative;
            width: 100%; /* Adjust the width as needed */
            overflow: hidden;
        }

        .carousel-images {
            display: flex; /* Align images in a row */
            gap: 70px; /* Add space between images */
            transition: transform 0.5s ease-in-out; /* Smooth transition */
        }

        .carousel-images img {
            width: 100%; /* Make sure images fit within the container */
            max-width: 300px; /* Set a max width for each image */
            height: auto;
            border-radius: 10px; /* Optional: add rounded corners */
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 16px;
            background-color: rgba(0,0,0,0.5);
            color: white;
            cursor: pointer;
        }

        .arrow-left {
            left: 0;
        }

        .arrow-right {
            right: 0;
        }   
    </style>
</head>
<body class="is-preload">
    <div id="wrapper" class="fade-in">
    <!-- Header -->
    <header id="header">
        <a href="index.html" class="logo"><img src="../images/pngegg.png" alt=""/></a>
    </header>
    
    <!-- Nav -->
    <nav id="nav">
        <ul class="links">
            <li><a href="index.html">Home</a></li>
            <li class="active">
                <a href="/src/adoptdog.html">
                    <img src="../images/dog.png" alt="" class="nav-icon"> 
                    <span>Adopt</span>
                </a>
            </li>
            <li>
                <a href="adoptcat.html">
                    <img src="../images/kitty.png" alt="" class="nav-icon"> 
                    <span>Adopt</span>
                </a>
            </li>
            <li><a href="elements.html">About Us</a></li>
            <li><a href="elements.html">Contact Us</a></li>
        </ul>
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root"; // Default username for WAMP
        $password = ""; // Default password for WAMP
        $dbname = "pet_adoption";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the pet identifier from the URL
        $cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;

        // Fetch pet details from the database
        $sql = "SELECT * FROM pet_cat WHERE cat_id = $cat_id"; // Assuming 'id' is the primary key
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $pet = $result->fetch_assoc();
        ?>

            <!-- Carousel for Dog Images -->
            <div class="carousel-container">
                <div class="dog-name"><?php echo htmlspecialchars($pet['name']); ?></div>
                <div class="carousel-images" id="carouselImages">
                    <img src="<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_2']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_3']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_4']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_5']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_6']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_7']); ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_8']); ?>">
                </div>
                <!-- Arrows -->
                <div class="arrow arrow-left" onclick="prevSlide()">&#10094;</div>
                <div class="arrow arrow-right" onclick="nextSlide()">&#10095;</div>
            </div>

            <!-- Dog Information -->
            <div class="dog-info">
                <h3><?php echo htmlspecialchars($pet['name']); ?>'s Information</h3>
                <div class="dog-info-container">
                    <div class="dog-info-column">
                        <p><strong>Animal ID:</strong> #<?php echo htmlspecialchars($pet['cat_id']); ?></p>
                        <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p><strong>Sex:</strong> <?php echo htmlspecialchars($pet['sex']); ?></p>
                        <p><strong>Weight:</strong> <?php echo htmlspecialchars($pet['weight']); ?> lbs</p>
                    </div>
                    <div class="dog-info-column">
                        <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                        <p><strong>Adoption Fee:</strong> $<?php echo htmlspecialchars($pet['adoption_fee']); ?></p>
                        <p><strong>Attributes:</strong> <?php echo htmlspecialchars($pet['attributes']); ?></p>
                    </div>
                </div>

                <!-- Apply for Adoption Button -->
                <ul class="actions special">
                    <li><a href="#" class="button">Apply For Adoption</a></li>
                </ul>
            </div>

        <?php
        } else {
            echo "<p>No pet found.</p>";
        }

        $conn->close();
        ?>
    </div>
    
    </div>

    <!-- Copyright -->
    <div id="copyright">
        <ul><li>&copy;Copyright 2024 © PAWFECT MATCH.</li></ul>
    </div>

    <script src="../assets/js/carousel.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.scrollex.min.js"></script>
    <script src="../assets/js/jquery.scrolly.min.js"></script>
    <script src="../assets/js/browser.min.js"></script>
    <script src="../assets/js/breakpoints.min.js"></script>
    <script src="../assets/js/util.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
