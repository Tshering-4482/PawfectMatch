<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/form.css" />
</head>
<body class="is-preload">
    <div class="form-container">
    <form class="form-content" action="submit_application.php" method="POST">
    <div class="container">
        <!-- Pet ID as hidden field -->
        <input type="hidden" name="dog_id" value="<?php echo $_GET['dog_id']; ?>">

        <div class="name-row">
            <input type="text" placeholder="First name" name="firstname" required>
            <input type="text" placeholder="Last name" name="lastname" required>
        </div>

        <input type="email" placeholder="Email" name="email" required>
        <input type="text" placeholder="City" name="city" required>
        <input type="text" placeholder="Country" name="country" required>
        <input type="text" placeholder="Street address" name="streetaddress" required>
        <input type="text" placeholder="Zip / Postal code" name="code" required>
        <input type="tel" placeholder="Phone number" name="phone" required>
        
        <div class="submit">
            <button type="submit" class="signup">Submit Application</button>
        </div>
    </div>
</form>

  </div>
  
</body>
</html>
