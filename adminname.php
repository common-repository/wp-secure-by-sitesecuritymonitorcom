<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');


ob_start();

	global $wpdb;
	//$now_certificator_url =  get_option('siteurl')."/?page_id=".get_option('certificator_ee_page');	
	//$now_register_url =  get_option('siteurl')."/?page_id=".get_option('register_ee_page');	
	//$now_login_url =  get_option('siteurl')."/?page_id=".get_option('ee-login');	
	if (isset($_POST['wpseUserName']))
	{
		$m_new = $wpdb->escape($_POST['wpseUserName']);
		update_option('wpseAdminNewUserName',$m_new);
?>
		<script type="text/javascript">
		self.parent.tb_remove();
		exit();
		</script>
<?php		
	}
	echo '<br />';
	echo '<form id="formnewadmin" name="formnewadmin" method="POST" action="">';
	echo 'Enter your new admin username';
	echo '<br />';
	
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	

	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="30%" style="margin-left:3px;">';
	echo 'username:';
	echo '</td>';
	echo '<td width="70%" style="margin-left:5px;">';
	echo '<input type="text" id="wpseUserName" name="wpseUserName" >';
	echo '</td>';
	echo '</tr>';
	echo '</table>';

	echo '<div style="text-align:right;margin-right:60px;margin-top:5px;">';
	echo '<input type="submit" id="wpseAdminName" name="wpseAdminName" value="Ready" style="background:#4682b4;color:#fff;" ';
	echo '</div>';	
	echo '</form>';
	echo '<br />';
	

?>