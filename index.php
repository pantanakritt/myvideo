<?
session_start();
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link rel="shortcut icon" href="favicon.ico" />
	<style>

		body {
			background-image:url('image/img2.jpg');
			background-size: 120%;
			background-repeat:no-repeat;
			background-attachment:fixed;
			
		}

		table.login{
			width: 100%;
			height: 50px;
		}

		.transbox
		{
			background-color:#000033;
			border:1px solid black;
			opacity: 0.8;
			filter:alpha(opacity=60);
		}

		.transbox2
		{
			background-color:#ffffff;
			border:1px solid black;
			opacity: 1;
			filter:alpha(opacity=60);
			width: 900px;
			margin-top: 50px;

		}
		.chk_gift_body{
			background-color:#ffffff;
			width: 900px;
			margin-top: 50px;
		}

		.transbox3
		{
			background-color:#ffffff;
			border:1px solid black;
			opacity: 0.95;
			filter:alpha(opacity=60);
			width: 400px;
			margin-top: 50px;

		}

		.transbox txt
		{
			
			font-weight:bold;
			font-family: ciacode39_m;

			color:#ffffff;
			text-align: left;
		}


		.txc
		{
			text-align: center;
			font-weight:bold;
		}

		.center 
		{
			position:absolute; 
			top:50%; 
			left:50%; 
			margin:-100px 0px 0px -150px;
		}

		.v_align
		{
			vertical-align: 50px;
		}
		


	</style>
	<title>Brave Frontier Checker</title>
	
</head>

<body>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/javascript.js"></script>	
	<?
	
	require_once('function.php');
	require_once('dbo.php');
	?>
		<div class='center main_body'>
		<?
			if(isset($_SESSION[session_usr])){
				chk_login();
			}
			else if($_GET[regis_ter]==1){
				register_form();
			}
			else {
			log_in();
			}

		?>
		
		


		</div>

</body>
</html>