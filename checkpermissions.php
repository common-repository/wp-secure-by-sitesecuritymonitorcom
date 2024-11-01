<?php
require_once("../../../wp-blog-header.php");
require_once("../../../wp-settings.php");
require_once(ABSPATH.'/wp-admin/includes/media.php');

ob_start();

/*


<script type="text/javascript">
$(document).ready(function() { 
	$("#myTable").tablesorter();

});
</script>

*/

?>

<?php	
	if (isset($_POST['wpseCheckPer']))
	{
?>
		<script type="text/javascript">
		self.parent.tb_remove();
		exit();
		</script>
<?php		
	}	
	//$now_certificator_url =  get_option('siteurl')."/?page_id=".get_option('certificator_ee_page');	
	//$now_register_url =  get_option('siteurl')."/?page_id=".get_option('register_ee_page');	
	//$now_login_url =  get_option('siteurl')."/?page_id=".get_option('ee-login');	
	echo '<br />';
	echo '<form id="formadminpermissions" name="formadminpermissions" method="POST" action="">';
	echo '<font color="Red"><b>The result of permissions check</b></font>';
	echo '<br />';
	
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
?>	
	<table class="widefat" id="myTable">
	<thead>
		<th width="40%" style="color:#21759B;text-align:left;align:left;">Folder Name</th>
		<th width="25%" style="color:#21759B;text-align:left;align:left;">Needed Chmod</th>
		<th width="25%" style="color:#21759B;text-align:left;align:left;">Current Chmod</th>
		<th width="10%" style="color:#21759B;text-align:left;align:left;">Actions</th>
	</thead>
	<tbody>
		<tr>
		<td><?php echo "Root Directory" //echo ABSPATH;  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH).'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>

		<tr>
		<td><?php echo "/wp-includes/"; //echo ABSPATH."/wp-includes/";  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH."/wp-includes/"))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-includes/").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
		
		<tr>
		<td><?php echo "/.htaccess"; //echo ABSPATH."/.htaccess";  ?></td>
		<td>0644</td>
		<?php 
		if ('0644' == wpseCheckPermissions(ABSPATH."/.htaccess"))
		{
			echo '<td><font color="Green">0644</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/.htaccess").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
		
		<tr>
		<td><?php echo "/wp-admin/index.php"; //echo ABSPATH."/wp-admin/index.php";  ?></td>
		<td>0644</td>
		<?php 
		if ('0644' == wpseCheckPermissions(ABSPATH."/wp-admin/index.php"))
		{
			echo '<td><font color="Green">0644</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-admin/index.php") .'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>

		<tr>
		<td><?php echo "/wp-admin/js/"; //echo ABSPATH."/wp-admin/js/";  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH."/wp-admin/js/"))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-admin/js/").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
				
		<tr>
		<td><?php echo "/wp-content/themes/"; //echo ABSPATH."/wp-content/themes/";  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH."/wp-content/themes/"))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-content/themes/").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
		
		<tr>
		<td><?php echo "/wp-content/plugins/"; //echo ABSPATH."/wp-content/plugins/";  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH."/wp-content/plugins/"))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-content/plugins/").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
		
		<tr>
		<td><?php echo "/wp-admin/"; //echo ABSPATH."/wp-admin/";  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH."/wp-admin/"))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-admin/").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
		
		<tr>
		<td><?php echo "/wp-content/"; //echo ABSPATH."/wp-content/";  ?></td>
		<td>0755</td>
		<?php 
		if ('0755' == wpseCheckPermissions(ABSPATH."/wp-content/"))
		{
			echo '<td><font color="Green">0755</font></td>';
			echo '<td></td>';
		}
		else 
		{
			echo '<td><font color="Red">'.wpseCheckPermissions(ABSPATH."/wp-content/").'</font></td>';
			echo '<td><span id="label-wordpress-upgrade">[<font size="+1" color="green"><B>?</B></font>]</span></td>';
		}
		?>
		</tr>
		
	</tbody>
	</table>
	
<?php		
	echo '<br />';
	echo '<div style="text-align:right;margin-right:40px;margin-top:5px;">';
	echo '<input type="submit" id="wpseCheckPer" name="wpseCheckPer" value="OK I Know" style="background:#4682b4;color:#fff;"';
	echo '</div>';	
	echo '</form>';
	echo '<br />';
	
	
	
function wpseCheckPermissions($path)
{
    clearstatcache();
    return substr(sprintf(".%o.", fileperms($path)), -4);
    
}
	
	
	
?>