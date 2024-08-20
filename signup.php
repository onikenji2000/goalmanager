<?php
session_start();

if(isset($_SESSION['goal_mngr_db_host'])) {
   $dbhost = $_SESSION['goal_mngr_db_host'];
	$dbuser = $_SESSION['goal_mngr_db_user'];
	$dbpass = $_SESSION['goal_mngr_db_pass'];
	if($dbpass == null) $dbpass = '';
	$dbschema = $_SESSION['goal_mngr_db_schema'];
}

if(isset($_POST['username'])) {
   $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbschema) or die('Error Connection!');

   $username = $_POST['username'];
   $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
   $confirm_password = password_hash($_POST['confirm-password'], PASSWORD_DEFAULT);
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   if($_POST['password'] != $_POST['confirm-password']) {
      header('Location: signup.php?err=1');
      die();
   }

   $save = 'INSERT INTO goal_user (username, user_password, user_email, user_contact_no)
   VALUES (?, ?, ?, ?)';
   $db_stmt = $db->prepare($save);
   $db_stmt->bind_param('ssss', $username , $password , $email , $phone);
   try {
      if($db_stmt->execute()) {
         header('Location: signin.php');
         die();
      }
      else {
         header('Location: signup.php?err=2');
         die();
      }
   }
   catch(Exception $ex) {
      header('Location: signup.php?err=3');
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Goal Management System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <div class="logo">Goal Management System</div>
    </header>

    <section class="signup-section">
        <form class="signup-form" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm your password</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>

            <button type="submit" class="signup-btn">Sign Up</button>
        </form>

        <p class="or-continue">or continue with</p>

        <div class="social-signup">
            <a href="#"><img src="google-icon.png" alt="Google"></a>
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a>
        </div>
    </section>

    <div class="illustration">
        <!-- INSERT IMAGE HERE -->
    </div>
</body>
</html>
