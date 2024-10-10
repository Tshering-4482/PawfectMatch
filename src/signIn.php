<?php
session_start(); 

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php"); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['psw'];

    $admin_email = 'admin@example.com'; // Example email
    $admin_password = 'password123';    // Example password

    if ($email === $admin_email && $password === $admin_password) {

        $_SESSION['admin_logged_in'] = true;
        $_SESSION['last_activity'] = time(); 

        header("Location: manage_dog.php");
        exit;
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../assets/css/signin.css">
  <title>Admin | Sign In</title>
</head>
<body>
  <div class="form-container ms-center">
    <form class="form-content" method="POST" action="">
      <div class="container">
        <h1>Admin Sign In</h1>
        <hr>
        <?php if (!empty($error_message)): ?>
          <div class="alert alert-danger">
              <?php echo $error_message; ?>
          </div>
        <?php endif; ?>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label>
          <input type="checkbox" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <div class="submit">
          <button type="submit" class="signup">Sign In</button>
          <a href="#">Forgot Password</a>
        </div>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
