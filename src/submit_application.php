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

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$city = $_POST['city'];
$country = $_POST['country'];
$streetaddress = $_POST['streetaddress'];
$code = $_POST['code'];
$phone = $_POST['phone'];
$dog_id = $_POST['dog_id']; // Pet ID

// Insert the application data into the database
$sql = "INSERT INTO adoption_applications (dog_id, firstname, lastname, email, city, country, streetaddress, code, phone)
        VALUES ('$dog_id', '$firstname', '$lastname', '$email', '$city', '$country', '$streetaddress', '$code', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Application submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
