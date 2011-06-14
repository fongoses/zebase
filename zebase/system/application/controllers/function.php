<?php 
session_start();
//make sure the user is logged in
$this->load->library('SimpleLoginSecure');  
if($this->session->userdata('logged_in')) { 	
}else{ 
	$html = '<script language="javascript">
	if (self.parent.Shadowbox != undefined) {
		alert("You are no longer logged in.  Please refresh your browser window and log in again.");
		self.parent.Shadowbox.close(); 
	}
	</script>
	You are not logged in.  Please click <a href="' . base_url() . 'index.php/fish/login">here</a> to login.'; 
	die($html);
}  
$_SESSION['base_url'] = base_url(); 
function sanitize($data){  
 // remove whitespaces (not a must though)  
 $data = trim($data);  
 // apply stripslashes if magic_quotes_gpc is enabled  
 if(get_magic_quotes_gpc()){  
 	$data = stripslashes($data);  
 }    
 // a mySQL connection is required before using this function  
 $data = mysql_real_escape_string($data);    
 return $data;
}
function create_qtip($id,$content){
	$html = '<script language="javascript">
	$(document).ready(function() 
{
   // Match all link elements with href attributes within the content div
   $(\'#' . $id . ' a[href]\').qtip(
   {
      content: \'' . $content . '\' ,
	  style:\'cream\' 
   });
});
 </script>';	
return $html;
}
function table_format($ID, $nopage,$title){
	if ($nopage == "1" && $title == ""){
		$html = '<script type="text/javascript"> 
		$(document).ready(function() {
			oTable = $(\'#' . $ID . '\').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"aaSorting": [[1,\'asc\']], 
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0 ] }],
				"bPaginate": false,
				"bFilter": false 
				});
		} );   
		</script>';
	}elseif ($nopage == "1"){
		$html = '<script type="text/javascript"> 
		$(document).ready(function() {
			oTable = $(\'#' . $ID . '\').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"aaSorting": [[1,\'asc\']], 
				"bPaginate": false,
				"bFilter": false,
				"sDom": \'<"ui-widget-header">frtip\' 
			}); 
			$("div.ui-widget-header").html(\'<div style=" padding-left:400px; font-size:1.1em;">' . $title . '</div>\');
		});  
		</script>';
	}elseif ($title != ""){
		$html = '<script type="text/javascript"> 
		$(document).ready(function() {
			oTable = $(\'#' . $ID . '\').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"aaSorting": [[1,\'asc\']], 
				"bPaginate": true,
				"bFilter": false,
				"sDom": \'<"' . $ID . '">frtip\' 
			}); 
			$("div.' . $ID . '").html(\'<div class="ui-widget-header"><div style=" padding-left:400px; font-size:1.1em;">' . $title . '</div></div>\');
		} );  
		</script>';
	}else{
		$html = '<script type="text/javascript"> 
		$(document).ready(function() {
			oTable = $(\'#' . $ID . '\').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"aaSorting": [[1,\'asc\']],
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0 ] }]';
				if ($ID == "lab_fish_table" || $ID == "all_fish_table"){
					 $html .= ',"bStateSave": true';
				}
		 $html .= '}); 
		} ); 
		</script>';
	}
	return $html;		
}
function footer(){ 
	echo ' <div id="footer">
  	<div id="footerd1">
		<p><a href="mailto:webman&#97;ger@bio&#46;purdue&#46;edu">webmanager@bio.purdue.edu</a><br />
		Maintained by BIO-IT  </p>
	</div>
 	 <div id="footerd2">
			<p>Department of Biological Sciences, Purdue University <br />
		
			915 W. State Street,
		West Lafayette, IN 47907
		ph. (765) 494-4408 
		Fax (765) 494-0876<br />
				&copy; 2009 Purdue University. An equal
			access/equal opportunity university.  </p>
 	 </div>
  <!-- end #footerr --></div>  
';
}
function libraries($url){
?> 
 
<link rel="stylesheet" href="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/css/custom-theme/jquery-ui-1.8.5.custom.css" type="text/css" media="screen" />

<script src="<?php echo $url ?>assets/functions/jquery/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.effects.core.js"></script> 	
<script src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.tabs.js" type="text/javascript"></script>
<script src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="<?php echo $url ?>assets/functions/jquery/jquery-ui-1.8.5.custom/development-bundle/ui/jquery.ui.accordion.js" type="text/javascript"></script>
<link href="<?php echo $url ?>assets/functions/jquery/shadowbox-3.0.3/shadowbox.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="<?php echo $url ?>assets/functions/jquery/shadowbox-3.0.3/shadowbox.js"></script> 

<link rel="stylesheet" href="<?php echo $url ?>assets/functions/itunes_grid/webroot/_assets/css/core.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $url ?>assets/functions/itunes_grid/webroot/_assets/js/jquery-jtemplates.js"></script>
<!--adobe spry-->
<link rel="stylesheet" href="<?php echo $url ?>assets/functions/SpryAssets/SpryTabbedPanels.css" type="text/css" media="screen" />
<script src="<?php echo $url ?>assets/functions/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $url ?>assets/functions/SpryAssets/SprySlidingPanels.css" type="text/css" media="screen" />
<script src="<?php echo $url ?>assets/functions/SpryAssets/SprySlidingPanels.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $url ?>assets/functions/shadedborder.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $url ?>assets/functions/jquery/DataTables-1.7.6/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $url ?>assets/functions/jquery/jquery.qtip-1.0.0-rc3.custom/jquery.qtip-1.0.0-rc3.min.js"></script>
 
<script language="javascript">
function selectAllOptions(selStr){
		  var selObj = document.getElementById(selStr);
		  for (var i=0; i<selObj.options.length; i++) {
			selObj.options[i].selected = true;
		  }		   
} 
	$(function() {
		$(  "a.jq_buttons").button(); 
		$(  "a.jq_buttons").click(function() { return false; }); 
	});
function moveCloseLink(){ 
    var cb=document.getElementById('sb-nav-close'); 
    var tb=document.getElementById('sb-title'); 
    if(tb) tb.appendChild(cb); 
} 	 
Shadowbox.init({ 
    players:    ["iframe"], 
	onOpen: moveCloseLink,
	animate: false	 
});
 

//jquery iphone switch start
jQuery.fn.iphoneSwitch = function(start_state, switched_on_callback, switched_off_callback, options) {
	 var state = start_state == 'on' ? start_state : 'off';
	
	// define default settings
	var settings = {
		mouse_over: 'pointer',
		mouse_out:  'default',
		switch_on_container_path: '<?php echo $url ?>assets/switch/iphone_switch_container_on.png',
		switch_off_container_path: '<?php echo $url ?>assets/switch/iphone_switch_container_off.png',
		switch_path: '<?php echo $url ?>assets/switch/iphone_switch.png',
		switch_height: 27,
		switch_width: 94
	};

	if(options) {
		jQuery.extend(settings, options);
	}

	// create the switch
	return this.each(function() {

		var container;
		var image;
		
		// make the container
		container = jQuery('<div class="iphone_switch_container" style="height:'+settings.switch_height+'px; width:'+settings.switch_width+'px; position: relative; overflow: hidden"></div>');
		
		// make the switch image based on starting state
		image = jQuery('<img class="iphone_switch" style="height:'+settings.switch_height+'px; width:'+settings.switch_width+'px; background-image:url('+settings.switch_path+'); background-repeat:none; background-position:'+(state == 'on' ? 0 : -53)+'px" src="'+(state == 'on' ? settings.switch_on_container_path : settings.switch_off_container_path)+'" /></div>');

		// insert into placeholder
		jQuery(this).html(jQuery(container).html(jQuery(image)));

		jQuery(this).mouseover(function(){
			jQuery(this).css("cursor", settings.mouse_over);
		});

		jQuery(this).mouseout(function(){
			jQuery(this).css("background", settings.mouse_out);
		});

		// click handling
		jQuery(this).click(function() {
			if(state == 'on') {
				jQuery(this).find('.iphone_switch').animate({backgroundPosition: -53}, "slow", function() {
					jQuery(this).attr('src', settings.switch_off_container_path);
					switched_off_callback();
				});
				state = 'off';
			}
			else {
				jQuery(this).find('.iphone_switch').animate({backgroundPosition: 0}, "slow", function() {
					switched_on_callback();
				});
				jQuery(this).find('.iphone_switch').attr('src', settings.switch_on_container_path);
				state = 'on';
			}
		});		

	});
	
};
//jquery iphone switch end
	</script>
<style>
@import "<?php echo $url ?>assets/functions/jquery/DataTables-1.7.6/media/css/demo_table_jui.css";

 
.SlidingPanels {
	float: left;
	height:600px;
}
.SlidingPanelsContentGroup {
	float: left;
	width: 10000px; 
}
.SlidingPanelsContent {
	float: left;
	width: 1200px; 
	
	height:600px;
} 
.SlidingPanelsAnimating * {
	overflow: hidden !important;
} 
.SlidingPanelsCurrentPanel {
}
 
.SlidingPanelsFocused {
}
 
/*#my-border { padding:20px;   margin:10px auto; color:#fff; }
#my-border, #my-border .sb-inner { background: #444 url(https://aragorn.bio.purdue.edu/Pics/grad.png) repeat-x; }
#my-border2 { padding:20px;   margin:10px auto; color:#fff; }
#my-border2, #my-border2 .sb-inner { background: #444 url(https://aragorn.bio.purdue.edu/Pics/grad.png) repeat-x; }
#my-border3 { padding:20px;   margin:10px auto; color:#fff; }
#my-border3, #my-border3 .sb-inner { background: #444 url(https://aragorn.bio.purdue.edu/Pics/grad.png) repeat-x; }
#my-border4 { padding:20px;   margin:10px auto; color:#fff; }
#my-border4, #my-border .sb-inner { background: #444 url(https://aragorn.bio.purdue.edu/Pics/grad.png) repeat-x; }
 #my-border6 { padding:20px;   margin:10px auto; color:#fff; }
#my-border6, #my-border .sb-inner { background: #444 url(https://aragorn.bio.purdue.edu/Pics/grad.png) repeat-x; } 
*/

#batch { margin: 30px 0;
box-shadow: -5px -5px 5px  #000;
-o-box-shadow: -5px -5px 5px #000;
-icab-box-shadow: -5px -5px 5px #000;
-khtml-box-shadow: -5px -5px 5px #000;
-moz-box-shadow: -5px -5px 5px #000;
-webkit-box-shadow: -5px -5px 5px #000;
border-radius: 5px;
-o-border-radius: 5px;
-icab-border-radius: 5px;
-khtml-border-radius: 5px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
padding: 5px 5px 5px 15px;
background-color: #eee;
width: 90%;} 
 
 
 .ui-tabs-vertical { width: 55em;  }
.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em;background:#999; height:550px;  }
.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 1em; padding-left:180px; width: 40em;}
</style>   
<![if IE]>
<style>
#standard_box { 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#E6E6FA');
}
#accented_box { 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#e6f3fa');
}
#plain_box { 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#D3D3D3');
border: 0px solid #FFFFFF;
background-color: #FFFFFF;
padding: 10px;
font-family: Verdana, Geneva, sans-serif;
font-size: 12pt;
color: #000000;
box-shadow: 6px 6px 9px #000000;
behavior: url(<?php echo $url ?>assets/ie-css3.htc);
}
</style>
<![endif]>

