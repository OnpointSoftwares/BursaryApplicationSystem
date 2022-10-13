<?php
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
		if(isset($_POST['grantId'])){
			$grantId = $_POST['grantId'];
			$success = $_SESSION["obj"]->giveGrantMoney($grantId);
		}
		header("Location:grantMoney_layout.php");
}
else{
	header("Location:login.php");
}
?>
