<?php session_start(); ?>
<?php
require_once './dbOperations/includes/config.inc.php';
require_once './dbOperations/includes/connect&functions.inc.php';
?>

<?php

$db = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
}
$user_list = '';
$query = "SELECT * FROM user WHERE is_deleted=0 ORDER BY first_name";
$users = mysqli_query($db, $query);
while ($user = mysqli_fetch_assoc($users)) {
	$user_list .= "<tr>";
	$user_list .= "<td>{$user['first_name']}</td>";
	$user_list .= "<td>{$user['last_name']}</td>";
	$user_list .= "<td>{$user['last_login']}</td>";
	$user_list .= "<td><a href=\"modify-user.php?user_id={$user['id']}\">Edit</a></td>";
	$user_list .= "<td><a href=\"delete-user.php?user_id={$user['id']}\">Delete</a></td>";
	$user_list .= "</tr>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="css/user.css">
</head>

<body>
    <header>
        <div class="appname">Moodle</div>
        <div class="logger">Welcome <?php echo $_SESSION['first_name'] ?>!&nbsp <a href="logout.php">Log Out</a> </div>
    </header>
    <div class="top"><a href="index.php">Home</a></div>
    <a href="add-user.php">Add New User &gt&gt</a> </br>
    <h1>Users</h1>

    <table class="masterlist">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Last Login</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php echo $user_list; ?>

    </table>
</body>

</html>
<?php mysqli_close($db); ?>