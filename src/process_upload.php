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

    // Handle first image upload
    $target_dir = "../images/"; // Define the directory where the uploaded images will be stored
    $target_file_1 = $target_dir . basename($_FILES["image"]["name"]); // Set the target file path for first image
    $uploadOk_1 = 1; // Initialize a variable to check if the upload is okay for first image
    $imageFileType_1 = strtolower(pathinfo($target_file_1, PATHINFO_EXTENSION)); // Get the file extension of the first image

    // Check if first image file is an actual image or fake image
    $check_1 = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check_1 === false) {
        echo "File is not an image.";
        $uploadOk_1 = 0;
    }

    // Check if file already exists for first image
    if (file_exists($target_file_1)) {
        echo "Sorry, file already exists.";
        $uploadOk_1 = 0;
    }

    // Check file size for first image
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk_1 = 0;
    }

    // Allow certain file formats for first image
    if (!in_array($imageFileType_1, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk_1 = 0;
    }

    // Handle second image upload (optional)
    $image_2 = ''; // Initialize as empty
    if (!empty($_FILES["image_2"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_2 = $target_dir . basename($_FILES["image_2"]["name"]); // Set the target file path for second image
        $uploadOk_2 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_2 = strtolower(pathinfo($target_file_2, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_2 = getimagesize($_FILES["image_2"]["tmp_name"]);
        if ($check_2 === false) {
            echo "File is not an image.";
            $uploadOk_2 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_2)) {
            echo "Sorry, file already exists.";
            $uploadOk_2 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_2"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_2 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_2, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_2 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_2 == 1 && move_uploaded_file($_FILES["image_2"]["tmp_name"], $target_file_2)) {
            $image_2 = $target_file_2; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your second image.";
        }
    }
    $image_3 = ''; // Initialize as empty
    if (!empty($_FILES["image_3"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_3 = $target_dir . basename($_FILES["image_3"]["name"]); // Set the target file path for second image
        $uploadOk_3 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_3 = strtolower(pathinfo($target_file_3, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_3 = getimagesize($_FILES["image_3"]["tmp_name"]);
        if ($check_3 === false) {
            echo "File is not an image.";
            $uploadOk_3 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_3)) {
            echo "Sorry, file already exists.";
            $uploadOk_3 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_3"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_3 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_3, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_3 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_3 == 1 && move_uploaded_file($_FILES["image_3"]["tmp_name"], $target_file_3)) {
            $image_3 = $target_file_3; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your third image.";
        }
    }
    $image_4 = ''; // Initialize as empty
    if (!empty($_FILES["image_4"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_4 = $target_dir . basename($_FILES["image_4"]["name"]); // Set the target file path for second image
        $uploadOk_4 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_4 = strtolower(pathinfo($target_file_4, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_4 = getimagesize($_FILES["image_4"]["tmp_name"]);
        if ($check_4 === false) {
            echo "File is not an image.";
            $uploadOk_4 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_4)) {
            echo "Sorry, file already exists.";
            $uploadOk_4 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_4"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_4 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_4, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_4 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_4 == 1 && move_uploaded_file($_FILES["image_4"]["tmp_name"], $target_file_4)) {
            $image_4 = $target_file_4; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your fourth image.";
        }
    }
    $image_5 = ''; // Initialize as empty
    if (!empty($_FILES["image_5"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_5 = $target_dir . basename($_FILES["image_5"]["name"]); // Set the target file path for second image
        $uploadOk_5 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_5 = strtolower(pathinfo($target_file_5, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_5 = getimagesize($_FILES["image_5"]["tmp_name"]);
        if ($check_5 === false) {
            echo "File is not an image.";
            $uploadOk_5 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_5)) {
            echo "Sorry, file already exists.";
            $uploadOk_5 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_5"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_5 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_5, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_5 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_5 == 1 && move_uploaded_file($_FILES["image_5"]["tmp_name"], $target_file_5)) {
            $image_5 = $target_file_5; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your fifth image.";
        }
    }
    $image_6 = ''; // Initialize as empty
    if (!empty($_FILES["image_6"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_6 = $target_dir . basename($_FILES["image_6"]["name"]); // Set the target file path for second image
        $uploadOk_6 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_6 = strtolower(pathinfo($target_file_6, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_6 = getimagesize($_FILES["image_6"]["tmp_name"]);
        if ($check_6 === false) {
            echo "File is not an image.";
            $uploadOk_6 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_6)) {
            echo "Sorry, file already exists.";
            $uploadOk_6 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_6"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_6 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_6, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_6 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_6 == 1 && move_uploaded_file($_FILES["image_6"]["tmp_name"], $target_file_6)) {
            $image_6 = $target_file_6; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your sixth image.";
        }
    }
    $image_7 = ''; // Initialize as empty
    if (!empty($_FILES["image_7"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_7 = $target_dir . basename($_FILES["image_7"]["name"]); // Set the target file path for second image
        $uploadOk_7 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_7 = strtolower(pathinfo($target_file_7, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_7 = getimagesize($_FILES["image_7"]["tmp_name"]);
        if ($check_7 === false) {
            echo "File is not an image.";
            $uploadOk_7 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_7)) {
            echo "Sorry, file already exists.";
            $uploadOk_7 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_7"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_7 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_7, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_7 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_7 == 1 && move_uploaded_file($_FILES["image_7"]["tmp_name"], $target_file_7)) {
            $image_7 = $target_file_7; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your seventh image.";
        }
    }
    $image_8 = ''; // Initialize as empty
    if (!empty($_FILES["image_8"]["name"])) { // Only attempt to upload if the file is provided
        $target_file_8 = $target_dir . basename($_FILES["image_8"]["name"]); // Set the target file path for second image
        $uploadOk_8 = 1; // Initialize a variable to check if the upload is okay for second image
        $imageFileType_8 = strtolower(pathinfo($target_file_8, PATHINFO_EXTENSION)); // Get the file extension of the second image

        // Check if second image file is an actual image or fake image
        $check_8 = getimagesize($_FILES["image_8"]["tmp_name"]);
        if ($check_8 === false) {
            echo "File is not an image.";
            $uploadOk_8 = 0;
        }

        // Check if file already exists for second image
        if (file_exists($target_file_8)) {
            echo "Sorry, file already exists.";
            $uploadOk_8 = 0;
        }

        // Check file size for second image
        if ($_FILES["image_8"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_8 = 0;
        }

        // Allow certain file formats for second image
        if (!in_array($imageFileType_8, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_8 = 0;
        }

        // If all checks pass, move the second image to the target directory
        if ($uploadOk_8 == 1 && move_uploaded_file($_FILES["image_8"]["tmp_name"], $target_file_8)) {
            $image_8 = $target_file_8; // Set the path of the second image
        } else {
            echo "Sorry, there was an error uploading your eighth image.";
        }
    }





    // Check if the first image upload was successful before inserting data
    if ($uploadOk_1 == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_1)) {
        // Insert pet data into the database, with image_2 being optional
        $sql = "INSERT INTO pet_dog (name, breed, sex, age_group, age, weight, adoption_fee, attributes, image, image_2, image_3, image_4, image_5, image_6, image_7, image_8) 
                VALUES ('$name', '$breed', '$sex', '$age_group', '$age', '$weight', '$adoption_fee', '$attributes_string', '$target_file_1', '$image_2', '$image_3', '$image_4', '$image_5', '$image_6', '$image_7', '$image_8')";

        if ($conn->query($sql) === TRUE) {
            echo "New pet uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your first image.";
    }
}

$conn->close();
?>
