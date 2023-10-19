<?php
	$locationId;
	isset($_POST['locationId']) ? $locationId = $_POST['locationId'] : $locationId = 1;
	include "model.php";
	$data = getTasks($locationId);
	$completed_rows = getCompletedTasks();
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="mobile-web-app-capable" content="yes">

	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="font/stylesheet.css">
	<link rel="stylesheet" href="font/apercu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">

	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="main.css">

	<!-- Map plugins -->
	<link href="css/pinchzoomer.min.css" rel="stylesheet">
	<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="js/hammer.min.js" type="text/javascript"></script>
	<script src="js/TweenMax.min.js" type="text/javascript"></script>
	<script src="js/jquery.pinchzoomer.min.js" type="text/javascript"></script> 
	<link href="css/tooltipster.bundle.min.css" type="text/css" rel="stylesheet"/>
	<script src="js/tooltipster.bundle.min.js" type="text/javascript"></script>
	<!-- Image label -->
	<script src="https://cdn.jsdelivr.net/jquery.picla/0.7.7/picla.min.js"></script>

</head>
<style>
	#percentage{
		width:<?php echo (float)$completed_rows/count($data)*100; ?>%;
		height:100%;
		top: 0;
		left: 0;
		background:rgba(0,255,177,0.23);
	}
</style>
<script>var lom = 0;</script>
<body>
	
	<div id="app-container">
		<div id="app-background"><img src="assets/main-bg.png"></div>
		<div id="main-content"><!-- main app content -->
	    	<div id="sites-title" class="page-title"> 
	    		<img src="assets/sites.png">
		    </div>

		    
	    	
	    </div>
	   <div id="content-container">
	   	<div class="task dummy"></div>
	   	<div class="container-fluid">

		    	<div class="row">
		    		<div class="col-5">
		    			<div class="report p-3 position-relative" onclick="$('body').load('tasks.php')">
		    				<div class="report-header row">
		    					<div class="report-attribute col-6">
		    						<div class="report-title">TRU</div>
		    						<div class="report-type">Campus</div>
		    					</div>
		    					<div class="col-6"><div id="fraction" style="font-size:0.9rem"><?php echo $completed_rows . '/' . count($data); ?></div></div>
		    				</div>
		    				<div id="percentage" class="position-absolute"></div>
		    			</div>
		    		</div>
		    	</div>
		    </div>

	   </div>
	    <?php include "actionBar.php"?>
	  </div>	
</body>
<script>

	

	$('#list-map').click(function(){
		
		if($('#list-container').hasClass('notransition'))
			$('#list-container').removeClass('notransition');
		$('#list-container').toggleClass('lm-visible');
		$('#map-container').toggleClass('lm-visible');
		$('#list-container').toggleClass('lm-invisible');
		$('#map-container').toggleClass('lm-invisible');
		$('#list').toggleClass('chosen');
		$('#map').toggleClass('chosen');
		// $('#map-container').load('tasks.php #map-container');
		
	})

	console.log('start');
	var isFullscreen = false;
	$(document).click(function(){
		if(!isFullscreen) {
			document.body.requestFullscreen();
			console.log("enter full screen");
			isFullscreen = true;
		}
	})


	function markAsComplete(task){
		
		var tid = $(task).attr("task-id");
		console.log(tid);
		$.post('ajax.php', {page: "tasks", command: "complete", taskId: tid}, function(data){
			console.log(data);
			var fraction = JSON.parse(data);
			if(!task.classList.contains('completed'))
				{
					task.classList.add('completed');
					$('#fraction').html(fraction['first'] + "/" + fraction['second']);
					$('#percentage-line').css("width", fraction['first']/fraction['second'] * 100 + "%");
				}
		})
	}
	function markAsIncomplete(task){
		if(task.classList.contains('completed'))
			task.classList.remove('completed');
		var tid = task.getAttribute("task-id");
		$.post('ajax.php', {page: "tasks", command: "incomplete", taskId: tid}, function(data){
			console.log(data);
		})
	}

</script>
</html>