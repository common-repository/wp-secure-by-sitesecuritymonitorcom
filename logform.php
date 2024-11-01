<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');

ob_start();

	//$now_certificator_url =  get_option('siteurl')."/?page_id=".get_option('certificator_ee_page');
	//$now_register_url =  get_option('siteurl')."/?page_id=".get_option('register_ee_page');
	//$now_login_url =  get_option('siteurl')."/?page_id=".get_option('ee-login');
	echo '<br />';
echo '<a href="http://www.sitesecuritymonitor.com" target="_newwindow"><img src="http://www.sitesecuritymonitor.com/Portals/78066/images//blue%20malware%20free%20button-resized-125.png" size=20%>WP-Secure by SSM - A free plugin from www.sitesecuritymonitor.com</A>';
	echo '<font color="green"><b>Security log files</b></font>';
	echo '<br />';

	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';

	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="100%" style="margin:5px;">';
	echo "
	<font color='black'><b>Running status </b></font>
	<br />
	fully success
	<br />
<br />
<font color='black'><b>old backup:</b></font><br />
all of your old files has been backuped at:
<br />

<br />
	";
	echo '</td>';
	echo '</tr>';
	echo '</table>';

	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	//echo '<div style="text-align:right;margin-right:15px;margin-top:5px;">';
	//echo '<input type="submit" id="eeRegister" name="eeRegister" value="OK" style="background:#4682b4;color:#fff;" onclick=\'javascript:window.location.href="'.$now_register_url.'"\'>';
	//echo '</div>';

	echo '<br />';

?>