<?php
	if(isset($_POST['page'])){
		include "model.php";
		$page = $_POST['page'];
		isset($_POST['username']) ? $username = $_POST['username'] : $username = "";
		isset($_POST['password']) ? $password = $_POST['password'] : $password = "";
		if($page == 'login'){
			if(verify($username, $password)){
				setIncompleteAll();
				echo "sites.php";
				die();
			}
			else{
				$error_msg = "Wrong username/password";
				echo $error_msg;
				die();
			}
		}
		else if($page == 'tasks'){
			if($_POST['command'] == 'complete'){
				setComplete((int)$_POST['taskId']);
				$arr = array('first' => getCompletedTasks(), 'second' => count(getTasks(1)));
				echo json_encode($arr);
			}
			else if($_POST['command'] == 'incomplete'){
				echo setIncomplete((int)$_POST['taskId']);
			}
			else if($_POST['command'] == 'findCheckpoint'){
				echo findCheckpoint((int) $_POST['checkpointId']);
			}
			else if($_POST['command'] == 'findCheckpoints'){
				echo $data = findCheckpoints();
			}
		}
		else if($page == 'addReport'){
			extract($_POST);
			if($reportId == ''){
				$data = addReport($title, $type, $body, 1, $incidentTime, $subject);
			}
			else{
				$data = editReport($reportId, $title, $type, $body, 1, $incidentTime, $subject);
			}
			echo $data == 1 ? 'success' : "failed";
			die();
		}
		else if($page == 'actionBar'){
			if($_POST['command'] == 'timeLog'){
				$result = logTime();
				echo $result ? 'success' : $result;
			}
		}
		else if($page == 'viewReport'){
			extract($_POST);
			if($title == '(No title)')
				$title = '';
			if($type == 'Common')
				$type = '';
			include('addReport.php');
		}
		else if($page == 'deleteReport'){
			if($_POST['reportId'] != ''){
				$data = deleteReport($_POST['reportId']);
				echo $data;
			}
		}
	}
	else{
		include "login.php";
	}

?>