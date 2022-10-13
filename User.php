<?php

class User{ 
    public $firstName;
    public $lastName;
	public $userName;
    public $gender;
    public $role;
    function __construct($firstName1, $lastName1 , $userName1 , $gender1 , $role1) {
        $this->firstName=$firstName1;
		$this->lastName=$lastName1;
		$this->userName=$userName1;
		$this->gender=$gender1;
		$this->role=$role1;
		
	}
    public function getFirstName() { 
        return $this->firstName;
    } 
	public function getLastName() { 
        return $this->lastName;
    } 
	public function getUserName() { 
        return $this->userName;
    } 
	public function getGender() { 
        return $this->gender;
    } 
	public function getRole() { 
        return $this->role;
    } 
}
class Applicant extends User{
	private $presentLimit;
	private $grantMoneyLeft;
	private $numberOfGrantsRequested;
	function __construct($firstName1 , $lastName1 , $userName1 , $gender1 , $role1 , $presentLimit1 , $grantMoneyLeft1 , $numberOfGrantsRequested1)  {
        parent::__construct($firstName1 , $lastName1 , $userName1 , $gender1 , $role1 );
		$this->presentLimit = $presentLimit1;
		$this->grantMoneyLeft = $grantMoneyLeft1;
		$this->numberOfGrantsRequested = $numberOfGrantsRequested1;
	}
	public function getPresentLimit() { 
        return $this->presentLimit;
    }
	public function setPresentLimit($presentLimit1) { 
        $this->presentLimit = $presentLimit1;
    }
	public function getGrantMoneyLeft() { 
        return $this->grantMoneyLeft;
    }
	public function setGrantMoneyLeft($grantMoneyLeft1) { 
        $this->grantMoneyLeft = $grantMoneyLeft1;
    }
	public function getNumberOfGrantsRequested() { 
        return $this->numberOfGrantsRequested;
	}
	public function setNumberOfGrantsRequested($factor) { 
        $this->numberOfGrantsRequested = $this->numberOfGrantsRequested+$factor;
		//return $this->numberOfGrantsRequested;
	}
	public function viewGrants($status) { 
		require_once('dbConnect.php');
		$userName=$this->getUserName();
		$sql = "SELECT * FROM grantdata WHERE username = '$userName' AND grantStatus = '$status'";
		$result = $_SESSION['databaseObj']->retrieveQuery($con,$sql);
		return $result;
    } 
	public function requestGrant($grantType , $grantMoney , $size){
		require_once('dbConnect.php');
		session_start();
		date_default_timezone_set('Asia/Kolkata');
		$time = date('H:i d/m/Y');
		$userName = $this->getUserName();
		$grantId = $this->getUserName();
		$this->setNumberOfGrantsRequested(1);
		$len = strlen($this->getNumberOfGrantsRequested());
		for( $i = 0; $i<4-$len; $i++ ) {
            $grantId .= "0";
        }
		$grantId .= $this->getNumberOfGrantsRequested();
		$sql = "INSERT INTO grantdata (grantId,userName,grantType,grantMoney,grantFileSize,grantStatus,requestTime) VALUES ('$grantId','$userName','$grantType','$grantMoney','$size','Pending','$time')";
		if($_SESSION['databaseObj']->updateQuery($con,$sql)){
			$this->setPresentLimit($this->getPresentLimit() - $grantMoney);
			$grantLimit = $this->getPresentLimit();
			$number = $this->getNumberOfGrantsRequested();
			$sql1 = "UPDATE users SET presentLimit = '$grantLimit' , numberOfGrantsRequested = '$number' WHERE userName = '$userName' ";
			if( $_SESSION['databaseObj']->updateQuery($con,$sql1) ){
				$_SESSION['result'] = "Grant Successfully Requested Grant Id ".$grantId;
				return $grantId;
			}
			else{
				$this->setPresentLimit($this->getPresentLimit() + $grantMoney);
				$_SESSION['result'] = "Sorry your grant is not Requested";
				$this->setNumberOfGrantsRequested(-1);
				$sql2 = "DELETE FROM grantdata WHERE grantId = '$grantId' ";
				$success = $_SESSION['databaseObj']->updateQuery($con,$sql2);
				return "Unsuccess";
			}
		}
		else{
			$_SESSION['result'] = "Sorry your grant is not Requested";
			$this->setNumberOfGrantsRequested(-1);
			return "Unsuccess";
		}
		mysqli_close($con);
	}
	public function deleteGrant($grantId){ 
		require_once('dbConnect.php');
		session_start();
		$sql1 = "SELECT * FROM grantdata WHERE grantId='$grantId'";
		$grant = $_SESSION['databaseObj']->retrieveQuery($con,$sql1);
		if($grant->num_rows==1){
			$rowGrant = $grant->fetch_assoc();
			$grantMoney = $rowGrant['grantMoney'];
			$userName = $this->getUserName();
			$grantType = $rowGrant['grantType'];
			$size = $rowGrant['grantFileSize'];
			$time = $rowGrant['requestTime'];
			$sql2 = "DELETE FROM grantdata WHERE grantId = '$grantId' ";
			if($_SESSION['databaseObj']->updateQuery($con,$sql2)){
				$this->setPresentLimit($this->getPresentLimit() + $grantMoney);
				$grantLimit = $this->getPresentLimit();
				$sql3 = "UPDATE users SET presentLimit = '$grantLimit' WHERE userName = '$userName' ";
				if($_SESSION['databaseObj']->updateQuery($con,$sql3)){
					$_SESSION['result'] = "Grant Successfully Deleted";
					$fileName = "uploads/".$grantId.".pdf";
					unlink($fileName);
					return true;
				}
				else{
					$this->setPresentLimit($this->getPresentLimit() + $grantMoney);
					$sql4 = "INSERT INTO grantdata (grantId,userName,grantType,grantMoney,grantFileSize,grantStatus,requestTime) VALUES ('$grantId','$userName','$grantType','$grantMoney','$size','Pending','$time')";
					$success = $_SESSION['databaseObj']->updateQuery($con,$sql4);
					$_SESSION['result'] = " Grant not Deleted";
					return false;
				}
				
			}
			else{
				$_SESSION['result'] = "Grant not deleted";
				return false;
			}
		}
		else{
			$_SESSION['result'] = "Please Try Again";
			return false;
		}
	}
} 
class Admin extends User{
	function __construct($firstName1 , $lastName1 , $userName1 , $gender1 , $role1) {
        parent::__construct($firstName1 , $lastName1 , $userName1 , $gender1 , $role1 );
	}
	public function viewPendingGrants($pending){
		require_once('dbConnect.php');
		$sql = "SELECT * FROM grantdata WHERE grantStatus='Pending'";
		$result = $_SESSION['databaseObj']->retrieveQuery($con,$sql);
		mysqli_close($con);
		return $result;
	}
	public function viewOldGrants(){
		require_once('dbConnect.php');
		$sql = "SELECT * FROM grantdata WHERE grantStatus!='Pending'";
		$result = $_SESSION['databaseObj']->retrieveQuery($con,$sql);
		mysqli_close($con);	
		return $result;
	}
	public function validateGrant($userName,$grantId,$result){
		require_once('dbConnect.php');
		$sql1 = "SELECT * FROM grantdata WHERE grantId='$grantId'";
		$grant = $_SESSION['databaseObj']->retrieveQuery($con,$sql1);
		$sql2 = "SELECT * FROM users WHERE userName='$userName'";
		$user = $_SESSION['databaseObj']->retrieveQuery($con,$sql2);
		if($grant->num_rows==1 and $user->num_rows==1){
			$rowGrant = $grant->fetch_assoc();
			$rowUser = $user->fetch_assoc();
			if($result=="Approved"){
				date_default_timezone_set('Asia/Kolkata');
				$time = date('H:i d/m/Y');
				$sql3 = "UPDATE grantdata SET grantStatus = '$result' , decisionTime = '$time' WHERE grantId='$grantId' ";
				$updatedGrantMoneyLeft = $rowUser['grantMoneyLeft'] - $rowGrant['grantMoney'];
				$sql4 = "UPDATE users SET grantMoneyLeft = '$updatedGrantMoneyLeft' WHERE userName='$userName' ";
				if( $_SESSION['databaseObj']->updateQuery($con,$sql3) and $_SESSION['databaseObj']->updateQuery($con,$sql4) ){
					$_SESSION['result'] = "Grant is approved successfully";
					return true;
				}
			}
			else{
				date_default_timezone_set('Asia/Kolkata');
				$time = date('H:i d/m/Y');
				$sql3 = "UPDATE grantdata SET grantStatus = '$result' , decisionTime = '$time' WHERE grantId='$grantId' ";
				$updatedPresentLimit = $rowUser['presentLimit'] + $rowGrant['grantMoney'];
				$sql4 = "UPDATE users SET presentLimit = '$updatedPresentLimit' WHERE userName='$userName' ";
				if( $_SESSION['databaseObj']->updateQuery($con,$sql3) and $_SESSION['databaseObj']->updateQuery($con,$sql4) ){
					$_SESSION['result'] = "Grant is disapproved successfully";
					return true;
				}
				else if(!($_SESSION['databaseObj']->updateQuery($con,$sql4)) and $_SESSION['databaseObj']->updateQuery($con,$sql3)){
					$sql5 = "UPDATE grantdata SET grantStatus = 'Pending' , decisionTime = 'No Time' WHERE grantId='$grantId' ";
					$success = $_SESSION['databaseObj']->updateQuery($con,$sql5);
					$_SESSION['result'] = "Error occured";
					return false;
				}
				else if(!($_SESSION['databaseObj']->updateQuery($con,$sql3)) and $_SESSION['databaseObj']->updateQuery($con,$sql4)){
					$updatedPresentLimit = $rowUser['presentLimit'] - $rowGrant['grantMoney'];
					$sql6 = "UPDATE users SET presentLimit = '$updatedPresentLimit' WHERE userName='$userName' ";
					$success = $_SESSION['databaseObj']->updateQuery($con,$sql6);
					$_SESSION['result'] = "Error occured";
					return false;
				}
				else{
					$_SESSION['result'] = "Error occured";
					return false;
				}
			}
		}
		else{
			$_SESSION['result'] = "Error occured";
			return false;
		}
	}
	public function removeApplicant($userName){
		if($userName=="admin"){
			$_SESSION['result'] = "You can't remove yourself";
		}
		else{
			require_once('dbConnect.php');
			
			$sql1 = "SELECT * FROM users WHERE userName='$userName'";
			$result1 = $_SESSION['databaseObj']->retrieveQuery($con,$sql1);
			//echo $result1->num_rows;
			if($result1->num_rows==1){
				$sql2 = "SELECT * FROM grantdata WHERE userName='$userName'";
				$result2 = $_SESSION['databaseObj']->retrieveQuery($con,$sql2);
				while($rows = $result2->fetch_assoc()){
					$fileName = "uploads/".$rows['grantId'].".pdf";
					unlink($fileName);
				}
				$sql3 = " DELETE FROM users WHERE userName='$userName' ";
				$sql4 = " DELETE FROM grantdata WHERE userName='$userName' ";
				if($_SESSION['databaseObj']->updateQuery($con,$sql3) && $_SESSION['databaseObj']->updateQuery($con,$sql4)){
					$_SESSION['result'] = "User Successfully removed";
					return true;
				}
				else{
					$_SESSION['result'] .= "User is not removed";
					return false;
				}
			}
			else{
				$_SESSION['result'] = "User does not exist";
				return false;
			}
			
		    mysqli_close($con);	
		}
	}
	public function giveGrantMoney($grantId){
		require_once('dbConnect.php');
		$sql1 = "SELECT * FROM grantdata WHERE grantId='$grantId'";
		$result1 = $_SESSION['databaseObj']->retrieveQuery($con,$sql1);
		if($result1->num_rows==1){
			$grant = $result1->fetch_assoc();
			if($grant['moneyGiven']==0 && $grant['grantStatus']=="Approved"){
				$sql2 = "UPDATE grantdata SET moneyGiven = '1' WHERE grantId='$grantId' ";
				if($_SESSION['databaseObj']->updateQuery($con,$sql2)){
					$_SESSION['result'] = "Success! Please give money to applicant";
					return true;
				}
			}
			else if($grant['moneyGiven']!=0 ) {
				$_SESSION['result'] = "Grant Money is given before";
				return false;
			}
			else{
				$_SESSION['result'] = "Grant is not approved";
				return false;
			}
			
		}
		else{
			$_SESSION['result'] = "Grant does not exists";
			return false;
		}
		
		mysqli_close($con);	
		
	}
}
?>