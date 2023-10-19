
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="font/stylesheet.css">
	<link rel="stylesheet" href="font/apercu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="main.css">
</head>
<style>
	.timelog{
		background: linear-gradient(90deg, rgba(255,255,255,0.05) 0%, rgba(252,252,252,0.01) 39%, rgba(255,255,255,0) 90%);
		font-family: cera;
		font-weight:thin;
		color: #888;
		height:6vh;
		margin-bottom:.7vh;
		padding-left:10vw;
		vertical-align: center;
		padding-top:1.5vh;
	}
</style>
<body>
	<div id="app-container">
		<div id="app-background"><img src="assets/main-bg.png"></div>
		
	    <div id="main-content"><!-- main app content -->
	    	<div id="timelogs-title" class="page-title"><img src="assets/timelog.png"></div>
	    	<div id="content-container">
	    		<div class="task dummy"></div>
	    		<div class="container">
	    			<div class="row">
			    	<?php
			    		include "model.php";
			    		$data = getTimeLogs();
				    	foreach($data as $time){
				    		extract($time);
				    		?>
				    		<div class="timelog"><?php echo date("Y/m/d H:i:s", strtotime($Date)); ?></div>
			    	<?php }?>
		    		</div>
	    		</div>
	    	</div>
	    </div>
	    <?php include "actionBar.php"?>
	  </div>	

</body>
<script>
	var isFullscreen = false;
	$(document).click(function(){
		if(!isFullscreen) {
			document.body.requestFullscreen();
			console.log("enter full screen");
			isFullscreen = true;
		}
	})



</script>
</html>