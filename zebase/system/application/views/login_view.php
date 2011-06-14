<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Zebrafish</title> 
<link href="<?php echo $this->config->item('base_url') ?>style/oneColFixCtrHdr.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->config->item('base_url') ?>style/js/jquery-1.4.1.min.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url') ?>style/js/jquery.lavalamp.js"></script>
<script language="javascript">
$(document).ready(function () {  
  
    //get the current position of the active item  
    var dleft = $('.lavalamp li.active').offset().left - $('.lavalamp').offset().left;  
    var dwidth = $('.lavalamp li.active').width() + "px";  
  
    //apply the current position of active item to our floatr element  
    $('.floatr').css({  
        "left": dleft+"px",  
        "width": dwidth  
    });  
  
    $('.lavalamp li').hover(function(){  
  
        var left = $(this).offset().left - ($(this).parents('.lavalamp').offset().left + 15);  
        var width = $(this).width() + "px";  
        var sictranslate = "translate("+left+"px, 0px)";  
  
        $(this).parent('ul').next('div.floatr').css({  
            "width": width,  
            "-webkit-transform": sictranslate,  
            "-moz-transform": sictranslate  
        });  
  
    },  
  
    function(){  
  
        var left = $(this).siblings('li.active').offset().left - ($(this).parents('.lavalamp').offset().left + 15);  
        var width = $(this).siblings('li.active').width() + "px";  
  
        var sictranslate = "translate("+left+"px, 0px)";  
  
        $(this).parent('ul').next('div.floatr').css({  
            "width": width,  
            "-webkit-transform": sictranslate,  
            "-moz-transform": sictranslate  			
  
        }); 
		    }).click(function(){   
  
    });   
});  
</script>

<script language="javascript">
function sub_data(){
	if (document.login_form.username.value == "" || document.login_form.pass.value == ""){
		alert("Please make sure you fill in your username and password!");
	}else{
		document.login_form.submit();	
	}
}
</script>   
</head>
<body   onload="document.login_form.username.focus();"> 
 <div class="container">
  <div class="header" style="float:left">
  <div class="statement"> <img src="<?php echo $this->config->item('base_url') ?>style/images/zebase-blue.png" alt="Zbase" width="185" height="50" hspace="10" />an open-source database for zebrafish inventory</div>
<div style="height:10px"></div>
 
  <!-- end .header --></div>
  <div style="height:180px"></div>
  <div class="content">
<?php
	$attributes = array('id' => 'login_form_ID','name' => 'login_form');
	echo form_open('fish/send_login', $attributes); 
?>
<h1 style="font-size:4.5em">Login</h1> 
<div style="width: 500px; height:300px; margin-left:30%; text-align: left"> <div style="padding-top:50px;">
          
                 <?php
				if ($attempt == "f"){
					echo '<div style="color:#F00; padding-left:100px;">Username or Password is incorrect!</div>';
				}
				?>
                    <table>
                    <tr><td>Username:</td><td><input type="text" style="width: 160px;" name="username" /></td></tr>
                    <tr><td>Password:</td><td> <input type="password" style="width: 160px; margin-top: 10px;" name="pass"/></td></tr>
                    </table> 
                  <input type="button" onclick="sub_data();" value="Sign In" />
                </div> </div> 
</form> 
  <!-- end .content --></div>
   
  <!-- end .container --></div>
</body>
</html>