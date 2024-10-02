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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $breed = $_POST['breed']; // Now an ENUM
    $sex = $_POST['sex'];
    $age_group = $_POST['age_group'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $adoption_fee = $_POST['adoption_fee'];

    // Handle attributes as an array
    $attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];
    $attributes_string = implode(", ", $attributes); // Join selected attributes into a string

    // Handle image upload
    $target_dir = "../images/"; // Define the directory where the uploaded images will be stored
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Set the target file path
    $uploadOk = 1; // Initialize a variable to check if the upload is okay
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Get the file extension of the uploaded file

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert pet data into the database
        $sql = "INSERT INTO pets (name, breed, sex, age_group, age, weight, adoption_fee, attributes, image) 
                VALUES ('$name', '$breed', '$sex', '$age_group', '$age', '$weight', '$adoption_fee', '$attributes_string', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "New pet uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}

$conn->close();
?>