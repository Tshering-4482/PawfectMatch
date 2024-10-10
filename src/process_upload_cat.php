<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $breed = $_POST['breed']; 
    $sex = $_POST['sex'];
    $age_group = $_POST['age_group'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $adoption_fee = $_POST['adoption_fee'];

    $attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];
    $attributes_string = implode(", ", $attributes); 

    $target_dir = "../images/"; 
    $target_file_1 = $target_dir . basename($_FILES["image"]["name"]); 
    $uploadOk_1 = 1; 
    $imageFileType_1 = strtolower(pathinfo($target_file_1, PATHINFO_EXTENSION)); 

    $check_1 = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check_1 === false) {
        echo "File is not an image.";
        $uploadOk_1 = 0;
    }

    if (file_exists($target_file_1)) {
        echo "Sorry, file already exists.";
        $uploadOk_1 = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk_1 = 0;
    }

    if (!in_array($imageFileType_1, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk_1 = 0;
    }

    $image_2 = ''; 
    if (!empty($_FILES["image_2"]["name"])) { 
        $target_file_2 = $target_dir . basename($_FILES["image_2"]["name"]); 
        $uploadOk_2 = 1; 
        $imageFileType_2 = strtolower(pathinfo($target_file_2, PATHINFO_EXTENSION)); 

        $check_2 = getimagesize($_FILES["image_2"]["tmp_name"]);
        if ($check_2 === false) {
            echo "File is not an image.";
            $uploadOk_2 = 0;
        }

        if (file_exists($target_file_2)) {
            echo "Sorry, file already exists.";
            $uploadOk_2 = 0;
        }

        if ($_FILES["image_2"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_2 = 0;
        }

        if (!in_array($imageFileType_2, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_2 = 0;
        }

        if ($uploadOk_2 == 1 && move_uploaded_file($_FILES["image_2"]["tmp_name"], $target_file_2)) {
            $image_2 = $target_file_2;
        } else {
            echo "Sorry, there was an error uploading your second image.";
        }
    }
    $image_3 = ''; 
    if (!empty($_FILES["image_3"]["name"])) { 
        $target_file_3 = $target_dir . basename($_FILES["image_3"]["name"]); 
        $uploadOk_3 = 1; 
        $imageFileType_3 = strtolower(pathinfo($target_file_3, PATHINFO_EXTENSION)); 

        $check_3 = getimagesize($_FILES["image_3"]["tmp_name"]);
        if ($check_3 === false) {
            echo "File is not an image.";
            $uploadOk_3 = 0;
        }

        if (file_exists($target_file_3)) {
            echo "Sorry, file already exists.";
            $uploadOk_3 = 0;
        }

        if ($_FILES["image_3"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_3 = 0;
        }

        if (!in_array($imageFileType_3, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_3 = 0;
        }

        if ($uploadOk_3 == 1 && move_uploaded_file($_FILES["image_3"]["tmp_name"], $target_file_3)) {
            $image_3 = $target_file_3; 
        } else {
            echo "Sorry, there was an error uploading your third image.";
        }
    }
    $image_4 = ''; 
    if (!empty($_FILES["image_4"]["name"])) { 
        $target_file_4 = $target_dir . basename($_FILES["image_4"]["name"]); 
        $uploadOk_4 = 1; 
        $imageFileType_4 = strtolower(pathinfo($target_file_4, PATHINFO_EXTENSION)); 

        $check_4 = getimagesize($_FILES["image_4"]["tmp_name"]);
        if ($check_4 === false) {
            echo "File is not an image.";
            $uploadOk_4 = 0;
        }

        if (file_exists($target_file_4)) {
            echo "Sorry, file already exists.";
            $uploadOk_4 = 0;
        }

        if ($_FILES["image_4"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_4 = 0;
        }

        if (!in_array($imageFileType_4, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_4 = 0;
        }

        if ($uploadOk_4 == 1 && move_uploaded_file($_FILES["image_4"]["tmp_name"], $target_file_4)) {
            $image_4 = $target_file_4; 
        } else {
            echo "Sorry, there was an error uploading your fourth image.";
        }
    }
    $image_5 = ''; 
    if (!empty($_FILES["image_5"]["name"])) { 
        $target_file_5 = $target_dir . basename($_FILES["image_5"]["name"]); 
        $uploadOk_5 = 1; 
        $imageFileType_5 = strtolower(pathinfo($target_file_5, PATHINFO_EXTENSION)); 

        $check_5 = getimagesize($_FILES["image_5"]["tmp_name"]);
        if ($check_5 === false) {
            echo "File is not an image.";
            $uploadOk_5 = 0;
        }

        if (file_exists($target_file_5)) {
            echo "Sorry, file already exists.";
            $uploadOk_5 = 0;
        }

        if ($_FILES["image_5"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_5 = 0;
        }

        if (!in_array($imageFileType_5, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_5 = 0;
        }

        if ($uploadOk_5 == 1 && move_uploaded_file($_FILES["image_5"]["tmp_name"], $target_file_5)) {
            $image_5 = $target_file_5; 
        } else {
            echo "Sorry, there was an error uploading your fifth image.";
        }
    }
    $image_6 = ''; 
    if (!empty($_FILES["image_6"]["name"])) { 
        $target_file_6 = $target_dir . basename($_FILES["image_6"]["name"]); 
        $uploadOk_6 = 1; 
        $imageFileType_6 = strtolower(pathinfo($target_file_6, PATHINFO_EXTENSION)); 

        $check_6 = getimagesize($_FILES["image_6"]["tmp_name"]);
        if ($check_6 === false) {
            echo "File is not an image.";
            $uploadOk_6 = 0;
        }

        if (file_exists($target_file_6)) {
            echo "Sorry, file already exists.";
            $uploadOk_6 = 0;
        }

        if ($_FILES["image_6"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_6 = 0;
        }

        if (!in_array($imageFileType_6, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_6 = 0;
        }

        if ($uploadOk_6 == 1 && move_uploaded_file($_FILES["image_6"]["tmp_name"], $target_file_6)) {
            $image_6 = $target_file_6; 
        } else {
            echo "Sorry, there was an error uploading your sixth image.";
        }
    }
    $image_7 = ''; 
    if (!empty($_FILES["image_7"]["name"])) { 
        $target_file_7 = $target_dir . basename($_FILES["image_7"]["name"]); 
        $uploadOk_7 = 1; 
        $imageFileType_7 = strtolower(pathinfo($target_file_7, PATHINFO_EXTENSION)); 

        $check_7 = getimagesize($_FILES["image_7"]["tmp_name"]);
        if ($check_7 === false) {
            echo "File is not an image.";
            $uploadOk_7 = 0;
        }

        if (file_exists($target_file_7)) {
            echo "Sorry, file already exists.";
            $uploadOk_7 = 0;
        }

        if ($_FILES["image_7"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_7 = 0;
        }

        if (!in_array($imageFileType_7, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_7 = 0;
        }

        if ($uploadOk_7 == 1 && move_uploaded_file($_FILES["image_7"]["tmp_name"], $target_file_7)) {
            $image_7 = $target_file_7; 
        } else {
            echo "Sorry, there was an error uploading your seventh image.";
        }
    }
    $image_8 = ''; 
    if (!empty($_FILES["image_8"]["name"])) { 
        $target_file_8 = $target_dir . basename($_FILES["image_8"]["name"]); 
        $uploadOk_8 = 1; 
        $imageFileType_8 = strtolower(pathinfo($target_file_8, PATHINFO_EXTENSION)); 

        $check_8 = getimagesize($_FILES["image_8"]["tmp_name"]);
        if ($check_8 === false) {
            echo "File is not an image.";
            $uploadOk_8 = 0;
        }

        if (file_exists($target_file_8)) {
            echo "Sorry, file already exists.";
            $uploadOk_8 = 0;
        }

        if ($_FILES["image_8"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk_8 = 0;
        }

        if (!in_array($imageFileType_8, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk_8 = 0;
        }

        if ($uploadOk_8 == 1 && move_uploaded_file($_FILES["image_8"]["tmp_name"], $target_file_8)) {
            $image_8 = $target_file_8; 
        } else {
            echo "Sorry, there was an error uploading your eighth image.";
        }
    }

    if ($uploadOk_1 == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_1)) {

        $sql = "INSERT INTO pet_cat (name, breed, sex, age_group, age, weight, adoption_fee, attributes, image, image_2, image_3, image_4, image_5, image_6, image_7, image_8) 
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
