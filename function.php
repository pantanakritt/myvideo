<?
session_start();
function video_tag($link){
echo "<video width='320' height='240' controls>";
  echo "<source src='".$link."' type='video/mp4'>";
  echo "Your browser does not support the video tag.";
echo "</video>";

}

function log_in(){
?>
	<table class='login transbox'> 
				<tr>
					<td colspan = '2'>
						<txt><center>C.I.A LOGIN</center></txt>
					</td>
				</tr>
				<tr>
					<td>
						<txt>AGENT ID </txt>
					</td>
					<td>
						<input type='password' class = 'user'>
					</td>
				</tr>

				<tr>
					<td>
						<txt>Password</txt> 
					</td>
					<td>
						<input type='password' class='psw'>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<center><input type='submit' value='LOGIN' class='login_enter'></center>
					</td>
				</tr>
			</table>
<?
}

function chk_login(){
	$num = 0;
	$user_chk = strtolower($_POST[user]);
	$psw_chk = strtolower($_POST[pass]);
	if(($user_chk =="admin"&& $psw_chk =="1234")||($_SESSION[session_usr]=="admin1")){
		$_SESSION[session_usr] = "admin1";
		//echo "<script>alert('Hello')</script>";
		$dir = "../video_source/general/";
		$o_dir = opendir($dir);
		echo "<div class='transbox'>";
		while($r_dir = readdir($o_dir)){
			$num++;
			if($num == 1 || $num == 2){

			}
			else {
				echo "<a href='#' class='video_link'><input class='link_tag' type='hidden' value='".$dir.$r_dir."'>".$r_dir."</a><br>";
			}

		}
		$num = 0;
		echo "<center><a href = 'log_out.php'>Log Out</a></center>";
		echo "</div>";
		closedir($o_dir);
	}
	else if(($user_chk =="admin"&& $psw_chk =="4321")||($_SESSION[session_usr]=="admin2")){
		$_SESSION[session_usr] = "admin2";
		//echo "<script>alert('Hello')</script>";
		$dir = "../video_source/special/";
		$o_dir = opendir($dir);
		echo "<div class='transbox'>";
		while($r_dir = readdir($o_dir)){
			$num++;
			if($num == 1 || $num == 2){

			}
			else {
				echo "<a href='#' class='video_link'><input class='link_tag' type='hidden' value='".$dir.$r_dir."'>".$r_dir."</a><br>";
			}

		}
		$num = 0;
		echo "<center><a href = 'log_out.php'>Log Out</a></center>";
		echo "</div>";
		closedir($o_dir);
	}

	else {
		echo "<script>alert('invalid agent id or password'); window.location.href = 'index.php'</script>";
	}
}

function vdo_route(){
	
	echo "<div>";
			//echo "+++++++++++++".$_POST[link_vdo]."++++++++++";
			echo "<center><a href='index.php'>Video LIST</a></center><br>";
			echo "<center>".video_tag($_POST[link_vdo])."</center><br>";
			echo "<center><a href = 'log_out.php'>Log Out</a></center>";

		

	echo "</div>";
}

if($_POST[condition]=="login"){
	chk_login();
}
else if($_POST[condition]=="vdo"){
	vdo_route();
}


?>