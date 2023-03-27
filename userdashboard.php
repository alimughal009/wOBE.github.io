<?php
session_start();
// Check if user is logged in
if(!isset($_SESSION['user_id'])){
	header('Location: User Login.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard</title>
</head>
<body>
	<h1>Welcome to the User Dashboard</h1>
	<p>Here you can manage your account and access the available features.</p>
	<ul>
		<li><a href="#">View Profile</a></li>
		<li><a href="#">Edit Profile</a></li>
		<li><a href="#">Change Password</a></li>
		<li><a href="#">Logout</a></li>
	</ul>
</body>
</html>
