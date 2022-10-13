<?php
session_start();
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}

?>
<!DOCTYPE html>
<html>
<title>Bursary Application Management System</title>
<head>

<script>
 $(document).ready(function(){
    $('ul.tabs').tabs();
  });
    $(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });
</script>
<style>
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
table{
    border-collapse: collapse;
    margin:auto;
    width: 80%;
    margin-top:20px;
    font-family: GillSans, Calibri, Trebuchet, sans-serif;
}
th, td {
    text-align: center;
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
<img src="logo.png" style="width:69.84px;height:75.76px;" ><h1 style="color:black; font-family:Comic Sans MS, cursive, sans-serif; font-size:30px; font-weight: bold; margin-top:-5%; margin-left:1%;"  align ="center">Bomet County</h1>
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
        </div>
     </div>  
      
<?php
if(isset($_SESSION['login'])==true){
		if(isset($_SESSION['result'])){
			echo '<div style="color:green; font-size : 25px; text-align:center"><br>'.$_SESSION["result"].'</div>';
			unset($_SESSION['result']);
		}
		$result = $_SESSION["obj"]->viewPendingGrants("pending");

		if($result->num_rows>0){
			echo "
                   
                    <table>
					<tr>
						<th>Username</th>
						<th>Grant Id</th>
						<th>Grant Type</th>
						<th>Grant Money</th>
						<th>Request Time</th>
						<th>Link</th>
						<th>Form</th>
					</tr>
                    ";
            echo " <form class='col s12' action='decision.php' method='POST'>";
			while($rows = $result->fetch_assoc()){
				$id = $rows['grantId'];
				$userName = $rows['userName'];
				echo " 
                   
                    <tr>
						<td>".$rows['userName']."</td>
						<td>".$rows['grantId']."</td>
						<td>".$rows['grantType']."</td>
						<td>".$rows['grantMoney']."</td>
						<td>".$rows['requestTime']."</td>
						<td><a href='uploads/".$rows['grantId'].".pdf' target='_blank'>See Document</a></td>
						<td>
						<form class='col s12' action='decision.php' method='POST'>
							<input type='hidden' name='id' value='$id'>
							<input type='hidden' name='userName' value='$userName'>
							<input name='approval' type='radio' id='test5' value='Approved'>Approve
							<input name='approval' type='radio' id='test5' value='Disapproved' >Disapprove
							<br>
							<input style='margin:auto;border-radius:3px; width:80px; height:30px;' type='submit'>
						</form>
						</td>
					</tr>
                   ";
			}
			echo "</table>";
		}
		else{
			echo '<div style="color:black; font-size : 25px; text-align:center">No Pending Grants</div>';
		}
		
}
else{
	header("Location:login.php");
}	
?>
</body>
</html>
