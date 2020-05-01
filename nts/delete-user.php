<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	if (isset($_GET['user_id'])) {
		// getting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

		if ($user_id == $_SESSION['user_id']){
			header('Location: users.php?err=cannot_delete_current_user');
		}
		else{
			$query = "UPDATE user SET is_deleted = 1 WHERE id = {$user_id} LIMIT 1 ";
			$result = mysqli_query($connection,$query);
			if($result){
				header('Location: users.php?msg=user_deleted');

			}else{
				header('Location: users.php?err=delete_failed');
			}

		}
		
	} else {
		// query unsuccessful
		header('Location: users.php');
	}

?>