<![if !IE]>
<style>
#standard_box { -webkit-border-radius: 23px; 
-moz-border-radius: 23px; 
border-radius: 23px; 
-webkit-box-shadow: 2px 2px 21px #808080; 
-moz-box-shadow: 2px 2px 21px #808080; 
box-shadow: 2px 2px 21px #808080; 
background-image: -moz-linear-gradient(top, #FFFFFF, #E6E6FA); 
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFFFFF), color-stop(1.0, #E6E6FA)); 
border: 0px solid #90EE90; 
background-color: #FFFF00; 
padding: 10px; 
font-family: Verdana, Geneva, sans-serif; 
font-size: 1em; 
color: #888888; 
text-align: left;}
#accented_box { -webkit-border-radius: 23px; 
-moz-border-radius: 23px; 
border-radius: 23px; 
-webkit-box-shadow: 2px 2px 21px #808080; 
-moz-box-shadow: 2px 2px 21px #808080; 
box-shadow: 2px 2px 21px #808080; 
background-image: -moz-linear-gradient(top, #FFFFFF, #e6f3fa); 
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFFFFF), color-stop(1.0, #e6f3fa)); 
border: 0px solid #90EE90; 
background-color: #FFFF00; 
padding: 10px; 
font-family: Verdana, Geneva, sans-serif; 
font-size: 1em; 
color: #888888; 
text-align: left;}
#plain_box{-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 6px 6px 9px #000000;
-moz-box-shadow: 6px 6px 9px #000000;
box-shadow: 6px 6px 9px #000000;
background-image: -moz-linear-gradient(top, #FFFFFF, #D3D3D3);
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFFFFF), color-stop(1.0, #D3D3D3));
border: 0px solid #FFFFFF;
background-color: #FFFFFF;
padding: 10px;
font-family: Verdana, Geneva, sans-serif;
font-size: 12pt;
color: #000000;
behavior: url(<?php echo $url ?>assets/ie-css3.htc);
}
</style>
<![endif]>


  	<?php	
}
function output_cal_func($field_name, $curval,$ID){
	if (trim($curval) == ""){
		$curval = "";
	}elseif ($curval == "empty"){
		$curval = "";
	}else{
		$curval = date('m/d/Y',$curval);
	} 
		 
	$html .= '<script type="text/javascript">
    $(function() {
		$(\'#' . $ID . '\').datepicker({
			yearRange: "1999:2012",
			changeMonth: true,
			changeYear: true
		});
	});
	
	</script>'; 
 
	 $html .= '<input id="' . $ID . '" name="' . $field_name . '"   type="text" size="10"  value="'. $curval . '"/>';	   
	 return $html;
}
function excel_batch_output($query,$url){
			$i = "0";
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype;	
			
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);			 
			$i="2"; 
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','Batch #');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Gender');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Birthday');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Date of Death');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','User');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Strain'); 
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Mutant Name'); 
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Transgene'); 
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Generation');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','Cur Adults');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','Start Nursery');
			foreach ($query as $key_outer => $row){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $i,$row['batch_ID']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $i,$row['gender']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $i,$row['name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $i,$row['status']);
				if ($row['birthday']){
					$objPHPExcel->getActiveSheet()->SetCellValue('E' . $i,date('m/d/Y',$row['birthday'])); 
				}
				if ($row['death_date']){
					$objPHPExcel->getActiveSheet()->SetCellValue('F' . $i,date('m/d/Y',$row['death_date']));
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $i,$row['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $i,$row['strain']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $i,$row['mutant']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $i,$row['transgene']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $i,$row['generation']);				 
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $i,$row['current_adults']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $i,$row['starting_nursery']);  			 
			    $i++; 
			} 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
}
function excel_search_results($query,$url){
			$i = "0";
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype;
			
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);			 
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','Batch #');				 
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);			
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Gender');				 
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Name');				 
			$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Status');				 
			$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Birthday');				 
			$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','User');				 
			$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Lab');				 
			$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true); 
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Strain');				 
			$objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true); 
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Mutant Name');				 
			$objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Mutant Allele');				 
			$objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Transgene Allele');				 
			$objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','Generation');				 
			$objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','Current Adults');				 
			$objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','Start Adults');				 
			$objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->SetCellValue('O1','Cur Nursery');				 
			$objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true); 
			$objPHPExcel->getActiveSheet()->SetCellValue('P1','Start Nursery');				 
			$objPHPExcel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true); 
			
			$i="2"; 
		 	$numfields = count($query);	 
			foreach ($query as $row){
				$objPHPExcel->getActiveSheet()->SetCellValue('A'. $i,$row['batch_ID']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'. $i,$row['gender']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'. $i,$row['name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'. $i,$row['status']);
				if ($row['birthday']){
					$objPHPExcel->getActiveSheet()->SetCellValue('E'. $i,date('m/d/Y',$row['birthday']));
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('F'. $i,$row['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'. $i,$row['lab']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'. $i,$row['strain']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'. $i,$row['mutant']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'. $i,$row['mutant_allele']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'. $i,$row['transgene_allele']);
				$objPHPExcel->getActiveSheet()->SetCellValue('L'. $i,$row['generation']);
				$objPHPExcel->getActiveSheet()->SetCellValue('M'. $i,$row['current_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('N'. $i,$row['starting_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('O'. $i,$row['current_nursery']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('P'. $i,$row['starting_nursery']);   
				$i++; 			
			}  
			 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
}
function excel_data($objPHPExcel,$query,$category_title){
	$i = $_SESSION['record_index'];
	//$numfields = count($query);			
	foreach ($query as $row){
		 $letter_index = 0;
		 //switch the letter value after z to zz
		 $letter_switch = -1;
		 $titles = "";
		 foreach ($row as $key => $value){
			if ($key == "strain_ID" || $key == "mutant_ID" || $key == "transgene_ID"){ 
			}else{
					 $titles[] = $key;
					 $letter = "A";
					 if ($letter_switch != -1){
						 $letter_value = chr(ord($letter)+ $letter_index);
						 $letter_value =  "A" . $letter_value;
					 }else{
						$letter_value = chr(ord($letter)+ $letter_index); 
					 }
					  if ($key == "birthday"){ 
						$objPHPExcel->getActiveSheet()->SetCellValue($letter_value . $i,date('m/d/Y',$value));
					 
					  }else{
						 $objPHPExcel->getActiveSheet()->SetCellValue($letter_value . $i,$value);	
					  }
					if ($letter_value == "Z"){
						$letter_switch = 1;
						$letter_index = -1;
					}				 
					$letter_index++;
			}
		}	
		 $i++; 			
	} 
		$letter_index = 0;	
		$letter_switch = 0;
		$record_index = $_SESSION['record_index'] -2;		
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $record_index,$category_title);				 
		$objPHPExcel->getActiveSheet()->getStyle('C' . $record_index)->getFont()->setBold(true);	
  	    $record_index++;
		foreach ($titles as $value){
			if ($value == "strain_ID" || $value == "mutant_ID" || $value == "transgene_ID"){
			}else{
				 $letter = "A";				 
				 switch ($value) {
					case  "batch_ID":
						 $value = "Batch Number";
						 break;
					case  "starting_adults":
						 $value = "Starting Adults";
						 break;	
					case  "current_adults":
						 $value = "Current Adults(Alive,Sick)";
						 break;
					case  "starting_nursery":
						 $value = "Nursery Quantity";
						 break;
				 }
				 if ($letter_switch == 1){
					 $letter_value = chr(ord($letter)+ $letter_index);
					 $letter_value =  "A" . $letter_value;
				 }else{
					$letter_value = chr(ord($letter)+ $letter_index); 
				 }			 
				 $objPHPExcel->getActiveSheet()->SetCellValue($letter_value . $record_index,$value);				 
				 $objPHPExcel->getActiveSheet()->getStyle($letter_value . $record_index)->getFont()->setBold(true);				  
				if ($letter_value == "Z"){
					$letter_switch = 1;
					$letter_index = -1;
				}				
				$letter_index++;
			}
		}
		$_SESSION['record_index'] = $i + 4;
	return $objPHPExcel;
}
function excel_survival_stat($query,$url){
			$i = "0"; 
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype;	
			
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);			 
			$i="2"; 
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','Batch #');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Start Nursery');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Cur Adults');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Start Adults');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Lab');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Survival Rate');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Birthday');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Date of Death');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Report Date'); 
			foreach ($query as $key_outer => $row){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $i,$row['batch_ID']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $i,$row['starting_nursery']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $i,$row['current_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $i,$row['starting_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $i,$row['lab']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $i,$row['status']);
			 if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
				   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
						$objPHPExcel->getActiveSheet()->SetCellValue('G' . $i,'0%'); 
				   }else{							 
						$objPHPExcel->getActiveSheet()->SetCellValue('G' . $i,round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%');
				   }
			   }else{ 
				  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $i,round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%');
			   }			
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $i,date('m/d/Y',$row['birthday']));
				if ($row['death_date']){
					$objPHPExcel->getActiveSheet()->SetCellValue('I' . $i,date('m/d/Y',$row['death_date']));
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $i,date('m/d/Y',$row['date_taken']));
				$i++; 
			} 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
} 
function excel_current_survival($query,$url){
			$i = "0"; 
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype;	
			
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);			 
			$i="2"; 
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','Batch #');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Username');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Lab');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Cur Adults');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Start Adults');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Start Nursery');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Cur Nursery');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Birthday'); 
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Survival Rate'); 
			foreach ($query as $key_outer => $row){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $i,$row['batch_ID']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $i,$row['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $i,$row['lab']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $i,$row['current_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $i,$row['starting_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $i,$row['starting_nursery']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $i,$row['starting_nursery']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $i,date('m/d/Y',$row['birthday'])); 
				if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
				   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
						$objPHPExcel->getActiveSheet()->SetCellValue('I' . $i,'0%'); 
				   }else{							 
						$objPHPExcel->getActiveSheet()->SetCellValue('I' . $i,round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%');
				   }
			   }else{ 
				  $objPHPExcel->getActiveSheet()->SetCellValue('I' . $i,round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%');
			   }   
			   $i++; 
			} 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
}
function excel_output_lab_all($query,$url){
			$i = "0"; 
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype;	 
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);			 
			$i="2"; 
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','Batch #');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Birthday');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','User');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Lab');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Strain');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Mutant Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Transgene Name'); 
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Generation');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Cur Adults'); 
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Start Nursery'); 
			foreach ($query->result_array() as $row){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $i,$row['batch_ID']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $i,$row['name']);
				if ($row['birthday']){
					$objPHPExcel->getActiveSheet()->SetCellValue('C' . $i,date('m/d/Y',$row['birthday'])); 
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $i,$row['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $i,$row['lab']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $i,$row['strain_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $i,$row['mutant']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $i,$row['transgene']); 
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $i,$row['generation']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $i,$row['current_adults']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $i,$row['starting_nursery']);  
			    $i++; 
			} 
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 			
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
}  
function excel_quantity_output($query,$url){
			$i = "0";
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype; 
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);
			$_SESSION['record_index'] = "3"; 
			$objPHPExcel = excel_data($objPHPExcel,$query['user_quant'], 'Quantity Summary');
			$objPHPExcel = excel_data($objPHPExcel,$query['mutant_quant'], 'Mutant Summary');
			$objPHPExcel = excel_data($objPHPExcel,$query['strain_quant'], 'Strain Summary');
			$objPHPExcel = excel_data($objPHPExcel,$query['transgene_quant'], 'Transgene Summary');
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
}
function excel_output($query,$url){
			$i = "0";
			set_include_path(getcwd() . '/assets/functions');
			include 'PHPExcel/PHPExcel.php'; 
			include 'PHPExcel/Writer/Excel2007.php';
			 
			srand ((double) microtime( )*1000000);
			$random = rand( );
			$filetype = "xls";
			$path = getcwd();
			$tempname = $path . "/tmp/" . $random . "." . $filetype;			
			$objPHPExcel = new PHPExcel();			 
			$objPHPExcel->setActiveSheetIndex(0);			 
			$i="2";
		 	$numfields = $query->num_fields(); 
			foreach ($query->result_array() as $row){
				 $letter_index = 0;
				 //switch the letter value after z to zz
				 $letter_switch = -1;
				 $titles = "";
				 foreach ($row as $key => $value){
					 $titles[] = $key;
					 $letter = "A";
					 if ($letter_switch != -1){
						 $letter_value = chr(ord($letter)+ $letter_index);
						 $letter_value =  "A" . $letter_value;
					 }else{
						$letter_value = chr(ord($letter)+ $letter_index); 
					 }
					   if ($key == "birthday"){ 
						$objPHPExcel->getActiveSheet()->SetCellValue($letter_value . $i,date('m/d/Y',$value)); 
					  }else{
					 	$objPHPExcel->getActiveSheet()->SetCellValue($letter_value . $i,$value);	
					  }
					if ($letter_value == "Z"){
						$letter_switch = 1;
						$letter_index = -1;
					}				 
					$letter_index++;
				}	
				 $i++; 			
			}  
			$letter_index = 0;	
			$letter_switch = 0;
			foreach ($titles as $value){
				 $letter = "A";				 
				 if ($value == "batch_ID"){
					 $value = "Batch Number";
				 }
				 if ($letter_switch == 1){
					 $letter_value = chr(ord($letter)+ $letter_index);
					 $letter_value =  "A" . $letter_value;
				 }else{
					$letter_value = chr(ord($letter)+ $letter_index); 
				 }
				 $objPHPExcel->getActiveSheet()->SetCellValue($letter_value . '1',$value);				 
				 $objPHPExcel->getActiveSheet()->getStyle($letter_value . '1')->getFont()->setBold(true);				  
				if ($letter_value == "Z"){
				 	$letter_switch = 1;
					$letter_index = -1;
				}				
				$letter_index++;
			}
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($tempname);			 
 
			header('Location: ' . $url . 'tmp/' . $random . "." . $filetype);
}
function all_lines_prev($url){ 
			   $tableID = "fish_table";
			   $html .= table_format($tableID,'1','All Zebrafish');		 			 	 
			   $html .=  '<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
									<thead>';	
			   $html .= '<tr ><th style=" width:5%">Batch&nbsp;#</th>
			   <th>Name</th>
			   <th  >Birthday</th>
			  <th  >User</th><th>Strain</th>
			  <th  >Mutant Name</th><th  >Transgene Name</th> 
			  <th  >Generation</th>
			  <th  >Cur Adults</th> 
			  <th  >Start Nursery</th>';			  		 
			   $html .= '</tr></thead><tbody>'; 
			   foreach ($_SESSION['preview_show_all_fish'] as $row){ 
				   $html .= '<tr>';
				   $html .= '<td>' .$row['batch_ID']. '</td>';
				   $html .= '<td>' .$row['name'] . '</td>';
				   if ($row['birthday']){ 
						$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
				   }else{
					   $html .= '<td></td>';
				   }
				   $html .= '<td>' . $row['username'] . '</td>';
				   $html .= '<td>' . $row['strain_name'] . '</td>';
				   $html .= '<td>' . $row['mutant'] . '</td>';
				   $html .= '<td>' . $row['transgene'] . '</td>'; 
				   $html .= '<td>' . $row['generation']. '</td>';
				   $html .= '<td>'  .$row['current_adults'] . '</td>';	 
				   $html .= '<td>' . $row['starting_nursery'] . '</td></tr>';	
			   } 				 
				$html .= '</tbody> </table>';
				echo $html; 
}
function all_lab_prev($url){ 
			   $tableID = "fish_table";
			   $html .= table_format($tableID,'1','My Lab Fish');	 
			   $html .=  '<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
									<thead>';	
			   $html .= '<tr ><th>Batch&nbsp;#</th>
			  <th>Gender</th><th>Name</th>
			  <th>Status</th><th  >Birthday</th>
			  <th  >User</th><th>Strain</th>
			  <th  >Mutant Name</th><th  >Transgene Name</th>
			   <th  >Generation</th>
			  <th  >Current&nbsp;Adults</th><th  >Starting Adults</th>
			  <th  >Cur Nursery</th>';			  		 
			   $html .= '</tr></thead><tbody>';					    
			   foreach ($_SESSION['preview_show_lab_fish'] as $row){ 
				   $html .= '<tr>';
				   $html .= '<td>' .$row['batch_ID']. '</td>';
				   $html .= '<td>' . $row['gender'] . '</td>';
				   $html .= '<td>' .$row['name'] . '</td>';
				   $html .= '<td>' .$row['status'] . '</td>';
				   if ($row['birthday']){ 
						$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
				   }else{
					   $html .= '<td></td>';
				   }
				   $html .= '<td>' . $row['username'] . '</td>';
				   $html .= '<td>' . $row['strain_name'] . '</td>';
				   $html .= '<td>' . $row['mutant'] . '</td>';
				   $html .= '<td>' . $row['transgene'] . '</td>'; 
				   $html .= '<td>' . $row['generation']. '</td>';
				   $html .= '<td>'  .$row['current_adults'] . '</td>';	
				   $html .= '<td>' . $row['starting_nursery']. '</td>';	
				   $html .= '<td>' . $row['starting_adults'] . '</td></tr>';	
			   } 				 
				$html .= '</tbody> </table>';
				echo $html; 
}
function quantity_summary_prev($url,$query){ 
			   $tableID = "user_sum";
			   $html .= table_format($tableID,'1',''); 			 			 	 
			   $html .=  '<div style="height:150px;"><h2>Batch Summary</h2>
			   <table style="font-size:.8em;" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';  
			   $html .= '<tr ><th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
				   <th >Total Batches</th>';			  		 
			   $html .= '</tr></thead><tbody>';					    
			  foreach ($query['user_quant'] as $key => $row){
				   $html .= '<tr>';
				   $html .= '<td>' .$row->starting_adults. '</td>';
				   $html .= '<td>' .$row->current_adults . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' .$row->total_batches . '</td> </tr>'; 
			   } 				 
			   $html .= '</tbody> </table></div>';
			   echo $html; 	 
			   $tableID = "mutant_quant";
			   $html = table_format($tableID,'1',''); 			 			 	 
			   $html .=  '<div style="height:250px;"><h2>Mutant Summary</h2>
			   <table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';   
			   $html .= '<tr ><th >Mutant</th>
			   <th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
			   <th >Total Batches</th>';			  		 
			   $html .= '</tr></thead><tbody>';			   
			   foreach ($query['mutant_quant'] as $key => $row){
			       $html .= '<tr>';
				   $html .= '<td>' .$row->mutant. '</td>';
				   $html .= '<td>' .$row->starting_adults. '</td>';
				   $html .= '<td>' .$row->current_adults . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' .$row->total_batches . '</td> </tr>'; 
			   } 				 
				$html .= '</tbody> </table></div>';
			   echo $html; 
			   $tableID = "strain_quant";
			   $html = table_format($tableID,'1',''); 			 			 	 
			   $html .=  '<div style="height:250px;"><h2>Strain Summary</h2>
			   <table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';  
			   $html .= '<tr ><th >Strain</th>
			   <th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
			   <th >Total Batches</th>';			  		 
			   $html .= '</tr></thead><tbody>';					    
			   foreach ($query['strain_quant'] as $key => $row){
				   $html .= '<tr>';
				   $html .= '<td>' .$row->strain. '</td>';
				   $html .= '<td>' .$row->starting_adults. '</td>';
				   $html .= '<td>' .$row->current_adults . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' .$row->total_batches . '</td> </tr>'; 
			   } 				 
			   $html .= '</tbody> </table></div>';
			   echo $html; 
			   $tableID = "transgene_quant";
			   $html = table_format($tableID,'1',''); 			 			 	 
			   $html .=  '<div style="height:150px;"><h2>Transgene Summary</h2>
			   <table style="font-size:.8em; " class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';  
			   $html .= '<tr ><th >Promoter</th>
			   <th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
				   <th >Total Batches</th>';			  		 
			   $html .= '</tr></thead><tbody>';					    
			   foreach ($query['transgene_quant'] as $key => $row){
				   $html .= '<tr>';
				   $html .= '<td>' .$row->promoter. '</td>';
				   $html .= '<td>' .$row->starting_adults. '</td>';
				   $html .= '<td>' .$row->current_adults . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' .$row->total_batches . '</td> </tr>'; 
			   } 				 
				$html .= '</tbody> </table></div>';
				echo $html; 
}
function batch_summary_prev($url){  
			$tableID = "fish_table";
			$html .= table_format($tableID,'1','Batch Summary'); 
			$html .=  '	<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>'; 
			$html .= '<tr ><th style=" width:5%">Batch&nbsp;#</th>
			  <th>Gender</th><th>Name</th>
			  <th>Status</th><th  >Birthday</th><th  >Date of Death</th>
			  <th  >User</th><th>Strain</th>
			  <th  >Mutant Name</th><th  >Transgene Name</th>
			  <th  >Generation</th>			  
			  <th  >Cur Adults</th> 
			  <th  >Start Nursery</th>';			  		 
			   $html .= '</tr></thead><tbody>';					    
			   foreach ( $_SESSION['report_data'] as $row){ 
				   $html .= '<tr>';
				   $html .= '<td>' .$row['batch_ID']. '</td>';
				   $html .= '<td>' . $row['gender'] . '</td>';
				   $html .= '<td>' .$row['username'] . '</td>';
				   $html .= '<td>' .$row['status'] . '</td>';
				   if ($row['birthday']){ 
						$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
				   }else{
					   $html .= '<td></td>';
				   }
				   if ($row['death_date']){
				  	 $html .= '<td>' . date('m/d/Y',$row['death_date']) . '</td>';
				   }else{
					   $html .= '<td></td>'; 
				   }
				   $html .= '<td>' . $row['username'] . '</td>';
				   $html .= '<td>' . $row['strain'] . '</td>';
				   $html .= '<td>' . $row['mutant'] . '</td>';
				   $html .= '<td>' . $row['transgene'] . '</td>'; 
				   $html .= '<td>' . $row['generation']. '</td>';
				   $html .= '<td>'  .$row['current_adults'] . '</td>';	 	
				   $html .= '<td>' . $row['starting_nursery'] . '</td></tr>';	
			   } 				 
				$html .= '</tbody> </table>';
				echo $html; 
}
function search_prev($url){  
			$tableID = "fish_table";
			$html .= table_format($tableID,'1','Search Results'); 
			$html .=  '	<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>'; 
			$html .= '<tr ><th style=" width:5%">Batch&nbsp;#</th>
			  <th>Gender</th><th>Name</th>
			  <th>Status</th><th  >Birthday</th><th  >Date of Death</th>
			  <th  >User</th><th>Strain</th>
			  <th  >Mutant Name</th><th  >Mutant Allele</th>
			  <th  >Transgene Allele</th>
			  <th  >Generation</th>
			  <th  >Cur Adults</th>
			  <th  >Start Adults</th> 
			  <th  >Cur Nursery</th>
			  <th  >Start Nursery</th>';			  		 
			   $html .= '</tr></thead><tbody>';					    
			   foreach ( $_SESSION['report_data'] as $row){ 
				   $html .= '<tr>';
				   $html .= '<td>' .$row['batch_ID']. '</td>';
				   $html .= '<td>' . $row['gender'] . '</td>';
				   $html .= '<td>' .$row['username'] . '</td>';
				   $html .= '<td>' .$row['status'] . '</td>';
				  if ($row['birthday']){ 
						$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
				   }else{
					   $html .= '<td></td>';
				   }
				   if ($row['death_date']){
				  	 $html .= '<td>' . date('m/d/Y',$row['death_date']) . '</td>';
				   }else{
					    $html .= '<td></td>';
				   }
				   $html .= '<td>' . $row['username'] . '</td>';
				   $html .= '<td>' . $row['strain'] . '</td>';
				   $html .= '<td>' . $row['mutant'] . '</td>';
				   $html .= '<td>' . $row['mutant_allele'] . '</td>';
				   $html .= '<td>' . $row['transgene_allele'] . '</td>';
				   $html .= '<td>' . $row['generation']. '</td>';
				   $html .= '<td>'  .$row['current_adults'] . '</td>';	
				   $html .= '<td>'  .$row['starting_adults'] . '</td>'; 
				   $html .= '<td>'  .$row['current_nursery'] . '</td>';	
				   $html .= '<td>' . $row['starting_nursery'] . '</td></tr>';	
			   } 				 
				$html .= '</tbody> </table>';
				echo $html; 
}
function survivalstat_prev($url,$query){  
			   $tableID = "survivalstat_prev";
			  $html .= table_format($tableID,'1','Track Survival Percentage'); 
			  $html .=  '	<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';  
			   $html .= '<tr ><th style=" width:2%">Batch&nbsp;#</th>
			   <th>Start Nursery</th>
				  <th>Cur Adults</th><th>Start Adults</th>
				  <th>Lab</th>	<th>Status</th>					  
				  <th>Survival Rate</th><th  >Birthday</th>
				  <th>Date of Death</th>	<th  >Report Date</th> ';			  		 
			   $html .= '</tr></thead><tbody>';	 
			  foreach ($query as $key => $row){ 
				   $html .= '<tr>';
				   $html .= '<td>' .$row['batch_ID']. '</td>';
				   $html .= '<td>' .$row['starting_nursery'] . '</td>';
				   $html .= '<td>' . $row['current_adults'] . '</td>';
				   $html .= '<td>' .$row['starting_adults'] . '</td>';	
				   $html .= '<td>' .$row['lab'] . '</td>';
				   $html .= '<td>' .$row['status'] . '</td>';				  
				   if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
					   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
							$html .= '<td>0%</td>'; 
					   }else{											  
							$html .= '<td>' . round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%</td>';
					   }
				   }else{
					  $html .= '<td>' . round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%</td>'; 
				   }   
				   if ($row['birthday']){ 
						$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
				   }else{
					   $html .= '<td></td>';
				   }
				   if ($row['death_date']){
				  	 $html .= '<td>' . date('m/d/Y',$row['death_date']) . '</td>';
				   }else{
					   $html .= '<td></td>';
				   }
				   $html .= '<td>' . date('m/d/Y',$row['date_taken']) . '</td>';
				   $html .= '</tr>'; 
			   } 				 
				$html .= '</tbody> </table>';
			   echo $html; 				 			     
}
function survivalcurrent_prev($url,$query){  
			   $tableID = "survivalcurrent_prev";
			   $html .= table_format($tableID,'1','Current Survival'); 
			   $html .=  '	<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';  
			   $html .= '<tr ><th style=" width:2%">Batch&nbsp;#</th>
				   <th>User</th> 
				   <th>Lab</th>
				  <th>Cur Adults</th><th>Start Adults</th>
				  <th>Start Nursery</th>
				  <th>Cur Nursery</th>
				   <th  >Birthday</th>
				  <th>Survival Rate</th>  ';			  		 
			   $html .= '</tr></thead><tbody>';					    
			  foreach ($query as $key => $row){ 
				   $html .= '<tr>';
				    $html .= '<td>' .$row['batch_ID']. '</td>';
					   $html .= '<td>' . $row['username'] . '</td>'; 
					   $html .= '<td>' . $row['lab'] . '</td>';						  
					   $html .= '<td>' . $row['current_adults'] . '</td>';
					   $html .= '<td>' .$row['starting_adults'] . '</td>'; 
					   $html .= '<td>' .$row['starting_nursery'] . '</td>'; 
					   $html .= '<td>' .$row['starting_nursery'] . '</td>'; 
					   if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }  
					   if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
						   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
								$html .= '<td>0%</td>'; 
						   }else{											  
								$html .= '<td>' . round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%</td>';
						   }
					   }else{
						  $html .= '<td>' . round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%</td>'; 
					   }   
					   $html .= '</tr>'; 
			   } 				 
				$html .= '</tbody> </table>';
			   echo $html; 				 			     
}
function show_all_fish($url,$allfish,$admin_access){ 
				$_SESSION['preview_show_all_fish']="";
				$tableID = "all_fish_table";
				 $html .= table_format($tableID,'0',''); 
			 	echo '<table><tr><td> 
			   <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_fish_48.png" name="doit" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:700,width:700, content:\'' . $url . 'index.php/fish/modify_line/n_/showall\'}); return false" />
		 	  <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/all\'"/>
			  <a href="' . $url . 'index.php/fish/print_prev_all" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
		  	  </td></tr></table>'; 
				   $html .= ' <h2>All Zebrafish</h2> '; 
				   $html .=  '<table style="font-size:.7em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
									<thead>';
				   $html .= '<tr ><th ></th><th style=" width:5%">Batch&nbsp;#</th>
				  <th>Name</th>
				   <th  >Birthday</th>
				  <th  >User</th> <th  >Lab</th>
				  <th>Strain</th><th  >Mutant Name</th><th  >Mutant Allele</th>
				  <th  >Transgene Name</th><th  >Transgene Allele</th>
				  <th  >Generation</th>
				  <th  >Cur Adults</th>
				  <th  >Start Nursery</th> ';			  		 
				   $html .= '</tr></thead><tbody>';					    
                   foreach ($allfish->result_array() as $row):
				  	   $_SESSION['preview_show_all_fish'][] = $row;	
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px">';
					   if ($admin_access == "on"){
					   		$html .= '<input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '/showall\'}); return false" />';  
					   }
					   $html .= '<input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:990, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'/showall\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['batch_ID']. '</td>';
					   $html .= '<td>' .$row['name'] . '</td>';
					   if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }
					   $html .= '<td>' . $row['username'] . '</td>';
					   $html .= '<td>' . $row['lab'] . '</td>';
					   $html .= '<td>' . $row['strain_name'] . '</td>';
					   $html .= '<td>' . $row['mutant'] . '</td>';
					   $html .= '<td>' . $row['mutant_allele'] . '</td>';
					   $html .= '<td>' . $row['transgene'] . '</td>';
					   $html .= '<td>' . $row['transgene_allele'] . '</td>'; 
					   $html .= '<td>' . $row['generation']. '</td>';
					   $html .= '<td>'  .$row['current_adults'] . '</td>';	
					   $html .= '<td>' . $row['starting_nursery']. '</td></tr>'; 
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table>';
					echo $html; 
}

