<?php
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	
		if(isset($_POST['approval'])){
			$approval = $_POST['approval'];
			$grantId = $_POST['id'];
			$userName = $_POST['userName'];
			$success = $_SESSION['obj']->validateGrant($userName,$grantId,$approval);
			header("Location:viewPendingAdmin.php");
		}
		else{
			$_SESSION['result'] = "Please select your decision first";
			header("Location:viewPendingAdmin.php");
		}
	
}
else{
	header("Location:login.php");
}
?>