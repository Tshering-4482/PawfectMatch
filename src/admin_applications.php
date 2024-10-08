<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch applications along with pet details
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
