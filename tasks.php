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
	#list-background{
		position:fixed;
		top:0;
		left:0;
		height:100vh;
		width:101vw;
		z-index:-1;
		filter: brightness(80%);
	}
	#detailed{
		display:block;
		position:relative;
		height:100vh !important;
		width:100vw;
		backdrop-filter:blur(0px) brightness(100%);
		z-index:3;
	}
	#detailed img{
		height: 100%;
		margin-top:40%;
	}
	#detailed #checkpoint-title{
		font-family: "cera";
		font-size:1.3rem;
		font-weight: bold;
		margin-top:4vh;
		margin-left:9vw;
		line-height: 110%;
	}
	.zoomHolder{
		width:100vw;
		height:100vh !important;
	}
	.marker
	{
		max-height: 6vh;
		max-width: 6vh;
	   position: absolute !important;
	   left: 0px !important;
	   top:0px !important;
	   bottom: auto !important;
	   right: auto !important
	}
	.controlHolder{
		top:30vh;
		right:5vw;
	}
	.fullscreenToggle{
		display:none;
	}
	#list-container{
		visibility: hidden;
		z-index: 4;
		width:100vw;
		top: 0;
		left:0;
		transition: .01s ease-in-out;
	}
	#map-container{
		position: fixed;
		visibility: hidden;
		z-index: 1;
		opacity:100%;
		transition: .01s ease-in-out;
	}
	.lm-visible{
		visibility: visible !important;
		top: 0;
		left:0;
		opacity: 100%;
		animation:floatin 1s;
		transition: 1s ease-in-out;
	}
	.lm-invisible{
		visibility: invisible !important;
		opacity: 0%;
		animation:floatout 1s;
		transition: 1s ease-in-out;
	}
	@keyframes floatout{
		0%{
			opacity:100%;
		}
		100%{
			opacity:0%;
		}
	}
	@keyframes floatin{
		0%{
			opacity:0%;
		}
		100%{
			opacity:100%;
		}
	}
	#progress{
		position: fixed;
		top: 12.3vh;
		left: 46vw;
		height:5vh;
		width:20vw;
	}
	#progress span{
		height: .3vh;
		width:100%;
		background-color: #444;
		display: block;
	}
	#progress #percentage-line{
		width:<?php echo (float)$completed_rows/count($data)*100; ?>%;
		background-color: #FFCE85;
	}
	.notransition {
	  -webkit-transition: none !important;
	  -moz-transition: none !important;
	  -o-transition: none !important;
	  transition: none !important;
	}
	#pinch{
		margin-top:10vh;
	}
	.half-dummy{
		height:10vh !important;
	}
	  #snackbar, .snackbar {
  visibility: hidden; /* Hidden by default. Visible on click */
  height:5vh;
  width:30vw;
  position: fixed;
  bottom:10vh;
  vertical-align: middle;
  left:35vw;
  border-radius: 20vh;
  backdrop-filter:blur(15px) brightness(200%) saturate(150%) opacity(80%);
  text-align: center;
  padding-top:1vh;
  z-index:9999;
 }
 .fullscreen{
 	position:fixed;
 	height:100vh;
 	width:100vw;
	background:rgba(0,255,177,0.13);
	top:0;
	left:0;
	display: none;
	
 }
/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show, .snackbar.show {
  visibility: visible; /* Show the snackbar */
  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */

  animation: fadein 0.5s, fadeout 0.5s 3.5s;
}



@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 10vh; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 10vh; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 10vh; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>
</style>
<script>var lom = 0;</script>
<body>
	
	<div id="app-container">
		<div id="app-background"><img src="assets/main-bg.png"></div>
		<div id="main-content"><!-- main app content -->
	    	<div id="tasks-title" class="page-title"> 
	    		<img src="assets/patrols-tru.png">
	    		<div id="progress"><div id="fraction"><?php echo $completed_rows . '/' . count($data); ?></div><span id="progress-line"><span id="percentage-line"></span></span></div>
		    	<div id="list-map">
		    		<div id="list" class="chosen">List</div>
		    		<div id="map">Map</div>
		    	</div>
		    </div>
	    	
	    	
	    	<div id="content-container">
	    		<div id="list-container" class="lm-visible .notransition">
	    			<div class="task dummy" total="<?php echo count($data); ?>"></div>
			    	<?php
				    	foreach($data as $checkpoint){
				    		extract($checkpoint);
				    		?>
				    		<div class="task <?php if($Completed == 1) echo "completed"?>" task-id="<?php echo $Id; ?>" onclick="markAsComplete(this)">
				    			<div class="left-side" onclick="console.log('left-sideClicked');">
					    			<div class="task-title"><?php echo $Name; ?></div>
					    			<div class="task-time"> - Sat, August 12/9PM</div>
					    			<div class="task-detail">Detail</div>
					    		</div>
				    			<div class="task-status"><?php if($Completed == 1) echo "done"; ?></div>
				    		</div>
			    	<?php }?>
			    	<!-- <div id="list-background"><img src="assets/main-bg.png"></div> -->
			    	<div class="task dummy half-dummy"></div>
			    </div>
			    <div id="map-container" class="lm-invisible">
				    <div id="detailed" class="zoomHolder">
				    	<div id="checkpoint-title"></div>
				    	<div id="pinch" data-elem="pinchzoomer" data-options="maxZoom: 8">
					    	<img src="#" data-src="assets/<?php echo ($locationId == 1 ? 'campus-map' : 'om-map'); ?>.png" data-elem="" data-options="adaptive:true">
					    	<?php
					    		$data = findCheckpoints();
					    		foreach($data as $checkpoint){
					    			extract($checkpoint);
					    			?>

					    			<img id="detailed-marker" src="#"
					    			task-id="<?php echo $Id?>" 
					    			data-src="assets/<?php echo $Completed == 1 ? 'green' : 'white'; ?>_checkpoint.png" 
					    			class="marker tooltip" 
					    			data-elem="marker" 
					    			data-options="x:<?php echo $x * 5.4 + 122; ?>; y:<?php echo $y * 5.4 + 222; ?>; transformOrigin:50% 100%; adaptive:true" 
					    			data-tooltip="<?php echo $Name; ?>"
					    			>
					    	<?php
					    		}
					    	?>
					    </div>
				    </div>
				</div>
	    	</div>
	    </div>
	   
	    <?php include "actionBar.php"?>
	  </div>
	  <div id="snackbar-success" class="fullscreen text-center align-content-center"><span style="line-height: 100vh; font-style: bold; font-size: 1.5rem;color:rgb(0,255,177);">Completed</span></div>	
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
					if(fraction['first'] == fraction['second']){
						$('#snackbar-success').fadeIn("slow");
						setTimeout(()=>{$('body').load('sites.php')}, 1500);
					}
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