
<html>
<head>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="font/stylesheet.css">
	<link rel="stylesheet" href="font/apercu.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="mobile-web-app-capable" content="yes">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
	<link rel="stylesheet" href="main.css">
</head>
<style>
	body{
		background-color:black;
	}
	#app-background.focus-shift{
		top:-17vh;
		
	}
	#bottom-section{
		position: fixed;
		height: 23vh;
		width: 100vw;
		left: 0;
		bottom: 0;
	}
	/*bottom section*/
	#error-msg{
		position:relative;
		left:20vw;
		margin-top:2vh;
		font-family: apercu;
		font-size:.8rem;
		font-weight:200;
		color:red;
	}
	
	form input{
		position:relative;
		margin-top: 2.5vh;
		display:inline-block;
		border:none;
		background:none;
		left:20vw;
		width:93%;
		color:white;
		font-size: 1.2rem;
	}
	form input:focus{
		border:none;
		outline:none;

	}
	form input::placeholder{
		font-family: apercu;
		font-weight: 200;
		font-size: 1.2rem;
	}
	form input:focus::placeholder{
		font-weight: bold;
	}
	.line{
		position: relative;
		left:20vw;
		top:-0.5vh;
		display: inline-block;
		height: .1vh;
		width: 0vw;
		background-color: #666;
		transition: 0.3s ease;
	}
	.line.active{
		width: 7vw;
		transition: 0.3s ease;
	}
	form button{
		position:fixed;
		border:none;
		background:none;
		font-family: cera;
		font-weight: bold;
		font-size: 1.1rem;
		right:10vw;
		bottom:10vw;
		color:white;
		text-transform: uppercase;
		letter-spacing: 0.1rem;
	}
	form button img{
		width:4vw;
		margin-left:1vw;
	}
</style>
<body>
	<div id="app-container">
		<div id="app-background"><img src="assets/login.png"></div>
	    <div id="main-content"><!-- main app content -->
	    	
	    </div>
	    <div id="bottom-section">
	    	<form id="login-form">
	    		<input type="hidden" name="page" value="login" >
	    		<span class="line"></span><input type="text" name="username" placeholder="username" autocomplete="off">
	    		<span class="line"></span><input type="password" name="password" placeholder="password" autocomplete="off">
	    		<div id="error-msg"></div>
	    		<button type="button" id="signin">Sign in<img src="assets/login-arrow.png"></button>
	    	</form>
	    </div>
	  </div>	
</body>
<script>
	$('#app-container').trigger('click');
	var isFullscreen = false;
	$(document).click(function(){
		if(!isFullscreen) {
			document.body.requestFullscreen();
			console.log("enter full screen");
			isFullscreen = true;
		}
	})
	$('form input').click(function(){
		$('form input').prev().removeClass('active');
		$(this).prev().toggleClass('active');
	})
	$(window).resize(function(){
			if($(window).height()/$(window).width() < 1.7)
		{
			if(!$('#app-background').hasClass('focus-shift'))
				$('#app-background').addClass('focus-shift');
		}
		else{
			if($('#app-background').hasClass('focus-shift'))
				$('#app-background').removeClass('focus-shift');
		}
	})
	$('#signin').click(function(){
		$.post('ajax.php', $('#login-form').serialize(), function(data){
			console.log(data);
			if(!data.includes(".php"))
				$('#error-msg').html(data);
			else
				$('body').load(data);
		})
	})
</script>
</html>