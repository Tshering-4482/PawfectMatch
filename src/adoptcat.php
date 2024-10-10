<!DOCTYPE HTML>
<html>
<head>
    <title>Adopt Cat</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/footer.css" />
    <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
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
                    <a href="adoptdog.php">
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
            <article class="post featured">
                <a href="#" class="image main"><img src="../images/meetourcat.png" alt="" /></a>
                <header class="major">
                    <h2><a>Meet Our Dogs</a></h2>
                </header>
                <form id="filterForm" method="GET" action="adoptcat.php">
                    <div class="dropdown">
                        <div class="dropbtn">Sex</div>
                        <div class="dropdown-content">
                            <a onclick="applyFilter('Male', 'sex')">Male</a>
                            <a onclick="applyFilter('Female', 'sex')">Female</a>
                            <a onclick="applyFilter('', 'sex')">All</a> 
                        </div>
                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">Attributes</div>
                        <div class="dropdown-content">
                            <a href="#" onclick="applyFilter('Good with cats', 'attributes')">Good with cats</a>
                            <a href="#" onclick="applyFilter('Good with dogs', 'attributes')">Good with dogs</a>
                            <a href="#" onclick="applyFilter('Good with kids', 'attributes')">Good with kids</a>
                            <a href="#" onclick="applyFilter('', 'attributes')">All</a> 
                        </div>
                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">Breed</div>
                        <div class="dropdown-content">
                            <a href="#" onclick="applyFilter('Labrador Retriever', 'breed')">Labrador Retriever</a>
                            <a href="#" onclick="applyFilter('German Shepherd', 'breed')">German Shepherd</a>
                            <a href="#" onclick="applyFilter('Golden Retriever', 'breed')">Golden Retriever</a>
                            <a href="#" onclick="applyFilter('Bulldog', 'breed')">Bulldog</a>
                            <a href="#" onclick="applyFilter('Poodle', 'breed')">Poodle</a>
                            <a href="#" onclick="applyFilter('Beagle', 'breed')">Beagle</a>
                            <a href="#" onclick="applyFilter('', 'breed')">All</a> 
                        </div>
                    </div>
                    <input type="hidden" name="sex" id="selectedSex" />
                    <input type="hidden" name="attributes" id="selectedAttributes" />
                    <input type="hidden" name="age_group" id="selectedAgeGroup" />
                    <input type="hidden" name="breed" id="selectedBreed" />
                </form>

            </article>
            <section class="posts">
            <?php
            $servername = "localhost";
            $username = "root"; 
            $password = ""; 
            $dbname = "pet_adoption";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $selected_sex = isset($_GET['sex']) ? $_GET['sex'] : '';
            $selected_attributes = isset($_GET['attributes']) ? $_GET['attributes'] : '';
            $selected_age_group = isset($_GET['age_group']) ? $_GET['age_group'] : '';
            $selected_breed = isset($_GET['breed']) ? $_GET['breed'] : '';

            $sql = "SELECT cat_id, name, image FROM pet_cat WHERE 1=1"; 

            if ($selected_sex) {
                $sql .= " AND sex = '$selected_sex'";
            }
            if ($selected_attributes) {
                $sql .= " AND attributes LIKE '%$selected_attributes%'"; 
            }
            if ($selected_age_group) {
                $sql .= " AND age_group = '$selected_age_group'";
            }
            if ($selected_breed) {
                $sql .= " AND breed = '$selected_breed'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<article>';
                    echo '<a href="pet_details_cat.php?cat_id=' . $row["cat_id"] . '" class="image"><img src="' . $row["image"] . '" alt="" /></a>';
                    echo '<ul class="actions special">';
                    echo '<li><a href="pet_details_cat.php?cat_id=' . $row["cat_id"] . '">' . htmlspecialchars($row["name"]) . '</a></li>';
                    echo '</ul>';
                    echo '</article>';
                }
            } else {
                echo "<p>No pets found.</p>";
            }

            $conn->close();
            ?>
            </section>
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
                            <a href="#" class="text-white me-2"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-twitter fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
