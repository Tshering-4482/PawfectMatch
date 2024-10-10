<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$pet_id = intval($_GET['pet_id']);
$pet_type = $_GET['pet_type'];

$table_name = ($pet_type === 'dog') ? 'pet_dog' : 'pet_cat';
$id_column = ($pet_type === 'dog') ? 'dog_id' : 'cat_id';

$sql = "SELECT * FROM $table_name WHERE $id_column = $pet_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $pet = $result->fetch_assoc();
} else {
    echo "<p>Pet not found.</p>";
    exit;
}

function deleteImage($image_path) {
    if (file_exists($image_path)) {
        unlink($image_path); 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $adoption_fee = $_POST['adoption_fee'];
    $attributes = $_POST['attributes'];

    $image = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $pet['image'];
    $target_folder = "../images/";

    if (!empty($_FILES['image']['tmp_name'])) {

        deleteImage($pet['image']);

        $target_file = $target_folder . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $image = $target_file;  
    } else {
        $image = $pet['image'];  
    }

    $update_sql = "UPDATE $table_name SET name=?, breed=?, sex=?, age=?, weight=?, adoption_fee=?, attributes=?, image=? WHERE $id_column=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('ssssddssi', $name, $breed, $sex, $age, $weight, $adoption_fee, $attributes, $image, $pet_id);

    if ($stmt->execute()) {

        for ($i = 2; $i <= 8; $i++) {
            if (!empty($_FILES['image_' . $i]['name'])) {
                $additional_image = $_FILES['image_' . $i]['name'];
                $target_file = $target_folder . basename($additional_image);

                if (!empty($pet['image_' . $i])) {
                    deleteImage($pet['image_' . $i]);
                }

                if (move_uploaded_file($_FILES['image_' . $i]['tmp_name'], $target_file)) {

                    $update_additional_image_sql = "UPDATE $table_name SET image_$i=? WHERE $id_column=?";
                    $stmt_additional = $conn->prepare($update_additional_image_sql);
                    $stmt_additional->bind_param('si', $target_file, $pet_id);
                    $stmt_additional->execute();
                } else {
                    echo "Error uploading additional image $i.";
                }
            }
        }


    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: admin_dashboard.php"); 
    }
    exit;
} else {
    echo "Error updating pet: " . $conn->error;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="file"] {
            padding: 5px;
        }

        .img-preview {
            display: block;
            margin: 10px 0;
            width: 150px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            input[type="text"],
            input[type="number"],
            input[type="file"],
            textarea {
                padding: 8px;
            }

            .submit-btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Pet: <?php echo htmlspecialchars($pet['name']); ?></h2>

        <form method="POST" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($pet['name']); ?>" required>

            <label for="sex">Sex:</label>
            <select name="sex" required>
                <?php if ($pet_type === 'dog'): ?>
                    <option value="Male" <?php echo $pet['sex'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $pet['sex'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                <?php else: ?>
                    <option value="Male" <?php echo $pet['sex'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $pet['sex'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                <?php endif; ?>
            </select>

            <label for="breed">Breed:</label>
            <select name="breed" required>
                <?php if ($pet_type === 'dog'): ?>
                    <option value="Labrador Retriever" <?php echo $pet['breed'] == 'Labrador Retriever' ? 'selected' : ''; ?>>Labrador Retriever</option>
                    <option value="German Shepherd" <?php echo $pet['breed'] == 'German Shepherd' ? 'selected' : ''; ?>>German Shepherd</option>
                    <option value="Golden Retriever" <?php echo $pet['breed'] == 'Golden Retriever' ? 'selected' : ''; ?>>Golden Retriever</option>
                    <option value="Bulldog" <?php echo $pet['breed'] == 'Bulldog' ? 'selected' : ''; ?>>Bulldog</option>
                    <option value="Poodle" <?php echo $pet['breed'] == 'Poodle' ? 'selected' : ''; ?>>Poodle</option>
                    <option value="Beagle" <?php echo $pet['breed'] == 'Beagle' ? 'selected' : ''; ?>>Beagle</option>
                <?php else: ?>
                    <option value="Persian" <?php echo $pet['breed'] == 'Persian' ? 'selected' : ''; ?>>Persian</option>
                    <option value="Maine Coon" <?php echo $pet['breed'] == 'Maine Coon' ? 'selected' : ''; ?>>Maine Coon</option>
                    <option value="Siamese" <?php echo $pet['breed'] == 'Siamese' ? 'selected' : ''; ?>>Siamese</option>
                    <option value="Ragdoll" <?php echo $pet['breed'] == 'Ragdoll' ? 'selected' : ''; ?>>Ragdoll</option>
                    <option value="Bengal" <?php echo $pet['breed'] == 'Bengal' ? 'selected' : ''; ?>>Bengal</option>
                    <option value="British Shorthair" <?php echo $pet['breed'] == 'British Shorthair' ? 'selected' : ''; ?>>British Shorthair</option>
                <?php endif; ?>
            </select>

            <label for="age">Age (years):</label>
            <input type="number" name="age" value="<?php echo htmlspecialchars($pet['age']); ?>" required>

            <label for="weight">Weight (lbs):</label>
            <input type="number" name="weight" value="<?php echo htmlspecialchars($pet['weight']); ?>" required>

            <label for="adoption_fee">Adoption Fee:</label>
            <input type="number" name="adoption_fee" value="<?php echo htmlspecialchars($pet['adoption_fee']); ?>" required>

            <label for="attributes">Attributes:</label>
            <select name="attributes" required>
                <?php if ($pet_type === 'dog'): ?>
                    <option value="Good with cats" <?php echo $pet['attributes'] == 'Good with cats' ? 'selected' : ''; ?>>Good with cats</option>
                    <option value="Good with dogs" <?php echo $pet['attributes'] == 'Good with dogs' ? 'selected' : ''; ?>>Good with dogs</option>
                    <option value="Good with kids" <?php echo $pet['attributes'] == 'Good with kids' ? 'selected' : ''; ?>>Good with kids</option>
     
                <?php else: ?>
                    <option value="Good with cats" <?php echo $pet['attributes'] == 'Good with cats' ? 'selected' : ''; ?>>Good with cats</option>
                    <option value="Good with dogs" <?php echo $pet['attributes'] == 'Good with dogs' ? 'selected' : ''; ?>>Good with dogs</option>
                    <option value="Good with kids" <?php echo $pet['attributes'] == 'Good with kids' ? 'selected' : ''; ?>>Good with kids</option>

                <?php endif; ?>
            </select>

            <label for="image">Main Image:</label>
            <input type="file" name="image">
            <img src="<?php echo htmlspecialchars($pet['image']); ?>" alt="Current Image" class="img-preview">

            <?php for ($i = 2; $i <= 8; $i++): ?>
                <?php if (!empty($pet['image_' . $i])): ?>
                    <label for="image_<?php echo $i; ?>">Additional Image <?php echo $i - 1; ?>:</label>
                    <input type="file" name="image_<?php echo $i; ?>">
                    <img src="<?php echo htmlspecialchars($pet['image_' . $i]); ?>" alt="Additional Image" class="img-preview">
                <?php else: ?>
                    <label for="image_<?php echo $i; ?>">Upload Additional Image <?php echo $i - 1; ?>:</label>
                    <input type="file" name="image_<?php echo $i; ?>">
                <?php endif; ?>
            <?php endfor; ?>

            <button type="submit" class="submit-btn">Update Pet</button>
        </form>

    </div>
</body>
</html>




<?php
$conn->close();
?>
