<!DOCTYPE html>
<html>
<title>Bursary Application Management System</title>
 <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
   <!--<link rel="stylesheet" href="final.css" type="text/css"> -->     
<style>
div.transbox{
  margin:auto;
  width:400px;
  align:center;
  padding:3%;
  border-style: solid;
  border-color: #000000;
  height:280px;
  background-color: #ffffff;
  text-color:#4db6ac;
}
div.transbox h5 {
  margin-left: 7.5%;
  margin-top:-2%;
  font-weight: bold;
  color: #009688 ;
}
ul {
    list-style-type: none;
    margin:auto;
    margin-left:0px;
    padding: 0;
    margin:5%;
    overflow: hidden;
    background-color: #009688;
    color:#ffcdd2;
}

li {
    float: left;
    width:16.66%;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 16px;
    text-decoration: none;
    font-family: GillSans, Calibri, Trebuchet, sans-serif;
    font-size:16px;
    margin-top:-1.4%;
    margin-left:-0.82%;
}

li a:hover {
    background-color:#00E5EE;
	font-weight: bold;
    color:gray;
}
</style>
</head>
<img src="logo.png" style="width:69.84px;height:75.76px;margin-top:0.6%;margin-left:0.6%;" ><h1 style="color:black; font-family:Comic Sans MS, cursive, sans-serif; font-size:30px; font-weight: bold; margin-top:-4.75%; margin-left:1.2%;"  align ="center">Elimu Bursary</h1>
<body style=" width:100%; height:100%;">
     <div class="row">
        <div class="col s12">
            <ul style=" ;margin-top:1.5%; height:51px;width:90.6%;margin-left:4.8%;">
              <li class="tab col s2"><a style="color:white;" target="_self" href="profile_admin.php">HOME</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="viewPendingAdmin.php">PENDING GRANTS</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="viewGrantsAdmin.php">VIEW OLD GRANTS</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="removeApplicant_layout.php">REMOVE APPLICANT</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="grantMoney_layout.php">GRANT MONEY</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="logout.php">LOG OUT</a></li>
           </ul>
        </div>
     </div>  
<?php
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
$message="";
session_start();
if(isset($_SESSION['login'])==true){
		echo 
			"
			<form action='grantMoney.php' method='POST'>
            <div class='row'>
                <div class='col l4 s12 m4'></div>
					<div class='transbox'>
							<div class='input-field col s6' style='width:100%; padding-bottom:15%'>
							    <input  class='validate' type='text' name='grantId' required>
								<label >Grant Id : </label>
                                
                            </div>
							<br>
							<h6 style='color:red; width:100%;text-align:center;'>";
								if(isset($_SESSION['result'])){
									if($_SESSION['result'][0]=='G'){
										echo '<div style="color:red; text-align:center">'.$_SESSION['result'].'</div>';
									}
									else{
										echo '<div style="color:green; text-align:center">'.$_SESSION['result'].'</div>';
									}
									unset($_SESSION['result']);
								}
		echo 				"</h6>
							<button style='width:40%;margin:0 auto; display:block;' class='btn waves-effect waves-light' type='submit' name='SubmitButton'' value='Submit'>Check
									<i class='material-icons right'>send</i>
							</button>
						
					</div>
				</div>
			</div>
			</form>";
}
else{
	header("Location:login.php");
}
?>









