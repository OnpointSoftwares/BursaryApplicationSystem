<?php
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
		if(isset($_POST['document'])){
			$grantId = $_POST['grantId'];
			$grantMoney = $_POST['grantMoney'];
			$grantType = $_POST['grantType'];
			$userName = $_POST['userName'];
		}
		else{
			header("Location:profile.php");
		}
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
    <head>
        <title>Elimu Bursary</title>
        <style>
            html, body {
              
                padding: 0;
                background-color: gray;
            }
            #container {
                width: inherit;
                height: inherit;
                margin: 0;
                padding: 0;
                background-color: white;
            }
            h3 {
                margin-left: 150px;
                padding: 0;
            }
            pre.custompgh{
				margin-left:-20px;
				font-size:18px;
			}
			h4.custom1{
				margin-left:20px;
				font-size:20px;
			}
			h3.custom2{
				margin-left:30px;
				font-size:24px;
			}
			h4.custom3{
				margin-right:-400px;
				margin-top: -50px;
				font-size:20px;
			}
			h2.custom2{
				margin-left:400px;
				font-size:20px;
			}
			img.custom4{
				margin-right:10px;
				
			}
        </style>
    </head>
    <body>
        <div id="container">
        	<br>
            <h3 class="custom2" align ="left">Elimu Bursary<br></h3></p><br>
            <h2 class="custom2" align="center">Grant acceptance letter</h2><br>
            <h4 class="custom1">Grant ID: <?php echo $grantId?></h4><br>
            <h4 class="custom1">Dear Applicant,</h4>
            <pre class="custompgh">
            	We are pleased to inform you that your request for <?php echo $grantType?> has been accepted by us.So you
		can collect your Cash Cheque ( Ksh.<?php echo $grantMoney?> ) from CDF office by showing this acceptance letter.<br>
			</pre>
			<br><br><br><br><br><br>
			<h4 class="custom1" align="left">Signature of applicant
			<h4 class="custom3" align="right">Signature of admin</h4>
        </div>
    </body>
</html>

