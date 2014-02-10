<?
session_start();
require_once("dbo.php");
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
	else if(($user_chk =="chkbf"&& $psw_chk =="chkbf")||($_SESSION[session_usr]=="chkbf")){
		$_SESSION[session_usr] = "chkbf";
		chk_gift_form();

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

function update_gift_check($c_name,$chk_attr){
	$qry1 = mysql_query("SELECT date_time,date_hour as hour FROM day_table WHERE date_time = '".date("ymd")."' && c_name = '".$c_name."'");
		$num_qry1 = mysql_num_rows($qry1);
		$fetch_qry1 = mysql_fetch_array($qry1);

	if ($chk_attr=="true"){
		//echo "TRUE";
		
		if($num_qry1>0&&$fetch_qry1[hour]=="99"){
			//echo "<br>if Ture";
			mysql_query("UPDATE day_table SET date_hour = '".date("h")."',date_min = '".date("m")."' WHERE date_time='".date("ymd")."' && c_name='".$c_name."'");
			mysql_query("UPDATE name_table SET rank = 'z' WHERE c_name = '$c_name'");
		}
		else {
			//echo "<br>if false";
			mysql_query("INSERT INTO day_table VALUES ('','".$c_name."','".date("ymd")."','".date("h")."','".date("i")."')");
			mysql_query("UPDATE name_table SET rank = 'z' WHERE c_name = '$c_name'");
		}

	}
	else {
		if($num_qry1>0){
			mysql_query("UPDATE day_table SET date_hour = '99' WHERE date_time = '".date("ymd")."' && c_name='$c_name'");
			mysql_query("UPDATE name_table SET rank = 'x' WHERE c_name = '$c_name'");

		}
	}
}

function chk_gift_form(){
	?>

				<script>
				$('.main_body').removeClass("center");
				$('.main_body').attr('align','center');
				</script>

				<div class='transbox2'>
					<table class='table table-bordered' width = '900'>
						<tr><td colspan='2'><center><table><tr><td><input type='text' class='add_fr' placeholder='Type your friend name'>&nbsp;&nbsp;<a href='#' class='clk_link'>Add Friend</a></td>
							<?
							if(isset($_SESSION[session_usr])){
							echo "<td class='v_align'><a href='log_out.php'>Log Out</a></td>";
						}
							?>
						<td></td></tr></table></center></td></tr>
						<tr>
							<td class='txc'>
								<center>Name</center>
							</td>
							<td class='txc' width='150'>
								<center>Check for <?=date("y-m-d")?><br>time start 17:00</center>
							</td>
						</tr>
						
						<tr>
							
									<?
									$query = mysql_query("SELECT * FROM name_table ORDER BY rank ASC");
									$num_qry_chk = mysql_num_rows($query);
									$date_now = date("ymd");
									$day_check = 0;
									for($x=0;$x<$num_qry_chk;$x++){
										$fetch = mysql_fetch_array($query);

										echo "<td class='txc'>";
										echo "<table>";
										echo "<tr>";
										echo "<td>";
											echo "<input type='button' class='delete_fr' value='Delete'>";
										echo "</td>";
										echo "<td>";
											echo $fetch[name];
										echo "</td>";
										echo "<td>";
										$query_chk_name = mysql_query("SELECT * FROM day_table WHERE c_name = '$fetch[c_name]'");
										$num_row_query_chk_name = mysql_num_rows($query_chk_name);

										for($num_name = 0 ; $num_name < $num_row_query_chk_name ; $num_name++){
											$query_chk_name_fetch = mysql_fetch_array($query_chk_name);
											if ($date_now-1==$query_chk_name_fetch[date_time]&&$query_chk_name_fetch[date_hour]!="99"){
												$day_check += 1;
												
											}
											else if($date_now-2==$query_chk_name_fetch[date_time]&&$query_chk_name_fetch[date_time]!="99"){
												$day_check +=1;
												
											}
											else if($date_now==$query_chk_name_fetch[date_time]&&$query_chk_name_fetch[date_hour]!="99"){
												$day_check +=1;
												if($query_chk_name_fetch[date_hour]=="99")
												$day_now = FALSE;
												else {
													$day_now = TRUE;
												}
											}

										}
										if($day_check==3){
											echo "<div class='alert alert-success'>Good !! Don't have any problem</div>";
										}
										else if ($day_check==2){
											echo "<div class='alert alert-info'>Warning !! He doesn't sent your gift for 1 day early</div>";
										}
										else if ($day_check==1){
											echo "<div class='alert alert-block'>Alert !! He doesn't sent your gift for 2 day !!</div>";
										}
										else {
											echo "<div class='alert alert-error'>Critical !! Delete Him now !!</div>";
										}
										if(!$day_now){
											if($day_check==3){
												mysql_query("UPDATE name_table SET rank = 'a' WHERE c_name = '$fetch[c_name]'");
											}
											else if($day_check==2){
												mysql_query("UPDATE name_table SET rank = 'b' WHERE c_name = '$fetch[c_name]'");
											}
											else if($day_check==1){
												mysql_query("UPDATE name_table SET rank = 'c' WHERE c_name = '$fetch[c_name]'");
											}
											else {
												mysql_query("UPDATE name_table SET rank = 'd' WHERE c_name = '$fetch[c_name]'");
											}
										}
										$day_check = 0;
											
										echo "</td>";
									echo "</tr>";
								echo "</table>";
							echo "</td>";
							echo "<td class = 'txc'>";

								echo "<div align='center'>";
								if($day_now){
									echo "<input type='checkbox' name='gift_check' class='gift_chk' value='".$fetch[c_name]."' checked>";
								}
								else {
									echo "<input type='checkbox' name='gift_check' class='gift_chk' value='".$fetch[c_name]."'>";
								}
									
								echo "</div>";
							echo "</td>";
						echo "</tr>";
						$day_now = FALSE;
									}
									
									
									?>
									



					</table>
				</div>
				<?
}


if($_POST[condition]=="login"){
	chk_login();
}
else if($_POST[condition]=="vdo"){
	vdo_route();
}
else if($_POST[condition]== "gift_check"){
	//echo $_POST[c_name]."+XXX+".$_POST[checked_attr];
	update_gift_check($_POST[c_name],$_POST[checked_attr]);
	echo "<script>window.location.href='index.php'</script>";

}
else if($_POST[condition]=="add_friend"){
	$friend_name = $_POST[fr_name];
	if(strlen($friend_name)>20){
		echo "<script>alert('You must input lower than 20 character');window.location.href='index.php';</script>";
	}
	else {
		$name_query = mysql_query("SELECT c_name FROM name_table WHERE name = '$friend_name'");
		$num_name_query = mysql_num_rows($name_query);
		if ($num_name_query > 0){
			echo "<script>alert('This name have exist');window.location.href='index.php';</script>";
		}
		else {
		mysql_query("INSERT INTO name_table VALUES ('','$friend_name')");
		echo "<script>window.location.href='index.php'</script>";
		}
	}
}


?>