<?
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<style>

		body {
			background-image:url('image/cia.jpg');
			background-size: 100%;
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
			opacity: 0.9;
			filter:alpha(opacity=60);
			width: 900px;
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
			vertical-align: middle;
		}
		


	</style>
	
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
			else {
			log_in();
			}
			?>

		</div>

</body>
</html>