function show_lab_fish($url,$allfish,$loggedin_user,$admin_access){
	  			$_SESSION['preview_show_lab_fish']="";
				$tableID = "lab_fish_table";
				$html .= table_format($tableID,'0','');  
			 	echo '<table><tr><td> 
			   <input alt="add fish" title="add fish" type="image"  src="' . $url . 'assets/Pics/Symbol-Add_fish_48.png" name="doit"  value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:700,width:800, content:\'' . $url . 'index.php/fish/modify_line/n_\'}); return false" />
		 	  <input alt="all fish" title="all fish" type="image"  src="' . $url . 'assets/Pics/Fish-bowl-64.png" name="doit" style="padding-bottom:8px;" onClick="Shadowbox.open({player:\'iframe\', title:\'All Fish\',height:800,width:1300, content:\'' . $url . 'index.php/fish/show_all\'}); return false"> 
		   	  </td><td >
			  <input alt="excel export" title="excel export" type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/lab\'"/>
			  <a alt="print view" title="print view" href="' . $url . 'index.php/fish/print_prev_lab" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
			</td><td style=" padding-left:80px">
					<table><tr><td>Scan Mode
					<div id="ajax"></div>
					<div id="1"></div> </td><td>
					<div id="scan_mode"><form name="scanning_batch"><table><tr><td><img border=0 width="44" src="' . $url . 'assets/Pics/scanner_icon.png"> 
					</td><td></td></tr></table>
					</form></div></td></tr></table>
			  </td></tr></table>';
			  $html .=  '	<table class="display" cellpadding="0" cellspacing="0" border="0" style="font-size:.8em" class="display" id="' . $tableID . '">
									<thead>';
				   $number_count = $allfish->num_rows(); 
				   $html .= '<tr ><th ></th><th style=" width:5%">Batch&nbsp;#</th>
				<th>Name</th>
				  <th  >Birthday</th>
				  <th  >User</th><th>Strain</th>
				  <th  >Mutant Name</th> 
				  <th  >Transgene Name</th>	 				  
				  <th  >Generation</th>
				  <th  >Cur Adults</th>  
				  <th  >Start Nursery</th> ';			  		 
				   $html .= '</tr></thead><tbody>';					    
                   foreach ($allfish->result_array() as $row): 
				  	   $_SESSION['preview_show_lab_fish'][] = $row;	
				   	   $html .= '<tr class="gradeC">';
					   $html .= '<td><div style=" width:33px">';
					   if ($admin_access == "on"){
					   		$html .= '<input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '\'}); return false" />';  
					   }
					   $html .= '<input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:950, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['batch_ID']. '</td>';
				 	   $html .= '<td>' .$row['name'] . '</td>'; 
					  if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }
					   $html .= '<td>' . $row['username'] . '</td>';
					   $html .= '<td>' . $row['strain_name'] . '</td>';
					   $html .= '<td>' . $row['mutant'] . '</td>'; 
					   $html .= '<td>' . $row['transgene'] . '</td>';				
					   $html .= '<td>' . $row['generation']. '</td>';
					   $html .= '<td>'  .$row['current_adults'] . '</td>';
					   $html .= '<td>' . $row['starting_nursery']. '</td></tr>';  
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table>  ';
					echo $html;  
} 
function output_fields_new($refresh, $batch_ID,$data){
	$html .=  '
	<div style=" background-color:#F5EEDE; padding-top:20px; padding-left:20px;">';
	$attributes = array('id' => 'fish_form_ID','name' => 'fish_form');
	echo form_open('fish/db_update/i', $attributes); ?>   
	<?php 	  
	$html .= '<a href="#" onclick="fish_form.submit();" class="jq_buttons" style=" font-size:12px;">Insert</a>';	 
	$html .=  '<table cellpadding="9" style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;"><tr><td>';
	$html .=  'Name: <br><input name="name" value="' . $refresh['name'] . '">';
	$html .= '</td></tr><tr><td>'; 
 	$html .= 'Status:<br><select name="status">';
	$status_array = "";
	$status_array[0] = "Alive";
	$status_array[1] = "Dead";
	$status_array[2] = "Sick";	 
	foreach($status_array as $value){
		if ($value == $refresh['status']){
			$html .= '<option selected>' . $value . '</option>';
		}else{
			$html .= '<option>' . $value . '</option>';
		}
	}
	$html .= '</select>';
	$html .= '</td><td>';
	$html .= 'Gender:<br><select name="gender"><option></option>';
	$gender_array = "";
	$gender_array[0] = "M";
	$gender_array[1] = "F";	
	$gender_array[2] = "Mixed"; 	 
	foreach($gender_array as $value){
		if ($value == $refresh['gender']){
			$html .= '<option selected>' . $value . '</option>';
		}else{
			$html .= '<option>' . $value . '</option>';
		}
	}
	$html .= '</select>';
	$html .= '</td><td>';
	$html .=  'Strain: <br><select name="strain_ID"><option></option>';
 	foreach ($data['all_strains']->result() as $row){
		if ($row->strain_ID == $refresh['strain_ID']){
			$index="1";
			$html .=  '<option value="' . $row->strain_ID  . '" selected>' . $row->strain  . '</option>';
		}else{
			$html .=  '<option value="' . $row->strain_ID  . '">' . $row->strain . '</option>';
		}	
	 }  
	$html .=  '</select>'; 	
	$html .= '</td></tr><tr><td>';
	$html .=  'Mother: <br><select name="mother_ID"><option></option>';
 	foreach ($data['all_fish']->result() as $row){
		if ($row->batch_ID == $refresh['mother_ID']){
			$index="1";
			$html .=  '<option value="' . $row->batch_ID  . '" selected>' . $row->batch_ID .  ', ' . $row->name  . '</option>';
		}else{
			$html .=  '<option value="' . $row->batch_ID  . '">' . $row->batch_ID .  ', ' . $row->name . '</option>';
		}	
	 }  
	$html .=  '</select>'; 
	$html .= '</td></tr><tr><td>';	 
	$html .=  'Father: <br><select name="father_ID"><option></option>';
 	foreach ($data['all_fish']->result() as $row){
		if ($row->batch_ID == $refresh['father_ID']){
			$index="1";
			$html .=  '<option value="' . $row->batch_ID  . '" selected>' . $row->batch_ID .  ', ' . $row->name  . '</option>';
		}else{
			$html .=  '<option value="' . $row->batch_ID  . '">' . $row->batch_ID .  ', ' . $row->name . '</option>';
		}	
	 }  
	$html .=  '</select>';
	$html .= '</td></tr><tr><td>';
	$gen_array = "";
	$gen_array[0] = "outcross/F0";
	$gen_array[1] = "F1";
	$gen_array[2] = "F2";
	$gen_array[3] = "F3";
	$gen_array[4] = "F4";
	$gen_array[5] = "F5";
	$html .= 'Generation: <br><select name="generation"><option></option>';
	foreach($gen_array as $value){
		if ($value == $refresh['generation']){
			$html .= '<option selected>' . $value . '</option>';
		}else{
			$html .= '<option>' . $value . '</option>';
		}
	}
	$html .= '</select>';
	$html .= '</td><td>';
	$html .= 'Birthday: <br>';
	$birthday =  $refresh['birthday'];
	$html .= output_cal_func('birthday', $birthday,'birthday');		 
	$html .= '</td><td>';
	$html .= 'Date of Death: <br><div  style=" position:static;">';
	$death_date =  $refresh['death_date'];
	$html .= output_cal_func('death_date', $death_date,'death_date');	
	$html .= '</div>';		
	$html .= '</td><td>';
	$html .=  'User: <br><select name="user_ID"><option></option>';
 	foreach ($data['all_users']->result() as $row){
		if ($row->user_ID == $data['loggedin_user_ID']){
			$index="1";
			$html .=  '<option value="' . $row->user_ID  . '" selected>'   . $row->username  . '</option>';
		}else{
			$html .=  '<option value="' . $row->user_ID  . '">' . $row->username . '</option>';
		}	
	 }  
	$html .=  '</select>';
	$html .= '</td></tr><tr><td>';
	$html .=  '<div id="plain_box">
	  Mutant&nbsp;';	
	$html .= ' <select name="mutant_ID"><option></option>';
	 $index= "";
	foreach ($data['all_mutants']->result() as $row){
		if ($row->mutant_ID == $refresh['mutant_ID']){
			$index="1";
			$mutant_ID = $row->mutant_ID;
			$html .= '<option value="' . $row->mutant_ID . '" selected>' . $row->mutant . '</option>';
		}else{
			$html .= '<option value="' . $row->mutant_ID . '">' .  $row->mutant . '</option>';
		}		
	  }	 
	$html .= '</select> <br>';	
	 if ($refresh['mutant_genotype_wildtype']){
		$html .= ' +/+ <input type="checkbox" name="mutant_genotype_wildtype" value="1" CHECKED>';
	}else{
		$html .= ' +/+ <input type="checkbox" name="mutant_genotype_wildtype" value="1">';
	}
	if ($refresh['mutant_genotype_heterzygous']){
		$html .= ' +/- <input type="checkbox" name="mutant_genotype_heterzygous" value="1" CHECKED>';
	}else{
		$html .= ' +/- <input type="checkbox" name="mutant_genotype_heterzygous" value="1">';
	} 
	if ($refresh['mutant_genotype_homozygous']){
		$html .= ' -/- <input type="checkbox" name="mutant_genotype_homozygous" value="1" CHECKED>';
	}else{
		$html .= ' -/- <input type="checkbox" name="mutant_genotype_homozygous" value="1">';
	} 
	$html .= '</div><br><br>';  	
	$html .=  '<div id="plain_box">Transgene';	
	$html .= '<select name="transgene_ID"><option></option>';
	 $index= "";
	 foreach ($data['all_transgenes']->result() as $row){
		if ($row->transgene_ID == $refresh['transgene_ID']){
			$index="1";
			$mutant_ID = $object['transgene_ID'];
			$html .= '<option value="' . $row->transgene_ID . '" selected>' . $row->promoter . '</option>';
		}else{
			$html .= '<option value="' . $row->transgene_ID . '">' . $row->promoter . '</option>';
		}		
	  }
 	$html .= '</select><br>';
	if ($refresh['transgene_genotype_wildtype']){
		$html .= ' +/+ <input type="checkbox" name="transgene_genotype_wildtype" value="1" CHECKED>';
	}else{
		$html .= ' +/+ <input type="checkbox" name="transgene_genotype_wildtype" value="1">';
	}
	if ($refresh['transgene_genotype_heterzygous']){
		$html .= ' +/- <input type="checkbox" name="transgene_genotype_heterzygous" value="1" CHECKED>';
	}else{
		$html .= ' +/- <input type="checkbox" name="transgene_genotype_heterzygous" value="1">';
	} 
	if ($refresh['transgene_genotype_homozygous']){
		$html .= ' -/- <input type="checkbox" name="transgene_genotype_homozygous" value="1" CHECKED>';
	}else{
		$html .= ' -/- <input type="checkbox" name="transgene_genotype_homozygous" value="1">';
	}	
	$html .= '</div><br>';
	$html .= '</td> <td colspan=2 >';
		$html .= '<table><tr><td></td><td>Qty</td></tr>
		<tr><td>
		Current Adults: </td><td><input size="5" type="text" name="current_adults" id="current_adults" value="' . $refresh['current_adults'] . '">';
		$html .= '</td></tr><tr><td>';
		$html .= 'Starting Adults: </td><td><input size="5" type="text" name="starting_adults" id="starting_adults" value="' . $refresh['starting_adults'] . '">';
		$html .= '</td></tr><tr><td>';
		$html .= 'Current Nursery: </td><td><input size="5" type="text" id="current_nursery" name="current_nursery" value="' . $refresh['current_nursery'] . '">';	
 		$html .= '</td></tr><tr><td>';
		$html .= 'Starting Nursery: </td><td><input size="5" type="text" id="starting_nursery" name="starting_nursery" value="' . $refresh['starting_nursery'] . '">';	
		$html .= '</td></tr></table>'; 		
	$html .= '</td></tr><tr><td colspan=4>';
	$html .= 'Comment:<br><textarea name="comments" cols="60" rows="5">' . $refresh['comments'] . '</textarea>';
	$html .= '</td></tr></table>';
	$html .= '</form></td></tr></table>';
	$html .= '</div> ';
	echo $html;
} 
function output_fields($refresh, $batch_ID,$data,$url){
	//barcode scanning variable
	$html .=  '<div style="position:absolute;"><input type="hidden" name="batch_number" id="batch_num" ></div>';
	if ($data['batch_found'] != 1){
		echo '<h2>No Batch was found for number ' . $batch_ID . '</h2><a href="#"  id="nobatchfound"></a>
		<script language="javascript"> 
			setTimeout("document.getElementById(\'nobatchfound\').focus()",0); 
		</script>'; 
	}else{ 
		$html .=  '<a href="#" id="setfocus_var"></a>
		<div style="padding-left:0px; margin-left:0px;"> <table  ><tr><td>'; 
		$attributes = array('id' => 'fish_form_ID','name' => 'fish_form','style' => 'display:inherit;padding-left:0px; margin-left:0px;');
		echo form_open('fish/db_update/u', $attributes); ?>                            
		<?=form_hidden('batch_ID',$batch_ID); ?>	
		<?php  
		$html .= '<input type="hidden" name="batch_ID" value="' . $refresh['batch_ID'] . '">';
		$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;"><tr>
		<td><a href="#" onclick="fish_form.submit();" class="jq_buttons" style=" font-size:12px;">Update</a>
		<a onClick="Shadowbox.open({player:\'iframe\', title:\'Label\',height:400,width:400, content:\'' . $url . 'index.php/fish/print_prev_label/' . $batch_ID . '\'}); return false"
		 href="#" target="_blank">Print Label</a></td>
		<td>';
		$html .= '<h2>Batch Number: ' . $refresh['batch_ID'] . '</h2><h2>Name: ' . $refresh['name'] . '</h2>'; 
		$html .= '</td></tr><tr><td colspan=8>
		 <table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;"><tr><td>';
						$html .=  'Name: <br><input name="name" value="' . $refresh['name'] . '">';
						$html .= '</td><td>'; 
						$html .= 'Status:<br><select name="status">';
						$status_array = "";
						$status_array[0] = "Alive";
						$status_array[1] = "Dead";
						$status_array[2] = "Sick";	 
						foreach($status_array as $value){
							if ($value == $refresh['status']){
								$html .= '<option selected>' . $value . '</option>';
							}else{
								$html .= '<option>' . $value . '</option>';
							}
						}
						$html .= '</select>'; 
						$html .= '</td><td>';
						$html .= 'Gender:<br><select name="gender"><option></option>';
						$gender_array = "";
						$gender_array[0] = "M";
						$gender_array[1] = "F";	
						$gender_array[2] = "Mixed"; 	 
						foreach($gender_array as $value){
							if ($value == $refresh['gender']){
								$html .= '<option selected>' . $value . '</option>';
							}else{
								$html .= '<option>' . $value . '</option>';
							}
						}
						$html .= '</select>';
						$html .= '</td><td>';
						$html .=  'Strain: <br><select name="strain_ID"><option></option>';
						foreach ($data['all_strains']->result() as $row){
							if ($row->strain_ID == $refresh['strain_ID']){
								$index="1";
								$html .=  '<option value="' . $row->strain_ID  . '" selected>' . $row->strain  . '</option>';
							}else{
								$html .=  '<option value="' . $row->strain_ID  . '">' . $row->strain . '</option>';
							}	
						 }  
						$html .=  '</select>';
						$html .= '</td><td>';
						$html .=  'User: <br><select name="user_ID"><option></option>';
						foreach ($data['all_users']->result() as $row){
							if ($row->user_ID == $refresh['user_ID']){
								$index="1";
								$html .=  '<option value="' . $row->user_ID  . '" selected>'   . $row->username  . '</option>';
							}else{
								$html .=  '<option value="' . $row->user_ID  . '">' . $row->username . '</option>';
							}	
						 }  
						$html .=  '</select>'; 	
		$html .= '</tr></td></table>
		</td></tr><tr><td colspan=7>';
		$html .=  'Mother: <br><select name="mother_ID"><option></option>';
		foreach ($data['all_fish']->result() as $row){
			if ($row->batch_ID == $refresh['mother_ID']){
				$index="1";
				$html .=  '<option value="' . $row->batch_ID  . '" selected>' . $row->batch_ID .  ', ' . $row->name  . '</option>';
			}else{
				$html .=  '<option value="' . $row->batch_ID  . '">' . $row->batch_ID .  ', ' . $row->name . '</option>';
			}	
		 }  
		$html .=  '</select>'; 
		$html .= '</td></tr><tr><td colspan=7>';	 
		$html .=  'Father: <br><select name="father_ID"><option></option>';
		foreach ($data['all_fish']->result() as $row){
			if ($row->batch_ID == $refresh['father_ID']){
				$index="1";
				$html .=  '<option value="' . $row->batch_ID  . '" selected>' . $row->batch_ID .  ', ' . $row->name  . '</option>';
			}else{
				$html .=  '<option value="' . $row->batch_ID  . '">' . $row->batch_ID .  ', ' . $row->name . '</option>';
			}	
		 }  
		$html .=  '</select>';
		$html .= '</td></tr><tr><td colspan=3>';
		$gen_array = "";
		$gen_array[0] = "outcross/F0";
		$gen_array[1] = "F1";
		$gen_array[2] = "F2";
		$gen_array[3] = "F3";
		$gen_array[4] = "F4";
		$gen_array[5] = "F5";
		$html .= '<div style="float:left; padding-right:40px;">Generation: <br><div  style=" position:static;"><select name="generation"><option></option>';
		foreach($gen_array as $value){
			if ($value == $refresh['generation']){
				$html .= '<option selected>' . $value . '</option>';
			}else{
				$html .= '<option>' . $value . '</option>';
			}
		}
		$html .= '</select></div></div>'; 
		$html .= '<div style="float:left; padding-right:40px;">Birthday: <br><div  style=" position:static;">';
		$birthday =  $refresh['birthday'];
		$html .= output_cal_func('birthday', $birthday,'birthday');	
		$html .= '</div></div>'; 
		$html .= '<div>Date of Death: <br><div  style=" position:static;">';
		$death_date =  $refresh['death_date'];
		$html .= output_cal_func('death_date', $death_date,'death_date');	
		$html .= '</div></div>';	 
		$html .= '</td></tr><tr><td >';
		$html .=  '<div id="plain_box"><div id="' . $refresh['mutant_ID'] . '_mutant" style=" margin:0px; padding:0px">Mutant';	
		$html .= ' <select name="mutant_ID"><option></option>';
		 $index= "";
		foreach ($data['all_mutants']->result() as $row){
			if ($row->mutant_ID == $refresh['mutant_ID']){
				$index="1";
				$mutant_ID = $row->mutant_ID;
				$html .= '<option value="' . $row->mutant_ID . '" selected>' . $row->mutant . '</option>';
			}else{
				$html .= '<option value="' . $row->mutant_ID . '">' .  $row->mutant . '</option>';
			}		
		  }	 
		$html .= '</select>';
		if ($refresh['mutant_ID']){			
			$content = '<table><tr><td align=right>Mutant:</td><td>' . $data['selected_mutant']['mutant'] . '</td></tr><tr><td align=right>Allele:</td><td>' . $data['selected_mutant']['allele'] . '</td></tr><tr><td align=right>Strain:</td><td>' . $data['selected_mutant']['strain'] . '</td></tr></table>';
			$html .= create_qtip($refresh['mutant_ID'] . '_mutant',$content);
			$html .= '<a href="#"  style=" font-size:.8em"><img border=0 src="' . $url . 'assets/Pics/Magnifying-glass-32.png"></a>';
		} 
		$html .= '</div><br>';	 
		if ($refresh['mutant_genotype_wildtype']){
			$html .= ' +/+ <input type="checkbox" name="mutant_genotype_wildtype" value="1" CHECKED>';
		}else{
			$html .= ' +/+ <input type="checkbox" name="mutant_genotype_wildtype" value="1">';
		}
		if ($refresh['mutant_genotype_heterzygous']){
			$html .= ' +/- <input type="checkbox" name="mutant_genotype_heterzygous" value="1" CHECKED>';
		}else{
			$html .= ' +/- <input type="checkbox" name="mutant_genotype_heterzygous" value="1">';
		} 
		if ($refresh['mutant_genotype_homozygous']){
			$html .= ' -/- <input type="checkbox" name="mutant_genotype_homozygous" value="1" CHECKED>';
		}else{
			$html .= ' -/- <input type="checkbox" name="mutant_genotype_homozygous" value="1">';
		} 
		$html .=  '</div><br>
	<div id="plain_box"><div id="' . $refresh['transgene_ID'] . '_transgene" >Transgene';	
		$html .= '<select name="transgene_ID"><option></option>';
		 $index= "";
		 foreach ($data['all_transgenes']->result() as $row){
			if ($row->transgene_ID == $refresh['transgene_ID']){
				$index="1";
				$mutant_ID = $object['transgene_ID'];
				$html .= '<option value="' . $row->transgene_ID . '" selected>' . $row->promoter . '</option>';
			}else{
				$html .= '<option value="' . $row->transgene_ID . '">' . $row->promoter . '</option>';
			}		
		  }
		$html .= '</select>';
		if ($refresh['transgene_ID']){			
			$content = '<table><tr><td align=right>Trangene:</td><td>' . $data['selected_transgene']['promoter'] . '</td></tr><tr><td align=right>Allele:</td><td>' . $data['selected_transgene']['allele'] . '</td></tr><tr><td align=right>Strain:</td><td>' . $data['selected_transgene']['strain'] . '</td></tr></table>';
			$html .= create_qtip($refresh['transgene_ID']. '_transgene',$content);
			$html .= '<a href="#"  style=" font-size:.8em"><img border=0 src="' . $url . 'assets/Pics/Magnifying-glass-32.png"></a>';
		}
		$html .= '</div><br>';
		if ($refresh['transgene_genotype_wildtype']){
			$html .= ' +/+ <input type="checkbox" name="transgene_genotype_wildtype" value="1" CHECKED>';
		}else{
			$html .= ' +/+ <input type="checkbox" name="transgene_genotype_wildtype" value="1">';
		}
		if ($refresh['transgene_genotype_heterzygous']){
			$html .= ' +/- <input type="checkbox" name="transgene_genotype_heterzygous" value="1" CHECKED>';
		}else{
			$html .= ' +/- <input type="checkbox" name="transgene_genotype_heterzygous" value="1">';
		} 
		if ($refresh['transgene_genotype_homozygous']){
			$html .= ' -/- <input type="checkbox" name="transgene_genotype_homozygous" value="1" CHECKED>';
		}else{
			$html .= ' -/- <input type="checkbox" name="transgene_genotype_homozygous" value="1">';
		}	
		
		$html .= ' </div>'; 
		$html .= '</td> <td colspan=4 >';
			$html .= '<table><tr><td></td><td>Qty</td></tr>
			<tr><td>
			Current Adults: </td><td><input size="5" type="text" name="current_adults" id="current_adults" value="' . $refresh['current_adults'] . '">';
			$html .= '</td></tr><tr><td>';
			$html .= 'Starting Adults: </td><td><input size="5" type="text" name="starting_adults" id="starting_adults" value="' . $refresh['starting_adults'] . '">';
			$html .= '</td></tr><tr><td>';
			$html .= 'Current Nursery: </td><td><input size="5" type="text" id="current_nursery" name="current_nursery" value="' . $refresh['current_nursery'] . '">';	
			$html .= '</td></tr><tr><td>';
			$html .= 'Starting Nursery: </td><td><input size="5" type="text" id="starting_nursery" name="starting_nursery" value="' . $refresh['starting_nursery'] . '">';	
			$html .= '</td></tr></table>'; 		
		$html .= '</td></tr><tr><td colspan=8><br>';
		$html .= 'Comment:<br><textarea name="comments" cols="60" rows="5">' . $refresh['comments'] . '</textarea>';
		$html .= '</td></tr></table>';
		$html .= '</form></td><td valign="top">';
		$html .= '</td> <td valign="top">';
		$html .= '<div id="standard_box" style="width:385px; height:560px;">	
		 <div id="tanks_sliding" class="SlidingPanels" tabindex="0" style=" position:absolute; width:390px; height:560px;" >                     
							<div class="SlidingPanelsContentGroup"   >                       
								<div id="ex1_p0" class="SlidingPanelsContent p2">
								<div style=" padding-left:50px; padding-top:10px;">
								<h2>Tanks <a href="#" onclick="sp2.showPanel(\'ex1_p1\'); return false;"><img border=0 src="' . $url . 'assets/Pics/Symbol-Add_48.png"  /></a></h2></div>';
		$html .= output_current_tanks($url,$data['current_tanks'],$refresh);		
		$html .= '					</div> <!--ex1_p0-->  
								 <div id="ex1_p1" class="SlidingPanelsContent p2"> 
								<div style=" padding-left:50px; padding-top:10px;"><h2>Add Tanks</h2><a href="#"  onclick="sp2.showPanel(\'ex1_p0\'); return false;" class="jq_buttons" style=" font-size:12px;">back</a></div> ';
		$html .= output_all_tanks($url,$data['all_tanks'],$refresh);						 
		$html .= '</div> <!--ex1_p1-->  
				</div> <!--SlidingPanelsContentGroup-->                          
				</div> <!--summary_sliding--> 
				</div></td></tr></table></div>';  
		$html .= '  <script language="javascript"> ';
		$html .= '	var sp2 = new Spry.Widget.SlidingPanels(\'tanks_sliding\');';
		$html .= '
		function set_focus_shadowbox(){
			document.getElementById(\'setfocus_var\').focus();  
		}
		setTimeout("set_focus_shadowbox()",500);  
			</script> '; 
	}
	if ($_SESSION['scanning'] == "enabled"){
		$html .= '  <script language="javascript"> ';
		$html .= '
		    document.onkeyup = KeyCheck; 
			function KeyCheck(event){ 
			   var KeyID = event.keyCode; 
			    if (KeyID == 120){
					  var scan_box = document.getElementById("batch_num");
					  scan_box.type = "text"; 
					  scan_box.value = "";  	 
					  scan_box.focus(); 
				}else if (KeyID == 119){  
				    var scan_box = document.getElementById("batch_num"); 					 
					var url_link = "' . $_SESSION['base_url'] . 'index.php/fish/modify_line/u_" + scan_box.value; 
		 			scan_box.type = "hidden";
					document.location.href =  url_link; 
				}
			}';	
		$html .= '  
		 </script> ';					
	} 
	echo $html;
}
function output_user_fields($selected_user,$url,$labs){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'user_form_ID','name' => 'user_form');
	echo form_open('fish/db_update_user/u', $attributes); ?>                            
	<?=form_hidden('user_ID',$selected_user['user_ID']); ?>	
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.user_form.submit();">Update</a>'; 
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td colspan=2><h2>User ID: ' . $selected_user['user_ID'] . '</h2>
	</td></tr><tr><td>Admin:';
	if ($selected_user['admin_access'] == "on"){
		$html .= '<input type="checkbox" name="admin_access" checked>';
	}else{
		$html .= '<input type="checkbox" name="admin_access">';
	}
	$html .= '</td></tr>';
	$html .= '<tr><td>Username:</td><td><input type="text" name="username" value="' . $selected_user['username'] . '"></td></tr>';
 	$html .= '<tr><td>Database Reference Name:</td><td><input type="text" name="db_reference_name" value="' . $selected_user['db_reference_name'] . '"></td></tr>';
	$html .= '<tr><td>First Name:</td><td><input type="text" name="first_name" value="' . $selected_user['first_name'] . '"></td></tr>';
	$html .= '<tr><td>Middle Name:</td><td><input type="text" name="middle_name" value="' . $selected_user['middle_name'] . '"></td></tr>';
	$html .= '<tr><td>Last Name:</td><td><input type="text" name="last_name" value="' . $selected_user['last_name'] . '"></td></tr>';
	$html .= '<tr><td>Email:</td><td><input type="text" name="email" value="' . $selected_user['email'] . '"></td></tr>'; 
	$html .= '<tr><td>Lab:</td><td><select name="lab">';
 	foreach ($labs->result_array() as $row){
		if ($selected_user['lab'] == $row['lab']){
			$html .= '<option selected>' . $row['lab'] . '</option>';
		}else{
			$html .= '<option>' . $row['lab'] . '</option>';
		}
	}
	$html .= '</select></td></tr>';
	$html .= '<tr><td>Office:</td><td><input type="text" name="office_location" value="' . $selected_user['office_location'] . '"></td></tr>';
	$html .= '<tr><td>Lab Location:</td><td><input type="text" name="lab_location" value="' . $selected_user['lab_location'] . '"></td></tr>';
	$html .= '<tr><td>Lab Phone:</td><td><input type="text" name="lab_phone" value="' . $selected_user['lab_phone'] . '"></td></tr>';
	$html .= '<tr><td>Emergency Phone:</td><td><input type="text" name="emergency_phone" value="' . $selected_user['emergency_phone'] . '"></td></tr>';
 	$html .= '
	<tr><td colspan=2>Change Password: <input type="checkbox" name="passcheck" id="passcheck" onclick="alt_contact_toggle();">
			<div id="alt_contact2" align="left" style=" font-size:10px; visibility:hidden;position:absolute; "> 
			<table><tr><td style=" font-size:12px;">Password:</td><td><input type="text" name="user_pass" value=""></td></tr>';
	$html .= '<tr><td style=" font-size:12px;">Confirm Password:</td><td><input type="text" name="user_pass2" value=""></td></tr></table></div> 
	</td></tr>';
	$html .= '</table></form> '; 
	$html .= '</div></div>
	
	<script language="javascript">
		  function alt_contact_toggle(type_var){			 		
			   		if (document.getElementById("passcheck").checked == false){
						document.getElementById("alt_contact2").style.visibility = "hidden";
						document.getElementById("alt_contact2").style.position = "absolute";
						 
					}else  {
						document.getElementById("alt_contact2").style.visibility = "visible";
						document.getElementById("alt_contact2").style.position = "static";
						 
					}
			  }
	</script>'; 
	echo $html;
} 
function output_user_fields_new($url,$labs){ 
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'user_form_ID','name' => 'user_form');
	echo form_open('fish/db_update_user/i', $attributes); ?>                            
	<?=form_hidden('user_ID',$selected_user['user_ID']); ?>	
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="submit_doc()">Insert</a>';
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Username:</td><td><input type="text" name="username" value=""></td></tr>';
	$html .= '<tr><td>Password:</td><td><input type="text" name="user_pass" value=""></td></tr>';
	$html .= '<tr><td>Confirm Password:</td><td><input type="text" name="user_pass2" value=""></td></tr>';
	$html .= '<tr><td>Database Reference Name:</td><td><input type="text" name="db_reference_name" value=""></td></tr>';
	$html .= '<tr><td>First Name:</td><td><input type="text" name="first_name" value=""></td></tr>';
	$html .= '<tr><td>Middle Name:</td><td><input type="text" name="middle_name" value=""></td></tr>';
	$html .= '<tr><td>Last Name:</td><td><input type="text" name="last_name" value=""></td></tr>';
	$html .= '<tr><td>Email:</td><td><input type="text" name="email" value=""></td></tr>';
	$html .= '<tr><td>Lab:</td><td><select name="lab">';
 	foreach ($labs->result_array() as $row){
  		$html .= '<option>' . $row['lab'] . '</option>'; 
	}
	$html .= '</select></td></tr>';
	$html .= '<tr><td>Office:</td><td><input type="text" name="office_location" value=""></td></tr>';
	$html .= '<tr><td>Lab Location:</td><td><input type="text" name="lab_location" value=""></td></tr>';
	$html .= '<tr><td>Lab Phone:</td><td><input type="text" name="lab_phone" value=""></td></tr>';
	$html .= '<tr><td>Emergency Phone:</td><td><input type="text" name="emergency_phone" value=""></td></tr>'; 
	$html .= '<tr><td>Admin:</td><td>';
  	$html .= '<input type="checkbox" name="admin_access">';	 
	$html .= '</td></tr>';
	$html .= '</table></form> '; 
	$html .= '</div></div>
	<script language="javascript">
	function submit_doc(){
		if (document.user_form.user_pass.value != document.user_form.user_pass2.value){
			alert("Confirm password is incorrect!");
		}else{
			document.user_form.submit();
		}
	}
	</script>'; 
	echo $html;
} 
function output_mutant_fields($selected,$url){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'mutant_form_ID','name' => 'mutant_form');
	echo form_open('fish/db_update_mutant/u', $attributes); ?>                            
	<?=form_hidden('mutant_ID',$selected['mutant_ID']); ?>	
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.mutant_form.submit();">Update</a>';
	$html .= '<h2>Mutant ID: ' . $selected['mutant_ID'] . '</h2>';
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Mutant:</td><td><input type="text" name="mutant" value="' . $selected['mutant'] . '"></td></tr>';
	$html .= '<tr><td>Mutant Allele:</td><td><input type="text" name="allele" value="' . $selected['allele'] . '"></td></tr>'; 
	$html .= '<tr><td>Mutant Gene:</td><td><input type="text" name="gene" value="' . $selected['gene'] . '"></td></tr>';
	$html .= '<tr><td valign="top">Reference:</td><td><textarea cols="27" rows="4" name="reference" >' . $selected['reference'] . '</textarea></td></tr>';
	$html .= '<tr><td>Strain:</td><td><input type="text" name="strain" value="' . $selected['strain'] . '"></td></tr>';
	$html .= '<tr><td valign="top">Comment:</td><td><textarea  cols="27" rows="4" name="cross_ref" >' . $selected['cross_ref'] . '</textarea></td></tr>';
 	$html .= '</table></form> '; 
	$html .= '</div></div>'; 
	echo $html;
} 
function output_mutant_fields_new($url){ 
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'mutant_form_ID','name' => 'mutant_form');
	echo form_open('fish/db_update_mutant/i', $attributes); ?>                            
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.mutant_form.submit();">Insert</a>';
 	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Mutant:</td><td><input type="text" name="mutant" value=""></td></tr>';
 	$html .= '<tr><td>Allele:</td><td><input type="text" name="allele" value=""></td></tr>';
	$html .= '<tr><td>Mutant Gene:</td><td><input type="text" name="gene" value=""></td></tr>'; 
	$html .= '<tr><td valign="top">Reference:</td><td><textarea cols="27" rows="4" name="reference" ></textarea></td></tr>';
	$html .= '<tr><td>Strain:</td><td><input type="text" name="strain" value=""></td></tr>';
	$html .= '<tr><td valign="top">Comment:</td><td><textarea  cols="27" rows="4" name="cross_ref" ></textarea></td></tr>';
 	$html .= '</table></form> '; 
	$html .= '</div></div>'; 
	echo $html;
}
function output_strain_fields($selected,$url){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'strain_form_ID','name' => 'strain_form');
	echo form_open('fish/db_update_strain/u', $attributes); ?>                            
	<?=form_hidden('strain_ID',$selected['strain_ID']); ?>	
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.strain_form.submit();">Update</a>';
	$html .= '<h2>Strain ID: ' . $selected['strain_ID'] . '</h2>';
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Strain:</td><td><input type="text" name="strain" value="' . $selected['strain'] . '"></td></tr>';
	$html .= '<tr><td>Source:</td><td><input type="text" name="source" value="' . $selected['source'] . '"></td></tr>'; 
	$html .= '<tr><td>Source Contact Information:</td><td><input type="text" name="source_contact_info" value="' . $selected['source_contact_info'] . '"></td></tr>'; 	
 	$html .= '<tr><td valign="top">Comments:</td><td><textarea cols="27" rows="4" name="comments" >' . $selected['comments'] . '</textarea></td></tr>';
	$html .= '</table></form> '; 
	$html .= '</div></div>'; 
	echo $html;
} 
function output_strain_fields_new($url){ 
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'strain_form_ID','name' => 'strain_form');
	echo form_open('fish/db_update_strain/i', $attributes); ?>                            
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.strain_form.submit();">Insert</a>';
 	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Strain:</td><td><input type="text" name="strain" value=""></td></tr>';
	$html .= '<tr><td>Source:</td><td><input type="text" name="source" value=""></td></tr>'; 
	$html .= '<tr><td>Source Contact Information:</td><td><input type="text" name="source_contact_info" value=""></td></tr>'; 	
 	$html .= '<tr><td valign="top">Comments:</td><td><textarea cols="27" rows="4" name="comments" ></textarea></td></tr>';
	$html .= '</table></form> ';  
	$html .= '</div></div>'; 
	echo $html;
}
function output_transgene_fields($selected,$url){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'transgene_form_ID','name' => 'transgene_form');
	echo form_open('fish/db_update_transgene/u', $attributes); ?>                            
	<?=form_hidden('transgene_ID',$selected['transgene_ID']); ?>	
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.transgene_form.submit();">Update</a>';
	$html .= '<h2>Transgene ID: ' . $selected['transgene_ID'] . '</h2>';
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Transgene:</td><td><input type="text" name="transgene" value="' . $selected['transgene'] . '"></td></tr>';
	$html .= '<tr><td>Promoter:</td><td><input type="text" name="promoter" value="' . $selected['promoter'] . '"></td></tr>';
	$html .= '<tr><td>Gene:</td><td><input type="text" name="gene" value="' . $selected['gene'] . '"></td></tr>';
	$html .= '<tr><td>Strain:</td><td><input type="text" name="strain" value="' . $selected['strain'] . '"></td></tr>';
	$html .= '<tr><td>Allele:</td><td><input type="text" name="allele" value="' . $selected['allele'] . '"></td></tr>';
	$html .= '<tr><td valign="top">Reference:</td><td><textarea cols="27" rows="4" name="reference" >' . $selected['reference'] . '</textarea></td></tr>';
	$html .= '<tr><td valign="top">Comment:</td><td><textarea  cols="27" rows="4" name="comment" >' . $selected['comment'] . '</textarea></td></tr>';
 	$html .= '</table></form> '; 
	$html .= '</div></div>'; 
	echo $html;
} 
function output_transgene_fields_new($url){ 
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'transgene_form_ID','name' => 'transgene_form');
	echo form_open('fish/db_update_transgene/i', $attributes); ?>                            
	<?php 	  
	$html .= '<a href="#" class="jq_buttons" onclick="document.transgene_form.submit();">Insert</a>';
 	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';
	$html .= '<tr><td>Transgene:</td><td><input type="text" name="transgene" value=""></td></tr>';
	$html .= '<tr><td>Promoter:</td><td><input type="text" name="promoter" value=""></td></tr>';
	$html .= '<tr><td>Gene:</td><td><input type="text" name="gene" value=""></td></tr>';
	$html .= '<tr><td>Strain:</td><td><input type="text" name="strain" value=""></td></tr>';
	$html .= '<tr><td>Allele:</td><td><input type="text" name="allele" value=""></td></tr>';
	$html .= '<tr><td valign="top">Reference:</td><td><textarea cols="27" rows="4" name="reference" ></textarea></td></tr>';
	$html .= '<tr><td valign="top">Comment:</td><td><textarea  cols="27" rows="4" name="comment" ></textarea></td></tr>';
 	$html .= '</table></form> ';  
	$html .= '</div></div>'; 
	echo $html;
}
function output_lab_fields($selected,$url){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'lab_form_ID','name' => 'lab_form');
	echo form_open('fish/db_update_lab/u', $attributes); ?>                            
	<?=form_hidden('lab',$selected['lab']); ?>	
	<?php  
	$html .=  '<h2>Update Lab</h2>
	<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Lab:</td><td><input type="text" name="lab" value="' . $selected['lab'] . '"></td></tr>';
	$html .= '<tr><td colspan=2 align="right"><br><br><a href="#" class="jq_buttons" onclick="document.lab_form.submit();">Update</a></td></tr>';
	$html .= '</table></form> '; 
	$html .= '';
	$html .= '</div></div>'; 
	echo $html;
} 
function output_lab_fields_new($url){ 
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'lab_form_ID','name' => 'lab_form');
	echo form_open('fish/db_update_lab/i', $attributes); ?>                            
	<?php 	   
 	$html .=  '<h2>Insert Lab</h2>
	<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Lab:</td><td><input type="text" name="lab" value=""></td></tr>';
	$html .= '<tr><td colspan=2 align="right"><br><br><a href="#" class="jq_buttons" onclick="document.lab_form.submit();">Insert</a></td></tr>';
 	$html .= '</table></form> ';  
	$html .= '</div></div>'; 
	echo $html;
}
function output_tank_fields($selected,$url){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'tank_form_ID','name' => 'tank_form');
	echo form_open('fish/db_update_tank/u', $attributes); ?>                            
	<?=form_hidden('tank_ID',$selected['tank_ID']); ?>	
	<?php 
	$html .= '<a href="#" class="jq_buttons" onclick="document.tank_form.submit();">Update</a>
	<h2>Tank ID: ' . $selected['tank_ID'] . '</h2>'; 
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Size:</td><td><input type="text" name="size" value="' . $selected['size'] . '"></td></tr>'; 
	$html .= '<tr><td>Location:</td><td><input type="text" name="location" value="' . $selected['location'] . '"></td></tr>';
	$html .= '<tr><td>Room:</td><td><input type="text" name="room" value="' . $selected['room'] . '"></td></tr>';
	$html .= '<tr><td valign="top">Comments:</td><td><textarea type="text" cols="25" rows="6" name="comments">' . $selected['comments'] . '</textarea></td></tr>'; 
  	$html .= '</table></form> ';  
	$html .= '</div></div>'; 
	echo $html;
} 
function output_tank_fields_new($url){ 
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'tank_form_ID','name' => 'tank_form');
	echo form_open('fish/db_update_tank/i', $attributes); ?>                            
	<?php 	   
 	$html .=  '<a href="#" class="jq_buttons" onclick="document.tank_form.submit();">Insert</a>
	<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;">';	
	$html .= '<tr><td>Size:</td><td><input type="text" name="size" ></td></tr>'; 
	$html .= '<tr><td>Location:</td><td><input type="text" name="location"></td></tr>';
	$html .= '<tr><td>Room:</td><td><input type="text" name="room" value=""></td></tr>';
	$html .= '<tr><td valign="top">Comments:</td><td><textarea type="text" cols="25" rows="6" name="comments"></textarea></td></tr>'; 
 	$html .= '</table></form> ';  
	$html .= '</div></div>'; 
	echo $html;
}
function output_users($url,$users){
			 	$tableID = "all_users";
				$html .= table_format($tableID,'0', '');  
			 	$html .= '<h2>Users <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:550,width:500, content:\'' . $url . 'index.php/fish/modify_users/n\'}); return false" /></h2>';
				$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';  
				$html .= '<tr > <th ></th> 
				  <th  >User&nbsp;ID</th><th  >Full Name</th>				  
				  <th  >User</th><th  >Lab</th>
				 <th  >Office</th> <th  >Lab&nbsp;Phone</th>
				 <th  >Emergency&nbsp;Phone</th> <th  >Email</th>
				   <th  >Admin</th>';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($users->result_array() as $row):
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px"><input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_users/r_' . $row['user_ID'] . '\'}); return false" />  
                  	  	 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:550,width:500, content:\'' . $url . 'index.php/fish/modify_users/u_' . $row['user_ID'] .'\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['user_ID']. '</td>';
					   $html .= '<td>' . $row['last_name'] . ', ' . $row['first_name'] . '</td>'; 
					    $html .= '<td>' . $row['username'] . '</td>';
						$html .= '<td>' . $row['lab'] . '</td>';	
						$html .= '<td>' . $row['office_location'] . '</td>';	
						$html .= '<td>' . $row['lab_phone'] . '</td>'; 
						$html .= '<td>' . $row['emergency_phone'] . '</td>'; 
						$html .= '<td>' . $row['email'] . '</td>';  
						if ($row['admin_access'] == "on"){							
							$html .= '<td>Admin</td></tr>';
						}else{
							$html .= '<td></td></tr>';
						}  
                  	endforeach; 
		   	 		$html .= '</tbody> </table>';
 		echo $html;
}
function output_labs($url,$users){
			 	$tableID = "all_labs";
				$html .= table_format($tableID,'0', '');  
			 	$html .= ' <h2>Labs <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_lab/n\'}); return false" /></h2>';
		 	 	$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';   
				$html .= '<tr > <th ><div class="sort"></div></th> 
				  <th  ><div class="sort">Lab</div></th>';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($users->result_array() as $row):
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px"><input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_lab/r_' . $row['lab'] . '\'}); return false" />  
                  	  	 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_lab/u_' . $row['lab'] .'\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['lab']. '</td></tr>';  
                  	endforeach; 
		   	 		$html .= '</tbody> </table>';
 		echo $html;
}
function output_tanks($url,$tanks){
			 	$tableID = "all_tanks";
				$html .= table_format($tableID,'0', '');  
			 	$html .= '<h2>Tanks <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_tank/n\'}); return false" /></h2>';
		 	 	$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';    
				$html .= '<tr > <th ></th> 
				  <th  >Tank ID</th><th  >Size</th>
				  <th  >Location</th>
				  <th  >Room</th>
				  <th  >Comments</th>';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($tanks->result_array() as $row):
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px"><input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:550,width:550, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_tank/r_' . $row['tank_ID'] . '\'}); return false" />  
                  	  	 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_tank/u_' . $row['tank_ID'] .'\'}); return false" /> </div></td>';
						$html .= '<td>' .$row['tank_ID']. '</td>';
						$html .= '<td>' .$row['size']. '</td>'; 
						$html .= '<td>' .$row['location']. '</td>'; 
						$html .= '<td>' .$row['room']. '</td>'; 
					   $html .= '<td>' .$row['comments']. '</td></tr>';  
                  	endforeach; 
		   	 		$html .= '</tbody> </table>';
 		echo $html;
}
function output_mutants($url,$all_records){
			 	$tableID = "all_mutants";
				$number_count = $all_records->num_rows();
				$html .= table_format($tableID,'0', '');  
			 	$html .= '<h2>Mutants <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_mutant/n\'}); return false" /></h2>';
		 		 if ($number_count > 0){
						  $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';
						   $html .= '<tr > <th ></th> 
						  <th  >Mutant&nbsp;ID</th><th  >Mutant Name</th>
						  <th>Mutant Allele</th><th>Mutant Gene</th>   
						  <th  >Strain</th> ';			  		 
						   $html .= '</tr></thead><tbody>';	 
						   foreach ($all_records->result_array() as $row):
							   $html .= '<tr>';
							   $html .= '<td><div style=" width:40px"><input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_mutant/r_' . $row['mutant_ID'] . '\'}); return false" />  
								 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_mutant/u_' . $row['mutant_ID'] .'\'}); return false" /> </div></td>';
							   $html .= '<td>' .$row['mutant_ID']. '</td>';
							   $html .= '<td>' . $row['mutant'] . '</td>'; 
							   $html .= '<td>' . $row['allele'] . '</td>'; 
							   $html .= '<td>' . $row['gene'] . '</td>'; 
							   $html .= '<td>' . $row['strain'] . '</td></tr>';	  
							endforeach;
							$html .= '</tbody> </table>';
				}else{
					$html .= 'No mutants!';	
				} 
 		echo $html;
}
function output_strains($url,$all_records){
			 	$tableID = "all_strains";
				$number_count = $all_records->num_rows();
				$html .= table_format($tableID,'0', '');
			 	$html .= ' <h2>Strains <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_strain/n\'}); return false" /></h2>';
		  		if ($number_count > 0){
						   $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';
						   $html .= '<tr > <th ><div class="sort"></div></th> 
						  <th  ><div class="sort">Strain&nbsp;ID</div></th><th  ><div class="sort">Strain</div></th>
						  <th  ><div class="sort">Source</div></th>  ';			  		 
						   $html .= '</tr></thead><tbody>';	
						   if ($number_count > 0){
							   foreach ($all_records->result_array() as $row):
								   $html .= '<tr>';
								   $html .= '<td><div style=" width:40px"><input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_strain/r_' . $row['strain_ID'] . '\'}); return false" />  
									 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_strain/u_' . $row['strain_ID'] .'\'}); return false" /> </div></td>';
								   $html .= '<td>' .$row['strain_ID']. '</td>';
								   $html .= '<td>' . $row['strain'] . '</td>';
								   $html .= '<td>' . $row['source'] . '</td>'; 
								   $html .= '</tr>';	  
								endforeach; 
						   }
		   	 				$html .= '</tbody> </table>';
				}else{
					$html .= 'No strains!';	
				} 
 		echo $html;
}
function output_transgenes($url,$all_records){
			 	$tableID = "all_transgene";
				$number_count = $all_records->num_rows();
				$html .= table_format($tableID,'0', '');
			 	$html .= '<h2>Transgenes <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_transgene/n\'}); return false" /></h2>';
		 	 	if ($number_count > 0){
					$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';
					$html .= '<tr > <th ></th> 
					<th  >Transgene&nbsp;ID</th>
					<th  >Transgene Name</th><th  >Promoter</th>
					<th  >Transgene Gene</th><th  >Strain</th><th  >Transgene Allele</th>  ';			  		 
					$html .= '</tr></thead><tbody>';	 
					foreach ($all_records->result_array() as $row):
					   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px"><input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_transgene/r_' . $row['transgene_ID'] . '\'}); return false" />  
						 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_transgene/u_' . $row['transgene_ID'] .'\'}); return false" /> </div></td>';
					   $html .= '<td>' .$row['transgene_ID']. '</td>';
					   $html .= '<td>' . $row['transgene'] . '</td>';
					   $html .= '<td>' . $row['promoter'] . '</td>';
					   $html .= '<td>' . $row['gene'] . '</td>'; 
					   $html .= '<td>' . $row['strain'] . '</td>';
					    $html .= '<td>' . $row['allele'] . '</td>';
					   $html .= '</tr>';	  
					endforeach; 				   
					$html .= '</tbody> </table>';
				}else{
					$html .= 'No transgenes!';	
				} 
 		echo $html;
}
function output_mutants_user($url,$all_records){
			 	$tableID = "all_mutants_users";
				 $number_count = $all_records->num_rows();
				$html .= table_format($tableID,'0', '');
			 	$html .= '<h2>Mutants <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_mutant/n\'}); return false" /></h2>';
		    	if ($number_count > 0){
						  $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
							<thead>';
						  $html .= '<tr > 
						  <th  ><div class="sort">Mutant&nbsp;ID</div></th><th  ><div class="sort">Mutant</div></th>
						  <th  ><div class="sort">Allele</div></th>  
						  <th  ><div class="sort">Strain</div></th> ';			  		 
						   $html .= '</tr></thead><tbody>';	 
						   foreach ($all_records->result_array() as $row):
							   $html .= '<tr>';
							    $html .= '<td>' .$row['mutant_ID']. '</td>';
							   $html .= '<td>' . $row['mutant'] . '</td>'; 
							   $html .= '<td>' . $row['allele'] . '</td>'; 
							   $html .= '<td>' . $row['strain'] . '</td></tr>';	  
							endforeach;
							$html .= '</tbody> </table>';
				}else{
					$html .= 'No mutants!';	
				} 
 		echo $html;
}
function output_strains_user($url,$all_records){
			 	$tableID = "all_strains_users";
				$number_count = $all_records->num_rows();
				$html .= table_format($tableID,'0', ''); 
			 	$html .= '<h2>Strain <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_strain/n\'}); return false" /></h2>';
		 	    if ($number_count > 0){
						 $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
							<thead>';
						   $html .= '<tr >  
						  <th  ><div class="sort">Strain&nbsp;ID</div></th><th  ><div class="sort">Strain</div></th>
						  <th  ><div class="sort">Source</div></th>  ';			  		 
						   $html .= '</tr></thead><tbody>';	
						   if ($number_count > 0){
							   foreach ($all_records->result_array() as $row):
								   $html .= '<tr>';
								   $html .= '<td>' .$row['strain_ID']. '</td>';
								   $html .= '<td>' . $row['strain'] . '</td>';
								   $html .= '<td>' . $row['source'] . '</td>'; 
								   $html .= '</tr>';	  
								endforeach; 
						   }
		   	 				$html .= '</tbody> </table>';
				}else{
					$html .= 'No strains!';	
				} 
 		echo $html;
}
function output_transgenes_user($url,$all_records){
			 	$tableID = "all_transgene_users";
				$number_count = $all_records->num_rows();
				$html .= table_format($tableID,'0', '');  
			 	$html .= '<h2>Transgene <input type="image"  src="' . $url . 'assets/Pics/Symbol-Add_48.png" name="doit3" value="Open ShadowBox" onClick="Shadowbox.open({player:\'iframe\', title:\'Insert\',height:500,width:500, content:\'' . $url . 'index.php/fish/modify_transgene/n\'}); return false" /></h2>';
		 	    if ($number_count > 0){
					  $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
							<thead>';
					   $html .= '<tr >   
					  <th  ><div class="sort">Transgene&nbsp;ID</div></th><th  ><div class="sort">Promoter</div></th>
					  <th  ><div class="sort">Gene</div></th><th  ><div class="sort">Strain</div></th>  ';			  		 
					   $html .= '</tr></thead><tbody>';	 
						   foreach ($all_records->result_array() as $row):
							   $html .= '<tr>';
							   $html .= '<td>' .$row['transgene_ID']. '</td>';
							   $html .= '<td>' . $row['promoter'] . '</td>';
							   $html .= '<td>' . $row['gene'] . '</td>'; 
							   $html .= '<td>' . $row['strain'] . '</td>';
							   $html .= '</tr>';	  
							endforeach; 				   
			   	 		$html .= '</tbody> </table>';
				}else{
					$html .= 'No transgenes!';	
				} 
 		echo $html;
}
function output_search_results($data,$url){
	switch ($report_array[1]) {
		case "m":
			echo '<h2>' . $report_array[0] . '</h2>';
			break;
		case "ml":
			echo '<h2>' . $report_array[0] . ' Lab</h2>';
			break;
		case "l":
			echo '<h2>' . $report_array[0] . ' Lab</h2>';
			break;
		case "u":
			echo '<h2>' . $report_array[0] . '</h2>';
			break;			
	}
	echo '<script language="javascript"> 
			Shadowbox.init({ 
				players:    ["iframe"]	 
			});
			</script>';
				$_SESSION['report_data']=""; 
				$tableID = "results_table";
				$html .= table_format($tableID,'0',''); 
			 	echo '<table><tr>
				<td> 
			   <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/search_results\'"/>
			  <a href="' . $url . 'index.php/fish/print_prev_search" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
		 	 </td>  </tr></table>
			 <h2>Search Results</h2>'; 
				  $html .=  '<table style="font-size:.7em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
							<thead>'; 
				   $html .= '<tr ><th ></th><th style=" width:5%">Batch&nbsp;#</th>
				  <th>Gender</th><th>Name</th>
				  <th>Status</th><th  >Birthday</th>
				  <th  >User</th><th  >Lab</th>
				  <th>Strain</th>
				  <th  >Mutant Name</th><th>Mutant Allele</th>
				  <th>Transgene Allele</th>
				  <th  >Generation</th>
				  <th  >Cur Adults</th><th  >Start Adults</th>
				  <th  >Cur Nursery</th><th  >Start Nursery</th>';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($data->result_array() as $row): 
					   $_SESSION['report_data'][] = $row;
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px">';
					  if ($selected_user['admin_access'] == "on"){
					   	   $html .= '<input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '\'}); return false" />';  
					  }
					   $html .= '<input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:980, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['batch_ID']. '</td>';
					   $html .= '<td>' . $row['gender'] . '</td>';
					   $html .= '<td>' .$row['name'] . '</td>';
					   $html .= '<td>' .$row['status'] . '</td>';
					   if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }
					   $html .= '<td>' . $row['username'] . '</td>';
					   $html .= '<td>' . $row['lab'] . '</td>';
					   $html .= '<td>' . $row['strain'] . '</td>';
					   $html .= '<td>' . $row['mutant'] . '</td>';
					   $html .= '<td>' . $row['mutant_allele'] . '</td>';
					   $html .= '<td>' . $row['transgene_allele'] . '</td>';
					   $html .= '<td>' . $row['generation']. '</td>';
					   $html .= '<td>'  .$row['current_adults'] . '</td>';	
					   $html .= '<td>' . $row['starting_adults'] . '</td>';	
					   $html .= '<td>' . $row['current_nursery'] . '</td>';
					   $html .= '<td>' . $row['starting_nursery'] . '</td></tr>';	
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table>';
					echo $html;	 
}
function output_report_recipients($url,$all_users,$all_report_recipients){
	 echo "<script type=\"text/javascript\">
			     $().ready(function() {  
      $('#add').click(function() {  
       return !$('#select1 option:selected').remove().appendTo('#select2');  
      });  
      $('#remove').click(function() {  
      return !$('#select2 option:selected').remove().appendTo('#select1');  
      });  
    }); 
	function selectAllOptions(selStr){
	  var selObj = document.getElementById(selStr);
		  for (var i=0; i<selObj.options.length; i++) {
			selObj.options[i].selected = true;
		  }		   
	} 
	function submit_recipients(){
		selectAllOptions('select2');
		document.recipients_form.submit();	
	}
			</script>
			<table><tr><td style=\"padding-right:20px\"><div id=\"standard_box\" style=\"height:300px; padding-left:20px;\">
			<h2>Email Recipients</h2>"; 
	echo '<form method="post" action="' . $url . 'index.php/fish/db_update_recipients"   name="recipients_form">  <input name="report" type="hidden" value="1">
	<br><a href="#" onclick="submit_recipients();" class="jq_buttons">Update</a><br><br>
	<div  style="float:left"> 
	<strong>Users</strong> <br>
			<select multiple="multiple" id="select1" name="select1[]">  ';
			foreach ($all_users->result_array() as $row){ 
				$already_recip = "0";
				foreach ($all_report_recipients->result_array() as $cur_recip){
					if ($cur_recip['user_ID'] == $row['user_ID'] && $cur_recip['report_ID'] == "1"){ 
						$already_recip = "1";
						break;
					}
				}
				if ($already_recip == "0"){
					echo '<option value="' . $row['user_ID'] . '">' . $row['last_name'] . ',' . $row['first_name'] . '</option>';
				}
			}
	echo '</select>  		  
	</div> 
	<div style="float:left;"><br><br>
		   <table> <tr><td>
			Add 
			</td></tr><tr><td> 
			<a href="javascript:;" id="add"><img width="25px" src="' . $url . 'assets/Pics/next_button.png" border="0"></a>
			</td></tr><tr><td>
			Remove
			</td></tr><tr><td> 	
			<a href="javascript:;" id="remove"><img width="25px" src="' . $url . 'assets/Pics/previous_button.png" border="0"></a>
			</td></tr></table>
		</div>
   <div style=" float:left"> <strong>Current Recipients</strong> <br>
	  <select multiple="multiple" id="select2" name="users[]">'; 
			foreach ($all_users->result_array() as $row){ 
				foreach ($all_report_recipients->result_array() as $cur_recip){
					if ($cur_recip['user_ID'] == $row['user_ID'] && $cur_recip['report_ID'] == "1"){
						echo '<option value="' . $row['user_ID'] . '">' . $row['last_name'] . ',' . $row['first_name'] . '</option>';
						break;
					}
				}
			}  
	echo '</select>  
	</div>  ';	
	echo '</form></div>
	</td><td valign="top"><div id="standard_box">'; 
			   $tableID = "scheduled_table";
			   $html  = table_format($tableID,'0','');		 			 	 
			   $html .= '<h2>Scheduled Reports</h2>';
			   $html .=  '<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
									<thead>';	
			   $html .= '<tr ><th style=" width:5%"><div class="sort">File</div></th>
			   <th style=" width:5%"><div class="sort"></div></th>';			  		 
			   $html .= '</tr></thead><tbody>';
			   $dir = "assets/scheduled_reports/";				    
			   $html .= directory_tree($dir,$url);  
			   $html .= '</tbody> </table>				
				</div></td></tr></table>';
				echo $html; 
}

