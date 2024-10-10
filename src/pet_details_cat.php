<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Pet Detail</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css"/>
    <link rel="stylesheet" href="../assets/css/footer.css"/>
    <style>

        .carousel-container {
            position: relative;
            width: 100%; 
            overflow: hidden;
        }

        .carousel-images {
            display: flex; 
            gap: 70px; 
            transition: transform 0.5s ease-in-out; 
        }

        .carousel-images img {
            width: 100%;
            max-width: 300px; 
            height: auto;
            border-radius: 10px; 
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

        <header id="header">
            <a href="index.html" class="logo"><img src="../images/pngegg.png" alt=""/></a>
        </header>

        <nav id="nav">
            <ul class="links">
                <li><a href="index.html">Home</a></li>
                <li>
                    <a href="/src/adoptdog.php">
                        <img src="../images/dog.png" alt="" class="nav-icon"> 
                        <span>Adopt</span>
                    </a>
                </li>
                <li class="active">
                    <a href="adoptcat.php">
                        <img src="../images/kitty.png" alt="" class="nav-icon"> 
                        <span>Adopt</span>
                    </a>
                </li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact_us.html">Contact Us</a></li>
            </ul>
            <ul class="icons">
                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            </ul>
        </nav>
        <div id="main">
            <?php
            $servername = "localhost";
            $username = "root"; 
            $password = ""; 
            $dbname = "pet_adoption";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;

            $sql = "SELECT * FROM pet_cat WHERE cat_id = $cat_id"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $pet = $result->fetch_assoc();
            ?>

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

                    <div class="arrow arrow-left" onclick="prevSlide()">&#10094;</div>
                    <div class="arrow arrow-right" onclick="nextSlide()">&#10095;</div>
                </div>

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
                    <ul class="actions special">
                        <li><a href="apply_cat.php?cat_id=<?php echo htmlspecialchars($pet['cat_id']); ?>" class="button">Apply For Adoption</a></li>
                    </ul>
                </div>

            <?php
            } else {
                echo "<p>No pet found.</p>";
            }

            $conn->close();
            ?>
        </div>
        <div id="copyright">

					<footer class="bg-dark text-white pt-4">
						<div class="container text-center">
							<div class="row">

								<div class="col-lg-4 col-md-6 mb-4" id="adj">
									<h5 class="footer">About Us</h5>
									<p>
										Welcome to PawfectMatch! We are dedicated to connecting pets with loving homes.
										Our platform makes pet adoption easy and transparent.
									</p>
								</div>

								<div class="col-lg-2 col-md-6 mb-4">
									<h5>Quick Links</h5>
									<ul class="list-unstyled">
                                        <li><a href="index.html" class="text-white">Home</a></li>
                                        <li><a href="aboutus.html" class="text-white">About</a></li>
										<li><a href="adoptdog.php" class="text-white">Adopt a Dog</a></li>
										<li><a href="adoptcat.php" class="text-white">Adopt a Cat</a></li>
									</ul>
								</div>

								<div class="col-lg-3 col-md-6 mb-4">
									<h5>Contact Us</h5>
									<ul class="list-unstyled">
										<li><i class="fas fa-map-marker-alt"></i> 1234 Street, Thimphu, Bhutan</li>
										<li><i class="fas fa-phone"></i> +975 123 456 789</li>
										<li><i class="fas fa-envelope"></i> support@pawfectmatch.com</li>
									</ul>
								</div>

								<div class="col-lg-3 col-md-6 mb-4">
									<h5>Follow Us</h5>
									<a href="#" class="text-white me-2"><i class="fab fa-facebook fa-lg"></i></a>
									<a href="#" class="text-white me-2"><i class="fab fa-twitter fa-lg"></i></a>
									<a href="#" class="text-white me-2"><i class="fab fa-instagram fa-lg"></i></a>
									<a href="#" class="text-white me-2"><i class="fab fa-linkedin fa-lg"></i></a>
								</div>
							</div>

							<div class="row lg-1">
								<div class="col text-center">
									<p class="mb-0">&copy; 2024 PawfectMatch. All Rights Reserved.</p>
									<p><a href="#" class="text-white">Privacy Policy</a> | <a href="#" class="text-white">Terms of Service</a></p>
								</div>
							</div>
						</div>
					</footer>

					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
					<script src="https://kit.fontawesome.com/a076d05399.js"></script>
				</div>
    
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
