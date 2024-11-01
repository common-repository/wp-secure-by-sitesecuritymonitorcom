<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');

ob_start();

	//$now_certificator_url =  get_option('siteurl')."/?page_id=".get_option('certificator_ee_page');	
	//$now_register_url =  get_option('siteurl')."/?page_id=".get_option('register_ee_page');	
	//$now_login_url =  get_option('siteurl')."/?page_id=".get_option('ee-login');	
	if (isset($_POST['wpseSubmitAdminPassowrd']))
	{
?>
		<script type="text/javascript">
		self.parent.tb_remove();
		exit();
		</script>
<?php		
	}	
	echo '<br />';
	echo '<form id="formadminaccess" name="formadminaccess" method="POST" action="">';
	echo '<font color="Red"><b>How to use password to protect your wp-admin</b></font>';
	echo '<br />';
	
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	
	echo '<table width="100%">';
	echo '<tr>';
	echo '<td width="100%" style="margin:5px;">';
	echo "
	<font color='green'><b>Password Required - .htpasswd</b></font>
	<br />
Certainly the preferred option is to use password protection. This means you can still access your
admin directory from anywhere, however, it adds an additional security layer.
<br />
<br />
<font color='green'><b>The .htaccess file within WP-ADMIN should look like that:</b></font><br />
AuthUserFile /srv/www/user1/.htpasswd #this file should be outside your webroot.
<br />
AuthType Basic
<br />
AuthName \"Blog\"
<br />
require user youruser #making this username difficult to guess can help mitigate password
brute force attacks.
<br />
The .htpasswd file
<br />
<br />
This file should, as already mentioned, be placed somewhere out of your web directory, ideally one
folder above it. 
<br />
<br />
<font color='green'><b>To generate the password encrypted you can use:</b></font>
<br />
http://www.euronet.nl/~arnow/htpasswd/ but many others are available as well, simply input your
username and your plain password into this form and then write the outputted code into the
.HTPASSWD file, your file should now look like this:
<br />
<b>Yourusr:\$a983seJ/a25.Aa</b>
<br />
Copy .HTPASSWD file outside your webroot,Now test it to see if everything is working; if that isn't the case, rewrite the encrypted password.
	";
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	
	echo '<div style="text-align:right;margin-right:40px;margin-top:5px;">';
	echo '<input type="submit" id="wpseSubmitAdminPassowrd" name="wpseSubmitAdminPassowrd" value="OK I Know" style="background:#4682b4;color:#fff;"';
	echo '</div>';	
	echo '</form>';
	echo '<br />';
	
?>