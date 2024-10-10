<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$pet_id = intval($_POST['pet_id']);
$pet_type = $_POST['pet_type'];
$table_name = ($pet_type === 'dog') ? 'pet_dog' : 'pet_cat';
$id_column = ($pet_type === 'dog') ? 'dog_id' : 'cat_id';


$sql = "SELECT * FROM $table_name WHERE $id_column = $pet_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $pet = $result->fetch_assoc();

    $image_folder = '../images/';

    $main_image_path = $image_folder . $pet['image'];
    if (!empty($pet['image']) && file_exists($main_image_path)) {
        unlink($main_image_path); 
    }

    for ($i = 1; $i <= 8; $i++) {
        $image_field = 'image_' . $i;
        if (!empty($pet[$image_field])) {
            $image_path = $image_folder . $pet[$image_field]; 
            if (file_exists($image_path)) {
                unlink($image_path); 
            }
        }
    }

    $delete_sql = "DELETE FROM $table_name WHERE $id_column = $pet_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Pet deleted successfully.";
    } else {
        echo "Error deleting pet: " . $conn->error;
    }
} else {
    echo "Pet not found.";
}

$conn->close();
?>
