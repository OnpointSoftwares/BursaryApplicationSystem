	<?php
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
$message="";
session_start();
if(isset($_SESSION['login'])==true){
		if(isset($_POST['userName'])){
			$userName = $_POST['userName'];
			$success = $_SESSION["obj"]->removeApplicant($userName);
		}
		header("Location:profile_admin.php");
	
}
else{
	header("Location:login.php");
}
?>