function output_fields_remove($refresh, $batch_ID){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update/r', $attributes); ?>                            
	<?=form_hidden('batch_ID',$batch_ID); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this batch?</h2>';	 
	$html .= '<input type="hidden" name="batch_ID" value="' . $refresh['batch_ID'] . '">
	<h4>Batch Number: ' . $refresh['batch_ID'] . '</h4>';
	$html .= '<h4>Name: '. $refresh['name'] . '</h4>';
	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();">No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
}
function user_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_user/r', $attributes); ?>                            
	<?=form_hidden('user_ID',$refresh['user_ID']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this user?</h2>';	 
	$html .= ' 
	<h4>User ID: ' . $refresh['user_ID'] . '</h4>';
	$html .= '<h4>Username: '. $refresh['name'] . '</h4>';
	$html .= '<h4>Name: '. $refresh['full_name'] . '</h4>';
	$html .= '<h4>Lab: '. $refresh['lab'] . '</h4>';
	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();">No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
}
function mutant_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_mutant/r', $attributes); ?>                            
	<?=form_hidden('mutant_ID',$refresh['mutant_ID']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this mutant?</h2>';	 
	$html .= ' 
	<h4>Mutant ID: ' . $refresh['mutant_ID'] . '</h4>';
	$html .= '<h4>Mutant: '. $refresh['mutant'] . '</h4>';
	$html .= '<h4>Strain: '. $refresh['strain'] . '</h4>'; 
	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();" >No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
}
function strain_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_strain/r', $attributes); ?>                            
	<?=form_hidden('strain_ID',$refresh['strain_ID']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this strain?</h2>';	 
	$html .= ' 
	<h4>Strain ID: ' . $refresh['strain_ID'] . '</h4>';
	$html .= '<h4>strain: '. $refresh['strain'] . '</h4>';
 	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#"  onclick="self.parent.Shadowbox.close();" >No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
}
function transgene_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_transgene/r', $attributes); ?>                            
	<?=form_hidden('transgene_ID',$refresh['transgene_ID']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this transgene?</h2>';	 
	$html .= ' 
	<h4>Transgene ID: ' . $refresh['transgene_ID'] . '</h4>';
	$html .= '<h4>Promoter: '. $refresh['promoter'] . '</h4>';

	$html .= '<h4>Strain: '. $refresh['strain'] . '</h4>';
 	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();">No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
}
function tank_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_tank/r', $attributes); ?>                            
	<?=form_hidden('tank_ID',$refresh['tank_ID']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this tank?</h2>';	 
	$html .= '<h4>Tank: '. $refresh['tank_ID'] . '</h4>'; 
	$html .= '<h4>Location: '. $refresh['location'] . '</h4>'; 
	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();">No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
}
function search_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_search/r', $attributes); ?>                            
	<?=form_hidden('search_ID',$refresh['search_ID']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this search?</h2>';
	$html .= '<h4>Search ID: '. $refresh['search_ID'] . '</h4>';	 
	$html .= '<h4>Name: '. $refresh['search_name'] . '</h4>'; 
	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();">No</a>'; 
	$html .= '</form>
	</div></div>';
	echo $html;
} 
function lab_fields_remove($refresh){
	$html .=  '<div style="width:400px; padding-left:40px; padding-top:40px;"><div id="standard_box">';
	$attributes = array('id' => 'record_form_ID','name' => 'record_form');
	echo form_open('fish/db_update_lab/r', $attributes); ?>                            
	<?=form_hidden('lab',$refresh['lab']); ?>	
	<?php 	  
	$html .= '<h2>Are you sure you want to remove this lab?</h2>';	 
	$html .= '<h4>Lab: '. $refresh['lab'] . '</h4>'; 
	$html .= '<a class="jq_buttons" href="#" onclick="document.record_form.submit();">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="jq_buttons" href="#" onclick="self.parent.Shadowbox.close();">No</a>'; 
	$html .= '</form>
	</div>';
	echo $html;
}
function output_current_tanks($url,$tanks,$refresh){
	$number_count = count($tanks);
	 if ($number_count > 0){
	$_SESSION['preview_array']="";
				$tableID = "fish_tanks";
				$html .= table_format($tableID,'0','');  
				$attributes = array('id' => 'tank_form_remove_ID','name' => 'tank_form_remove');
				$html .= form_open('fish/remove_tanks', $attributes);
				$html .= form_hidden('batch_ID', $refresh['batch_ID']); 
				$html .= '<select id="cur_rem_tanks" multiple name="tanks[]" style=" visibility:hidden; position:absolute;"></select></form>';
		 	   $html .=' <div style=" overflow:auto; height:460px; width:390px;"><table><tr><td>';			 
			   $html .=  '<div style="  width:300px; font-size:.7em;">	<table style=" font-size:.8em " class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>'; 
						   $html .= '<tr > <th  width="3"></th> 
						  <th>Location</th><th>Room</th>
						  <th  >Multiple Batches</th>';			  		 
						   $html .= '</tr></thead><tbody>';	 
								 foreach ($tanks  as $row){ 								 	  
									  $html .= '<tr><td><a href="#" onclick="displayremoveVals(\'' . $row['tank_ID'] . '\',\'' . $row['location'] . '\',\'add_tank\');"><img width="12" src="' . $url . 'assets/Pics/Red_x.png" border=0></a></td>'; 				   
									  $html .= '<td>' . $row['location'] . '</td>';
									  $html .= '<td>' . $row['room'] . '</td>';
									  if(is_array($row['multiple_batch']) && count($row['multiple_batch']) > 1){
										  $html .= "<td>";
										  foreach ($row['multiple_batch']  as $value){   
											$html .= '<a href="'. $url .'index.php/fish/modify_line/u_' . $value . '">' . $value . '</a>,';
										  }
										 $html .= "</td>";
									   }else{
											$html .= "<td></td>";
									   }
									   $html .= "</tr>";	
								 }						 
							$html .= '</tbody> </table> </div>  
						</td><td valign="top">  				
							<a href="#" onclick="submit_remove_tanks();" class="jq_buttons" style=" font-size:.8em;">Remove</a>
							<div id="remove_tanks"></div>
					</td></tr></table>
					 </div>
					<script>
	 function submit_remove_tanks() { 
		 selectAllOptions("cur_rem_tanks");			 
		 document.tank_form_remove.submit();
	 }
	 
    function displayremoveVals(temp_var,location,change_var) { 
     	 if (change_var == "remove_tank"){
			var d1=document.getElementById("cur_rem_tanks");
			var d2=document.getElementById("opt_r_" + temp_var);			 
			d1.removeChild(d2); 
			var d1=document.getElementById("remove_tanks");
			var d2=document.getElementById("div_r_" + temp_var);			 
			d1.removeChild(d2); 
			return ;
		}
	 	if (change_var == "add_tank"){
			var innervar = document.getElementById("remove_tanks").innerHTML;
			document.getElementById("remove_tanks").innerHTML = innervar + "<div id=\"div_r_" + temp_var + "\">" + location + 
			"<a href=\"#\" onclick=\"displayremoveVals(\\\'" + temp_var + "\\\',\\\'\\\',\\\'remove_tank\\\');\"><img src=\"' . $url . 'assets/Pics/Red_x.png\" width=\"16\" border=0></a></div>";	
	 		var elSel=document.getElementById("cur_rem_tanks");
			var elOptNew = document.createElement("option");
			elOptNew.text = temp_var;
			elOptNew.id = "opt_r_" + temp_var;  
			try {
				elSel.add(elOptNew, null); // standards compliant; does not work in IE
			  }
			  catch(ex) {
				elSel.add(elOptNew); // IE only
			  } 
		} 
    }  
</script>';
					
					$_SESSION['preview_array']= $html;
	 
	 }
    return $html;
}
function output_all_tanks($url,$tanks,$refresh){
	$_SESSION['preview_array']="";
				$tableID = "fish_all_tanks";
				$html .= table_format($tableID,'0',''); 
				$attributes = array('id' => 'tank_form_ID','name' => 'tank_form');
				$html .= form_open('fish/add_tanks', $attributes);
				$html .= form_hidden('batch_ID', $refresh['batch_ID']); 
				$html .= '<select id="cur_tanks" multiple name="tanks[]" style=" visibility:hidden; position:absolute;"></select></form>';
			    $html .= '  <div style=" overflow:auto; height:460px; width:390px;"> <table ><tr><td><div style="  width:300px; font-size:.7em;">
				  <table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>  '; 
				   $html .= '<tr > <th ></th> 
				  <th  >Location</th> ';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($tanks->result() as $row){  
				   	   $html .= '<tr><td><a href="#"  onclick="displayVals(\'' . $row->tank_ID . '\',\'' . $row->location . '\',\'add_tank\');"><img border=0 src="' . $url . 'assets/Pics/Symbol-Add_48.png" width="16" ></a></td>'; 				   
					   $html .= '<td  >' . $row->location . '</td>';	 
					   $html .= "</tr>";
				   }
		   	 		$html .= '</tbody> </table></div>
					</td><td valign="top"> 
					<a href="#"  onclick="submit_add_tanks();" class="jq_buttons" style=" font-size:.8em;">Insert</a>
					<div id="selected_vars"></div>
					</td></tr></table> </div>
					
					<script>
	 function submit_add_tanks() { 
		 selectAllOptions("cur_tanks");			 
		 document.tank_form.submit();
	 }
	 
    function displayVals(temp_var,location,change_var) { 
     	 if (change_var == "remove_tank"){
			var d1=document.getElementById("cur_tanks");
			var d2=document.getElementById("opt_" + temp_var);			 
			d1.removeChild(d2); 
			var d1=document.getElementById("selected_vars");
			var d2=document.getElementById("div_" + temp_var);			 
			d1.removeChild(d2); 
			return ;
		}
	 	if (change_var == "add_tank"){
			var innervar = document.getElementById("selected_vars").innerHTML;
			document.getElementById("selected_vars").innerHTML = innervar + "<div id=\"div_" + temp_var + "\">" + location + 
			"<a href=\"#\" onclick=\"displayVals(\\\'" + temp_var + "\\\',\\\'\\\',\\\'remove_tank\\\');\"><img src=\"' . $url . 'assets/Pics/Red_x.png\" width=\"16\" border=0></a></div>";	
			//var elSel = document.createElement(\'div\');
  			//newdiv.setAttribute(\'id\', id);	
			var elSel=document.getElementById("cur_tanks");
			var elOptNew = document.createElement("option");
			elOptNew.text = temp_var;
			elOptNew.id = "opt_" + temp_var;
			//elOptNew.value = "append" + num;

			try {
				elSel.add(elOptNew, null); // standards compliant; does not work in IE
			  }
			  catch(ex) {
				elSel.add(elOptNew); // IE only
			  }

		}
	    
    } 

