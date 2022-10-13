<?php 
function __autoload($class_name) {
	// including the classes files
	require_once('User.php');
	require_once('Database.php');
}

session_start();
// Checking whether the user is logged in or not.
if(isset($_SESSION['login'])==true){
	// Checking the user is admin or applicant.
	if($_SESSION["obj"]->getUserName()=="admin"){
		header("Location:profile_admin.php");
	}
	else{
		header("Location:profile.php");
	}	
}
// Checking whether the submit is pressed or not.
else if(isset($_POST['submitButton'])){
	// Storing data in variables.
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	// Checking whether all the fields are filled or not.
	if($userName == '' || $password == '' || $role == 'Select'){
		$_SESSION['result'] = "Please fill all values!";
	}
	// Checking the credentials.
	else{
		require_once('dbConnect.php');
		// sql query.
		$sql = "SELECT * FROM users WHERE userName='$userName'";
		// Creating session object of database class.
		$_SESSION['databaseObj'] = new Database();
		// Finding the row in database which matches with the username provided by user.
		$result = $_SESSION['databaseObj']->retrieveQuery($con,$sql);
		if($result->num_rows==1){
			$row = $result->fetch_assoc();
			// Checking that the other fields are matching or not.
			if($row['password']==$password && $row['role'] == $role){
				// Session login object.
				$_SESSION['login'] = true;
				$_SESSION['result'] = "Successfully Logged in";
				if($role=="Admin"){
					// Creating Session object of Admin class.
					$_SESSION['obj'] = new Admin($row['firstName'],$row['lastName'],$userName,$row['gender'],$role);
					header("Location:profile_admin.php");
				}
				else{
					// Creating Session object of Applicant class.
					$_SESSION['obj'] = new Applicant($row['firstName'],$row['lastName'],$userName,$row['gender'],$role,$row['presentLimit'],$row['grantMoneyLeft'],$row['numberOfGrantsRequested']);
					header("Location:profile.php");
				}	
			}
			else{
				$_SESSION['result'] = "Password or Role is not correct ";
			}
		}
		else{
			$_SESSION['result'] = "Username does not exist";
		}
		mysqli_close($con);
	}
}
?>
<!--<link rel="stylesheet" href="final.css" type="text/css">-->
<!DOCTYPE html>
<title>Bursary Aplication System</title>
<html>
 <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
   <!--<link rel="stylesheet" href="final.css" type="text/css"> -->     
<style>
div.transbox{
  width:500px;
  align:center;
  height:400px;
  margin:0 auto;
  padding:1%;
  background-color: white;
  text-size:20px;
  text-color:#4db6ac;
}
div.transbox h5 {
  text-size:25px;
  font-weight: bold;
  color: #009688 ;
}
</style>
<body >
<div class="row" style="background:#2B8C67;">

			<br>
			<p align="center" style="font-size:25px;width:30%;margin:0 auto; display:block;height:80px;color:white;">Elimu Bursary</p>
</div>
<div class="row">
	<h5 style="width:100%;text-align:center;margin-top:4%;">Bursary Application System</h5><br><br>
    <div class="col l4 s12 m4"></div>
	<div class="transbox col l4 s12 m4">
		<form style="width:100%; height:100%;" action="login.php" method="POST">
		        <div class="row">
		            
		            <div class="input-field col s6" style="width:100%;margin:0 auto;display: block;">
                      <input id="first_name" type="text" class="validate" name="userName" required>
                      <label for="username" style="color:#009688">Username : </label>
                    </div>
                    <div class="input-field col s6" style="width:100%;">
                      <input id="password" type="password" class="validate" name="password" required>
                      <label for="password" style="color:#009688">Password : </label>
                    </div>
                </div>
                <div class="input-field col s12" style="width:100%;">
                    <select name="role"  required>
                      <option value="Select" selected="selected">Select</option>
                      <option value="Student" >Student</option>
			          <option value="Faculty" >Faculty</option>    
			          <option value="Admin" >Admin</option>
                    </select>
                    <label style="color:#009688">Roles : </label>
                </div>
                <br><br><br><br>
            <h6 style="color:red;width:100%;text-align:center;display: block;">
	            <?php if(isset($_SESSION['result'])){
			            if($_SESSION['result']!="Successfully Logged in"){
							echo $_SESSION['result'];
							unset($_SESSION['result']);
						}
						
					}
				?>
            </h6>
	        <button style="width:30%;margin:0 auto; display:block;text-align:center;" class="btn waves-effect waves-light" type="submit" name="submitButton" value="Login">Login
                <i class="material-icons right">send</i>
            </button>
            <!--<input  class="waves-effect waves-light btn" type="submit" name="submitButton" value="Login">-->
		    </form>
	    
	  </div>
</div>	

<script>
$(document).ready(function() {
    $('select').material_select();
	
});
     
</script>
</body>
</html>
