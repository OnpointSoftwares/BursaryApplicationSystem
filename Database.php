<?php
class Database{
	public function updateQuery($con,$sql){
		if(mysqli_query($con,$sql)){
			return true;
		}
		else{
			return false;
		}
	}
	public function retrieveQuery($con,$sql){
		return $con->query($sql);
	}
	
}
?>