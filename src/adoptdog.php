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
            <!-- Featured Post -->
            <article class="post featured">
                <a href="#" class="image main"><img src="../images/meetourdog.png" alt="" /></a>
                <header class="major">
                    <h2><a>Meet Our Dogs</a></h2>
                </header>
            </article>

            <!-- Posts -->
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

                /// Fetch pets data from the database
				$sql = "SELECT dog_id, name, image FROM pet_dog"; // Modified to include pet_id
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
    			// Output data of each pet
    				while ($row = $result->fetch_assoc()) {
       					echo '<article>';
       					echo '<a href="pet_details.php?dog_id=' . $row["dog_id"] . '" class="image"><img src="' . $row["image"] . '" alt="" /></a>'; // Link to pet_details.php
        				echo '<ul class="actions special">';
        				echo '<li><a href="pet_details.php?dog_id=' . $row["dog_id"] . '">' . htmlspecialchars($row["name"]) . '</a></li>'; // Link to pet_details.php
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
</body>
</html>
