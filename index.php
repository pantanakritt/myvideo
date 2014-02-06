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

		.transbox txt
		{
			
			font-weight:bold;
			font-family: ciacode39_m;

			color:#ffffff;
			text-align: left;
		}

		.center 
		{
			position:absolute; 
			top:50%; 
			left:50%; 
			margin:-100px 0px 0px -150px;
		}
		


	</style>
	
</head>

<body>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
		
		var ajax_common = function(data,url,type,obj){
			$.ajax({
				url : url,
				data : data,
				type : type,
				success : function(response){
					$(obj).html(response);
				}
			});
		};

		$(".login_enter").click(function(event){
			event.preventDefault();
			var userid = $(".user").val();
			var pswid = $(".psw").val();
			chk_login("login",userid,pswid);
			
		});

		var chk_login = function(type,id,pswd){
			var data = {"condition" : type , "user" : id , "pass" : pswd};
			ajax_common(data,"function.php","POST",$(".main_body"));
		};

		$(".video_link").click(function(event){
			event.preventDefault();
			var link_vdo = $(this).children(".link_tag").val();
			
			vdo_click("vdo",link_vdo);
			
		});

		var vdo_click = function(type,link_vdo){
			var data = {"condition" : type , "link_vdo" : link_vdo };
			ajax_common(data,"function.php","POST",$(".main_body"));
		};
		

		});

	</script>
	
	<?
	require_once('function.php');
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