</script> ';
					
					$_SESSION['preview_array']= $html;
    return $html;
} 
function output_batch_summary($data,$url,$report_array){
	switch ($report_array[1]) {
		case "m":
			echo '<h2>' . $report_array[0] . '</h2>';
			break;
		case "ml":
			echo '<h2>' . $report_array[0] . ' Lab</h2>';
			break;
		case "l":
			echo '<h2>' . $report_array[0] . ' Lab</h2>';
			break;
		case "u":
			echo '<h2>' . $report_array[0] . '</h2>';
			break;			
	}
	echo '<script language="javascript"> 
			Shadowbox.init({ 
				players:    ["iframe"]	 
			});
			</script>';
				 $_SESSION['report_data']=""; 
				$tableID = "mylb_table";
				$html .= table_format($tableID,'1','');  
			 	echo '<table><tr><td> 
			   <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/batch_summary\'"/>
			  <a href="' . $url . 'index.php/fish/print_prev_batchsum" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
		 	  </td></tr></table>';
			   $attributes = array('id' => 'fish_form_ID','name' => 'fish_form');
				echo form_open('/modify_line', $attributes);                      
				echo form_hidden('modify_line', $batch_ID); 
				echo form_hidden('batch_ID', ''); 
				   $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
						<thead>';  
				   $html .= '<tr ><th ></th><th style=" width:5%">Batch&nbsp;#</th>
				  <th>Gender</th><th>Name</th>
				  <th>Status</th><th  >Birthday</th>
				  <th  >Date of Death</th>
				  <th  >User</th><th>Strain</th>
				  <th  >Mutant Name</th><th  >Transgene Name</th>
				  <th  >Generation</th>
				  <th  >Cur Adults</th> 
				  <th  >Start Nursery</th>';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($data['fish_report']->result_array() as $row):
				 	   $_SESSION['report_data'][] = $row;
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px">';
					   if ($selected_user['admin_access'] == "on"){
					 	  $html .= ' <input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '\'}); return false" /> ';
					   }
					   $html .= '	 <input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:980, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['batch_ID']. '</td>';
					   $html .= '<td>' . $row['gender'] . '</td>';
					   $html .= '<td>' .$row['name'] . '</td>';
					   $html .= '<td>' .$row['status'] . '</td>';
					   if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }
					   if ($row['death_date']){
						 $html .= '<td>' . date('m/d/Y',$row['death_date']) . '</td>';   
					   }else{
						  $html .= '<td></td>';  
					   }
					   $html .= '<td>' . $row['username'] . '</td>';
					   $html .= '<td>' . $row['strain'] . '</td>';
					   $html .= '<td>' . $row['mutant'] . '</td>';
					   $html .= '<td>' . $row['transgene'] . '</td>'; 
					   $html .= '<td>' . $row['generation']. '</td>';
					   $html .= '<td>'  .$row['current_adults'] . '</td>';	
					   $html .= '<td>' . $row['starting_nursery']. '</td></tr>'; 
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table></form>  ';
					echo $html;	  
}

