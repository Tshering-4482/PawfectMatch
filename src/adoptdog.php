<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
    <div id="wrapper" class="fade-in">
        <!-- Header -->
        <header id="header">
            <a href="index.php" class="logo"><img src="../images/pngegg.png" alt=""/></a>
        </header>
        
        <!-- Nav -->
        <nav id="nav">
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li class="active">
                    <a href="adoptdog.php">
                        <img src="../images/dog.png" alt="" class="nav-icon"> 
                        <span>Adopt</span>
                    </a>
                </li>
                <li>
                    <a href="adoptcat.php">
                        <img src="../images/kitty.png" alt="" class="nav-icon"> 
                        <span>Adopt</span>
                    </a>
                </li>
                <li><a href="elements.php">About Us</a></li>
                <li><a href="elements.php">Contact Us</a></li>
            </ul>
            <ul class="icons">
                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">
            <!-- Featured Post -->
            <article class="post featured">
                <a href="#" class="image main"><img src="../images/meetourdog.png" alt="" /></a>
                <header class="major">
                    <h2><a>Meet Our Dogs</a></h2>
                </header>

                <!-- Filter dropdowns -->
                <form id="filterForm" method="GET" action="adoptdog.php">
                    <div class="dropdown">
                        <div class="dropbtn">Sex</div>
                        <div class="dropdown-content">
                            <a href="#" onclick="applyFilter('Male', 'sex')">Male</a>
                            <a href="#" onclick="applyFilter('Female', 'sex')">Female</a>
                            <a href="#" onclick="applyFilter('', 'sex')">All</a> <!-- Option to clear the filter -->
                        </div>
                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">Attributes</div>
                        <div class="dropdown-content">
                            <a href="#" onclick="applyFilter('Good with cats', 'attributes')">Good with cats</a>
                            <a href="#" onclick="applyFilter('Good with dogs', 'attributes')">Good with dogs</a>
                            <a href="#" onclick="applyFilter('Good with kids', 'attributes')">Good with kids</a>
                            <a href="#" onclick="applyFilter('', 'attributes')">All</a> <!-- Option to clear the filter -->
                        </div>
                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">Age group</div>
                        <div class="dropdown-content">
                            <a href="#" onclick="applyFilter('Senior', 'age_group')">Senior</a>
                            <a href="#" onclick="applyFilter('Adult', 'age_group')">Adult</a>
                            <a href="#" onclick="applyFilter('Babies', 'age_group')">Babies</a>
                            <a href="#" onclick="applyFilter('', 'age_group')">All</a> <!-- Option to clear the filter -->
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
                            <a href="#" onclick="applyFilter('', 'breed')">All</a> <!-- Option to clear the filter -->
                        </div>
                    </div>

                    <!-- Hidden inputs to store selected filter values -->
                    <input type="hidden" name="sex" id="selectedSex" />
                    <input type="hidden" name="attributes" id="selectedAttributes" />
                    <input type="hidden" name="age_group" id="selectedAgeGroup" />
                    <input type="hidden" name="breed" id="selectedBreed" />
                </form>

            </article>

            <!-- Display pets based on filter -->
            <section class="posts">
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

            // Get filter values from GET request
            $selected_sex = isset($_GET['sex']) ? $_GET['sex'] : '';
            $selected_attributes = isset($_GET['attributes']) ? $_GET['attributes'] : '';
            $selected_age_group = isset($_GET['age_group']) ? $_GET['age_group'] : '';
            $selected_breed = isset($_GET['breed']) ? $_GET['breed'] : '';

            // Build SQL query with conditions
            $sql = "SELECT dog_id, name, image FROM pet_dog WHERE 1=1"; // Base query

            if ($selected_sex) {
                $sql .= " AND sex = '$selected_sex'";
            }
            if ($selected_attributes) {
                $sql .= " AND attributes LIKE '%$selected_attributes%'"; // Partial match for attributes
            }
            if ($selected_age_group) {
                $sql .= " AND age_group = '$selected_age_group'";
            }
            if ($selected_breed) {
                $sql .= " AND breed = '$selected_breed'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each pet
                while ($row = $result->fetch_assoc()) {
                    echo '<article>';
                    echo '<a href="pet_details.php?dog_id=' . $row["dog_id"] . '" class="image"><img src="' . $row["image"] . '" alt="" /></a>';
                    echo '<ul class="actions special">';
                    echo '<li><a href="pet_details.php?dog_id=' . $row["dog_id"] . '">' . htmlspecialchars($row["name"]) . '</a></li>';
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

        <!-- Copyright -->
        <div id="copyright">
            <ul><li>&copy;Copyright 2024 © PAWFECT MATCH.</li></ul>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.scrollex.min.js"></script>
    <script src="../assets/js/jquery.scrolly.min.js"></script>
    <script src="../assets/js/browser.min.js"></script>
    <script src="../assets/js/breakpoints.min.js"></script>
    <script src="../assets/js/util.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        function applyFilter(value, filterType) {
            document.getElementById('selected' + capitalizeFirstLetter(filterType)).value = value;
            document.getElementById('filterForm').submit();
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
</body>
</html>
