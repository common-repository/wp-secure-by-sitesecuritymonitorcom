<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');

ob_start();
	global $wpdb;
	//$now_certificator_url =  get_option('siteurl')."/?page_id=".get_option('certificator_ee_page');	
	//$now_register_url =  get_option('siteurl')."/?page_id=".get_option('register_ee_page');	
	//$now_login_url =  get_option('siteurl')."/?page_id=".get_option('ee-login');	
	if (isset($_POST['wpseTextIP']))
	{
		$m_new = $wpdb->escape($_POST['wpseTextIP']);
		update_option('wpseAdminIP',$m_new);
?>
		<script type="text/javascript">
		self.parent.tb_remove();
		exit();
		</script>
<?php		
	}	
	echo '<br />';
	echo '<form id="formadminip" name="formadminip" method="POST" action="">';
	echo 'Enter your ip';
	echo '<br />';
	
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	
	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="60%" style="margin-left:5px;">';
	$m_new = get_option('wpseAdminIP');
	if (!(empty($m_new)))
	{
		echo '<input type="text" id="wpseTextIP"   name="wpseTextIP" value="'.$m_new.'" style="width:100%">';
	}
	else 
	{
		echo '<input type="text" id="wpseTextIP"   name="wpseTextIP" style="width:100%">';
	}
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	
	echo '<div style="text-align:right;margin-right:20px;margin-top:5px;">';
	echo '<input type="submit" id="wpseSubmitIP" name="wpseSubmitIP" value="Save it" style="background:#4682b4;color:#fff;" >';
	echo '</div>';	
	echo '</form>';
	echo '<br />';
	
?>