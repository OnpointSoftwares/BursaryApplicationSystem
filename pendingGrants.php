<!DOCTYPE html>
<html>
<title>Bursary Application Management System</title>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
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
</body>
</head>
</html>	
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
 document.ready(function(){
    $('ul.tabs').tabs();
  });
    $(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });
  
</script>
<script type="text/javascript">
    document.getElementById("redirect").onclick = function () {
        location.href = "request_layout.php";
    };
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
			echo '<div style="color:black; font-size : 25px; text-align:center"><br>'.$_SESSION["result"].'</div>';
			unset($_SESSION['result']);
		}
		$result = $_SESSION["obj"]->viewGrants("Pending");
		if($result->num_rows>0){
			echo "<table>
				<tr>
					<th>Grant Id</th>
					<th>Grant Type</th>
					<th>Grant Money</th>
					<th>Request Time</th>
					<th>Status</th>
					<th>Delete Grant</th>
				</tr>";
			while($rows = $result->fetch_assoc()){
				echo "<tr>
					<td>".$rows['grantId']."</td>
					<td>".$rows['grantType']."</td>
					<td>".$rows['grantMoney']."</td>
					<td>".$rows['requestTime']."</td>
					<td>".$rows['grantStatus']."</td>";
						$id = $rows['grantId'];
						echo "<td><form method='POST' action='deleteGrant.php' >
								<input style='width:30%;height:20%;' type='hidden' name='id' value='$id'>
								<button style='font-size : 12px;width:40%;height:25px;margin:0 auto; display:block;' type='submit' name='deleteButton' value='Delete Grant'>Delete
									<i class='material-icons right'></i>
								</button> 
							</form></td>";
					
				"</tr>";
			}
			echo "</table>";
		}
		else{
			echo " <br><br> <form method='POST' action='request_layout.php' >
						<button style='font-size:15px;width:20%;height:30%;margin:0 auto; display:block; padding:1%;'  id='redirect' type='submit' name='deleteButton' value='Delete Grant'>Request New Grant
				
						</button> 
					</form>";
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

