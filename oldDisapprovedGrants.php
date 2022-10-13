<!DOCTYPE html>
<html>
<title>Bursary Application Management System</title>
<head>
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
	margin:auto;
    width: 80%;
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
<img src="logo.png" style="width:69.84px;height:75.76px;" ><h1 style="color:black; font-family:Comic Sans MS, cursive, sans-serif; font-size:30px; font-weight: bold; margin-top:-5%; margin-left:1%;"  align ="center">Elimu Bursary</h1>
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
</script>
<?php
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
		if(isset($_SESSION['result'])){
			echo $_SESSION['result'];
			unset($_SESSION['result']);
		}
		$result = $_SESSION["obj"]->viewGrants("Disapproved");
		if($result->num_rows>0){
			echo "<table>
				<tr>
					<th>Grant Id</th>
					<th>Grant Type</th>
					<th>Grant Money</th>
					<th>Request Time</th>
					<th>Status</th>
				</tr>";
			while($rows = $result->fetch_assoc()){
				echo "<tr>
					<td>".$rows['grantId']."</td>
					<td>".$rows['grantType']."</td>
					<td>".$rows['grantMoney']."</td>
					<td>".$rows['requestTime']."</td>
					<td>".$rows['grantStatus']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else{
			echo "No data";
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
</body>
</html>
