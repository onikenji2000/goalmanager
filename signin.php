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
   $password = $_POST['password']; // password_hash($_POST['password'], PASSWORD_BCRYPT);
   
   $query = 'SELECT user_id, username, user_password FROM goal_user WHERE username LIKE ?';
   $db_stmt = $db->prepare($query);
   $db_stmt->bind_param('s', $username);
   $db_stmt->execute();
   $result = $db_stmt->get_result();
   
   $user_data = $result->fetch_assoc();
   if($user_data && password_verify($password, $user_data['user_password'])) {
      $_SESSION['user_id'] = $user_data['user_id'];
      header('Location: dashboard.php');
      die();
   }
   else {
      ?>
      <script>
      alert("The username and password you entered did not match");
      </script>
      <?php
   }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Goal Management System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <div class="logo">Goal Management System</div>
    </header>

    <section class="login-section">
        <form class="login-form" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <a href="#" class="forgot-password">Forgot Password?</a>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="illustration">
            <!-- You can insert your image here -->
        </div>
    </section>
</body>
</html>