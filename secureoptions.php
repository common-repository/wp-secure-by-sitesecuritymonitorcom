<?php
@session_start();
ob_start();
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#myTable1").tablesorter();

});
</script>
<?php

	wpseKeepNoticePlace();

	echo '<br />';

	echo '<H3><I>Security log files</I></H3>';
	//echo '<br />';

	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
?>
	<table class="widefat" id="myTable1">
	<thead>
		<?php  // <th width="40%" style="color:#21759B;">Check Name</th>?>
		<th width="25%" style="color:#21759B;">Date</th>
		<th width="10%" style="color:#21759B;">status</th>
		<th width="65%" style="color:#21759B;">Details</th>
	</thead>
	<tbody>
	<?php
		global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
		$m_table = $table_prefix."wpselog";
		$m_sql = "select * from `".$m_table."` where `valid` = 'YES' order by errordate DESC";
		$m_result = $wpdb->get_results($m_sql,ARRAY_A);
		if (!(empty($m_result)))
		{
			foreach ($m_result as $m_now)
			{
				echo "<tr>";
				echo "<td>".$m_now['errordate']."</td>";
				if ($m_now['status'] == 'success')
				{
					echo "<td><I><Font color='gray'>".$m_now['status']."</Font></I></td>";
				}
				else
				{
					echo "<td><Font color='red'>".$m_now['status']."</Font></td>";
				}
				echo "<td>".$m_now['errorreason']."</td>";
				echo "</tr>";
			}
		}

	?>


<?php
/*
		<td><font color="gray">Sucess</font></td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/logform.php?height=200&width=350" title="System Log" class="thickbox"><I><font color="green" style="text-decoration:underline">Here</I></font></a></td>
		</tr>

		<tr>
		<td>plugins upgrade check</td>
		<td>2010-01-20</td>
		<td><font color="gray">Sucess</font></td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/logform.php?height=140&width=300" title="System Log" class="thickbox"><I><font color="green" style="text-decoration:underline">Here</I></font></a></td>
		</tr>


		<tr>
		<td>Remove error information on login-page</td>
		<td>2010-01-22</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>

		<tr>
		<td>Hide your wordpress version(frontend)</td>
		<td>2010-01-22</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>

		<tr>
		<td> Restrict wp-admin for only your IP</td>
		<td>2010-01-22</td>
		<td><font color="red">Fail</font></td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/logform.php?height=140&width=300" title="System Log" class="thickbox"><I><font color="green" style="text-decoration:underline">Here</I></font></a></td>
		</tr>

		<tr>
		<td>Change the default admin username</td>
		<td>2010-01-25</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>

		<tr>
		<td>Add index.php to plugin directory</td>
		<td>2010-01-25</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>

		<tr>
		<td>Remove plugin update information</td>
		<td>2010-01-25</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>

		<tr>
		<td>Restrict access to wp-config.php file</td>
		<td>2010-01-25</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>

		<tr>
		<td>Hide your wordpress version(dashboard)</td>
		<td>2010-01-25</td>
		<td><font color="gray">Sucess</font></td>
		<td><font color="gray">Null</font></td>
		</tr>
	*/

?>
	</tbody>
	</table>

<?php
	echo '<br />';


	echo '<br />';

?>