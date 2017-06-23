<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content=" width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>二维码</title>
	<style type="text/css">
  body{
    background: #f5f5f5;
  }
  .qrcode{
    text-align: center;
    margin:50px auto;
  }
	</style>
</head>
<body>
  <div class="qrcode">
    <img src="<?php echo $qrcode;?>">
  </div>
</body>
</html>
