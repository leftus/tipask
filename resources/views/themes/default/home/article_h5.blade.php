<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content=" width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title></title>
	<style type="text/css">
		img, object{
			max-width: 100%;
			height:auto !important;
		}
		video{
			height: 100% !important;
		}
	</style>
</head>
<body id="content">
<?php
	echo $content;
?>
</body>
</html>
<script type="text/javascript">
	var video_ojb = document.getElementsByTagName('video');
	var video_height = video_ojb.offsetHeight;
	var video_width  = video_ojb.offsetWidth;
	var window_width = window.innerwidth;
	video_ojb.style.height = window_width;
	console.log(video_ojb);
</script>
