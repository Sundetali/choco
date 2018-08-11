<?php
	require 'connect.php';

	$drop_user = "truncate user_data";
	$conn->query($drop_user);

	$drop_tax = "truncate tax_data";
	$conn->query($drop_tax);

	$drop_rule = "truncate rule_data";
	$conn->query($drop_rule);

	header('Location:superviser.php');
	exit;
?>