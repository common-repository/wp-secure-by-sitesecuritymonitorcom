<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');

ob_start();

	//$now_certificator_url =  get_option('siteurl')."/?page_id=".get_option('certificator_ee_page');	
	//$now_register_url =  get_option('siteurl')."/?page_id=".get_option('register_ee_page');	
	//$now_login_url =  get_option('siteurl')."/?page_id=".get_option('ee-login');	
?>	
<script type="text/javascript">
$(".password_test").passStrength({
	//userid:	"#user_id"
	shortPass: 		"top_shortPass",	//optional
	badPass:		"top_badPass",		//optional
	goodPass:		"top_goodPass",		//optional
	strongPass:		"top_strongPass",	//optional
	baseStyle:		"top_testresult",	//optional
	//userid:			"user_id",		//required override
	messageloc:		0			//before == 0 or after == 1	
});
</script>
<?php
	echo '<br />';
	
	echo 'Enter your password';
	echo '<br />';
	
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	
	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="60%" style="margin-left:5px;">';
	echo '<input type="text" id="eeCer"  class="password_test" name="eeCer" style="width:100%">';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	
	//echo '<div style="text-align:right;margin-right:60px;margin-top:5px;">';
	//echo '<input type="submit" id="eeRegister" name="eeRegister" value="Ready" style="background:#4682b4;color:#fff;" onclick=\'javascript:window.location.href="'.$now_register_url.'"\'>';	
	//echo '</div>';	
	
	echo '<br />';
	
?>