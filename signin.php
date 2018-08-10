<?php
require 'connect.php';

session_start();

if(isset($_POST['signin'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = "SELECT * FROM agent where username = '".$username."' and password = '".$password."'";
	
	if($conn->query($result)->num_rows == 1) {
		$_SESSION['username'] = $username;
		header('Location: index.php');
	}
	else {
		header('Location: login.php');
	}
}
?>