function output_quantity_summary($data,$url,$report_array){
	switch ($report_array[1]) {
		case "m":
			echo '<h2>' . $report_array[0] . '</h2>';
			break;
		case "ml":
			echo '<h2>' . $report_array[0] . ' Lab</h2>';
			break;
		case "l":
			echo '<h2>' . $report_array[0] . ' Lab</h2>';
			break;
		case "u":
			echo '<h2>' . $report_array[0] . '</h2>';
			break;			
	}
 
	echo '<script language="javascript"> 
Shadowbox.init({ 
    players:    ["iframe"]	 
});
</script>'; 	 
				$_SESSION['preview_array']="";
				$tableID = "user_table";
				$html = table_format($tableID,'0','Quantity Summary');   
			 	$html .= '<table><tr><td> 
			   <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/quantity_summary\'"/>
			   <a href="' . $url . 'index.php/fish/print_prev_quantsum" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
	 		   </td></tr></table>';
			   $attributes = array('id' => 'fish_form_ID','name' => 'fish_form'); 
			   $html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
				<thead>';
			   $html .= '<tr ><th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
			   <th ><div class="sort">Total Batches</div></th>';			  		 
			   $html .= '</tr></thead><tbody>';	
			   foreach ($data['user_quant']->result() as $row): 
				   $_SESSION['report_data']['user_quant'][] = $row;
				   $html .= '<tr>';
				   $html .= '<td>' .$row->starting_adults. '</td>';
				   $html .= '<td>' .$row->current_adults . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   
				   $html .= '<td>' .$row->total_batches . '</td> </tr>'; 
				endforeach; 				 
				$html .= '</tbody> </table>';
				echo $html;
				$_SESSION['preview_array']= $html; 
	  			$html = "";
	  			$tableID = "mutant_table";
				$html = table_format($tableID,'0','Mutant Summary');  
			    $attributes = array('id' => 'mutant_form_ID','name' => 'mutant_form'); 
				$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
				<thead>'; 
			   $html .= '<tr ><th >Mutant</th>
			   <th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
			   <th >Total Batches</th>';			  		 
			   $html .= '</tr></thead><tbody>';	 
			   foreach ($data['mutant_quant']->result() as $row): 
				  $_SESSION['report_data']['mutant_quant'][] = $row;
				  if ($row->mutant){
					   $html .= '<tr>';
					   $html .= '<td>' .$row->mutant. '</td>';
					   $html .= '<td>' .$row->starting_adults. '</td>';
					   $html .= '<td>' .$row->current_adults . '</td>';
					   $html .= '<td>' . $row->starting_nursery . '</td>';
					   $html .= '<td>' . $row->starting_nursery . '</td>';
					   $html .= '<td>' .$row->total_batches . '</td> </tr>'; 
				  }
				endforeach; 				 
				$html .= '</tbody> </table> '; 
				$_SESSION['preview_array'] = $html;
				echo $html;
	   			$html = "";
	  			$tableID = "strain_table";
				$html = table_format($tableID,'0','Strain Summary');  
				$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
				<thead>';  
			   $html .= '<tr ><th >Strain</th>
			   <th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
			   <th >Total Batches</th>';			  		 
			   $html .= '</tr></thead><tbody>';	
			   $index = "0";
			   foreach ($data['strain_quant']->result() as $row): 
				  $_SESSION['report_data']['strain_quant'][] = $row;
				  if ($row->strain){
				   $html .= '<tr>';
				   $html .= '<td>' .$row->strain. '</td>';
				   $html .= '<td>' .$row->starting_adults. '</td>';
				   $html .= '<td>' .$row->current_adults . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' . $row->starting_nursery . '</td>';
				   $html .= '<td>' .$row->total_batches . '</td> </tr>';
				   $index++;
				  }
				endforeach; 				 
				$html .= '</tbody> </table>'; 
				echo $html;					 
				$_SESSION['preview_array']= $html; 
				$html = "";
	  			$tableID = "transgene_table";
				$html = table_format($tableID,'0','Transgene Summary');  
				$html .=  '<table style="font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
				<thead>'; 
				   $html .= '<tr ><th >Promoter</th>
				   <th >Start Adults</th>
			   <th >Cur Adults</th>
			   <th >Start Nursery</th>
			   <th >Cur Nursery</th>
				   <th >Total Batches</th>  ';			  		 
				   $html .= '</tr></thead><tbody>';	 
				   $index = "0";
                   foreach ($data['transgene_quant']->result() as $row):
				 	  $_SESSION['report_data']['transgene_quant'][] = $row;
				   	  if ($row->promoter){
				   	   $html .= '<tr>';
					   $html .= '<td>' .$row->promoter. '</td>';
					    $html .= '<td>' .$row->starting_adults. '</td>';
					   $html .= '<td>' .$row->current_adults . '</td>';
					   $html .= '<td>' . $row->starting_nursery . '</td>';
					   $html .= '<td>' . $row->starting_nursery . '</td>';
					   $html .= '<td>' .$row->total_batches . '</td> </tr>';
					   $index++;
					  }
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table></div> ';
					echo $html;				 
					$_SESSION['preview_array']= $html;         
}
function track_percentage($data,$url,$datefilter,$admin_access){
  			 $_SESSION['percent_report_data']=""; 
				$tableID = "track_table"; 
				echo '<div id="standard_box" style=" padding-top:30px; padding-bottom:30px; margin-left:50px;width:805px; ">';
				$show .= '<h3>Show by month:<br>
				<select id="cursurvival_filter"><option></option>';
				$first_run = 1;
				foreach($datefilter->result_array() as $row){ 
					if ($first_run == 1){
						$show .=  '<optgroup label="' . date('Y',$row['date_taken']) . '">';	
					}elseif ($yearcheck != date('Y',$row['date_taken'])) {
						$show .=  '</optgroup><optgroup label="' . date('Y',$row['date_taken'])  . '">';	
					}
					$show .=  '<option value="' . $row['date_taken'] . '">' . date('F Y',$row['date_taken']) . '</option>';
					$yearcheck = date('Y',$row['date_taken']);
					$first_run++;
				}
				$show .=  '</optgroup></select><input type="button" value="Show" onclick="show_filterby();"></h3>';
				$number_count = $data->num_rows();  
				
					  		$html .= table_format($tableID,'0', ''); 
			 		  	   $html .=  '<table><tr><td> 
						   <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/survival_stat\'"/>
						   <a href="' . $url . 'index.php/fish/print_prev_survivalstat" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
						   </td><td>' . $show . '
						   </td></tr><tr><td colspan=3>'; 
							$html .=  '<div style="width:800px;" >';
							if ($number_count > 0){
								$html .= '<table class="display" style="font-size:.8em"cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
									<thead>';  
								$html .= '<tr ><th  ></th><th style=" width:2%">Batch&nbsp;#</th>
								  <th>Start Nursery</th>
								  <th>Cur Adults</th><th>Start Adults</th>
								  <th>Lab</th>
								  <th>Status</th>
								  <th>Survival Rate</th><th  >Birthday</th><th>Date of Death</th>
								  <th  >Report Date</th>';			  		 
								   $html .= '</tr></thead><tbody>';	
								   foreach ($data->result_array() as $row){ 
									   $_SESSION['percent_report_data'][] = $row;
									   $html .= '<tr>';
									   $html .= '<td><div style=" width:40px">';
									   if ($admin_access == "on"){
											 $html .= '<input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '\'}); return false" />';  
									   }
									   $html .= '<input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:950, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'\'}); return false" /> </div></td>';
									   $html .= '<td>' .$row['batch_ID']. '</td>';
									    $html .= '<td>' .$row['starting_nursery'] . '</td>';
									   $html .= '<td>' . $row['current_adults'] . '</td>';
									   $html .= '<td>' .$row['starting_adults'] . '</td>';
									   $html .= '<td>' .$row['lab'] . '</td>';
									   $html .= '<td>' .$row['status'] . '</td>';
									   if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
										   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
											    $html .= '<td>0%</td>'; 
										   }else{											  
											    $html .= '<td>' . round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%</td>';
										   }
									   }else{
										  $html .= '<td>' . round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%</td>'; 
									   }  
									   if ($row['birthday']){ 
											$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
									   }else{
										   $html .= '<td></td>';
									   }
									   $html .= '<td>';
									   if ($row['death_date']){
									  	  $html .= date('m/d/Y',$row['death_date']);
									   }
									    $html .= '</td>';
									   $html .= '<td>' . date('m/d/Y',$row['date_taken']) . '</td>';
									   $html .= '</tr>'; 
								   } 		 
								   $html .= '</tbody> </table>';
							   }
							   $html .= '</div>
							   </td></tr></table>';
						
						echo $html;	?>  
						<script>
						function show_filterby(){
							if (document.getElementById("cursurvival_filter").value){
								Shadowbox.open({
									content:   "<?php echo $url; ?>index.php/fish/filter_track_survival/" + document.getElementById("cursurvival_filter").value,
									player:     "iframe",
									title:      "Track Current Survival",
									height:     800,
									width:      1100
								}); 
							}
						}
						</script> </div><?php				
}
function track_percentage_filtered($data,$url){
  			 $_SESSION['percent_report_data']=""; 
			 	echo '<script language="javascript"> 
					Shadowbox.init({ 
						players:    ["iframe"]	 
					});
					</script>';
				$tableID = "track_table";
				$html .= table_format($tableID,'0', '');  
			 	echo '<table><tr>
				<td> 
			   <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/survival_stat\'"/>
			  <a href="' . $url . 'index.php/fish/print_prev_survivalstat" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>
		    </td></tr></table>';
			   $attributes = array('id' => 'fish_form_ID','name' => 'fish_form');
				echo form_open('/modify_line', $attributes);                      
				echo form_hidden('modify_line', $batch_ID); 
				echo form_hidden('batch_ID', '');  
				   $html .=  '<h2>Track Survival Percentage ' . date('F Y',$data['date_taken']) . '</h2>
				   <div style="width:1040px;" ><table style=" font-size:.8em" class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';  
				   $html .= '<tr ><th ></th><th >Batch&nbsp;#</th>
				   <th>Start Nursery</th>
				  <th>Cur Adults</th><th>Start Adults</th>
				   <th>Lab</th><th>Status</th>
				  <th>Survival Rate</th><th  >Birthday</th>
				   <th  >Date of Death</th><th  >Report Date</th>';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($data['track_percentage']->result_array() as $row):
				       $_SESSION['percent_report_data'][] = $row;
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px">';
					   if ($data['admin_access'] == "on"){
					  	 $html .= '<input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '\'}); return false" />'; 
					   }
					   $html .= '	<input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:1000, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'\'}); return false" /></div></td>';
  					   $html .= '<td>' .$row['batch_ID']. '</td>';
					   $html .= '<td>' . $row['starting_nursery'] . '</td>';
					   $html .= '<td>' . $row['current_adults'] . '</td>';
					   $html .= '<td>' .$row['starting_adults'] . '</td>';
					   $html .= '<td>' .$row['lab'] . '</td>';
					   $html .= '<td>' .$row['status'] . '</td>';
					   if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
						   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
								$html .= '<td>0%</td>'; 
						   }else{											  
								$html .= '<td>' . round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%</td>';
						   }
					   }else{
						  $html .= '<td>' . round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%</td>'; 
					   }   
					   if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }
					   if ($row['death_date']){
						  $html .= '<td>' . date('m/d/Y',$row['death_date']) . '</td>';
					   } else{
						    $html .= '<td></td>';
					   }
					   $html .= '<td>' . date('m/d/Y',$row['date_taken']) . '</td>';
					   $html .= '</tr>'; 
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table>  </form> ';
					echo $html;					 
                   ?>  
                     <script> 
				function show_update(update_var){
					 	 Shadowbox.open({
							content:    "<?php echo $url; ?>index.php/fish/modify_line/u_" + update_var,
							player:     "iframe",
							title:      "Update",
							height:     700,
							width:      930
						});  
				}
				</script> 
	  <?php
}
function track_current($data,$url,$admin_access){
  		 $_SESSION['current_report_data']=""; 
				$tableID = "track_current";
				$html .= table_format($tableID,'0', '');  
				?>
        	 	<div id="standard_box" style=" padding-top:30px; padding-bottom:30px; margin-left:30px;  width: 800px; ">
           		 <?php
			 	 $html .= '<table><tr>
				<td> 
			   <input type="image"  src="' . $url . 'assets/Pics/File-Excel-48.png" name="doit"   onClick="location.href=\'' . $url . 'index.php/fish/export/survival_current\'"/>
			  <a href="' . $url . 'index.php/fish/print_prev_currentstat" target="_blank"><img border=0 src="' . $url . 'assets/Pics/Print-Preview-48.png"></a>';				 
			    $html .= '</td></tr><tr><td colspan=3>';
			    $attributes = array('id' => 'fish_form_ID','name' => 'fish_form');
				 $html .= form_open('/modify_line', $attributes);                      
				 $html .= form_hidden('modify_line', $batch_ID); 
				 $html .= form_hidden('batch_ID', ''); 
				    $html .=  '<div style="width:795px;" ><table class="display" style=" font-size:.8em" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $tableID . '">
								<thead>';  
				   $html .= '<tr ><th ></th><th>Batch&nbsp;#</th>
				   <th>User</th> 
				   <th>Lab</th>
				  <th>Cur Adults</th><th>Start Adults</th><th>Start Nursery</th>
				  <th>Cur Nursery</th>
				  <th>Birthday</th>
				   <th>Survival Rate</th> ';			  		 
				   $html .= '</tr></thead><tbody>';	
				   foreach ($data->result_array() as $row):
				       $_SESSION['current_report_data'][] = $row;
				   	   $html .= '<tr>';
					   $html .= '<td><div style=" width:40px">';
					   if ($admin_access == "on"){
					   		$html .= '<input type="image" width="12" src="' . $url . 'assets/Pics/Red_x.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'index.php/fish/modify_line/r_' . $row['batch_ID'] . '\'}); return false" /> ';
					   }
                  	   $html .= '<input type="image" width="16" src="' . $url . 'assets/Pics/Edit-32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\', title:\'Update\',height:700,width:950, content:\'' . $url . 'index.php/fish/modify_line/u_' . $row['batch_ID'] .'\'}); return false" /> </div></td>';
  					   $html .= '<td>' .$row['batch_ID']. '</td>';
					   $html .= '<td>' . $row['username'] . '</td>'; 
					   $html .= '<td>' . $row['lab'] . '</td>';						  
					   $html .= '<td>' . $row['current_adults'] . '</td>';
					   $html .= '<td>' .$row['starting_adults'] . '</td>'; 
					   $html .= '<td>' .$row['starting_nursery'] . '</td>'; 
					   $html .= '<td>' . $row['starting_nursery'] . '</td>';
					   if ($row['birthday']){ 
					   		$html .= '<td>' . date('m/d/Y',$row['birthday']) . '</td>';
					   }else{
						   $html .= '<td></td>';
					   }
					   if ($row['starting_nursery'] == "" || $row['starting_nursery'] == "0"){
						   if ($row['starting_adults'] == "" || $row['starting_adults'] == "0"){
								$html .= '<td>0%</td>'; 
						   }else{											  
								$html .= '<td>' . round($row['current_adults'] /  $row['starting_adults'],4) * 100 . '%</td>';
						   }
					   }else{
						  $html .= '<td>' . round($row['current_adults'] / $row['starting_nursery'],4) * 100 . '%</td>'; 
					   }   
					   $html .= '</tr>'; 
                  	endforeach; 				 
		   	 		$html .= '</tbody> </table></div> </form>
					</td></tr></table>';
					echo $html;					 
                   ?>  
	 			</div><?php
}  
function search_function($all_fish,$all_users,$all_mutants,$all_strains,$all_transgenes,$quantity,$batch_sum,$url,$all_labs,$all_tanks,$all_searches,$all_mutant_allele,$all_transgene_allele){	
	$html .= '<table><tr><td valign="top">';
	$attributes = array('id' => 'search_form_ID','name' => 'search_form');
	$html .= form_open($url . 'index.php/fish/search_data', $attributes);   
	$html .= '<div id="standard_box">
	<table><tr><td><h2 style=" color:#000;">Custom Search</h2></td><td style=" padding-left:20px">My Lab Results: <input type="checkbox" name="mylab" checked></td></tr></table>'; 
 	$html .= '<a class="jq_buttons" onclick="submit_search_data();">Search</a>';	 
	$html .=  '<table style=" font-size:12px; font-family:Verdana, Geneva, sans-serif;"><tr><td>';
	$html .= 'Batch Number:<br><select name="batch_ID"><option></option>';
 	foreach ($all_fish->result_array() as $row){
  		$html .= '<option>' . $row['batch_ID'] . '</option>'; 
	}
	$html .= '</select>';
	$html .= '</td></tr><tr><td>'; 
 	$html .= 'Status:<br><select name="status"><option></option>';
	$status_array = "";
	$status_array[0] = "Alive";
	$status_array[1] = "Dead";
	$status_array[2] = "Sick";	 
	foreach($status_array as $value){
		if ($value == $refresh['status']){
			$html .= '<option selected>' . $value . '</option>';
		}else{
			$html .= '<option>' . $value . '</option>';
		}
	}
	$html .= '</select>'; 
	$html .= '</td><td>';
	$html .= 'Gender:<br><select name="gender"><option></option>';
	$gender_array = "";
	$gender_array[0] = "M";
	$gender_array[1] = "F";	
	$gender_array[2] = "Mixed"; 	 
	foreach($gender_array as $value){
		if ($value == $refresh['gender']){
			$html .= '<option selected>' . $value . '</option>';
		}else{
			$html .= '<option>' . $value . '</option>';
		}
	}
	$html .= '</select>';
	$html .= '</td><td>';
	$html .=  'Strain: <br><select name="strain_ID"><option></option>';
 	foreach ($all_strains->result() as $row){
		if ($row->strain_ID == $refresh['strain_ID']){
			$index="1";
			$html .=  '<option value="' . $row->strain_ID  . '" selected>' . $row->strain  . '</option>';
		}else{
			$html .=  '<option value="' . $row->strain_ID  . '">' . $row->strain . '</option>';
		}	
	 }  
	$html .=  '</select>';
	$html .= '</td><td>';
	$html .=  'User: <br><select name="user_ID"><option></option>';
 	foreach ($all_users->result() as $row){
		$html .=  '<option value="' . $row->user_ID  . '">' . $row->username . '</option>'; 
	}  
	$html .=  '</select>';
	$html .= '</td></tr><tr><td>'; 	
	$html .= 'Lab:<br><select name="lab"><option></option>';
 	foreach ($all_labs->result_array() as $row){
  		$html .= '<option>' . $row['lab'] . '</option>'; 
	} 
	$html .= '</select>';
	$html .= '</td><td>';
	$html .=  'Tank: <br><select name="tank_ID"><option></option>';
 	foreach ($all_tanks->result() as $row){
		$html .=  '<option value="' . $row->tank_ID  . '">' . $row->location . '</option>'; 
	}  
	$html .=  '</select>';
	$html .= '</td><td>';
	$gen_array = "";
	$gen_array[0] = "outcross/F0";
	$gen_array[1] = "F1";
	$gen_array[2] = "F2";
	$gen_array[3] = "F3";
	$html .= 'Generation: <br><select name="generation"><option></option>';
	foreach($gen_array as $value){ 
		$html .= '<option>' . $value . '</option>';	 
	}
	$html .= '</select>';
	$html .= '</td></tr><tr><td>';
	$html .= 'Birthday: <br>'; 
	$birthday =  'empty';	
	$html .= output_cal_func('birthday', $birthday,'birthday');	 
	$html .= '</td><td>';
	$html .= 'Date of Death: <br>'; 
	$death_date =  'empty';	
	$html .= output_cal_func('death_date', $death_date,'death_date');	 
	$html .= '</td></tr><tr><td colspan=4>';
	$html .=  'Mother: <br><select name="mother_ID"><option></option>';
 	foreach ($all_fish->result() as $row){
		if ($row->batch_ID == $refresh['mother_ID']){
			$index="1";
			$html .=  '<option value="' . $row->batch_ID  . '" selected>' . $row->batch_ID .  ', ' . $row->name  . '</option>';
		}else{
			$html .=  '<option value="' . $row->batch_ID  . '">' . $row->batch_ID .  ', ' . $row->name . '</option>';
		}	
	 }  
	$html .=  '</select>'; 
	$html .= '</td></tr><tr><td colspan=4>';	 
	$html .=  'Father: <br><select name="father_ID"><option></option>';
 	foreach ($all_fish->result() as $row){
		if ($row->batch_ID == $refresh['father_ID']){
			$index="1";
			$html .=  '<option value="' . $row->batch_ID  . '" selected>' . $row->batch_ID .  ', ' . $row->name  . '</option>';
		}else{
			$html .=  '<option value="' . $row->batch_ID  . '">' . $row->batch_ID .  ', ' . $row->name . '</option>';
		}	
	 }  
	$html .=  '</select>'; 
	$html .= '</td></tr><tr><td colspan=4>
	<table><tr><td>';
	$html .=  '<div id="plain_box" ><h3 style=" padding:0px;margin:0px">Mutant</h3>';	
	$html .= '<table><tr><td>Name:<br><select name="mutant_ID"><option></option>';
 	foreach ($all_mutants->result() as $row){ 
		$html .= '<option value="' . $row->mutant_ID . '">' .  $row->mutant . '</option>'; 
	}	 
	$html .= '</select></td>'; 
	$html .= '<td>Allele:<br><select name="mutant_allele"><option></option>';
	foreach ($all_mutant_allele->result() as $row){ 
		$html .= '<option>' . $row->allele . '</option>'; 
	}
 	$html .= '</select>';
	$html .= '</td></tr></table>';	
  	$html .= ' +/+ <input type="checkbox" name="mutant_genotype_wildtype"  >';
  	$html .= ' +/- <input type="checkbox" name="mutant_genotype_heterzygous"  >';
	$html .= ' -/- <input type="checkbox" name="mutant_genotype_homozygous"  >';
 	$html .= '</div></td></tr><tr><td>';  	
	$html .=  '<div id="plain_box"  ><h3 style=" padding:0px;margin:0px">Transgene</h3>';	
	$html .= '<table><tr><td>Name:<br><select name="transgene_ID"><option></option>';
	foreach ($all_transgenes->result() as $row){ 
		$html .= '<option value="' . $row->transgene_ID . '">' . $row->transgene . '</option>'; 
	}
 	$html .= '</select></td>'; 
	$html .= '<td>Allele:<br><select name="transgene_allele"><option></option>';
	foreach ($all_transgene_allele->result() as $row){ 
		$html .= '<option>' . $row->allele . '</option>'; 
	}
 	$html .= '</select>';
	$html .= '</td></tr></table>';
	$html .= ' +/+ <input type="checkbox" name="transgene_genotype_wildtype"  >';
	$html .= ' +/- <input type="checkbox" name="transgene_genotype_heterzygous"  >';	 
	$html .= ' -/- <input type="checkbox" name="transgene_genotype_homozygous"  >';		
	$html .= '</div></div></td></tr></table>'; 
	$html .= '</td></tr><tr><td colspan=6>';
	$html .= 'Comment:<br><textarea name="comments" cols="60" rows="5"></textarea>';
	$html .= '</td></tr></table>'; 
	$html .= '</div></form>  
	</td><td valign="top" style=" width:600px;">';
 	$html .=  '<div id="tab_reports" > 
						<ul  >
							<li><a href="#t-0">Saved Searches</a></li>
							<li><a href="#t-1">Quantity</a></li>
							<li><a href="#t-2">Batch</a></li> 
						</ul>
						<div id="t-0" > 	
							<div id="accented_box" style="width:300px;">
							<h3>Save Search Criteria</h3> <form id="saved_search_ID" name="saved_search_form" action="/fish/index.php/fish/index/nsearch/2" method="post">
						 	Name:<input name="search_name" type="text">	<a href="#" onclick="save_search();" class="jq_buttons" style=" font-size:12px;">Save</a>						
							<div id="hidden_vars" style="visibility:hidden; position:absolute;"></div>
							</form></div>
							<h3>Searches</h3>';
						$ID = "saved_searches_table";
						$html .= table_format($ID,'0',''); 
						$html .=  '	<table class="display" cellpadding="0" cellspacing="0" border="0" class="display" id="' . $ID . '">
									<thead><tr><th width="1"></th><th>Search Name</th></tr></thead><tbody>';
						foreach ($all_searches->result() as $row){
							$html .= '<tr class="gradeC">';
							$html .= '<td style=" width:5px;"><a href="#" onclick="remove_search(\'' . $row->search_ID . '\');"><img border=0 width="14" src="' . $url . 'assets/Pics/Red_x.png"></a></td>';
							$html .= '<td>' . $row->search_name . '<a href="#" onclick="load_saved_search(\'' . $row->search_ID . '\');"><img border=0 width="14" src="' . $url . 'assets/Pics/Search-32.png"></a></td>'; 
							$html .= '</tr>';  
						}
						$html .=  '</tbody></table> 
						</div>
						<div id="t-1" > 
							<div id="standard_box" > 
								<h2>Quantity Reports</h2>';
								$html .= $quantity; 
								$html .=  '
							</div> 
						</div><!-- t-1-->
						<div id="t-2"> 
							<div id="standard_box"  >  
							 <h2>Batch Reports</h2>';
							$html .= $batch_sum; 
							$html .='
							</div>
					</div><!-- t-2-->
				</div><!--vreports-->
			</td></tr></table>
			'; 
	echo $html; 
	?> 
    <script language="javascript">   
	function submit_search_data(){		 
		 Shadowbox.open({
			content:    "<?php echo $url; ?>index.php/fish/submit_search_data",
			player:     "iframe",
			title:      "Search",
			height:     800,
			width:      1200
		}); 
	}
	function remove_search(searchID){
		Shadowbox.open({ 
			content:    "<?php echo $url; ?>index.php/fish/modify_search/r_" + searchID,
			player:     "iframe",
			title:      "Search",
			height:     500,
			width:      500
		}); 
	}
	function load_saved_search(searchID){ 
		Shadowbox.open({
			content:    "<?php echo $url; ?>index.php/fish/load_search_data/" + searchID,
			player:     "iframe",
			title:      "Search",
			height:     800,
			width:      1200
		}); 
	}
	function save_search(){
				var new_form_var = document.getElementById("hidden_vars");
				var form_var = document.search_form;
				
				for(i=0; i<form_var.elements.length; i++){	 
					if (form_var.elements[i].checked == true){
						var newinput = document.createElement("input");
						new_form_var.appendChild(newinput);	
						newinput.name = form_var.elements[i].name;
						newinput.value = "1";   
					}else if(form_var.elements[i].checked == false){
					}else if(form_var.elements[i].value == ""){
					}else{
						var newinput = document.createElement("input");
						new_form_var.appendChild(newinput); 
						newinput.name = form_var.elements[i].name;
						newinput.value = form_var.elements[i].value; 
						newinput.id = i; 		
					}  
				} 
				document.saved_search_form.submit();	
			}
	</script>
    <?php
	
}

function directory_tree($address,$url){
 @$dir = opendir($address);
  if(!$dir){ return 0; }
        while($entry = readdir($dir)){
                if(is_dir("$address/$entry") && ($entry != ".." && $entry != ".")){                            
                        directory_tree("$address/$entry",$comparedate);
                } else   {
                  if($entry != ".." && $entry != ".") {                 
                    $fulldir=$address.'/'.$entry;
                    $last_modified = filemtime($fulldir);
                    $last_modified_str= date("Y-m-d h:i:s", $last_modified);
                    $html .= '<tr><td>
					<input type="image" width="20" src="' . $url . 'assets/Pics/Task Report Regular_32.png" name="doit" value="Open ShadowBox" onclick="Shadowbox.open({player:\'iframe\',height:500,width:500, title:\'Confirm\', content:\'' . $url . 'assets/scheduled_reports/' . $entry . '\'}); return false" /> 
			 		</td><td>' . $entry . '</td></tr>';                                                  
                 }
            }
      }
	  return $html;
}
?>