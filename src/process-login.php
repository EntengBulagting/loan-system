<?php
if (isset($_POST["submit"])) {
	session_start();
	require_once "../config/config.php";
	require_once "../lib/database-handler.php";
	require_once "../models/Administrator.php";

	$email = $_POST["email"];
	$password = $_POST["password"];
	$administrator = new Administrator();
	$admin = $administrator->getAdmin($email);
	if ($admin) {
		if (password_verify($password, $admin->password)) {
			$_SESSION["admin-verified"] = $admin->data_subject_id;
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