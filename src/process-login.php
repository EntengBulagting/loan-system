<?php
if (isset($_POST["submit"])) {
	session_start();
	require_once "../config/config.php";
	require_once "../lib/database-handler.php";
	require_once "../models/Administrator.php";
	require_once "../models/Cycle.php";

	$email = $_POST["email"];
	$password = $_POST["password"];
	$user = new User();
	$admin = $user->confirmAdmin($email);
	if ($admin) {
		if (password_verify($password, $admin->password)) {
			$_SESSION["admin-verified"] = $admin->user_id;
			$_SESSION["cycle"] = date("Y");
			$path = "../home.php";
		}
		else {
			$message = "The password you entered is incorrect!";
			$path = "../index.php";
		}
	}
	else {
		$message = "You do not have permission to access this website.";
		$path = "../index.php";
	}

	if (isset($message))
		echo "<script>alert('$message');</script>";
	echo "<script>window.location.replace('$path');</script>";
}