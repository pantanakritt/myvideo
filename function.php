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
					<form>
					<td colspan = '2'>
						<txt><center>LOGIN</center></txt>
					</td>
				</tr>
				<tr>
					<td>
						<txt>Username </txt>
					</td>
					<td>
						<input type='text' class = 'user'>
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
						<center><input type='submit' value='LOGIN' class='login_enter'>&nbsp;&nbsp;&nbsp;<input type='button' value='Register' class='register_id'></center>
					</form>
					</td>
				</tr>
			</table>
<?
}

function chk_login(){
	$num = 0;
	$user_chk = strtolower($_POST[userr]);
	$psw_chk = strtolower($_POST[pass]);
	$qry_name = mysql_query("SELECT * FROM user_login WHERE uname = '$user_chk' && upsw = '$psw_chk'");
	$num_qry_name = mysql_num_rows($qry_name);


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
	else if($num_qry_name==1 && strlen($psw_chk)>1){
		//echo "<script>alert('num qry')</script>";
		$_SESSION[session_usr] = "chkbf";		
		if (!isset($_SESSION[u_info])){
			$fetch_uname = mysql_fetch_array($qry_name);
			$_SESSION[u_info] = $fetch_uname[uid]."-".$fetch_uname[uname]."-".$fetch_uname[upsw];
		}
		echo "<script>window.location.href = 'index.php';</script>";
	}
	else if($_SESSION[session_usr]== "chkbf"){
		chk_gift_form();
	}

	else if($_SESSION[session_usr]=="regis"){

		register_form();
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
	$name_info = explode("-", $_SESSION[u_info]);
	$qry1 = mysql_query("SELECT date_time,date_hour as hour FROM day_table WHERE date_time = '".date("ymd")."' && c_name = '".$c_name."' && uid='$name_info[0]'");
		$num_qry1 = mysql_num_rows($qry1);
		$fetch_qry1 = mysql_fetch_array($qry1);

	if ($chk_attr=="true"){
		//echo "TRUE";
		
		if($num_qry1>0&&$fetch_qry1[hour]=="99"){
			//echo "<br>if Ture";
			mysql_query("UPDATE day_table SET date_hour = '".date("h")."',date_min = '".date("m")."' WHERE date_time='".date("ymd")."' && c_name='".$c_name."'  && uid='$name_info[0]'");
			mysql_query("UPDATE name_table SET rank = 'z' WHERE c_name = '$c_name'  && uid='$name_info[0]'");
		}
		else {
			//echo "<br>if false";
			mysql_query("INSERT INTO day_table VALUES ('','".$c_name."','$name_info[0]','".date("ymd")."','".date("h")."','".date("i")."')");
			mysql_query("UPDATE name_table SET rank = 'z' WHERE c_name = '$c_name'  && uid='$name_info[0]'");
		}

	}
	else {
		//echo "<script>alert('X".$name_info[0]."X')</script>";
		if($num_qry1>0){
			mysql_query("UPDATE day_table SET date_hour = '99' WHERE date_time = '".date("ymd")."' && c_name='$c_name'  && uid='$name_info[0]'");
			mysql_query("UPDATE name_table SET rank = 'x' WHERE c_name = '$c_name'  && uid='$name_info[0]'");

		}
	}
}
function gift_check($day_time,$chk_name){
	$qry_chk_amount = mysql_query("SELECT * FROM day_table WHERE uid = '$chk_name' && date_time = '$day_time'");
	$num_amnt = mysql_num_rows($qry_chk_amount);
	return $num_amnt;
}
function chk_fr_amnt($uid){
	$qry_chk_fr_amnt = mysql_query("SELECT COUNT(uid) as num FROM name_table WHERE uid = '$uid'");
	$num_fr_amnt = mysql_fetch_array($qry_chk_fr_amnt);
	return $num_fr_amnt[0];
}

function ch_day($d_val,$ch_to){
	$d_spilt = str_split($d_val,2);
	if($ch_to=="d"){
		return $d_spilt[2];
	}
	else if($ch_to=="y"){
		$d_spilt[0] = date("Y", mktime(0,0,0,1,1,$d_spilt[0]));
		return $d_spilt[0];
	}
	else if($ch_to=="m"){
		return $d_spilt[1];
	}
	else {
		return "invalid value";
	}
}

function cal_fr($first_add){
	$day_add = str_split($first_add, 2);
	//$start = mktime(0,0,0,$day_add[1],$day_add[2],$day_add[0]);
	$end[0] = date("y");
	$end[1] = date("m");
	$end[2] = date("d");

	$total_day = (mktime(0,0,0,$end[1],$end[2],$end[0])-mktime(0,0,0,$day_add[1],$day_add[2],$day_add[0]))/86400;
	return $total_day;
}

function chk_day_send($day_send){
	$f_num =0;
	$n_c = 0;
	//echo "<script>alert('".$day_send[0].$day_send[1].$day_send[2]."')</script>";
	if($day_send[0]!="SEND"){
		$day_send[0] = "Today";
	}
	else {
		$day_send[0] = "";
	}
	if($day_send[1]!="SEND"){
		$day_send[1] = "Yesterday";
	}
	else {
		$day_send[1] = "";
	}
	if($day_send[2]!="SEND"){
		$day_send[2] = "2 day ago";
	}
	else {
		$day_send[2] = "";
	}
	foreach ($day_send as $day_s) {
		if(strlen($day_s)>4){
			$f_num +=1;
		}
	}
	if($f_num==1){
		return $day_send[0].$day_send[1].$day_send[2];
	}
	else if($f_num==2){

		foreach($day_send as $dd1){
			
			if(strlen($dd1)>4){
				//echo "<script>alert('".$dd1."')</script>";
				$n_c += 1;
				if($n_c<=1){
					$return_d .= $dd1;
				}
				else {
					$return_d .= " and ".$dd1;
				}
			}
		}
		return $return_d;
	}

	else if($f_num==3){
		foreach($day_send as $dd1){
			$n_c += 1;
			if($n_c==1){
			$return_d .= $dd1;
			}
			else if($n_c==2) {
				$return_d .= ",".$dd1;
			}
			else if($n_c==3) {
				$return_d .= " and ".$dd1;
			}
		}
		return $return_d;
	}
}

function chk_gift_form(){
	$name_info = explode("-", $_SESSION[u_info]);
	?>

				<script>
				$('.main_body').removeClass("center");
				$('.main_body').attr('align','center');
				</script>

				<div class='chk_gift_body'>
					<center><table class='table table-bordered'>
						<tr>
							<td class='txc' colspan='2'><div align='right'><br>
								Loged in as <?=$name_info[1]?><?
							if(isset($_SESSION[session_usr])){
							echo "&nbsp;&nbsp;<a href='log_out.php'>Log Out</a>";
								}
							?>
							<br><br></div></td>
							
						</tr>
						<tr>
							<td>Total gift yesterday : <?=gift_check(date("ymd")-1,$name_info[0])?>(don't sent <?=chk_fr_amnt($name_info[0])-gift_check(date("ymd")-1,$name_info[0])?>)</td>
							<td>Total gift today : <?=gift_check(date("ymd"),$name_info[0])?> (don't sent <?=chk_fr_amnt($name_info[0])-gift_check(date("ymd"),$name_info[0])?>)</td>
						</tr></table>
				</center>


					<table class='table table-bordered' width = '900'>
						<tr><td colspan='4'><input type='text' class='add_fr' placeholder='Type your friend name'>&nbsp;&nbsp;<a href='#' class='clk_link'>Add Friend</a></td></tr>
						<tr>
							<td class='txc' colspan='2'>
								<center>Name</center>
							</td>
							<td class='txc'><center>Detail</center></td>
							<td class='txc'><center>Status(last 3 day)</center></td>
							<td class='txc' width='150'>
								<center>Check for <?=date("d/m/Y")?></center>
							</td>
						</tr>
						
						<tr>
							
									<?
									$query = mysql_query("SELECT * FROM name_table WHERE uid='$name_info[0]' ORDER BY rank ASC ");
									$num_qry_chk = mysql_num_rows($query);
									$date_now = date("ymd");
									$day_check = 0;
									for($x=0;$x<$num_qry_chk;$x++){
										$fetch = mysql_fetch_array($query);

										
										
										
										echo "<td>";
											echo "<a href='#' class='delete_fr'><input type='hidden' class='val_del' value='".$fetch[c_name]."-".$name_info[0]."'><i class='icon-trash'></i></a>";
										echo "</td>";
										echo "<td class='txc'>";
											echo $fetch[name];
										
										$query_chk_name = mysql_query("SELECT * FROM day_table WHERE c_name = '$fetch[c_name]' && uid='$name_info[0]'");
										$num_row_query_chk_name = mysql_num_rows($query_chk_name);

										echo "</td>";
										echo "<td>First add : ".ch_day($fetch[first_add],"d")."-".ch_day($fetch[first_add],"m")."-".ch_day($fetch[first_add],"y");

										if($num_row_query_chk_name==0){
										echo "<br><font color='red'>Total gift(Recive) : ".$num_row_query_chk_name."</font>";
										}
										else {
										echo "<br>Total gift(Recive) : ".$num_row_query_chk_name;
										}

										echo "<br>Day as friend : ".cal_fr($fetch[first_add])."</td>";
										echo "<td>";

										for($num_name = 0 ; $num_name < $num_row_query_chk_name ; $num_name++){
											$query_chk_name_fetch = mysql_fetch_array($query_chk_name);
											if ($date_now-1==$query_chk_name_fetch[date_time]&&$query_chk_name_fetch[date_hour]!="99"){
												$day_check += 1;
												$dontsendgift[1] = "SEND";
												
											}
											else if($date_now-2==$query_chk_name_fetch[date_time]&&$query_chk_name_fetch[date_time]!="99"){
												$day_check +=1;
												$dontsendgift[2] = "SEND";
											}
											else if($date_now==$query_chk_name_fetch[date_time]&&$query_chk_name_fetch[date_hour]!="99"){
												$day_check +=1;
												$dontsendgift[0] = "SEND";
												if($query_chk_name_fetch[date_hour]=="99")
												$day_now = FALSE;
												else {
													$day_now = TRUE;
												}
											}

										}
										

										if(cal_fr($fetch[first_add])>=2){
											if($day_check==3){
												echo "<div class='alert alert-success'>Good !! Don't have any problem</div>";
											}
											else if ($day_check==2){
												echo "<div class='alert alert-info'>Warning !! don't sent your gift for 1 day (".chk_day_send($dontsendgift).")</div>";
											}
											else if ($day_check==1){
												echo "<div class='alert alert-block'>Alert !! don't sent your gift for 2 day(".chk_day_send($dontsendgift).")</div>";
											}
											else {
												echo "<div class='alert alert-error'>Critical !! Consider to delete from your friend !!</div>";
											}
										}
										else {
											echo "<div class='alert alert-newfriend'>New friend !!</div>";
										}

										$dontsendgift = array();


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
function register_form(){
	$_SESSION[session_usr]="regis";
	?>
	<script>
	$('.main_body').removeClass("center");
	$('.main_body').attr('align','center');
	</script>
	<div class='transbox3'>
		<form><br><table>
			<tr><td>Username</td><td><input type='text' placeholder='Type your username' id='user_regis'></td>
			<tr><td>password</td><td><input type='password' id='pass_regis'></td></tr>
			<tr><td>confirm password</td><td><input type='password' id='con_pass_regis'></td>
			<tr><td colspan='2'><center><input type='button' value='Register'class='sub_regis'></td>
		</table>
		</form>
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
	//chk_gift_form();
	echo "<script>window.location.href='index.php'</script>";

}
else if($_POST[condition]=="add_friend"){
	$name_info = explode("-", $_SESSION[u_info]);

	$friend_name = $_POST[fr_name];
	if(strlen($friend_name)>20||strlen($friend_name)<1){
		echo "<script>alert('You must input lower than 20 character');window.location.href='index.php';</script>";
	}
	else {

		$name_query = mysql_query("SELECT c_name FROM name_table WHERE name = '$friend_name' && uid='$name_info[0]'");
		$num_name_query = mysql_num_rows($name_query);
		if ($num_name_query > 0){
			echo "<script>alert('This name have exist');window.location.href='index.php';</script>";
		}
		else {
		mysql_query("INSERT INTO name_table VALUES ('','$friend_name','y','$name_info[0]','".date("ymd")."')");
		echo "<script>window.location.href='index.php'</script>";
		}
	}
}
else if($_POST[condition]=="del_user"){

	$del_spilt = explode("-", $_POST[del_val]);
	//echo "<script>alert('".$del_spilt[0]."-".$del_spilt[1]."')</script>";
	mysql_query("DELETE FROM day_table WHERE c_name = '$del_spilt[0]' && uid = '$del_spilt[1]'");
	mysql_query("DELETE FROM name_table WHERE c_name = '$del_spilt[0]' && uid = '$del_spilt[1]'");
	echo "<script>window.location.href='index.php';</script>";

}

else if($_POST[condition]=="register"){
	register_form();
}
else if($_POST[condition]=="register_form"){
	session_destroy();
	$numid = mysql_num_rows(mysql_query("SELECT uid FROM user_login WHERE uname = '$_POST[user]' && upsw = '$_POST[con]'"));
	if( strlen($_POST[con]) >= 5 && strlen($_POST[user]) >= 5 ){
		if($numid>0){
			echo "<script>alert('This usename has been already used')</script>";
			echo "<script>window.location.href='index.php';</script>";
		}
		else {
			if($_POST[psw]==$_POST[con]){
				mysql_query("INSERT INTO user_login VALUES ('".date("ymdhis")."','$_POST[user]','$_POST[con]')");
				echo "<script>alert('Register successfully !!')</script>";
				echo "<script>window.location.href='index.php';</script>";
			}
			else {
				$_SESSION[session_usr]="regis";
				echo "<script>alert('Password does not match')</script>";
				echo "<script>window.location.href='index.php';</script>";
			}
		}
	}
	else {
		$_SESSION[session_usr]="regis";
		echo "<script>alert('Username and password must have at least 5 charecter !!')</script>";
		echo "<script>window.location.href='index.php';</script>";
	}
}

?>