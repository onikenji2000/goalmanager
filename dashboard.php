<?php
session_start();

if(isset($_SESSION['goal_mngr_db_host'])) {
   $dbhost = $_SESSION['goal_mngr_db_host'];
	$dbuser = $_SESSION['goal_mngr_db_user'];
	$dbpass = $_SESSION['goal_mngr_db_pass'];
	if($dbpass == null) $dbpass = '';
	$dbschema = $_SESSION['goal_mngr_db_schema'];
}

if(!isset($_SESSION['user_id'])) {
   header('Location: index.php');
}

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbschema) or die('Error Connection!');
$query = 'SELECT user_id, username, user_email, user_contact_no FROM goal_user WHERE user_id = ?';
$db_stmt = $db->prepare($query);
$db_stmt->bind_param('i', $_SESSION['user_id']);
$db_stmt->execute();
$result = $db_stmt->get_result();

$user_data = $result->fetch_assoc();
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
        <div class="logo">
            <img src="goal-management-logo.png" alt="Goal Management System Logo" style="width: 50px; vertical-align: middle;">
            Goal Management System
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="signout.php" class="login-btn">Sign-out</a>
        </div>
    </header>

    <section class="main-section">
        <h1>Welcome <?php echo $user_data['username']; ?>!</h1>
        <p>You are almost there!</p>
        <a href="goals.php" class="learn-more">See my goals</a>
    </section>

    <section class="signup-section">
        <div class="illustration">
            <img src="completed-goals.png" alt="Completed Goals Illustration" style="width: 200px;">
            <p>You have completed 10 goals so far. Keep going!</p>
        </div>
        <div class="illustration">
            <img src="goal-tracking.png" alt="Goal Tracking Illustration" style="width: 200px;">
        </div>
    </section>
</body>

</html>
