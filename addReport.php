
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
	<script src="js/jquery-clock-timepicker.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="main.css">
</head>
<style>
	#info{
		float:right;
		text-align: right;
		width:100vw;
		margin-top:10vh;
		height: 7vh;
		padding-right:6vw;
	}
	#info .name{
		font-family:"cera";
		font-size:0.8rem;
		font-style:bold;
	}
	#info .time{
		font-family:"apercu";
		font-size:0.8rem;
		font-style:200;
		color: #666;
	}
	 #action{
	 	top: 15vh;
		height:7vh;
		position:fixed;
		width:96vw;
		padding-right:5vw;
		z-index:40;
	}
	#action img{
		position:relative;
		height:1.5vh;
		display: inline-block;
		float:right;
		margin-top:1.5vh;
		margin-right:2vw;
		z-index:40;
	}
	#content-container{
		padding-left:5%;
	}
	#content-container input, textarea{
		background:none;
		border:none;
		outline:none;
		color:white;
		width: 96%;
	}
	#title input::placeholder{
		font-family: "apercu";
		font-style: medium;
		font-size:1.5rem;
		color: #666;
	}
	#type input::placeholder{
		font-family: "apercu";
		font-style: medium;
		font-size:1rem;
		color: #666;
	}
	textarea::placeholder{
		font-family: "cera";
		font-style: thin;
		font-size:1rem;
		color: #666;
	}
	#content-container #title{}
	#content-container #title input{
		height:5vh;
		font-family: "apercu";
		font-style: medium;
		font-size:1.5rem;
		color: white;
	}
	#content-container #type{
		height:5vh;
		font-family: "apercu";
		font-style: medium;
		font-size:1rem;
		color: white;
	}
	#content-container #body textarea{
		font-family: "cera";
		font-size: 1rem;
		font-weight: 200;
		color:#ddd;

	}
	.line{
		position: relative;
		left:1vw;
		top:3vh;
		display: inline-block;
		height: .15vh;
		width: 0vw;
		background-color: #666;
		transition: 0.3s ease;
	}
	.line.active{
		width: 7vw;
		transition: 0.3s ease;
	}

	#warning{
		position: fixed;
		height:20vh;
		width: 80vw;
		top: 25vh;
		left:10vw;
		z-index:9001;
		display:none;
	}
	#warning #save-message{
		padding:10%;
		z-index:9002;
	}
	#warning .row{
		margin-top:0%;
		z-index: 9002;
		padding-left:7%;
	}
	#warning-blanket, #delete-warning-blanket{
		position:fixed;
		width: 100vw;
		height:100vh;
		backdrop-filter: blur(3px);
		top:0;
		left:0;
		z-index: 9000;
		display:none;
	}
	#save{
		position: fixed;
		bottom:5vh;
		right: 10vw;
	}
</style>
<body>
	<div id="app-container">
		<div id="app-background"><img src="assets/main-bg.png"></div>
		
	    <div id="main-content"><!-- main app content -->
	    	<div id="report-header" class="page-title">
	    		<div id="info">
			    	<div class="name">Name</div>
			    	<div class="time"><?php echo substr(date("l", strtotime(date('H:i d/m/Y'))), 0, 3) . '. ' . date("F j / g:iA", strtotime(date('H:i d/m/Y'))); ?></div>
				</div>
				<div id="action"><img src="assets/delete.png" onclick="askDelete()"><img src="assets/important.png"><img src="assets/archive.png"></div>
			</div>
	    	<div id="progress-line"></div>	
	    	<div id="content-container">
	    		<div class="task dummy"></div>
	    		
	    			<form id="report-form">
						<div class="container" style="">
							<input type="hidden" name="page" value="addReport">
								<div class="row">
									<input id="report-id" type="hidden" name='reportId' value="<?php echo isset($reportId) ? $reportId : ''; ?>">
									<div id="title" class="col-12"><input type="text" style="left: 0" name="title" placeholder="Report title" value="<?php echo isset($title)? $title : ''; ?>"></div>
									<div id="type" class="col-12"><input type="text" style="left: 0" name="type" placeholder="Report type" value="<?php echo isset($type)? $type : ''; ?>"></div>
									<div id="time" class="col-12"><input class="time" style="left: 0" type="text" name="incidentTime" value="<?php echo date("H:i"); ?>"></div>
									<div class="row" style="height:35vh">
										<div id="body" class="col-12 h-100 mb-5">
											<textarea class='h-100 mb-5'name="body" form="report-form" placeholder="Report content goes here"><?php echo isset($content) ? $content : ''; ?></textarea> 
										</div>
									</div>
									<div id="subject" class="col-12 h-50 mt-5">
										<textarea class="mt-5" name="subject" form="report-form" placeholder="Subject info (optional)" value="<?php echo isset($subject) ? $subject : ''; ?>"></textarea> 
									</div>
							</div>
						</div>
					</form>
				
			</div>
			<div id="save">save</div>
	    </div>
	  <div id="warning-blanket"></div>
	    <div id="warning">
	    	<div id="save-message">This report is not saved. Proceed to exit?</div>
	    	<div class="row">
		    	<div class="options col-4 text-center" id="save-exit">save & exit</div>
		    	<div class="options col-4 text-center" id="cancel">cancel</div>
		    	<div class="options col-4 text-center" id="dont-save">exit</div>
		    </div>
	    </div>
	    <div id="snackbar-success">Successfully added a report</div>
	    <div id="snackbar-danger" class="snackbar">Failed to add a report</div>
	</div>
	<?php $prevPage = "reports.php"; include "actionBar.php"; ?>

</body>
<script src="clockPicker.js"></script>
<script>

	$('input').change(function(){
		safe = false;
	})
	$('textarea').change(function(){
		safe = false;
	})
	$('#save-exit').click(function(){
		$.post("ajax.php", $('#report-form').serialize(), function(data){
			if(data == "success"){
				
				$('body').load('<?php echo $prevPage; ?>');
				show();
			}
			else{
				console.log(data);
			}
		})
	})
	$('#save').click(function(){
		$.post("ajax.php", $('#report-form').serialize(), function(data){

			if(data == "success"){
				
				$('body').load('<?php echo $prevPage; ?>');
				show();
			}
			else{
				console.log(data);
			}
		})
	})
	$('#cancel').click(function(){
		$('#warning').css('display', 'none');
		$('#warning-blanket').css('display', 'none');
		$('#save-message').html("This report is not saved. Proceed to exit?");
		$('#dont-save').html("exit");
	})
	$('#warning-blanket').click(function(){
		$('#warning').css('display', 'none');
		$('#warning-blanket').css('display', 'none');
	})
	$('#dont-save').click(function(){
		if($(this).html() == "Delete")
			{deleteReport(); return;}
		show();
		$('body').load('<?php echo $prevPage; ?>');
	})
	var isFullscreen = false;
	$(document).click(function(){
		if(!isFullscreen) {
			document.body.requestFullscreen();
			console.log("enter full screen");
			isFullscreen = true;
		}
	})
	function askDelete(){
		$('#warning').show()
		$('#warning-blanket').show();
		$('#save-exit').hide();
		$('#save-message').html("Delete report?");
		$('#dont-save').html("Delete");
	}
	function deleteReport(){
		$.post('ajax.php', {page: 'deleteReport', reportId: $('#report-id').val()}, (data)=>{
			console.log(data);
			$('body').load('reports.php');
		})
	}
</script>
</html>