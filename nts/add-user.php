<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php 
	if (!isset($_SESSION['user_id'])) {
		header('Location: login.php');
	}

	$errors = array();
	$first_name = '';
	$last_name = '';
	$email = '';
	$password = '';

	if (isset($_POST['submit'])) {
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];

		// checking required fields
		$req_fields = array('first_name', 'last_name', 'email', 'password');

		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
				$errors[] = $field . ' is required';
			}
		}

		// checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'password' => 40);

		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field . ' must be less than ' . $max_len . ' characters';
			}
		}

		// checking email address
		// if (!is_email($_POST['email'])) {
		// 	$errors[] = 'Email address is invalid.';
		// }
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
		$result_set = mysqli_query($connection,$query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1){
				$errors[] = "Email address already exists.";
			}
		}

		if ($password!=$password_confirm){
			$errors[]= "Password confirmation is unsuccessful.";
		}

		if (empty($errors)){
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$password= mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);

			$query = "INSERT INTO user ( ";
			$query .= "first_name, last_name, email, password, is_deleted";
			$query .= ") VALUES (";
			$query .= " '{$first_name}' , '{$last_name}', '{$email}', '{$hashed_password}',0";
			$query .= ")";

			$result = mysqli_query($connection,$query);

			if ($result){
				header('Location: users.php?user_added=true');
			} else{
				$errors[] = 'Failed to add the new record';
			}

		}

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
	<div class="bg-image">
	<h1>Add New User <span><a href="users.php"> User Account &gt&gt</a></span></h1>
	<fieldset>
		<?php 

			if (!empty($errors)) {
				echo '<div class="errmsg">';
				echo '<b>There were error(s) on your form.</b><br>';
				foreach ($errors as $error) {
					$error = ucfirst(str_replace("_", " ", $error));
					echo "<b> - $error </b>". '<br>';
				}
				echo '</div>';
			}

		 ?>
	<form action="add-user.php" method="post" class="userform">
		<p>
			<label for="">First Name</label>
			<input type="text" name="first_name" <?php echo 'value="' . $first_name . '"'; ?>>
		</p>
		<p>
			<label for="">Last Name</label>
			<input type="text" name="last_name" <?php echo 'value="' . $last_name . '"'; ?>>
		</p>
		<p>
			<label for="">Email Address</label>
			<input type="text" name="email" <?php echo 'value="' . $email . '"'; ?>>
		</p>
		<p>
			<label for="">New Password</label>
			<input type="password" name="password" >
		</p>
		<p>
			<label for="">Confirm Password</label>
			<input type="password" name="password_confirm" >
		</p>
		<p>
			<label for=""></label>
			<button type="submit" name="submit">Submit</button>
		</p>
	</form>
	</fieldset>
	</div>
</body>

</html>
<?php mysqli_close($connection); ?>