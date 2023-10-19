<?php
	$conn = mysqli_connect('localhost', 'hle', 'hle136', 'C354_hle');

	function verify($username, $password){
		if($username == "test" && $password == "test")
			return true;
		return false;
	}
	function getTasks($locationId){
		global $conn;
		$sql = "SELECT DISTINCT * FROM `HCI_Checkpoints` WHERE `LocationId` = $locationId";
		$result = $conn -> query($sql) or die($conn->error);
		$data = [];
		while($row = $result->fetch_assoc()){
			array_push($data, $row);
		} 
		return $data;
	}
	function getCompletedTasks(){
		global $conn;
		$sql = "SELECT DISTINCT * FROM `HCI_Checkpoints` WHERE `Completed` = 1";
		$result = $conn -> query($sql) or die($conn->error);
		return mysqli_num_rows($result);
	}
	function setComplete($taskId){
		global $conn;
		$sql = "UPDATE `HCI_Checkpoints` SET `Completed` = 1 WHERE `Id` = $taskId";
		$result = $conn -> query($sql) or die($conn->error);
		return $result;
	}
	function setIncomplete($taskId){
		global $conn;
		$sql = "UPDATE `HCI_Checkpoints` SET `Completed` = 0 WHERE `Id` = $taskId";
		$result = $conn -> query($sql) or die($conn->error);
		return $result;
	}
	function setIncompleteAll(){
		global $conn;
		$sql = "UPDATE `HCI_Checkpoints` SET `Completed` = 0";
		$result = $conn -> query($sql) or die($conn->error);
		return $result;
	}
	function findCheckpoint($checkpointId){
		global $conn;
		$sql = "SELECT DISTINCT * FROM `HCI_Checkpoints` WHERE `Id` = $checkpointId";
		$result = $conn -> query($sql) or die($conn->error);
		$data = [];
		while($row = $result->fetch_assoc()){
			array_push($data, $row);
		} 
		return ($data);
	}
	function findCheckpoints(){
		global $conn;
		$sql = "SELECT DISTINCT * FROM `HCI_Checkpoints`";
		$result = $conn -> query($sql) or die($conn->error);
		$data = [];
		while($row = $result->fetch_assoc()){
			array_push($data, $row);
		} 
		return $data;
	}
	function addReport($title, $type, $content, $user, $iDate, $subjectInfo){
		global $conn;
		$iTime = date("Y/m/d H:i");

		$sql = "INSERT INTO `HCI_REPORTS` VALUES (null, '$title', '$type', '$content', $user, now(), Cast('$iTime' as datetime), '$subjectInfo')";
		$result = $conn -> query($sql) or die($conn->error);
		return $result;
	}
	function editReport($reportId, $title, $type, $content, $user, $iDate, $subjectInfo){
		global $conn;
		$iTime = date("Y/m/d H:i");

		$sql = "UPDATE `HCI_REPORTS` SET `Title` = '$title', `Type` = '$type', `Content` = '$content', `Date` = now(), `IncidentDate` = Cast('$iTime' as datetime), `SubjectInfo` = '$subjectInfo' WHERE `Id` = $reportId";
		$result = $conn -> query($sql) or die($conn->error);
		return $result;
	}
	function deleteReport($reportId){
		global $conn;
		$sql = "DELETE FROM `HCI_REPORTS` WHERE `Id` = $reportId";
		$result = $conn->query($sql) or die($conn->error);
		return $result;
	}
	function getReports(){
		global $conn;
		$sql = "SELECT DISTINCT * FROM `HCI_REPORTS` ORDER BY `Date` DESC";
		$result = $conn -> query($sql) or die($conn->error);
		$data = [];
		while($row = $result->fetch_assoc()){
			array_push($data, $row);
		} 
		return $data;
	}
	function getTimeLogs(){
		global $conn;
		$sql = "SELECT DISTINCT * FROM `HCI_Timelogs` ORDER BY `Date` DESC";
		$result = $conn -> query($sql) or die($conn->error);
		$data = [];
		while($row = $result->fetch_assoc()){
			array_push($data, $row);
		} 
		return $data;
	}
	function logTime(){
		global $conn;
		$sql = "INSERT INTO `HCI_Timelogs` VALUES (null, current_timestamp())";
		$result = $conn->query($sql) or die($conn->error);
		return $result;
	}
?>