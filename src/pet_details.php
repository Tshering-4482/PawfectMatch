<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Pet Detail</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
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
        $pet_id = isset($_GET['pet_id']) ? intval($_GET['pet_id']) : 0;

        // Fetch pet details from the database
        $sql = "SELECT * FROM pets WHERE pet_id = $pet_id"; // Assuming 'id' is the primary key
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $pet = $result->fetch_assoc();
        ?>

            <!-- Carousel for Dog Images -->
            <div class="carousel-container">
                <div class="dog-name"><?php echo htmlspecialchars($pet['name']); ?></div>
                <div class="carousel-images" id="carouselImages">
                    <img src="<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                    <!-- Add more images if necessary -->
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
                        <p><strong>Animal ID:</strong> #<?php echo htmlspecialchars($pet['pet_id']); ?></p>
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
