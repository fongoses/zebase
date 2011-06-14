<?php
function output_form(){
	?>
    <script language="javascript">
	function submit_form_data(){
		if (document.install_form.database_name.value == ""){
			alert('Make sure you insert the database name.');
		}else if (document.install_form.username.value == ""){
			alert('Make sure you insert the username.');
		}else if (document.install_form.password.value == ""){
			alert('Make sure you insert the password.');
		}else if (document.install_form.host.value == ""){
			alert('Make sure you insert the host name.');
		}else if (document.install_form.web_url.value == ""){
			alert('Make sure you insert the website URL.');
		}else{
			document.install_form.submit();
		}
	}
	</script>
    <?php
	$temp_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$url = substr($temp_url,0,strlen($temp_url) - 26);
	?>
<div class="standard_box" style="width:800px; margin-left:200px; margin-top:50px;">
        <div>
        <h1>Zbase</h1>
        </div>
        <div>
        <h2>Step 1: Database Information</h2> 
         Enter your database connection settings:<br /> <br />  
       <form method="post" action="install.php?next=2" name="install_form">
       <table style="padding-left:50px;">
       <tr><td align="right"><strong>Database Name</strong></td><td><input size="50" type="text" name="database_name" />(ie. fishdb)</td></tr>
       <tr><td align="right"><strong>Username</strong></td><td><input size="50"  type="text" name="username" /></td></tr>
       <tr><td align="right"><strong>Password</strong></td><td><input size="50"  type="password" name="password" /></td></tr>
       <tr><td align="right"><strong>Database Host</strong></td><td><input size="50"  type="text" value="localhost" name="host" />(ie. localhost)</td></tr> 
       <tr><td align="right"><strong>Website URL</strong></td><td><input size="50"  type="text" value="<?php echo $url;  ?>" name="web_url" />(ie. http://www.domain.com)</td></tr>             
       </table>
       </form>
       <br />
        If you have all of this information ready, they you are ready to go.  Hit next to proceed.
        </div>
        <br />
          <div style=" float:left">
        <a href="#" onClick="location.href='install.php';" class="jq_buttons" style=" font-size:20px;">Back</a>
        </div>
        <div style="margin-left:700px;">
        <a href="#" onClick="submit_form_data();" class="jq_buttons" style=" font-size:20px;">Next</a>
        </div>
    </div>    
<?php
}
function check_db_inuse($local){
	
}
function output_pre_installation(){
	?>
 <div class="standard_box" style="width:800px; margin-left:200px; margin-top:50px;">
        <div>
        <h1>Zbase</h1>
        </div>
        <div>
        <h2>Pre-Installation Notes</h2> 
        Welcome to Zbase.  Before we begin please ensure that you have the below information:
        <ul>
        <li>Database name</li>
        <li>Database username</li>
        <li>Database password</li>
        <li>Database host</li>
        </ul><br />
        If you have all of this information ready, they you are ready to go.  Hit next to proceed.
        </div>
        <br /> 
        <div style="margin-left:700px;">
        <a href="#" onClick="location.href='install.php?next=1';" class="jq_buttons" style=" font-size:20px;">Next</a>
        </div>
    </div>
<?php
}
function output_finish(){
	?>
 <div class="standard_box" style="width:800px; margin-left:200px; margin-top:50px;">
        <div>
        <h1>Zbase</h1>
        </div>
        <div>
        <h2>Finished</h2> 
        You are finished.<br /><br />
        <strong>Username:</strong> admin<br />
        <strong>Password::</strong> user<br />
        </div>
        <br />
         <div style=" float:left">
        <a href="#" onClick="location.href='install.php';" class="jq_buttons" style=" font-size:20px;">Back</a>
        </div>
        <div style="margin-left:650px;">Go to your site
        <a href="#" target="_new" onClick="window.open('<?php echo $_POST['web_url']; ?>index.php/fish/login','form','width=1200,height=1200,left=10,top=163,location=no, menubar=yes,status=yes,toolbar=yes,scrollbars=yes,resizable=yes');" class="jq_buttons" style=" font-size:20px;">Go</a>
        </div>
    </div>
<?php
}
function output_file_permission_page($permissions){ 
	?>
       <form method="post" action="install.php?next=3" name="install_form">
       <input size="50" type="hidden" name="database_name" value="<?php echo $_POST['database_name'] ?>"/> 
        <input size="50"  type="hidden" name="username" value="<?php echo $_POST['username'] ?>" /> 
        <input size="50"  type="hidden" name="password" value="<?php echo $_POST['password'] ?>" /> 
        <input size="50"  type="hidden" name="host" value="<?php echo $_POST['host'] ?>" /> 
       <input size="50"  type="hidden" name="web_url" value="<?php echo $_POST['web_url'] ?>" />          
       
       </form>
 <div class="standard_box" style="width:800px; margin-left:200px; margin-top:50px;">
        <div>
        <h1>Zbase</h1>
        </div>
        <div>
        <h2>Step 2: Configure Files</h2>  
        Make sure the permissions are set to allow this script to read/write the directories below and then click next:<br /><br />
        <?php
		echo $permissions;
		?> 
        </div>
        <br />
         <div style=" float:left">
        <a href="#" onClick="location.href='install.php';" class="jq_buttons" style=" font-size:20px;">Back</a>
        </div>
        <div style="margin-left:650px;">
        <a href="#" onClick="document.install_form.submit();" class="jq_buttons" style=" font-size:20px;">Next</a>
        </div>
    </div>
<?php
}
function update_config_url($file_path){
	//ini_set('display_errors', 'On');
	$temp = getcwd();
	$dir = substr($temp,0,strlen($temp) - 8);
	$file = $dir . $file_path;	 
	$f= @fopen($file,'r'); 
	$data='';
	$file_conents = "";
	while(!feof($f)){
		$data = fgets($f,1800);
		$matchvar = '$config[\'base_url\']';   
		if (strstr($data,$matchvar)){ 
			$file_conents .= $matchvar . ' = "' . $_POST['web_url'] . '";' . "\n";  
		}else{
			$file_conents .= $data;	
		}
	} 
	$f= @fopen($file,'w+');
	if(!fwrite($f, $file_conents)){
		$error = "Error: Unable to write file: " . $file;
	}
	fclose($f);
	return $status;
}
function update_config_db($file_path){
	//ini_set('display_errors', 'On');
	$temp = getcwd();
	$dir = substr($temp,0,strlen($temp) - 8);
	$file = $dir . $file_path;	 
	$f= @fopen($file,'r'); 
	$data='';
	$file_conents = "";
	while(!feof($f)){
		$data = fgets($f,1800); 
		$matchvar1 = '$db[\'default\'][\'hostname\']';
		$matchvar2 = '$db[\'default\'][\'username\']';
		$matchvar3 = '$db[\'default\'][\'password\']';
		$matchvar4 = '$db[\'default\'][\'database\']';
		if (strstr($data,$matchvar1)){ 
			$file_conents .= '$db[\'default\'][\'hostname\'] = "' . $_POST['host'] . '";' . "\n"; 
			$file_conents .= '$db[\'default\'][\'username\'] = "' . $_POST['username'] . '";' . "\n"; 
			$file_conents .= '$db[\'default\'][\'password\'] = "' . $_POST['password'] . '";' . "\n"; 
			$file_conents .= '$db[\'default\'][\'database\'] = "' . $_POST['database_name'] . '";' . "\n"; 
		}elseif (strstr($data,$matchvar2) || strstr($data,$matchvar3) || strstr($data,$matchvar4)){
		}else{
			$file_conents .= $data;	
		}
	} 
	$f= @fopen($file,'w+');
	if(!fwrite($f, $file_conents)){
		$error = "Error: Unable to write file: " . $file;
	}
	fclose($f);
	
	return $error;
}
function update_survival_track($file_path){
	//ini_set('display_errors', 'On');
	$temp = getcwd();
	$dir = substr($temp,0,strlen($temp) - 8);
	$file = $dir . $file_path;	 
	$f= @fopen($file,'r'); 
	$data='';
	$file_conents = "";
	while(!feof($f)){
		$data = fgets($f,1800); 
		$matchvar1 = '$username_local =';
		$matchvar2 = '$password_local =';
		$matchvar3 = '$hostname_local =';
		$matchvar4 = '$database_local ='; 
		if (strstr($data,$matchvar1)){ 
			$file_conents .= '$hostname_local = "' . $_POST['host'] . '";' . "\n"; 
			$file_conents .= '$username_local = "' . $_POST['username'] . '";' . "\n"; 
			$file_conents .= '$password_local = "' . $_POST['password'] . '";' . "\n"; 
			$file_conents .= '$database_local = "' . $_POST['database_name'] . '";' . "\n";  
		}elseif (strstr($data,$matchvar2) || strstr($data,$matchvar3) || strstr($data,$matchvar4)){
		}else{
			$file_conents .= $data;	
		}
	} 
	$f= @fopen($file,'w+');
	if(!fwrite($f, $file_conents)){
		$error = "Error: Unable to write file: " . $file;
	}
	fclose($f); 
	return $error;
}
function update_email_files($file_path){
	//ini_set('display_errors', 'On');
	$temp = getcwd();
	$dir = substr($temp,0,strlen($temp) - 8);
	$file = $dir . $file_path;	 
	$f= @fopen($file,'r'); 
	$data='';
	$file_conents = "";
	while(!feof($f)){
		$data = fgets($f,1800); 
		$matchvar1 = '$username_local =';
		$matchvar2 = '$password_local =';
		$matchvar3 = '$hostname_local =';
		$matchvar4 = '$database_local ='; 
		$matchvar5 = '$web_url ='; 
		if (strstr($data,$matchvar1)){ 
			$file_conents .= '$hostname_local = "' . $_POST['host'] . '";' . "\n"; 
			$file_conents .= '$username_local = "' . $_POST['username'] . '";' . "\n"; 
			$file_conents .= '$password_local = "' . $_POST['password'] . '";' . "\n"; 
			$file_conents .= '$database_local = "' . $_POST['database_name'] . '";' . "\n";  
			$file_conents .= '$web_url = "' . $_POST['web_url'] . '";' . "\n";  
		}elseif (strstr($data,$matchvar2) || strstr($data,$matchvar3) || strstr($data,$matchvar4) || strstr($data,$matchvar5)){
		}else{
			$file_conents .= $data;	
		}
	} 
	$f= @fopen($file,'w+');
	if(!fwrite($f, $file_conents)){
		$error = "Error: Unable to write file: " . $file;
	}
	fclose($f); 
	return $error;
}
function create_tables($link){  
	$dir = getcwd();
	$file = $dir . "/create_tables.sql";	
	$error = ""; 
	$f= @fopen($file,'r'); 
	$sqldata=''; 
	$data=''; 
	$error = "";
	$statement = "";
	while(!feof($f)){
		$data = fgets($f,1800); 
		if (strstr($data,'^')){
			$sqldata[] = $statement;
			$statement = "";
		}else{
			$statement .= $data; 
		}
	}
	if (is_array($sqldata)){
		foreach ($sqldata as $sql_statement){
			if (mysql_query($sql_statement, $link)) {  
			} else {		 
				$error = 'Database configuration: <br>: ' . mysql_error();		
			}  
		}
	}
	//insert the admin account
	//username: admin
	//password: user
	require_once('phpass-0.1/PasswordHash.php');
	define('PHPASS_HASH_STRENGTH', 8);
	define('PHPASS_HASH_PORTABLE', false);
	$user_pass = "user";
	$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
	$user_pass_hashed = $hasher->HashPassword($user_pass);
	//$temppass = '$2a$08$7F9wlzclDJq8Hc0UhvtSqOMmUYV06CG0TClQoGgjNjH8NSt7jkiTa';
	$sql = "insert into users values('','" . $user_pass_hashed . "','','','','','templab','','','','','','admin','on','admin','','');";
	if (mysql_query($sql, $link)) {   
	} else {	  
		$error = 'Error: ' . mysql_error();		
	}
	$sql = "insert into labs values('templab');";
	if (mysql_query($sql, $link)) {   
	} else {	  
		$error = 'Error: ' . mysql_error();		
	}   
	return $error; 
}
function run_db_connect(){
		$link = mysql_connect($_POST['host'], $_POST['username'], $_POST['password']); 
		if (!$link) { 
		  $error .= 'Not connected : ' . mysql_error();
		}else{
			$error = check_db_inuse($link);
			$sql = "use " . $_POST['database_name'];
			if (mysql_query($sql, $link)) {
				$error = $_POST['database_name'] . " database already in use.<br>"; 
				return $error; 
			}  
			$db_selected = mysql_select_db($_POST['database_name'], $link); 
			if (!$db_selected) {
				$sql = "CREATE DATABASE " .  $_POST['database_name'] . ";";  
				if (mysql_query($sql, $link)) { 
				} else {		 
					$error .= 'Error: ' . mysql_error();		
				} 
				$db_selected = mysql_select_db($_POST['database_name'], $link);
			}else{
				$error .= 'Cannot use ' . $_POST['database_name'];						
			}
		} 
			$error .= create_tables($link);
	return $error;
}
function check_report_tmp($file){
	$file = $file . 'temp.txt';
	$f= @fopen($file,'w');
	if (!fwrite($f, "temp")) {
       $error = "Error: Unable read/write to folder: " . $file . '<br>';
	    // failed.
	}
	fclose($f);
	unlink($file);
	return $error; 
}
function check_main_tmp($file){
	$file = $file . 'temp.txt';
	$f= @fopen($file,'w');
	if (!fwrite($f, "temp")) {
       $error = "Error: Unable read/write to folder: " . $file . '<br>';
	    // failed.
	}
	fclose($f);
	unlink($file);
	return $error; 
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zbase Installation</title>
<style>
.standard_box { -webkit-border-radius: 23px; 
-moz-border-radius: 23px; 
border-radius: 23px; 
-webkit-box-shadow: 2px 2px 21px #808080; 
-moz-box-shadow: 2px 2px 21px #808080; 
box-shadow: 2px 2px 21px #808080; 
 border: 0px solid #90EE90; 
background-color: #FFF; 
padding: 10px; 
font-family: Verdana, Geneva, sans-serif; 
font-size: 1em; 
color: #888888; 
text-align: left;}
.container {  
height:800px;
background-image: -moz-linear-gradient(top, #FFFFFF, #E6E6FA); 
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFFFFF), color-stop(1.0, #E6E6FA)); 
 }
 .error_msg{
background-color: #F08080;
padding: 10px;
font-family: Verdana, Geneva, sans-serif;
font-weight: bold;
font-size: 12pt;
color: #FFFFFF;
text-align: left;
outline: 6px solid #DC143C; 
 }
  .complete_msg{
background-color: #390;
padding: 10px;
font-family: Verdana, Geneva, sans-serif;
font-weight: bold;
font-size: 12pt;
color: #FFFFFF;
text-align: left;
outline: 6px solid #3C0; 
 }
</style> 
<link rel="stylesheet" href="../assets/functions/jquery/jquery-ui-1.8.5.custom/css/custom-theme/jquery-ui-1.8.5.custom.css" type="text/css" media="screen" />

<script src="../assets/functions/jquery/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.effects.core.js"></script> 	
<script src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.tabs.js" type="text/javascript"></script>
<script src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="../assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.accordion.js" type="text/javascript"></script>

<script language="javascript">
$(function() {
	$(  "a.jq_buttons").button(); 
	$(  "a.jq_buttons").click(function() { return false; }); 
});
</script>
</head>

<body >
<div  class="container">
<?php
if ($_GET['next'] == ""){
	output_pre_installation();
}elseif ($_GET['next'] == "1"){
	output_form(); 
}elseif ($_GET['next'] == "2"){ 
			$error = ""; 
			$error = run_db_connect();	
			
		  if ($error != ""){			 
			echo '<div class="error_msg" style=" width:900px; margin-left:180px"><h2>Error:</h2>' . $error . '</div>';                   
			output_form();	 
		  }else{
			 echo '<div class="complete_msg" style=" width:900px; margin-left:180px"><h2>Database Configuration Finished</h2></div>';
			$temp = getcwd();
			$dir = substr($temp,0,strlen($temp) - 8);  
			$permissions =  $dir . "/assets/scheduled_reports/tmp <br>";
			$permissions .= $dir . "/assets/scheduled_reports <br>";
			$permissions .= $dir . "/tmp <br>";
			$permissions .= $dir . "/system/application/config <br>";
			output_file_permission_page($permissions); 
		  }
}elseif ($_GET['next'] == "3"){
	$temp = getcwd();
	$dir = substr($temp,0,strlen($temp) - 8);  
	$error = update_config_url('/system/application/config/config.php'); 
	$error .= update_config_db('/system/application/config/database.php'); 
	$error .= update_survival_track('/assets/scheduled_reports/track_survival.php');
	$error .= update_email_files('/assets/scheduled_reports/email_stats.php');	
	$error .= check_report_tmp($dir . "/assets/scheduled_reports/tmp/");
	$error .= check_main_tmp($dir . "/tmp/");
	if ($error != ""){
		echo '<div class="error_msg" style=" width:900px; margin-left:180px"><h2>Error:</h2>' . $error . '</div>';
		$temp = getcwd();
		$dir = substr($temp,0,strlen($temp) - 8);  
		$permissions =  $dir . "/assets/scheduled_reports/tmp <br>";
		$permissions .= $dir . "/assets/scheduled_reports <br>";
		$permissions .= $dir . "/tmp <br>";
		$permissions .= $dir . "/system/application/config <br>";
		output_file_permission_page($permissions);     
	}else{
		echo '<div class="complete_msg" style=" width:900px; margin-left:180px"><h2>Configure Files Finished</h2></div>';
		output_finish();	 
	}
		   ?>          
        </div> 
<?php
}
?>
</div>
</body>
</html>