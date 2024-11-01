<?php
@session_start();

require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');

ob_start();
	global $wpdb;

	$m_username = false;
	if (isset($_POST['textusername']))
	{
		$m_username = $wpdb->escape($_POST['textusername']);
	}
	
	$m_password = false;
	if (isset($_POST['textpassword']))
	{
		$m_password = $wpdb->escape($_POST['textpassword']);
	}

	$m_hosting = false;
	if (isset($_POST['texthosting']))
	{
		$m_hosting = $wpdb->escape($_POST['texthosting']);
	}

	$m_path = false ;
	if (isset($_POST['textpath']))
	{
		$m_path = $wpdb->escape($_POST['textpath']);
	}
	
	if (isset($_POST['textusername']))
	{
		if ((empty($m_path)) || (empty($m_hosting)) || (empty($m_password)) || (empty($m_username)) )
		{
			echo "sorry, please input your ftp information first<br />";
		}
		else 
		{
			$_SESSION['wpseftphost'] = $m_hosting;
			$_SESSION['wpseftppath'] = $m_path;
			$_SESSION['wpseftpusername'] = $m_username;
			$_SESSION['wpseftppassword'] = $m_password;
?>
			<script type="text/javascript">
			self.parent.tb_remove();
			exit();
			</script>
<?php
		}
	}
	echo '<form id="formftpsetting" name="formftpsetting" method="POST" action="">';
	echo '<br />';
	echo 'Ftp Information<I><font color="gray">(will not stored)</font></I>';
	echo '<br />';
	
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	
	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="30%" style="margin-left:3px;">';
	echo 'username:';
	echo '</td>';
	echo '<td width="70%" style="margin-left:5px;">';
	echo '<input type="text" id="textusername" name="textusername" >';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td width="30%" style="margin-left:3px;">';
	echo 'password:';
	echo '</td>';
	echo '<td width="70%" style="margin-left:5px;">';
	echo '<input type="text" id="textpassword" name="textpassword" >';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td width="30%" style="margin-left:3px;">';
	echo 'hosting:';
	echo '</td>';
	echo '<td width="70%" style="margin-left:5px;">';
	echo '<input type="text" id="texthosting" name="texthosting" >';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td width="30%" style="margin-left:3px;">';
	echo 'ftp path:';
	echo '</td>';
	echo '<td width="70%" style="margin-left:5px;">';
	echo '<input type="text" id="textpath" name="textpath" value="/" >';
	echo '</td>';
	echo '</tr>';	
	echo '</table>';
	
	echo '<div style="text-align:right;margin-right:50px;margin-top:5px;">';
	echo '<input type="submit" id="eeRegister" name="eeRegister" value="Ready" style="background:#4682b4;color:#fff;" onclick=\'javascript:window.location.href="'.$now_register_url.'"\'>';	
	echo '</div>';	
	
	echo '<br />';
	echo '</form>';
?>