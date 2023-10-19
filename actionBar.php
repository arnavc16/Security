<?php include "snackbar.php"; ?>

<style>#noti-center{height:50vh !important;}</style>
<?php if (isset($prevPage)): ?>
	<div id="header-bar">
		<div class="back-icon">
			<img src="assets/back-arrow.png">
		</div>
		<div id="noti-icon"><img src="assets/noti_icon.png"></div>
	</div>
	<div id="noti-center" style="z-index: 122 !important">
		<?php
	    	for($i = 0; $i < 3; $i++){?>
	    	
			<div class="profile">
				<div class="profile-pic"><img src="assets/ava.png"></div>
				<div class="profile-right">
					<div class="profile-name"><span>Name</span></div>
					<div class="profile-message"><span>This is a test message just for testing overflow of text</span></div>
					<div class="message-time"><span>1 minute ago</span></div>
				</div>
			</div>
		<?php }?>
	</div>
	
	<script>
	//boolean safe to exit
	var safe = <?php echo isset($safe) ? "false" : "true"; ?>;
	$('#noti-icon').click(function(){
		$('#noti-center').toggleClass('visible');
		$('#blanket').css('display', 'block');
		$('#blanket').css('z-index', 3);
	})
	$('.back-icon').click(function(){
		if(safe)
			$('body').load('<?php echo $prevPage; ?>');
		else{
			$('#warning').css("display", "block");
			$('#warning-blanket').css("display", "block");  //custom warning in each page
		}

	})	
	$('#timestamp-log').click(function(){
			$.post('ajax.php', {page:'actionBar', command:'timeLog'}, function(data){
				if(data == 'success'){
					$('#timelogged').addClass('snackbar');
					console.log('added');
					show();
				}
			})
		})
		$('#logged').click(function(){
			$('body').load('timelogs.php');
		})

</script>
<div id="snackbar" class="snackbar">Time logged</div>
<?php else: ?>
<div id="header-bar">
	<div class="menu_icon">
	    <span class="one"></span>
	    <span class="two"></span>
	    <span class="three"></span>
 	</div>	
	<div id="noti-icon"><img src="assets/noti_icon.png"></div>
</div>
<div id="blanket" style="z-index: 19 !important">
</div>
<div id="menu" style="z-index:8999">
	<div class="menu-item" id="home">Home</div>
<!-- 	<div class="menu-item" id="profile">Profile</div> -->
	<div class="menu-item" id="logged">Logged</div>
<!-- 	<div class="menu-item" id="calendar">Calendar</div>
	<div class="menu-item" id="timeline">Timeline</div>
	<div class="menu-item" id="fingerprint">Fingerprint</div -->
	<div class="menu-item" id="log-out" style="z-index:8999">Log out</div>
</div>
<div id="noti-center" style="z-index: 21 !important">
	<?php
    	for($i = 0; $i < 19; $i++){ ?>
    	
		<div class="profile">
			<div class="profile-pic"><img src="assets/ava.png"></div>
			<div class="profile-right">
				<div class="profile-name"><span>Name</span></div>
				<div class="profile-message"><span>This is a test message just for testing overflow of text</span></div>
				<div class="message-time"><span>1 minute ago</span></div>
			</div>
		</div>
	<?php } ?>
</div>

<div id="bottom-bar">
	<div class="bar-button" id="timestamp-log">timestamp<img src="assets/line_timestamp.png"></div>
	<div class="bar-button" id="emergency"><a href="tel:911" style="color:white; text-decoration:none">emergency</a><img src="assets/line_emergency.png"></div>
	<div class="bar-button" id="reports">reports<img src="assets/line_reports.png"></div>
</div>
<script>
	$('.menu_icon').click(function(){
		$('#menu').toggleClass('expand');
		$(this).toggleClass('clicked');
		$('#blanket').css('display', 'block');
	})
	
	$('#noti-icon').click(function(){
		$('#noti-center').toggleClass('visible');
		$('#blanket').css('display', 'block');
		$('#blanket').css('z-index', 20);
	})	
	$('#blanket').click(function(){
		$('#menu').removeClass('expand');
		$('#noti-center').removeClass('visible');
		$(this).css('display', 'none');
		$(this).css('z-index', 9);
	})
	$('#home').click(function(){
		$('body').load("sites.php");
	})
	$('#reports').click(function(){
		$('body').load("reports.php");
	})
	$('#log-out').click(function(){
		$('body').load("login.php");
	})
	$('#timestamp-log').click(function(){
		$.post('ajax.php', {page:'actionBar', command:'timeLog'}, function(data){
			if(data == 'success'){
				$('#timelogged').addClass('snackbar');
				console.log('added');
				show();
			}
		})
	})
	$('#logged').click(function(){
		$('body').load('timelogs.php');
	})

</script>
<div id="snackbar" class="snackbar">Time logged</div>
<?php endif; ?>