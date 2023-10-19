
<html>
<head>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="font/stylesheet.css">
	<link rel="stylesheet" href="font/apercu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="mobile-web-app-capable" content="yes">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
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
	input, textarea{
		background:none;
		border:none;
		outline:none;
		color:white;
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
		margin-left:1%;
	}
	#content-container #body textarea{
		font-family: "cera";
		font-size: 1rem;
		font-weight: 200;
		color:#ddd;
	}
	.line{
		position: relative;
		left:2vw;
		top:3vh;
		display: inline-block;
		height: .2vh;
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
	#warning-blanket{
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
		position:fixed;
		bottom:10vh;
		right:10vw;
	}
</style>
<body>
	<div id="app-container">
		<div id="app-background"><img src="assets/main-bg.png"></div>
		
	    <div id="main-content"><!-- main app content -->
	    	<div id="report-header" class="page-title">
	    		<div id="info">
			    	<div class="name">Name</div>
			    	<div class="time">Sat. Nov 9 / 6PM</div>
				</div>
				<div id="action"><img src="assets/delete.png"><img src="assets/important.png"><img src="assets/archive.png"></div>
			</div>
	    	<div id="progress-line"></div>	
	    	<div id="content-container">
	    		<div class="task dummy"></div>
	    		<div class="container">
	    			<form id="report-form">
						<span class="line active"></span>
						<input type="hidden" name="page" value="">
						<div id="title" class="row ps-5"><input name="title" placeholder="Report title"></div>
						<div id="type" class="row ps-5">Report type</div>
						<div id="body" class="row h-50 p-3 px-5"><textarea name="body" placeholder="Report content goes here"></textarea> </div>
					</form>
				</div>
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
	</div>	
	<?php $prevPage = "reports.php"; include "actionBar.php"; ?>

</body>
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
			}
			else{
				alert('Unable to save');
			}
		})
	})
	$('#cancel').click(function(){
		$('#warning').css('display', 'none');
		$('#warning-blanket').css('display', 'none');
	})
	$('#warning-blanket').click(function(){
		$('#warning').css('display', 'none');
		$('#warning-blanket').css('display', 'none');
	})
	$('#dont-save').click(function(){
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

</script>
</html>