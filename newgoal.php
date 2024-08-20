<?php
session_start();

if(isset($_SESSION['goal_mngr_db_host'])) {
   $dbhost = $_SESSION['goal_mngr_db_host'];
	$dbuser = $_SESSION['goal_mngr_db_user'];
	$dbpass = $_SESSION['goal_mngr_db_pass'];
	if($dbpass == null) $dbpass = '';
	$dbschema = $_SESSION['goal_mngr_db_schema'];
}

if(isset($_POST['goal-name'])) {
   $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbschema) or die('Error Connection!');
   
   $query = 'INSERT INTO goal_tracker (goal_name, goal_deadline, goal_status, user_id, goal_color) VALUES
   (?, ?, ?, ?, ?)';
   $db_stmt = $db->prepare($query);
   $initial_status = 'in queue';
   $db_stmt->bind_param('sssis', $_POST['goal-name'], $_POST['goal-deadline'], $initial_status, $_SESSION['user_id'], $_POST['goal-color']);
   if($db_stmt->execute()) {
      header('Location: goals.php');
      die();
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal Management System - Goals</title>
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
                <li><a href="dashboard.php">Home</a></li>
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
        <div style="display: flex; justify-content: space-around; margin: 20px;">
            <form method="post">
               <label for="goal-name">Goal Name</label>
               <input type="text" id="goal-name" name="goal-name" placeholder="Name of the Goal">
               <label for="goal-deadline">Goal Name</label>
               <input type="date" id="goal-deadline" name="goal-deadline" placeholder="Goal Deadline">
               <label for="goal-color">Goal Name</label>
               <input type="color" id="goal-color" name="goal-color" placeholder="Define Color">
               <button type="submit" class="login-btn">Save Goal</button>
            </form>
        </div>
    </section>
</body>

</html>
