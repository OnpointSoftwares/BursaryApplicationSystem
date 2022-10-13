<?php
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
	}
	else{
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
<style>

div.transbox{
  margin:auto;
  width:400px;
  align:center;
  padding-left:3%;
  padding-right:3%;
  padding-bottom:3%;
  border-style: solid;
  border-color: #000000;
  height:280px;
  background-color: #ffffff;
  text-color:#4db6ac;
}
div.transbox h3 {
  text-align:left;
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
</style>
</head>
<body >
<img src="logo.png" style="width:69.84px;height:75.76px;" ><h1 style="color:black; font-family:Comic Sans MS, cursive, sans-serif; font-size:30px; font-weight: bold; margin-top:-5%; margin-left:1%;"  align ="center">ELimu Bursary</h1>
<body style=" width:99%; height:100%;">
     <div class="row">
        <div class="col s12">
          <ul id="tabs-swipe-demo" class="tabs" style="color:#009688; margin-top:3%;">
            <li ><a style="color:white;" target="_self" href="profile.php">Home</a></li>
            <li ><a style="color:white;" target="_self" href="request_layout.php">Request Grant</a></li>
            <li ><a style="color:white;" target="_self" href="pendingGrants.php">Pending Grants</a></li>
            <li ><a style="color:white;" target="_self" href="oldApprovedGrants.php">Approved Grants</a></li>
            <li ><a style="color:white;" target="_self" href="oldDisapprovedGrants.php">Disapproved Grants</a></li>
            <li ><a style="color:white;" target="_self" href="logout.php">Logout</a></li>
          </ul>
        </div>
     </div> 
	 
<script>
 $(document).ready(function(){
    $('ul.tabs').tabs();
  });
    $(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });
</script>
	<h3 >
	                    <?php if(isset($_SESSION['result'])){
			                    echo '<div style="color:green; text-align:center"><br>'.$_SESSION["result"].'</div>';
			                    unset($_SESSION['result']);
							}
							
						?>
                 </h3>
     <div class="row">
	        <div class="transbox">
	            <br>
            
	            <h3>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:                    
					<?php echo " ".$_SESSION["obj"]->getFirstName()." ".$_SESSION["obj"]->getlastName(); ?></h3>
	            <h3>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:                   
					<?php echo " ".$_SESSION["obj"]->getUserName(); ?> </h3>
	            <h3>Gender&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:                      
					<?php echo " ".$_SESSION["obj"]->getGender(); ?></h3>     
	            <h3>Role&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp :                        
					<?php echo " ".$_SESSION["obj"]->getRole(); ?></h3>
	            <h3>Present Limit&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:              
					<?php echo " ".$_SESSION["obj"]->getPresentLimit(); ?></h3>
	            <h3>Grant Money Left&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:            
					<?php echo " ".$_SESSION["obj"]->getGrantMoneyLeft(); ?></h3>
	        </div>
	</div>
</body>
</html>
 
