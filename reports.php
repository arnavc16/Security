
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
	#add-report{
		position:fixed;
		height:20vw;
		bottom: 10vh;
		left: 75vw;
	}
	#add-report img{
		height: 20vw;
	}
	.half-dummy{
		height:10vh !important;
	}
</style>
<body>
	<div id="app-container">
		<div id="app-background"><img src="assets/main-bg.png"></div>
		
	    <div id="main-content"><!-- main app content -->
	    	<div id="reports-title" class="page-title"><img src="assets/reports-title.png"></div>
	    	<div id="content-container">
	    		<div class="task dummy"></div>
	    		<div class="container">
	    			<div class="row">
			    	<?php
			    		include "model.php";
			    		$data = getReports();
				    	foreach($data as $report){
				    		extract($report);
				    		?>
				    		<div class="col-12">
				    			<div class="report p-3" onclick="openReport(this)">
				    				<div class="report-header row">
				    					<div class="report-attribute col-6">
				    						<input class="report-id" type="hidden" name="reportId" value="<?php echo $Id; ?>">
				    						<div class="report-title"><?php echo ($Title != '') ? $Title : '(No title)' ; ?></div>
				    						<div class="report-type"><?php echo ($Type != '') ? $Type : 'Common'; ?></div>
				    					</div>
				    					<div class="r-profile col-6">
				  
				    						<div class="r-info ">
				    							<div class="r-profile-name row" style="float:right"><span style="text-align: right">Name</span></div>
				    							<div class="r-time row" style="float-right"><span style="text-align: right"><?php echo substr(date("l", strtotime($Date)), 0, 3) . '. ' . date("F j / g:iA", strtotime($Date)); ?></span></div>
				    						</div>
				    				
			    						</div>
				    		
				    				</div>
					    			<div class="report-content"><span><?php echo $Content; ?></span>
					    			</div>
					    		</div>
				    		</div>
			    	<?php }?>
		    		</div>
	    		</div>
	    		<div class="task dummy half-dummy"></div>
	    	</div>
	    	<div id="add-report"><img src="assets/add.png"></div>
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
	$('#add-report').click(function(){
			$('body').load("addReport.php");	
	})

		function openReport(report){
			var title = $(report).find('.report-title').html();
			var type = $(report).find('.report-type').html();
			var id = $(report).find('.report-id').val();
			var content = $(report).find('.report-content').find('span').html();
			console.log(id + ", " + title + ", " + type + ", "  + content);
			$.post('ajax.php', {page: 'viewReport', reportId : id, title: title, type: type, content: content}, (data)=>{
				$('body').html(data);
			})
			
		}

	


</script>
</html>