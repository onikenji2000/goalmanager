<?php 
session_start();
$_SESSION['goal_mngr_db_host'] = 'localhost';
$_SESSION['goal_mngr_db_user'] = 'root';
$_SESSION['goal_mngr_db_pass'] = null;
$_SESSION['goal_mngr_db_schema'] = 'goalmanager';

if(isset($_SESSION['user_id'])) {
   header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal Management System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <div class="logo">Goal Management System</div>
        <nav>
            <ul>
                <li><a href="#">Demo</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About us</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="signin.php" class="login-btn">Login</a>
            <a href="signup.php" class="signup-btn">Sign Up</a>
        </div>
    </header>

    <section class="main-section">
        <h1>ACHIEVE YOUR GOALS WITH EASE AND CLARITY</h1>
        <p>Welcome to our goal management website, where you can easily categorize your goals.<br>Take control of your life and start achieving your dreams today.</p>
        <a href="#" class="learn-more">Learn More</a>
    </section>

    <div class="illustration">
        <!-- INSERT IMAGE HERE -->
    </div>
</body>
</html>
