<?php
$status_color['completed'] = '#00c853';
$status_color['in queue'] = '#ffca28';
$status_color['ongoing'] = '#76ff03';

$status_text['completed'] = '✔ Completed';
$status_text['in queue'] = '⏳ In Queue';
$status_text['ongoing'] = '● Ongoing';
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
$query = 'SELECT goal_no, goal_name, goal_deadline, goal_status, goal_color FROM goal_tracker WHERE user_id = ?';
$db_stmt = $db->prepare($query);
$db_stmt->bind_param('i', $_SESSION['user_id']);
$db_stmt->execute();
$result = $db_stmt->get_result();
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
            <a href="newgoal.php" style="background-color: #00c853; padding: 15px 30px; border: none; border-radius: 25px; font-weight: bold; color: white;">Create New Goal</a>
            <button style="background-color: #ff5252; padding: 15px 30px; border: none; border-radius: 25px; font-weight: bold; color: white;">Delete Goal</button>
        </div>

        <table style="width: 100%; margin: 20px auto; text-align: left; border-spacing: 20px;">
            <thead>
                <tr>
                    <th>Goal Name</th>
                    <th>Deadline</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
               <?php
               while($goal_data = $result->fetch_assoc()) {
                 ?>
                 <tr>
                    <td style="background-color: <?php echo $goal_data['goal_color']; ?>; padding: 20px; border-radius: 10px;"><?php echo $goal_data['goal_name']; ?></td>
                    <td style="background-color: <?php echo $goal_data['goal_color']; ?>; padding: 20px; border-radius: 10px;"><?php echo $goal_data['goal_deadline']; ?></td>
                    <td style="background-color: <?php echo $status_color[$goal_data['goal_status']]; ?>; padding: 20px; border-radius: 10px; text-align: center; color: white;"><?php echo $status_text[$goal_data['goal_status']]; ?></td>
                 </tr>
                 <?php
               }
               //<!--
                //<tr>
                //    <td style="background-color: #64b5f6; padding: 20px; border-radius: 10px;">Goal 1</td>
                //    <td style="background-color: #64b5f6; padding: 20px; border-radius: 10px;">03/08/24</td>
                //    <td style="background-color: #00c853; padding: 20px; border-radius: 10px; text-align: center; color: white;">✔ Completed</td>
                //</tr>
                //<tr>
                //    <td style="background-color: #ba68c8; padding: 20px; border-radius: 10px;">Goal 2</td>
                //    <td style="background-color: #ba68c8; padding: 20px; border-radius: 10px;">05/08/24</td>
                //    <td style="background-color: #00c853; padding: 20px; border-radius: 10px; text-align: center; color: white;">✔ Completed</td>
                //</tr>
                //<tr>
                //    <td style="background-color: #ff8a65; padding: 20px; border-radius: 10px;">Goal 3</td>
                //    <td style="background-color: #ff8a65; padding: 20px; border-radius: 10px;">03/09/24</td>
                //    <td style="background-color: #ffca28; padding: 20px; border-radius: 10px; text-align: center; color: white;">⏳ In queue</td>
                //</tr>
                //<tr>
                //    <td style="background-color: #ffd54f; padding: 20px; border-radius: 10px;">Goal 4</td>
                //    <td style="background-color: #ffd54f; padding: 20px; border-radius: 10px;">08/09/24</td>
                //    <td style="background-color: #76ff03; padding: 20px; border-radius: 10px; text-align: center; color: white;">● Ongoing</td>
                //</tr>
                //-->
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>
