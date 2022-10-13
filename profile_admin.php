<?php
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	/*if($_SESSION["obj"]->getUserName()=="Admin"){
	}
	else{
		header("Location:profile.php");
	}*/
}
else{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<title>Elimu Bursary</title>
<head>  
  
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
  height:250px;
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
    color: white;
    text-align: center;
    padding: 16px;
    text-decoration: none;
    font-family: GillSans, Calibri, Trebuchet, sans-serif;
    font-size:16px;
}
li a:hover {
    background-color:#00E5EE;
	font-weight: bold;
    color:gray;
}
</style>

<script>
     $(document).ready(function(){
        $('ul.tabs').tabs();
     });
        $(document).ready(function(){
        $('ul.tabs').tabs('select_tab', 'tab_id');
     });
</script>
</head>
<img src="logo.png" style="width:69.84px;height:75.76px;" ><h1 style="color:black; font-family:Comic Sans MS, cursive, sans-serif; font-size:30px; font-weight: bold; margin-top:-5%; margin-left:1%;"  align ="center">Elimu Bursary</h1>
<body style="width:99%; height:100%;">
     <div class="row">
        <div class="col s12">
            <ul style="color:white;margin-top:3%;">
              <li class="tab col s2"><a style="color:white;" target="_self" href="profile_admin.php">HOME</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="viewPendingAdmin.php">PENDING GRANTS</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="viewGrantsAdmin.php">VIEW OLD GRANTS</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="removeApplicant_layout.php">REMOVE APPLICANT</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="grantMoney_layout.php">GRANT MONEY</a></li>
              <li class="tab col s2"><a style="color:white;" target="_self" href="logout.php">LOG OUT</a></li>
           </ul>
		 	<h3 >
	                    <?php if(isset($_SESSION['result'])){
			                    echo '<div style="color:green; text-align:center"><br>'.$_SESSION["result"].'</div>';
			                    unset($_SESSION['result']);
							}
							
						?>
                 </h3>
        </div>       

            <div class="col l4 s12 m4"></div>
	        <div class="transbox">
                <br><br>
	            <h6 style="color:green;width:100%;text-align:center;display: block;">
					<?php if(isset($_SESSION['result'])){
							if($_SESSION['result']!="Successfully Logged in"){
								echo $_SESSION['result'];
							}
							unset($_SESSION['result']);
						}
					?>
				</h6>
                <h3>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:                    
					<?php echo " ".$_SESSION["obj"]->getFirstName()." ".$_SESSION["obj"]->getlastName(); ?></h3>
	            <h3>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:                   
					<?php echo " ".$_SESSION["obj"]->getUserName(); ?> </h3>
	            <h3>Gender&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:                      
					<?php echo " ".$_SESSION["obj"]->getGender(); ?></h3>     
	            <h3>Role&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp :                        
					<?php echo " ".$_SESSION["obj"]->getRole(); ?></h3>
	        </div>
    </div>
</body>
</html>         
