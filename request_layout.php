<?php 
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()=="admin"){
		header("Location:profile_admin.php");
	}
}	
else{
	header("Location:login.php");	
}
?>
<!DOCTYPE html>
<html>
<title>Bursary Application System</title>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
<style>
div.transbox{
  margin-top:5%;
  margin-left:30%;
  width:600px;
  align:center;
  height:400px;
  border-style: solid;
  border-color: #000000;
  background-color: #ffffff;
  opacity: 0.8;
  color:#4db6ac;
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
    width:16.666666%;
}

li a {
    display: block;
    margin-top:-1.3%;
	margin-left:-0.8%;
    color: #ef9a9a;
    text-align: center;
    padding: 16px;
    text-decoration: none;
    font-family: GillSans, Calibri, Trebuchet, sans-serif;
    font-size:16px;
}

li a:hover {
    background-color:#00E5EE;
	font-weight: bold;
    color:#e57373;
}
table{
    border-collapse: collapse;
    width: 99%;
    margin-top:20px;
    font-family: GillSans, Calibri, Trebuchet, sans-serif;
}
th, td {
    text-align: left;
    font-family: GillSans, Calibri, Trebuchet, sans-serif;
    height:50px;
}
tr:nth-child(even){background-color: #D0D0D0}
tr:nth-child(odd){background-color: #f0f0f0}
th {
    background-color: #009688;
    color: white;
} 
td{
    height:50px;
}
</style>
</head>
<img src="logo.png" style="width:69.84px;height:75.76px; margin-top:0.6%;margin-left:0.6%;"><h1 style="color:black; font-family:Comic Sans MS, cursive, sans-serif; font-size:30px; font-weight: bold; margin-top:-4.75%; margin-left:1.1%;"  align ="center">Elimu Bursary</h1>
<body style="width:100%; height:100%;">
        <div class="col s12">
           <ul style=" color:#009688;margin-top:3.3%; height:51px;width:89.05%;margin-left:5.6%;">
            <li ><a style="color:white;" target="_self" href="profile.php">Home</a></li>
            <li ><a style="color:white;" target="_self" href="request_layout.php">Request Grant</a></li>
            <li ><a style="color:white;" target="_self" href="pendingGrants.php">Pending Grants</a></li>
            <li ><a style="color:white;" target="_self" href="oldApprovedGrants.php">Approved Grants</a></li>
            <li ><a style="color:white;" target="_self" href="oldDisapprovedGrants.php">Disapproved Grants</a></li>
            <li ><a style="color:white;" target="_self" href="logout.php">Logout</a></li>
          </ul>
        </div>
     </div>
    <form class="col s12" action="request.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col l4 s12 m4"></div>
	        <div class="transbox">
			        <div class="input-field col s12" style="width:450px; margin-left:12.5%; margin-top:10%;">
                            <select name="grantType" required>
						        <option value="Select"  selected="selected">Select</option>
                                <option value="School Fees" >School Fees</option>
						        
                            </select>
                    <label style="color:#009688">Type of Grant :</label>
                    </div>
                    <br><br>
                    <div class="row">
		                    <div class="input-field col s6" style="width:450px; margin-left:12.5%;">
                              <input type="number" class="validate" name="grantMoney" required>
                              <label style="color:#009688">Money Required : </label>
                            </div>
                            <div class="input-field col s6" style="width:450px; margin-left:12.5%;">
                              <input style="color:#009688:"id="fileToUpload" type="file" class="validate" name="fileToUpload" required><br>
                              <p style="color:#009688">Select Fees Structure File to Upload :(Size<2MB)</p>
                            </div>
                    </div>
                    
                    <h6 style="color:red; width:100%;text-align:center;">
	                    <?php if(isset($_SESSION['result'])){
								if($_SESSION['result'][0]=='G'){
									echo '<div style="color:green; text-align:center">'.$_SESSION['result'].'</div>';
								}
								else{
									echo '<div style="color:red; text-align:center">'.$_SESSION['result'].'</div>';
								}
			                    unset($_SESSION['result']);
							}
	                    ?>
                    </h6>
	                <button style="width:20%;margin:0 auto; display:block;" class="btn waves-effect waves-light" type="submit" name="grantButton" value="Submit">Request
                        <i class="material-icons right"></i>
                    </button>
	        </div>
        </div>
    </form>
	
</body>

    <script>
     $(document).ready(function() {
        $('select').material_select();
      });
    </script>
</html>
