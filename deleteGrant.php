<?php
function __autoload($class_name) {
	require_once('Database.php');
    require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
		if(isset($_POST['deleteButton'])){
			$grantId = $_POST['id'];
			$success = $_SESSION['obj']->deleteGrant($grantId);
			header("Location:pendingGrants.php");
		}
		else{
			header("Location:profile.php");
		}
	}
	else{
		header("Location:profile_admin.php");
	}
}
?>