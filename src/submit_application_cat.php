<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$city = $_POST['city'];
$country = $_POST['country'];
$streetaddress = $_POST['streetaddress'];
$code = $_POST['code'];
$phone = $_POST['phone'];
$cat_id = $_POST['cat_id'];

$sql = "INSERT INTO adoption_applications (cat_id, firstname, lastname, email, city, country, streetaddress, code, phone)
        VALUES ('$cat_id', '$firstname', '$lastname', '$email', '$city', '$country', '$streetaddress', '$code', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Application submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
