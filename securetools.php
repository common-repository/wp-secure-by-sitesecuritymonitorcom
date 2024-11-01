<?php
@session_start();

wpSecureDoor();


function wpSecureDoor()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();

	//echo '<div class="wrap"><h2></h2><div class="updated fade" id="message"><p>Sorry, You must setting your Ftp information first!</p></div></div>' . "\n";
	//!!! echo '<div class="wrap"><h2></h2><div class="updated fade" id="message"><p>Befor any action, You must finish <font size="+1" ><I><a href="">System Setting</a></I></font> first!</p></div></div>' . "\n";
	echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs').tabs({cookie:{ expires: 30 }})});</script>";
	echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs > ul > li').css('list-style','none')});</script>";

	//show layout
	wpseKeepNoticePlace();
	echo '<br />';
	echo '<a href="http://www.sitesecuritymonitor.com" target="_newwindow"><img src="http://www.sitesecuritymonitor.com/Portals/78066/images//blue%20malware%20free%20button-resized-125.png" size=20%><BR>WP-Secure by SSM - <BR>A free plugin from www.sitesecuritymonitor.com</A><P>';
	echo '<div id="wpsecureadmintabs">'; // all content begin from here

	echo '<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id = "tabs">';

	echo '<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">';
	echo '<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">';
	echo '<a href="#tabs-1"><span>Module Upgrade Checking</span></a>';
	echo '</li>';
	echo '<li class="ui-state-default ui-corner-top">';
	echo '<a href="#tabs-2"><span>Remove Vulnerabilities</span></a>';
	echo '</li>';

	echo '<li class="ui-state-default ui-corner-top">';
	echo '<a href="#tabs-3"><span><center>Enhance Security<BR>Posture</center></span></a>';
	echo '</li>';


	echo '<li class="ui-state-default ui-corner-top">';
	echo '<a href="#tabs-4"><span>Undo</span></a>';
	echo '</li>';

	echo '<li class="ui-state-default ui-corner-top">';
	echo '<a href="#tabs-5"><span>Security Seal</span></a>';
	echo '</li>';

	echo '</ul>';

	echo '<div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	wpSecureUpgard();
	echo "</div>";

	echo '<div id="tabs-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	wpReduceV();
	echo "</div>";

	echo '<div id ="tabs-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	wpSecureEnhance();
	echo '</div>';

	echo "<div id='tabs-4' class='ui-tabs-panel ui-widget-content ui-corner-bottom'>";
	wpSecureUndo();
	echo "</div>";

	echo "<div id='tabs-5' class='ui-tabs-panel ui-widget-content ui-corner-bottom'>";
	wpSecureFreeScan();
	echo "</div>";
	echo '</div>'; //rp_wholeContent


	echo '</div>'; //realLayout
}

function wpSecureUpgard()
{
	// running statu
?>
	<script type='text/javascript'>
	//$(document).ready
	//{
		//wpseTips('#label-wordpress-upgrade','Before we do this,we suggest you do a full backup or at least do a database backup.');
	//}
	function showProgress(now_id,now_status)
	{
		var progress_key = '4b64a701d9906';
		$(document).ready(function()
		{
			$("#pb1").progressBar(now_id,{callback:function(data)
			{
				if (data.running_value == data.value)
				{
					jQuery('#showUpgradBar').text(now_status);
				}
			}});
		});
	}
	</script>

<?php // this is show options platform ?>


<script type="text/javascript">
$(document).ready(function()
{
	$("#myTable").tablesorter();
    $("#myTable").tablesorter(
    {
        // pass the headers argument and assing a object
        //headers: {
            // assign the secound column (we start counting zero)
            //1: {
                // disable it by setting the property sorter to false
                //sorter: true
            //},
            // assign the third column (we start counting zero)
            //2: {
                // disable it by setting the property sorter to false
                //sorter: true
            //}
        //}
    });
});
</script>


<?php



	if ($_POST['wpseHiddenUpgrade'] == 'YES')
	{
		if ($_POST['check-wordpress-upgrade'] == 'YES')
		{
			$m_wpseNeedUpgrade = get_preferred_from_update_core();
			if (!isset($m_wpseNeedUpgrade->response) || $m_wpseNeedUpgrade->response != 'upgrade')
			{
				$p_message = 'You have the newest wordpress version.';
				wpseNotice($p_message,"YES","fail");
				return false;
			}
			else
			{
?>



	<div class="wrap" id = "wpsepbl">
	<div id="dashboard-widgets-wrap">
	<div id="dashboard-widgets" class="metabox-holder">
	<div id="post-body">
	<div id="dashboard-widgets-main-content">
	<div class="postbox-container" style="width:100%;">
	<div class="postbox">
	<h3 class='hndle'><span>Runing Report <I><font color="Gray"> (do not stop the action)</font></I><span></h3>
	<div class="inside" style='padding-left:5px;'>
	<br />
	<br />
	<span class="progressBar" id="pb1"></span><span id="showUpgradBar" style="margin-left:20px; color:green;font-style:italic;">Begin upgrading your wordpress files....</span>

	<br />
	<br />

	<br />
	</div> <?php // inside  ?>
	</div> <?php // postbox ?>
	</div> <?php // postbox-container  ?>
	</div> <?php // dashboard-widgets-main-content  ?>
	</div> <?php // post-body  ?>
	</div> <?php // dashboard-widgets  ?>
	</div> <?php // dashboard-widgets-wrap  ?>
	</div> <?php //  wrap ?>




	<br />
	<br />
<?php
				wpseWordpressUpgradeNow();
			}

		}

		if ($_POST['check-plugin-upgrade'] == 'YES')
		{

			wpseCheckPluginsUpgradeNow();
		}
	}



?>

<form id="checkboxDemo" action="" method="post">

	<I>Wordpress Version and Plugin Upgrade Check </I>
	<table class="widefat">
	<thead>
		<th>Checking Name</th>
		<th>Last Time</th>
		<th>Check Options</th>
		<th>Tips</th>
	</thead>
	<tbody>
		<tr>
		<td>
			<label for="check-wordpress-upgrade" tabindex="1">
			upgrade to the last version of wordpress &nbsp;&nbsp;&nbsp;&nbsp;
			</label>
			<input type="checkbox" id="check-wordpress-upgrade" name="check-wordpress-upgrade" class="prettyCheckbox" value="YES" />
		</td>
		<td>2010-01-11</td>
		<td>Ftp <a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/ftppassword.php?keepThis=true&TB_iframe=true&height=220&width=300" title="Ftp username and password needed" class="thickbox"><I><font color="Red" size="+1" style="text-decoration:underline">setting</font></I></a> Needed</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="label-wordpress-upgrade">[<font size="+1" color="red"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="check-plugin-upgrade" tabindex="2">
			check plugins that are out of date &nbsp;&nbsp;&nbsp;&nbsp;
			</label>
			<input type="checkbox" id="check-plugin-upgrade" name="check-plugin-upgrade" class="prettyCheckbox" value="YES" />
		</td>
		<td>2010-01-11</td>
		<td><font color="Gray"><I>N/A</I></font></td>
		<td></td>
		</tr>
	</tbody>
	</table>

	<br />
	<div style="align:right;text-align:right;">
	<input type="hidden" id="wpseHiddenUpgrade" name="wpseHiddenUpgrade" value="YES">
	<input type="submit" id="wpseSubmitUpgrade" name="wpseSubmitUpgrade" value="Check Now" style="background:#4682b4;color:#fff; margin-right:20px;">
	</div>
	<br />
</form>

<script type='text/javascript'>
	$(document).ready
	{
		wpseTips('#label-wordpress-upgrade','Before we do this,we suggest you do a full backup or at least do a database backup.And if you had activated "Hide your wordpress version(dashboard)" option, please unselect it temporarily');
	}
</script>
<?php

}

function wpReduceV()
{
	if ($_POST['wpseHiddenReduce'] == 'YES')
	{

		if ($_POST['removes-error-login-page'] == 'YES')
		{
			update_option('wpseHiddenErrorOnLogin','YES');
			wpseLog("Active option:remove error information on login-page","success");
		}
		else
		{
			update_option('wpseHiddenErrorOnLogin','NO');
			wpseLog("Deactive option:remove error information on login-page","success");
		}


		if ($_POST['hidden-wp-version'] == 'YES')
		{
			update_option('wpseHiddenWpVersionFrontend','YES');
			wpseLog("Active option:Hide your wordpress version(frontend)","success");
		}
		else
		{
			update_option('wpseHiddenWpVersionFrontend','NO');
			wpseLog("Deactive option:Hide your wordpress version(frontend)","success");
		}

		if ($_POST['Hide-your-wordpress-version-dashboard'] == 'YES')
		{
			update_option('wpseHiddenWpVersionDashboard','YES');
			wpseLog("Active option:Hide your wordpress version(dashboard)","success");
		}
		else
		{
			update_option('wpseHiddenWpVersionDashboard','NO');
			wpseLog("Deactive option:Hide your wordpress version(dashboard)","success");
		}

		if ($_POST['removes-Really-Simple-Discovery'] == 'YES')
		{
			update_option('wpseHiddenWpRSDFront','YES');
			wpseLog("Active option:remove really simple discovery","success");
		}
		else
		{
			update_option('wpseHiddenWpRSDFront','NO');
			wpseLog("Deactive option:remove really simple discovery","success");
		}


		if ($_POST['removes-Windows-Live-Writer'] == 'YES')
		{
			update_option('wpseHiddenWpWindowLiveWriter','YES');
			wpseLog("Active option:remove Windows Live Writer","success");
		}
		else
		{
			update_option('wpseHiddenWpWindowLiveWriter','NO');
			wpseLog("Deactive option:remove Windows Live Writer","success");
		}

		if ($_POST['remove-core-update-information'] == 'YES')
		{
			update_option('wpseHiddenCoreUpdate','YES');
			wpseLog("Active option:remove core update information","success");
		}
		else
		{
			update_option('wpseHiddenCoreUpdate','NO');
			wpseLog("Deactive option:remove core update information","success");
		}

		if ($_POST['remove-plugin-update-information'] == 'YES')
		{
			update_option('wpseHiddenPluginUpdate','YES');
			wpseLog("Active option:remove plugin update information","success");
		}
		else
		{
			update_option('wpseHiddenPluginUpdate','NO');
			wpseLog("Deactive option:remove plugin update information","success");
		}

		if ($_POST['remove-theme-update-informationfor'] == 'YES')
		{
			update_option('wpseHiddenThemeUpdate','YES');
			wpseLog("Active option:remove theme update informationfor","success");
		}
		else
		{
			update_option('wpseHiddenThemeUpdate','NO');
			wpseLog("Deactive option:remove theme update informationfor","success");
		}

		$p_message = "Options Selected and Executed... Complete";
		wpseNotice($p_message,"YES","success");
	}
?>
<?php
/*
	<script type='text/javascript'>
	function showProgress(now_id,now_status)
	{
		var progress_key = '4b64a701d9906';
		$(document).ready(function()
		{
			$("#pb1").progressBar(now_id,{callback:function(data)
			{
				if (data.running_value == data.value)
				{
					jQuery('#showUpgradBar').text(now_status);
				}

			}});

		});
	}
	</script>

	<div class="wrap">
	<div id="dashboard-widgets-wrap">
	<div id="dashboard-widgets" class="metabox-holder">
	<div id="post-body">
	<div id="dashboard-widgets-main-content">
	<div class="postbox-container" style="width:100%;">
	<div class="postbox">
	<h3 class='hndle'><span>Runing Report <I><font color="Gray"> (do not stop the action)</font></I><span></h3>
	<div class="inside" style='padding-left:5px;'>
	<br />
	<br />
	<span class="progressBar" id="pb1"></span><span id="showUpgradBar" style="margin-left:20px; color:green;font-style:italic;">Backup old wordpress files....</span>
	<script type='text/javascript'>
	//jQuery('#showUpgradBar').text('Backup old wordpress files....');

	//showProgress(3,'Backup old wordpress files....');
	//showProgress(10,'Setup password protect for backuped old wordpress fiels....');
	//showProgress(20,'Download the last version of wordpress zip files....');
	//showProgress(60,'Unzip the wordpress files....');
	//showProgress(70,'Overwrite the wordpress files....');
	//showProgress(90,'Check if plugins are out of the date....');
	showProgress(100,'All Vulnerability Options Finished....');
	//jQuery('#showUpgradBar').text('Setup password protect for backuped old wordpress fiels...');
	</script>
	<br />
	<br />

	<br />
	</div> <?php // inside  ?>
	</div> <?php // postbox ?>
	</div> <?php // postbox-container  ?>
	</div> <?php // dashboard-widgets-main-content  ?>
	</div> <?php // post-body  ?>
	</div> <?php // dashboard-widgets  ?>
	</div> <?php // dashboard-widgets-wrap  ?>
	</div> <?php //  wrap ?>
	*/
	?>
<form id="checkboxDemo" action="" method="post">

	<I>Reduce Vulnerability Risks From Your Wordpress Blog</I>
	<table class="widefat">
	<thead>
		<th width="40%">Checking Name</th>
		<th width="10%">Status</th>
		<th width="40%">Checking Options</th>
		<th width="10%">Why</th>
	</thead>
	<tbody>
		<tr>
		<td>
			<label for="removes-error-login-page" tabindex="1">
			Remove error information on login-page &nbsp;&nbsp;&nbsp;&nbsp;
			</label>
			<?php
			$m_wpseHiddenErrorOnLogin = get_option('wpseHiddenErrorOnLogin');
			if ("YES" == $m_wpseHiddenErrorOnLogin)
			{
				echo '<input type="checkbox" id="removes-error-login-page" name="removes-error-login-page" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="removes-error-login-page" name="removes-error-login-page" class="prettyCheckbox" value="YES" />';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenErrorOnLogin == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-removes-error-login-page">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="hidden-wp-version" tabindex="2">
			Hide your wordpress version(frontend) &nbsp;&nbsp;&nbsp;&nbsp;
			</label>
			<?php
				$m_wpseHiddenWpVersionFrontend = get_option('wpseHiddenWpVersionFrontend');
				if ($m_wpseHiddenWpVersionFrontend == 'YES')
				{
					echo '<input type="checkbox" id="hidden-wp-version" name="hidden-wp-version" class="prettyCheckbox" value="YES" checked/>';
				}
				else
				{
					echo '<input type="checkbox" id="hidden-wp-version" name="hidden-wp-version" class="prettyCheckbox" value="YES" />';
				}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenWpVersionFrontend == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-hidden-wp-version">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Hide-your-wordpress-version-dashboard" tabindex="7">
			Hide your wordpress version(dashboard)
			</label>
			<?php
			$m_wpseHiddenWpVersionDashboard = get_option('wpseHiddenWpVersionDashboard');
			if ("YES" == $m_wpseHiddenWpVersionDashboard)
			{
				echo '<input type="checkbox" id="Hide-your-wordpress-version-dashboard" name="Hide-your-wordpress-version-dashboard" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Hide-your-wordpress-version-dashboard" name="Hide-your-wordpress-version-dashboard" class="prettyCheckbox" value="YES"/>';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenWpVersionDashboard == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Hide-your-wordpress-version-dashboard">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>


		<tr>
		<td>
			<label for="removes-Really-Simple-Discovery" tabindex="3">
			Remove really simple discovery
			</label>
			<?php
			$m_wpseHiddenWpRSDFront = get_option('wpseHiddenWpRSDFront');
			if ("YES" == $m_wpseHiddenWpRSDFront)
			{
				echo '<input type="checkbox" id="removes-Really-Simple-Discovery" name="removes-Really-Simple-Discovery" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="removes-Really-Simple-Discovery" name="removes-Really-Simple-Discovery" class="prettyCheckbox" value="YES"/>';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenWpRSDFront == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-removes-Really-Simple-Discovery">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="removes-Windows-Live-Writer" tabindex="4">
			Remove Windows Live Writer
			</label>
			<?php
			$m_wpseHiddenWpWindowLiveWriter = get_option('wpseHiddenWpWindowLiveWriter');
			if ("YES" == $m_wpseHiddenWpWindowLiveWriter)
			{
				echo '<input type="checkbox" id="removes-Windows-Live-Writer" name="removes-Windows-Live-Writer" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="removes-Windows-Live-Writer" name="removes-Windows-Live-Writer" class="prettyCheckbox" value="YES" />';
			}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenWpWindowLiveWriter == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-removes-Windows-Live-Writer">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="remove-core-update-information" tabindex="5">
			Remove core update information
			</label>

			<?php
			$m_wpseHiddenCoreUpdate = get_option('wpseHiddenCoreUpdate');
			if ("YES" == $m_wpseHiddenCoreUpdate)
			{
				echo '<input type="checkbox" id="remove-core-update-information" name="remove-core-update-information" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="remove-core-update-information" name="remove-core-update-information" class="prettyCheckbox" value="YES" />';
			}
			?>


		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenCoreUpdate == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-remove-core-update-information">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="remove-plugin-update-information" tabindex="6">
			Remove plugin update information
			</label>
			<?php
			$m_wpseHiddenPluginUpdate = get_option('wpseHiddenPluginUpdate');
			if ("YES" == $m_wpseHiddenPluginUpdate)
			{
				echo '<input type="checkbox" id="remove-plugin-update-information" name="remove-plugin-update-information" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="remove-plugin-update-information" name="remove-plugin-update-information" class="prettyCheckbox" value="YES" />';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenPluginUpdate == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-remove-plugin-update-information">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="remove-theme-update-informationfor" tabindex="7">
			Remove theme update information
			</label>
			<?php
			$m_wpseHiddenThemeUpdate = get_option('wpseHiddenThemeUpdate');
			if ("YES" == $m_wpseHiddenThemeUpdate)
			{
				echo '<input type="checkbox" id="remove-theme-update-informationfor" name="remove-theme-update-informationfor" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="remove-theme-update-informationfor" name="remove-theme-update-informationfor" class="prettyCheckbox" value="YES" />';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseHiddenThemeUpdate == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-remove-theme-update-informationfor">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>


	</tbody>
	</table>

	<br />
	<div style="align:right;text-align:right;">
	<input type="hidden" id="wpseHiddenReduce" name ="wpseHiddenReduce" value="YES">
	<input type="submit" id="wpseSubmitReduce" name="wpseSubmitReduce" value="Reduce Now" style="background:#4682b4;color:#fff; margin-right:20px;">
	</div>
	<br />
</form>
<script type="text/javascript">
	$(document).ready
	{
		wpseTips('#tips-removes-error-login-page','Remove error informations from login page to block manual detection.');
		wpseTips('#tips-hidden-wp-version','Hide your wordpress versions from fronend area.');
		wpseTips('#tips-Hide-your-wordpress-version-dashboard','So the users who are not admin can not get your wordpress version at dashboard.');
		wpseTips('#tips-removes-Really-Simple-Discovery','Remove Really Simple Discovery(RSD) URL information from your frontend.');
		wpseTips('#tips-removes-Windows-Live-Writer','Remove Windows Live Writer URL information from your frontend.');
		wpseTips('#tips-remove-core-update-information','Remove core update information.');
		wpseTips('#tips-remove-plugin-update-information','Remove plugin update information.');
		wpseTips('#tips-remove-theme-update-informationfor','Remove theme update information.');
	}
</script>
<?php
}

function wpSecureEnhance()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
?>
<?php
/*
	<script type='text/javascript'>
	function showProgress(now_id,now_status)
	{
		var progress_key = '4b64a701d9906';
		$(document).ready(function()
		{
			$("#pb1").progressBar(now_id,{callback:function(data)
			{
				if (data.running_value == data.value)
				{
					jQuery('#showUpgradBar').text(now_status);
				}

			}});

		});
	}
	</script>

	<div class="wrap">
	<div id="dashboard-widgets-wrap">
	<div id="dashboard-widgets" class="metabox-holder">
	<div id="post-body">
	<div id="dashboard-widgets-main-content">
	<div class="postbox-container" style="width:100%;">
	<div class="postbox">
	<h3 class='hndle'><span>Runing Report <I><font color="Gray"> (do not stop the action)</font></I><span></h3>
	<div class="inside" style='padding-left:5px;'>
	<br />
	<br />
	<span class="progressBar" id="pb1"></span><span id="showUpgradBar" style="margin-left:20px; color:green;font-style:italic;">Backup old wordpress files....</span>
	<script type='text/javascript'>
	//jQuery('#showUpgradBar').text('Backup old wordpress files....');

	//showProgress(3,'Backup old wordpress files....');
	//showProgress(10,'Setup password protect for backuped old wordpress fiels....');
	//showProgress(20,'Download the last version of wordpress zip files....');
	//showProgress(60,'Unzip the wordpress files....');
	//showProgress(70,'Overwrite the wordpress files....');
	//showProgress(90,'Check if plugins are out of the date....');
	showProgress(100,'All Vulnerability Options Finished....');
	//jQuery('#showUpgradBar').text('Setup password protect for backuped old wordpress fiels...');
	</script>
	<br />
	<br />

	<br />
	</div> <?php // inside  ?>
	</div> <?php // postbox ?>
	</div> <?php // postbox-container  ?>
	</div> <?php // dashboard-widgets-main-content  ?>
	</div> <?php // post-body  ?>
	</div> <?php // dashboard-widgets  ?>
	</div> <?php // dashboard-widgets-wrap  ?>
	</div> <?php //  wrap ?>
	*/

	if (isset($_POST['wpseHiddenEnhance']))
	{
		if ($_POST['Add-index-php-for-plugin-directory'] == 'YES')
		{
			update_option('wpseAddIndexForPluginDirectory','YES');
			wpseLog("Active option:add index.php to plugin directory","success");
		}
		else
		{
			update_option('wpseAddIndexForPluginDirectory','NO');
			wpseLog("Deactive option:add index.php to plugin directory","success");
		}



		if ($_POST['Hide-your-plugins-folder'] == 'YES')
		{
			update_option('wpseHideYourPluginsFolder','YES');
			wpseLog("Active option:hide your plugins folder","success");
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/plugins/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
 				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
				if ((strpos($m_contentPluginHtacces,"Options -Indexes")) === false)
				{
					@fclose($m_hiddenPluginHandle);
					$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
					if ($m_hiddenPluginHandle)
					{
						$m_contentPluginHtacces = str_replace("Options -Indexes","",$m_contentPluginHtacces);
						if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
						{
							$p_message = 'Write "Options -Indexes" to .htaccess failed.';
							wpseNotice($p_message,"YES","fail");
							update_option('wpseRestrictWpconfig','NO');
						}
					}
				}
				@fclose($m_hiddenPluginHandle);
 			}
 			else
 			{
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					@fwrite($m_hiddenPluginHandle,"\nOptions -Indexes");
					@fclose($m_indexPluginHandle);
				}
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}
		else
		{
			update_option('wpseHideYourPluginsFolder','NO');
			wpseLog("Deactive option:hide your plugins folder","success");
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/plugins/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
 				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
				@fclose($m_hiddenPluginHandle);
				if ((strpos($m_contentPluginHtacces,"Options -Indexes")) === false)
				{
				}
				else
				{
					$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
					$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
					if ($m_hiddenPluginHandle)
					{
						if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
						{
							$p_message = 'Write "Options -Indexes" to .htaccess failed.';
							wpseNotice($p_message,"YES","fail");
							update_option('wpseRestrictWpconfig','NO');
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
				//@unlink($m_wpseHideYourPluginsDirectory);
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}



		if ($_POST['Restrict-access-to-wp-config'] == 'YES')
		{
			$m_newRestrictConfig = "\n<files wp-config.php>\nOrder deny,allow\ndeny from all\n</files>";
			update_option('wpseRestrictWpconfig','YES');
			wpseLog("Active option:restrict access to wp-config.php file","success");
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				if ($m_hiddenPluginHandle)
				{
					$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
					if ((strpos($m_contentPluginHtacces,"files wp-config.php")) === false)
					{
						@fclose($m_hiddenPluginHandle);
						$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'a');
						if ($m_hiddenPluginHandle)
						{
							if (false === @fwrite($m_hiddenPluginHandle,$m_newRestrictConfig))
							{
								$p_message = 'Write wp-config protect action to .htaccess failed.';
								wpseNotice($p_message,"YES","fail");
								update_option('wpseRestrictWpconfig','NO');
							}
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
 			}
 			else
 			{
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					@fwrite($m_hiddenPluginHandle,$m_newRestrictConfig);
					@fclose($m_indexPluginHandle);
				}
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}
		else
		{
			update_option('wpseRestrictWpconfig','NO');
			wpseLog("Deactive option:hide your plugins folder","success");
			$m_newRestrictConfig = "\n<files wp-config.php>\nOrder deny,allow\ndeny from all\n</files>";
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
 				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
				@fclose($m_hiddenPluginHandle);
				if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
				{

				}
				else
				{
					//$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
					$m_oldRestrictConfig = " ";
					$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
					$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
					if ($m_hiddenPluginHandle)
					{
						if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
						{
							$p_message = 'Remove wp-config protect to .htaccess failed.';
							wpseNotice($p_message,"YES","fail");
							update_option('wpseRestrictWpconfig','NO');
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
				//@unlink($m_wpseHideYourPluginsDirectory);
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}

		if ($_POST['Restrict-access-to-wp-includes'] == 'YES')
		{
			//$m_newRestrictConfig = "\nOrder Allow,Deny\nDeny from all\nAllow from all\n";
			$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\n";
			$m_newRestrictConfig .= '<Files ~ "\.(css|jpe?g|png|gif|js)$">'."\n";
			$m_newRestrictConfig .= 'Allow from all'."\n";
			$m_newRestrictConfig .= '</Files>'."\n";
			//Allow from $m_new\n";
			update_option('wpseRestrictWpIncludes','YES');
			wpseLog("Active option:restrict access to wp-includes folder","success");
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-includes/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				if ($m_hiddenPluginHandle)
				{
					$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
					if ((strpos($m_contentPluginHtacces,"Order Allow")) === false)
					{
						@fclose($m_hiddenPluginHandle);
						$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'a');
						if ($m_hiddenPluginHandle)
						{
							if (false === @fwrite($m_hiddenPluginHandle,$m_newRestrictConfig))
							{
								$p_message = 'Write wp-includes protect action to .htaccess failed.';
								wpseNotice($p_message,"YES","fail");
								update_option('wpseRestrictWpIncludes','NO');
							}
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
 			}
 			else
 			{
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					@fwrite($m_hiddenPluginHandle,$m_newRestrictConfig);
					@fclose($m_indexPluginHandle);
				}
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}
		else
		{
			update_option('wpseRestrictWpIncludes','NO');
			wpseLog("Deactive option:restrict access to wp-includes folder","success");
			//$m_newRestrictConfig = "\nOrder Allow,Deny\nDeny from all\nAllow from all\n";
			$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\n";
			$m_newRestrictConfig .= '<Files ~ "\.(css|jpe?g|png|gif|js)$">'."\n";
			$m_newRestrictConfig .= 'Allow from all'."\n";
			$m_newRestrictConfig .= '</Files>'."\n";
			//Allow from $m_new\n";
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-includes/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
 				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
				@fclose($m_hiddenPluginHandle);
				if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
				{

				}
				else
				{
					//$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
					$m_oldRestrictConfig = " ";
					$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
					$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
					if ($m_hiddenPluginHandle)
					{
						if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
						{
							$p_message = 'Remove wp-includes protect to .htaccess failed.';
							wpseNotice($p_message,"YES","fail");
							update_option('wpseRestrictWpIncludes','NO');
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
				//@unlink($m_wpseHideYourPluginsDirectory);
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}


		if ($_POST['Restrict-access-to-wp-content-folder'] == 'YES')
		{
			//$m_newRestrictConfig = "\nOrder Allow,Deny\nDeny from all\nAllow from all\n";
			$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\n";
			$m_newRestrictConfig .= '<Files ~ "\.(css|jpe?g|png|gif|js)$">'."\n";
			$m_newRestrictConfig .= 'Allow from all'."\n";
			$m_newRestrictConfig .= '</Files>'."\n";
			//Allow from $m_new\n";
			update_option('wpseRestrictWpContent','YES');
			wpseLog("Active option:restrict access to wp-content folder","success");
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				if ($m_hiddenPluginHandle)
				{
					$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
					if ((strpos($m_contentPluginHtacces,"Order Allow")) === false)
					{
						@fclose($m_hiddenPluginHandle);
						$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'a');
						if ($m_hiddenPluginHandle)
						{
							if (false === @fwrite($m_hiddenPluginHandle,$m_newRestrictConfig))
							{
								$p_message = 'Write wp-content protect action to .htaccess failed.';
								wpseNotice($p_message,"YES","fail");
								update_option('wpseRestrictWpContent','NO');
							}
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
 			}
 			else
 			{
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					@fwrite($m_hiddenPluginHandle,$m_newRestrictConfig);
					@fclose($m_indexPluginHandle);
				}
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}
		else
		{
			update_option('wpseRestrictWpContent','NO');
			wpseLog("Deactive option:restrict access to wp-content folder","success");
			//$m_newRestrictConfig = "\nOrder Allow,Deny\nDeny from all\nAllow from all\n";
			$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\n";
			$m_newRestrictConfig .= '<Files ~ "\.(css|jpe?g|png|gif|js)$">'."\n";
			$m_newRestrictConfig .= 'Allow from all'."\n";
			$m_newRestrictConfig .= '</Files>'."\n";
			//Allow from $m_new\n";
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
 				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
				@fclose($m_hiddenPluginHandle);
				if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
				{

				}
				else
				{
					//$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
					$m_oldRestrictConfig = " ";
					$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
					$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
					if ($m_hiddenPluginHandle)
					{
						if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
						{
							$p_message = 'Remove wp-content protect to .htaccess failed.';
							wpseNotice($p_message,"YES","fail");
							update_option('wpseRestrictWpContent','NO');
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
				//@unlink($m_wpseHideYourPluginsDirectory);
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}

		$m_new = get_option('wpseAdminIP');
		if (($_POST['Restrict-wp-admin-for-only-your-Ip'] == 'YES') && (empty($m_new)))
		{
			$p_message = 'You must input admin ip first, thanks.';
			wpseNotice($p_message,"YES","fail");
			update_option('wpseRestrictWpAdminIP','NO');
		}

		if (($_POST['Restrict-wp-admin-for-only-your-Ip'] == 'YES') && (!(empty($m_new))))
		{
			$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\nAllow from $m_new\n";
			update_option('wpseRestrictWpAdminIP','YES');
			wpseLog("Active option:restrict wp-admin for only your Ip","success");
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-admin/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				if ($m_hiddenPluginHandle)
				{
					$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
					if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
					{
						@fclose($m_hiddenPluginHandle);
						$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'a');
						if ($m_hiddenPluginHandle)
						{
							if (false === @fwrite($m_hiddenPluginHandle,$m_newRestrictConfig))
							{
								$p_message = 'Write wp-admin ip protect action to .htaccess failed.';
								wpseNotice($p_message,"YES","fail");
								update_option('wpseRestrictWpAdminIP','NO');
							}
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
 			}
 			else
 			{
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					@fwrite($m_hiddenPluginHandle,$m_newRestrictConfig);
					@fclose($m_indexPluginHandle);
				}
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}
		else
		{
			update_option('wpseRestrictWpAdminIP','NO');
			wpseLog("Deactive option:restrict wp-admin for only your Ip","success");
			$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\nAllow from $m_new\n";
	 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-admin/.htaccess";
 			if ((is_file($m_wpseHideYourPluginsDirectory)))
 			{
 				@chmod($m_wpseHideYourPluginsDirectory, 0755);
 				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
				$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
				@fclose($m_hiddenPluginHandle);
				if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
				{

				}
				else
				{
					//$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
					$m_oldRestrictConfig = " ";
					$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
					$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
					if ($m_hiddenPluginHandle)
					{
						if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
						{
							$p_message = 'Remove wp-admin ip protect to .htaccess failed.';
							wpseNotice($p_message,"YES","fail");
							update_option('wpseRestrictWpAdminIP','NO');
						}
					}
					@fclose($m_hiddenPluginHandle);
				}
				//@unlink($m_wpseHideYourPluginsDirectory);
 			}
 			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}






		//!!! this must be at the end, because will force user to logout.
		if (isset($_POST['Change-the-admin-username']))
		{
			$m_wpseAdminNewUserName = get_option('wpseAdminNewUserName');
			if (empty($m_wpseAdminNewUserName))
			{
				$p_message = 'You must input your new user name first, thanks.';
				wpseNotice($p_message,"YES","fail");
				update_option('wpseChangeAdminUsername','NO');
			}
			else
			{
				$m_sql = "select `user_login` from `".$table_prefix."users` where `user_login` = 'admin'";
				$m_result = $wpdb->get_var($m_sql);
				if (empty($m_result))
				{
					$p_message = 'Sorry,We can not find "admin" username in your site.';
					wpseNotice($p_message,"YES","fail");
					update_option('wpseChangeAdminUsername','NO');
				}
				else
				{
					$m_sql = "update `".$table_prefix."users` set `user_login` = '".$m_wpseAdminNewUserName."' where `user_login` = 'admin'";
					$m_result = $wpdb->query($m_sql);
					update_option('wpseChangeAdminUsername','YES');
				}
			}
		}
		else
		{
			$m_wpseIsAdminChanged = get_option('wpseChangeAdminUsername');
			if ($m_wpseIsAdminChanged == "YES")
			{
				$m_wpseAdminNewUserName = get_option('wpseAdminNewUserName');
				if (!(empty($m_wpseAdminNewUserName)))
				{
					$m_sql = "update `".$table_prefix."users` set `user_login` = 'admin' where `user_login` = '".$m_wpseAdminNewUserName."'";
					$m_result = $wpdb->query($m_sql);
					update_option('wpseChangeAdminUsername','NO');
				}
			}
		}
	}
	?>
<form id="checkboxDemo" action="" method="post">

	<I>Enhance Secure For Your Wordpress </I>
	<table class="widefat">
	<thead>
		<th width="40%">Checking Name</th>
		<th width="10%">Status</th>
		<th width="40%">Checking Options</th>
		<th width="10%">Why</th>
	</thead>
	<tbody>
		<tr>
		<td>
			<label for="Add-index-php-for-plugin-directory" tabindex="1">
			Add index.php for plugin directory &nbsp;&nbsp;&nbsp;&nbsp;
			</label>
			<?php
			$m_wpseAddIndexForPluginDirectory = get_option('wpseAddIndexForPluginDirectory');
			if ("YES" == $m_wpseAddIndexForPluginDirectory)
			{
				echo '<input type="checkbox" id="Add-index-php-for-plugin-directory" name="Add-index-php-for-plugin-directory" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Add-index-php-for-plugin-directory" name="Add-index-php-for-plugin-directory" class="prettyCheckbox" value="YES"/>';
			}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseAddIndexForPluginDirectory == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Add-index-php-for-plugin-directory">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Hide-your-plugins-folder" tabindex="2">
			Hide your plugins folder &nbsp;&nbsp;&nbsp;&nbsp; <?php //Options -Indexes in .htaccess , index.php ?>
			</label>
			<?php
			$m_wpseHideYourPluginsFolder = get_option('wpseHideYourPluginsFolder');
			if ("YES" == $m_wpseHideYourPluginsFolder)
			{
				echo '<input type="checkbox" id="Hide-your-plugins-folder" name="Hide-your-plugins-folder" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Hide-your-plugins-folder" name="Hide-your-plugins-folder" class="prettyCheckbox" value="YES" />';
			}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseHideYourPluginsFolder == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Hide-your-plugins-folder">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Change-the-admin-username" tabindex="3">
			Change the default admin username
			</label>
			<?php
			$m_wpseChangeAdminUsername = get_option('wpseChangeAdminUsername');
			if ("YES" == $m_wpseChangeAdminUsername)
			{
				echo '<input type="checkbox" id="Change-the-admin-username" name="Change-the-admin-username" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Change-the-admin-username" name="Change-the-admin-username" class="prettyCheckbox" value="YES" />';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseChangeAdminUsername == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/adminname.php?keepThis=true&TB_iframe=true&height=160&width=300" title="Change your default admin username" class="thickbox"><I><font color="Red" size="+1" style="text-decoration:underline">Here</I></font></a> to rename it</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Change-the-admin-username">[<font size="+1" color="red"><B>?</B></font>]</span></td>
		</tr>


		<tr>
		<td>
			<label for="Test-the-strength-of-your-password" tabindex="7">
			--> Test the strength of your password
			</label>

		</td>
		<td>None</td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/passwordtest.php?height=140&width=300" title="Test the strength of your password" class="thickbox"><I><font color="Red" size="+1" style="text-decoration:underline">Here</I></font></a> to test it</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Test-the-strength-of-your-password">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Restrict-access-to-wp-config" tabindex="4">
			Restrict access to wp-config.php file
			</label>
			<?php
			$m_wpseRestrictWpconfig = get_option('wpseRestrictWpconfig');
			if ("YES" == $m_wpseRestrictWpconfig)
			{
				echo '<input type="checkbox" id="Restrict-access-to-wp-config" name="Restrict-access-to-wp-config" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Restrict-access-to-wp-config" name="Restrict-access-to-wp-config" class="prettyCheckbox" value="YES" />';
			}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseRestrictWpconfig == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Restrict-access-to-wp-config">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Restrict-access-to-wp-includes" tabindex="5">
			Restrict access to wp-includes folder
			</label>
			<?php
			$m_wpseRestrictWpIncludes = get_option('wpseRestrictWpIncludes');
			if ("YES" == $m_wpseRestrictWpIncludes)
			{
				echo '<input type="checkbox" id="Restrict-access-to-wp-includes" name="Restrict-access-to-wp-includes" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Restrict-access-to-wp-includes" name="Restrict-access-to-wp-includes" class="prettyCheckbox" value="YES" />';
			}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseRestrictWpIncludes == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Restrict-access-to-wp-includes">[<font size="+1" color="red"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Restrict-access-to-wp-content-folder" tabindex="6">
			Restrict access to wp-content folder
			</label>
			<?php
			$m_wpseRestrictWpContent = get_option('wpseRestrictWpContent');
			if ("YES" == $m_wpseRestrictWpContent)
			{
				echo '<input type="checkbox" id="Restrict-access-to-wp-content-folder" name="Restrict-access-to-wp-content-folder" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Restrict-access-to-wp-content-folder" name="Restrict-access-to-wp-content-folder" class="prettyCheckbox" value="YES" />';
			}
			?>
		</td>
		<td><?php $m_wpseDone = ($m_wpseRestrictWpContent == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><font color="Gray"><I>No configuration required...</I></font></td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Restrict-access-to-wp-content-folder">[<font size="+1" color="red"><B>?</B></font>]</span></td>
		</tr>


		<tr>
		<td>
			<label for="Restrict-wp-admin-for-only-your-Ip" tabindex="3">
			Restrict wp-admin for only your Ip
			</label>
			<?php
			$m_wpseRestrictWpAdminIP = get_option('wpseRestrictWpAdminIP');
			if ("YES" == $m_wpseRestrictWpAdminIP)
			{
				echo '<input type="checkbox" id="Restrict-wp-admin-for-only-your-Ip" name="Restrict-wp-admin-for-only-your-Ip" class="prettyCheckbox" value="YES" checked />';
			}
			else
			{
				echo '<input type="checkbox" id="Restrict-wp-admin-for-only-your-Ip" name="Restrict-wp-admin-for-only-your-Ip" class="prettyCheckbox" value="YES" />';
			}
			?>

		</td>
		<td><?php $m_wpseDone = ($m_wpseRestrictWpAdminIP == 'YES') ? 'Done' : '<font color="Gray"><I>Not Yet</I></font>'; echo $m_wpseDone ; ?></td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/adminip.php?keepThis=true&TB_iframe=true&height=160&width=300" title="Restrict wp-admin for only your Ip" class="thickbox"><I><font color="Red" size="+1" style="text-decoration:underline">Here</I></font></a> to save your ip</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Restrict-wp-admin-for-only-your-Ip">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Restrict-access-wp-admin" tabindex="3">
			--> Restrict access to wp-admin
			</label>
			<?php
			//<input type="checkbox" id="Restrict-access-wp-admin" name="Restrict-access-wp-admin" class="prettyCheckbox" value="YES" />
			?>
		</td>
		<td>Manual</td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/adminaccess.php?keepThis=true&TB_iframe=true&height=500&width=600" title="Restrict access to wp-admin" class="thickbox"><I><font color="Red" size="+1" style="text-decoration:underline">Here</I></font></a> to read how to do it</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Restrict-access-wp-admin">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Check-files-and-folder-permissions" tabindex="3">
			--> Check files and folder permissions
			</label>
			<?php
			//<input type="checkbox" id="Check-files-and-folder-permissions" name="Check-files-and-folder-permissions" class="prettyCheckbox" value="YES" />
			?>
		</td>
		<td>None</td>
		<td><a href="<?php echo get_option('siteurl');    ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/checkpermissions.php?keepThis=true&TB_iframe=true&height=400&width=600" title="Check files and folder permissions" class="thickbox"><I><font color="Red" size="+1" style="text-decoration:underline">Here</I></font></a> to scan my folder now</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Check-files-and-folder-permissions">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

		<tr>
		<td>
			<label for="Scan-your-site-for-free" tabindex="3">
			Get a free malware scan from SSM
			</label>
			<?php // <input type="checkbox" id="Scan-your-site-for-free" name="Scan-your-site-for-free" class="prettyCheckbox" value="YES" /> ?>
		</td>
		<td><font color="Gray"><I>Not Yet</I></font></td>
		<td><a href="http://www.sitesecuritymonitor.com/wordpress-secure-plugin/" title="Get a free scan" class="thickbox">goto <I><font color="Green" size="+1" style="text-decoration:underline">SiteSecurityMonitor.COM</I></font></a> for a free scan</td>
		<?php  /* <td><font color="Gray"><I>N/A</I></font></td> */ ?>
		<td><span id="tips-Scan-your-site-for-free">[<font size="+1" color="green"><B>?</B></font>]</span></td>
		</tr>

	</tbody>
	</table>

	<br />
	<div style="align:right;text-align:right;">
	<input type="hidden" id="wpseHiddenEnhance" name = "wpseHiddenEnhance" value="YES">
	<input type="submit" id="wpseSubmitEnhance" name="wpseSubmitEnhance" value="Enhance Now" style="background:#4682b4;color:#fff; margin-right:20px;">
	</div>
	<br />
</form>

<script type="text/javascript">
	$(document).ready
	{
		wpseTips('#tips-Add-index-php-for-plugin-directory','Add index.php for plugin directory.');
		wpseTips('#tips-Hide-your-plugins-folder','add a .htaccess at yout plugin folder to avoid your plugins ,So nobody can list your plugins file and directory from internet.');
		wpseTips('#tips-Change-the-admin-username','change your default admin username to reduce the risk of hacker attack.If you do it, your will be forced to logout from wordpress, you need login again, so do it at the endest step is better...');
		wpseTips('#tips-Test-the-strength-of-your-password','Test the strength of your password to help you build a stong password.');
		wpseTips('#tips-Restrict-access-to-wp-config','wp-config stored your password of database, if there are php broken, your password will been readable, so please do this options to protect the file.');
		wpseTips('#tips-Restrict-access-to-wp-includes','This option will cause the conflict with hidden information in dashboard! And maybe some plugins will not work if you select this option, but why not try first, any problem just unselect this option...');
		wpseTips('#tips-Restrict-access-to-wp-content-folder','This option will cause the conflict with hidden information in dashboard! And maybe some plugins will not work if you select this option, but why not try first, any problem just unselect this option...');
		wpseTips('#tips-Restrict-wp-admin-for-only-your-Ip','Only your ip can visit your admin area..');
		wpseTips('#tips-Restrict-access-wp-admin','Nobody can visit your wp-admin directory');
		wpseTips('#tips-Check-files-and-folder-permissions','Scan your wordpress directories to get a right permission');
		wpseTips('#tips-Scan-your-site-for-free','Scan your site , it is free.');
	}
</script>

<?php
}

function wpSecureUndo()
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	if (isset($_POST['wpseHiddenUndo']))
	{
		update_option('wpseHiddenErrorOnLogin','NO');
		update_option('wpseHiddenWpVersionFrontend','NO');
		update_option('wpseHiddenWpVersionDashboard','NO');
		update_option('wpseHiddenWpRSDFront','NO');
		update_option('wpseHiddenWpWindowLiveWriter','NO');
		update_option('wpseHiddenCoreUpdate','NO');
		update_option('wpseHiddenPluginUpdate','NO');
		update_option('wpseHiddenThemeUpdate','NO');
		update_option('wpseAddIndexForPluginDirectory','NO');
		update_option('wpseHideYourPluginsFolder','NO');

		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/plugins/.htaccess";
 		if ((is_file($m_wpseHideYourPluginsDirectory)))
 		{
 			@chmod($m_wpseHideYourPluginsDirectory, 0755);
 			$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
			$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
			@fclose($m_hiddenPluginHandle);
			if ((strpos($m_contentPluginHtacces,"Options -Indexes")) === false)
			{
			}
			else
			{
				$m_contentPluginHtacces = str_replace("Options -Indexes","",$m_contentPluginHtacces);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
					{
						$p_message = 'Write "Options -Indexes" to .htaccess failed.';
						wpseNotice($p_message,"YES","fail");
						update_option('wpseRestrictWpconfig','NO');
					}
				}
				@fclose($m_hiddenPluginHandle);
			}
			@chmod($m_wpseHideYourPluginsDirectory, 0644);
 		}

 		update_option('wpseRestrictWpconfig','NO');
		$m_newRestrictConfig = "\n<files wp-config.php>\nOrder deny,allow\ndeny from all\n</files>";
 		$m_wpseHideYourPluginsDirectory = ABSPATH."/.htaccess";
		if ((is_file($m_wpseHideYourPluginsDirectory)))
		{
			@chmod($m_wpseHideYourPluginsDirectory, 0755);
			$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
			$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
			@fclose($m_hiddenPluginHandle);
			if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
			{

			}
			else
			{
				//$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
				$m_oldRestrictConfig = " ";
				$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
					{
						$p_message = 'Remove wp-config protect to .htaccess failed.';
						wpseNotice($p_message,"YES","fail");
						update_option('wpseRestrictWpconfig','NO');
					}
				}
				@fclose($m_hiddenPluginHandle);
			}
			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}

		update_option('wpseRestrictWpIncludes','NO');
		$m_newRestrictConfig = "\nOrder Allow,Deny\nDeny from all\nAllow from all\n";
 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-includes/.htaccess";
		if ((is_file($m_wpseHideYourPluginsDirectory)))
		{
			@chmod($m_wpseHideYourPluginsDirectory, 0755);
			$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
			$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
			@fclose($m_hiddenPluginHandle);
			if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
			{

			}
			else
			{
				$m_oldRestrictConfig = " ";
				$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
					{
						$p_message = 'Remove wp-includes protect to .htaccess failed.';
						wpseNotice($p_message,"YES","fail");
						update_option('wpseRestrictWpIncludes','NO');
					}
				}
				@fclose($m_hiddenPluginHandle);
			}
			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}

		update_option('wpseRestrictWpContent','NO');
		$m_newRestrictConfig = "\nOrder Allow,Deny\nDeny from all\nAllow from all\n";
 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/.htaccess";
		if ((is_file($m_wpseHideYourPluginsDirectory)))
		{
			@chmod($m_wpseHideYourPluginsDirectory, 0755);
			$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
			$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
			@fclose($m_hiddenPluginHandle);
			if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
			{

			}
			else
			{
				//$m_contentPluginHtacces = str_replace("Options -Indexes","#Options -Indexes",$m_contentPluginHtacces);
				$m_oldRestrictConfig = " ";
				$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
					{
						$p_message = 'Remove wp-content protect to .htaccess failed.';
						wpseNotice($p_message,"YES","fail");
						update_option('wpseRestrictWpContent','NO');
					}
				}
				@fclose($m_hiddenPluginHandle);
			}
			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}

		update_option('wpseRestrictWpAdminIP','NO');
		$m_newRestrictConfig = "\nOrder Deny,Allow\nDeny from all\nAllow from $m_new\n";
 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-admin/.htaccess";
		if ((is_file($m_wpseHideYourPluginsDirectory)))
		{
 			@chmod($m_wpseHideYourPluginsDirectory, 0755);
 			$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'r');
			$m_contentPluginHtacces = @fread($m_hiddenPluginHandle,filesize($m_wpseHideYourPluginsDirectory));
			@fclose($m_hiddenPluginHandle);
			if ((strpos($m_contentPluginHtacces,$m_newRestrictConfig)) === false)
			{

			}
			else
			{
				$m_oldRestrictConfig = " ";
				$m_contentPluginHtacces = str_replace($m_newRestrictConfig,$m_oldRestrictConfig,$m_contentPluginHtacces);
				$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
				if ($m_hiddenPluginHandle)
				{
					if (false === @fwrite($m_hiddenPluginHandle,$m_contentPluginHtacces))
					{
						$p_message = 'Remove wp-admin ip protect to .htaccess failed.';
						wpseNotice($p_message,"YES","fail");
						update_option('wpseRestrictWpAdminIP','NO');
					}
				}
				@fclose($m_hiddenPluginHandle);
			}
			@chmod($m_wpseHideYourPluginsDirectory, 0644);
		}

		//$m_wpseIsAdminChanged = get_option('wpseChangeAdminUsername');
		//if ($m_wpseIsAdminChanged == "YES")
		{
			$m_wpseAdminNewUserName = get_option('wpseAdminNewUserName');
			if (!(empty($m_wpseAdminNewUserName)))
			{
				$m_sql = "update `".$table_prefix."users` set `user_login` = 'admin' where `user_login` = '".$m_wpseAdminNewUserName."'";
				$m_result = $wpdb->query($m_sql);
				update_option('wpseChangeAdminUsername','NO');
			}
		}
		$p_message = 'Undo finished';
		wpseNotice($p_message,"YES","success");
	}
	echo "<I>Undo all these changes of your wordpress </I>";
	echo '<div style="margin:8px 0px;border-bottom:1px dotted gray">';
	echo '</div>';
	echo "If you click the undo button, all of the security settings that you have applied it will be undone. The only thing that will not be reversed will be the WordPress version upgrade itself. Unless you have a really pressing reason for this, we recommend that you do not execute this.
	<br />
	<br />
	If you wish to remove a specific setting, you may simply deselect that option and click apply on that specific page. This will undo that security feature.
	<br />
	<br />
	If you require further assistance, please feel free to <a href='http://www.sitesecuritymonitor.com/wordpress-secure-plugin/' target='_newwindow'>contact us here</a>
	";
	?>
	<br />
	<br />
	<br />
	<div id='confirm-dialog' style="align:right;text-align:right;">
	<form id="wpseUndoForm" name="wpseUndoForm" method="POST" action="">
	<input type="hidden" id="wpseHiddenUndo" name="wpseHiddenUndo" value="YES">
	<input type="button" id="wpseUndoSubmit" name="wpseUndoSubmit" class='confirm' value="Undo Now" style="background:#4682b4;color:#fff; margin-right:50px;">
	</form>
	</div>
	<div id='confirm'>
		<div class='header'><span>Confirm</span></div>
			<p class='message'></p>
			<div class='buttons'>
			<div class='no simplemodal-close'>No</div><div class='yes'>Yes</div>
		</div>
	</div>
	<?php
}


function wpseWordpressUpgradeNow()
{
	$m_ftphost = $m_ftp_path = $m_ftpusername = $m_ftppassword = '';
	update_option("wpseFinishedUpgrade","NO");

	if ((empty($_SESSION['wpseftphost'])) || (empty($_SESSION['wpseftppath']))  || (empty($_SESSION['wpseftpusername'])) || (empty($_SESSION['wpseftppassword'])))
	{
		$p_message = 'please input ftp server,path,username and password.';
		wpseNotice($p_message);
		return false;
	}

	$m_ftphost = $_SESSION['wpseftphost'];
	$m_ftp_path = $_SESSION['wpseftppath'];
	$m_ftpusername = $_SESSION['wpseftpusername'];
	$m_ftppassword = $_SESSION['wpseftppassword'];
	//$m_localTempDir = $m_ftp_path."/wpseTempDir/";
	$m_localTempDir = ABSPATH."wpseTempDir/";



	$m_ftpCheckFlag = $m_removedFlag = $m_DownloadFinishedFlag = 	$m_makeDirFlag = $m_changeMaintainFlag = $m_backupDirFlag =
	$m_finishBackupOldWordpressFlag = false;
		///!!! checkbox
	$m_isWWW =  ABSPATH . "wp-config.php";
	if (!(file_exists($m_isWWW)))
	{
		$p_message = "Can not find the wordpress!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	$m_nowFtp = wpseOpenFtp();
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(3,'Checking FTP....')";
		echo "})</script>";
	}
	if ($m_nowFtp == false)
	{
		return false;
	}

	$m_changeMaintainFlag = wpseChangeMaintenance("YES");
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(8,'Change Your Wordpress To Maintenance Model')";
		echo "})</script>";
	}

	if ($m_changeMaintainFlag === true)
	{
		//!!! progress
	}
	else
	{
		wpseChangeMaintenance("NO");
		return false;
	}

	$m_ftpCheckFlag =  wpseWpUpgradeCheck();
	if ($m_ftpCheckFlag == false)
	{
		//??? there need show error and log and  stop
		wpseChangeMaintenance("NO");
		return false;
	}
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(12,'Prepare for the upgrading')";
		echo "})</script>";
	}

	$m_removedFlag = wpseRemoveDir($m_localTempDir);
	if ($m_removedFlag == false)
	{
		wpseChangeMaintenance("NO");
		wpseNotice("Can not remove directory $m_localTempDir","YES","fail");
		return false;
	}
	//$m_makeDirFlag = wpseMakeDir($m_localTempDir);
	$m_makeDirFlag = @mkdir($m_localTempDir,0777);
	if ($m_makeDirFlag == FALSE)
	{
		wpseChangeMaintenance("NO");
		wpseNotice("Can not create directory $m_localTempDir","YES","fail");
		return false;
	}

	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		//echo "showProgress(20,'Downing the latest version of wordpress file')";
		echo "})</script>";
		usleep(1000000);
	}

	$m_wpDownloadURL = "http://wordpress.org/latest.zip";
	$m_localWPFile = $m_localTempDir."wordpress.zip";
	$m_DownloadFinishedFlag = wpseDownload($m_localWPFile,$m_wpDownloadURL);
	if ($m_DownloadFinishedFlag == false)
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not download the file $p_remote!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}
	else
	{
		//!!! there need use progress to show it.
		$p_message = "Download the file $p_remote finished.";
		wpseLog($p_message,"success");
	}
	if (!(is_file($m_localWPFile)))
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not find newest install files at $m_localWPFile!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		//echo "showProgress(25,'Unzip the wordpress.zip')";
		echo "})</script>";
		usleep(1000000);
	}

	require_once("lib/pclzip.lib.php");
	$m_pckZipNow = new PclZip($m_localWPFile);
	$m_pclZipExtract = @$m_pckZipNow->extract(PCLZIP_OPT_PATH, $m_localTempDir);
	if (0 == $m_pclZipExtract)
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not extract wordpress files at $m_localTempDir!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	if (!(is_dir($m_localTempDir.'wordpress')))
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not find extract wordpress files at $m_localTempDir!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	if (!(is_dir($m_localTempDir.'wordpress')))
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not find extract wordpress files at $m_localTempDir!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(30,'Backup your old wordpress files')";
		echo "})</script>";
	}
	//$m_backupDir = $m_ftp_path."/wpseBackupDir/";
	$m_backupDir = ABSPATH."wpseBackupDir/";
	if (!(is_dir($m_backupDir)))
	{
		//$m_backupDirFlag = wpseMakeDir($m_backupDir);
		$m_backupDirFlag = @mkdir($m_backupDir);
		if (false == $m_backupDirFlag)
		{
			wpseChangeMaintenance("NO");
			$p_message = "Can not create backup directory at $m_backupDir!";
			wpseNotice($p_message,"YES","fail");
			return false;
		}
	}
	$m_nowTime = date("YmdHis");
	$m_todayBackupDir = $m_backupDir."$m_nowTime/";
	if (is_dir($m_todayBackupDir))
	{
		$m_backupDirFlag = wpseRemoveDir($m_todayBackupDir);
		if ($m_backupDirFlag == false)
		{
			wpseChangeMaintenance("NO");
			wpseNotice("Can not remove directory $m_backupDirFlag","YES","fail");
			return false;
		}
	}

	//$m_backupDirFlag = wpseMakeDir($m_todayBackupDir);
	$m_backupDirFlag = @mkdir($m_todayBackupDir);
	if (false == $m_backupDirFlag)
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not create backup directory at $m_todayBackupDir!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	$m_oldWordpressBackupDir = $m_todayBackupDir."oldwordpress/";
	$m_backupDirFlag = wpseMakeDir($m_oldWordpressBackupDir);
	if (false == $m_backupDirFlag)
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not create old wordpress backup directory at $m_oldWordpressBackupDir!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	$m_finishBackupOldWordpressFlag =  wpseCopyDir(ABSPATH.$m_ftp_path,$m_oldWordpressBackupDir);
	if (false == $m_finishBackupOldWordpressFlag)
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not finished the backup of your old wordpress from $m_ftp_path to $m_oldWordpressBackupDir!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

	$m_newestWPUrl = $m_localTempDir."wordpress/";
	if (is_file($m_newestWPUrl."wp-config-sample.php"))
	{
		if (@unlink($m_newestWPUrl."wp-config-sample.php") == false)
		{
			wpseChangeMaintenance("NO");
			$p_message = "Can not delete $m_newestWPUrl/wp-config-sample.php!";
			wpseNotice($p_message,"YES","fail");
			return false;
		}
	}

	$m_deleteFlag = false;
	if (is_dir($m_newestWPUrl."wp-content"))
	{
		$m_deleteFlag = wpseRemoveDir($m_newestWPUrl."wp-content");
		if ($m_deleteFlag == false)
		{
			wpseChangeMaintenance("NO");
			wpseNotice("Can not remove directory $m_newestWPUrl wp-content","YES","fail");
			return false;
		}
	}

	if (is_file(ABSPATH.$m_ftp_path."/wp-config.php"))
	{
		if (@copy(ABSPATH.$m_ftp_path."/wp-config.php",$m_newestWPUrl."wp-config.php") == false)
		{
			wpseChangeMaintenance("NO");
			$p_message = "Can not copy file from ".$m_ftp_path."/wp-config.php to ".$m_newestWPUrl."wp-config.php";
			wpseNotice($p_message,"YES","fail");
			return false;
		}
	}

	if (is_file(ABSPATH.$m_ftp_path."/.htaccess"))
	{
		if (@copy(ABSPATH.$m_ftp_path."/.htaccess",$m_newestWPUrl.".htaccess") == false)
		{
			wpseChangeMaintenance("NO");
			$p_message = "Can not copy file from ".$m_ftp_path."/.htaccess to ".$m_newestWPUrl.".htaccess";
			wpseNotice($p_message,"YES","fail");
			return false;
		}
	}

	if (is_dir(ABSPATH.$m_ftp_path."/wp-content/"))
	{
		if (false == @wpseCopyDir(ABSPATH.$m_ftp_path."/wp-content/",$m_newestWPUrl."wp-content/"))
		{
			wpseChangeMaintenance("NO");
			$p_message = "Can not copy wp-content from ".$m_ftp_path."/wp-content to ".$m_newestWPUrl."wp-content";
			wpseNotice($p_message,"YES","fail");
			return false;
		}
	}

	if (is_dir(ABSPATH.$m_ftp_path."/wp-includes/languages"))
	{
		if (false == @wpseCopyDir(ABSPATH.$m_ftp_path."/wp-includes/languages",$m_newestWPUrl."wp-includes/languages"))
		{
			wpseChangeMaintenance("NO");
			$p_message = "Can not copy languages file from ".$m_ftp_path."/wp-includes/languages to ".$m_newestWPUrl."wp-includes/languages";
			wpseNotice($p_message,"YES","fail");
			return false;
		}
	}
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(50,'Removing your old files..')";
		echo "})</script>";
	}
	$m_ftpHandle = @opendir(ABSPATH.$m_ftp_path);
	if (false == $m_ftpHandle)
	{
		wpseChangeMaintenance("NO");
		$p_message = "Can not read file from ".$m_ftpHandle;
		wpseNotice($p_message,"YES","fail");
		return false;
	}
	while ($file = readdir($m_ftpHandle))
	{
		if ( (is_file($file)) && ("." != $file) && (".." != $file) )
		{
			$m_nowFtp->delete($file);
			/*
			if (false ==  @unlink($file))
			{
				$p_message = "Can not delete file from ".$m_ftpHandle;
				wpseNotice($p_message,"YES");
				return false;
			}
			*/
		}

		if (is_dir($file))
		{
			if ( (false === strpos($file,'wp-admin')) && (false === strpos($file,'wp-includes')) && (false === strpos($file,'wp-content')))
			{
				continue;
			}
			else
			{
				$m_nowFtp->mdel($m_ftp_path.$file);
			}
		}
	}
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		//echo "showProgress(60,'Upgrading wordpress..')";
		echo "})</script>";
	}
	$m_nowFtp->mput($m_newestWPUrl,$m_ftp_path,true);
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(100,'we finished..')";
		echo "});";
		//echo "document.getElementById('pbl').style.display='none';";

		//echo "document.getElementById('wpsepbl').style.display='none';";

		//echo "document.getElementById('wpsepbl').innerHTML = ''??";
		echo "</script>";
	}
	update_option("wpseFinishedUpgrade","YES");

	usleep(300000);
	echo "<script type='text/javascript'>";
	//echo "document.getElementById('wpsepbl').style.display='none';";
	echo "</script>";
	$p_message = "Upgrade wordpress finished.";
	wpseNotice($p_message,"YES","success");
	//wpseLog($p_message,"success");

	require_once (ABSPATH.WPINC."/class-snoopy.php");
	$m_snoopy = new Snoopy();
	$m_snoopy->read_timeout = 60;
	@$m_snoopy->fetch(get_option('siteurl')."/wp-admin/upgrade.php?step=1");
	if ($m_snoopy->status != '200')
	{
		wpseChangeMaintenance("NO");
		$p_message = "Please run <a href='". get_option('siteurl')."/wp-admin/upgrade.php?step=1'>database upgrade</a> to finish the upgrade now";
		wpseNotice($p_message);
		if ("NO" == get_option("wpseFinishedUpgrade"))
		{
			echo "<script type='text/javascript'>";
			echo "$(document).ready(function(){";
			echo "showProgress(100,'finished..');";
			echo "})";
			echo "document.getElementById('pbl').style.display='none';";
			echo "document.getElementById('wpsepbl').style.display='none';";
			echo "document.getElementById('wpsepbl').innerHTML = ''??";
			echo "</script>";
		}
		update_option("wpseFinishedUpgrade","YES");
		//return false;
	}
	else
	{
		if ("NO" == get_option("wpseFinishedUpgrade"))
		{
			echo "<script type='text/javascript'>";
			echo "$(document).ready(function(){";
			echo "showProgress(100,'finished..');";
			echo "})";
			echo "document.getElementById('pbl').style.display='none';";
			echo "document.getElementById('wpsepbl').style.display='none';";
			echo "document.getElementById('wpsepbl').innerHTML = ''??";


			echo "</script>";
		}
		update_option("wpseFinishedUpgrade","YES");
	}
}

function wpseCheckPluginsUpgradeNow()
{
	require_once(ABSPATH.WPINC."/update.php");
	$m_updatePlugins = false;

	wp_update_plugins();
	$m_updatePlugins =  get_plugin_updates();
	if (false != $m_updatePlugins)
	{
		echo '<table class="widefat" id="myTable">';
		echo '<thead> ';
		echo '<th width="24%" style="color:#21759B;">Plugin Name</th>';
		echo '<th width="4%" style="color:#21759B;">Actived</th>';
		echo '<th width="8%" style="color:#21759B;">Version</th>';
		echo '<th width="45%" style="color:#21759B;">Description</th>';
		echo '<th width="9%" style="color:#21759B;">Update</th>';
		echo '</thead>';
		echo '<tbody>';
		$m_activedPlugins = get_option('active_plugins');
		foreach ($m_updatePlugins as $m_nowCheckPlugin => $value)
		{
			echo '<tr>';
			//echo "<td>".$m_nowCheckPlugin['name']."</td>";
			echo "<td>".$value->Name."</td>";
			if (in_array($m_nowCheckPlugin,$m_activedPlugins))
			{
				echo "<td>YES</td>";
			}
			else
			{
				echo "<td>No</td>";
			}

			echo "<td>".$value->Version."</td>";
			echo "<td>".$value->Description."</td>";
			if (isset($value->update->new_version))
			{
				echo '<td><I><a href = "'.$value->update->url.'" target="_blank"><font color="blue">HERE</font></a></I></td>';
			}
			else
			{
				echo '<td><font color="Gray"><I>No</I></font></td>';
			}
			echo "</tr>";
		}
		echo '</tbody>';
		echo '</table>';
	}
	echo "<br />";
	$p_message = "checking wordpress plugin upgrade finished.";
	wpseNotice($p_message,"YES","success");
}

function wpSecureFreeScan()
{



echo <<<END


<Table border="1">
<TR>
<TH>

Thankyou for using our plugin.  You are free to use the plugin below (outputs HTML for easy copy-pasting) into your blog.  This seal does not give you scanning services - it simple does the basics of wordpress security - as recommended by the community and our own experiences with our customers.<BR>Should you wish to get regular vulnerability and malware scanning services, please <A HREF="http://www.sitesecuritymonitor.com/wordpress-secure-plugin/">see our main page here...</A>
<HR>
For a Free Scan, fillout the form here:

<form action="http://www.sitesecuritymonitor.com/Default.aspx?app=iframeform&hidemenu=true&ContactFormID=26978" method="post">
    <input type="hidden" name="FormSubmitRedirectURL" id="FormSubmitRedirectURL" value="http://www.sitesecuritymonitor.com" >
    <input type="hidden" name="Lead_Src" id="LeadSrc" value="Get a Free Scan" />
    
    
<script type='text/javascript' language='javascript'>/* <![CDATA[ */
   HubSpotFormSpamCheck_LeadGen_ContactForm_26978_m0 = function() {
       var key = document.getElementById('LeadGen_ContactForm_26978_m0spam_check_key').value;
	   var sig = '';
	   for (var x = 0; x< key.length; x++ ) {
				sig += key.charCodeAt(x)+13;
	   }
	   document.getElementById('LeadGen_ContactForm_26978_m0spam_check_sig').value = sig; 
       // Set the hidden field to contain the user token
       var results = document.cookie.match ( '(^|;) ?hubspotutk=([^;]*)(;|$)' );
        if (results && results[2]) {
            document.getElementById('LeadGen_ContactForm_26978_m0submitter_user_token').value =  results[2];
        } else if (window['hsut']) {
            document.getElementById('LeadGen_ContactForm_26978_m0submitter_user_token').value = window['hsut'];
	    }
        return true;
   };
/*]]>*/</script>

<input type='hidden' id='LeadGen_ContactForm_26978_m0submitter_user_token' name='LeadGen_ContactForm_26978_m0submitter_user_token'  value='' /><input type='hidden' name='ContactFormId'  value='26978' /><input type='hidden' id='LeadGen_ContactForm_26978_m0spam_check_key' name='LeadGen_ContactForm_26978_m0spam_check_key'  value='shmijrhgolmqdsmipnsiphghoqlgjdqikqsqegqisilueocqjkkwpswnomvs' /><input type='hidden' id='LeadGen_ContactForm_26978_m0spam_check_sig' name='LeadGen_ContactForm_26978_m0spam_check_sig'  value='' /><div class='ContactFormItems FormClassID_26978'><table border="0" cellspacing="0" cellpadding="5">
<tr>
  <td>Full Name <span style='color: red'> *</span></td>
  <td><input type="Text" name="LeadGen_ContactForm_26978_m0:FullName" class="StandardI AutoFormInput LeadGen_ContactForm_26978_m0_AutoForm" id="LeadGen_ContactForm_26978_m0_FullName" value="" /><div class="fieldclear"></div></td>
</tr>
<tr>
  <td>Email Address<BR><I>(Email Address must match domain name)</I> <span style='color: red'> *</span></td>
  <td><input type="Text" name="LeadGen_ContactForm_26978_m0:Email" class="StandardI AutoFormInput LeadGen_ContactForm_26978_m0_AutoForm" id="LeadGen_ContactForm_26978_m0_Email" value="" /><div class="fieldclear"></div></td>
</tr>
<tr>
  <td>Website <span style='color: red'> *</span></td>
  <td><input type="Text" name="LeadGen_ContactForm_26978_m0:WebSite" class="StandardI AutoFormInput LeadGen_ContactForm_26978_m0_AutoForm" id="LeadGen_ContactForm_26978_m0_WebSite" value="" /><div class="fieldclear"></div></td>
</tr>
<tr>
  <td>Phone (xxx-xxx-xxxx) <span style='color: red'> *</span></td>
  <td><input type="Text" name="LeadGen_ContactForm_26978_m0:Phone" class="StandardI AutoFormInput LeadGen_ContactForm_26978_m0_AutoForm" id="LeadGen_ContactForm_26978_m0_Phone" value="" /><div class="fieldclear"></div></td>
</tr>
<tr>
  <td>Yes, I need help!</td>
  <td><div id="LeadGen_ContactForm_26978_m0_Field_Checkboxes_5_cbcontainer" class='CheckboxGroupContainer'   > <input type="checkbox" name="LeadGen_ContactForm_26978_m0:Field_Checkboxes_5" id="LeadGen_ContactForm_26978_m0_Field_Checkboxes_5_cb_0" value="Call me"  > <label for="LeadGen_ContactForm_26978_m0_Field_Checkboxes_5_cb_0">Call me</label><br/></div>
</td>
</tr>
<tr>
  <td><a href="/terms.html" target="_blank">Terms and Conditions</a>  <span style='color: red'> *</span></td>
  <td><div id="LeadGen_ContactForm_26978_m0_Field_Checkboxes_7_cbcontainer" class='CheckboxGroupContainer'   > <input type="checkbox" name="LeadGen_ContactForm_26978_m0:Field_Checkboxes_7" id="LeadGen_ContactForm_26978_m0_Field_Checkboxes_7_cb_0" value="I accept"  > <label for="LeadGen_ContactForm_26978_m0_Field_Checkboxes_7_cb_0">I accept</label><br/></div>
</td>
</tr>
<tr><td></td><td><input onclick='return HubSpotFormSpamCheck_LeadGen_ContactForm_26978_m0();' class='FormSubmitButton' type='submit' name='LeadGen_ContactForm_Submit_LeadGen_ContactForm_26978_m0' value="Start My Scan!"></td></tr>
</table></div>

    </form>
    
<HR>
<script type="text/javascript">
	function updateSealPreview()
	{
		var seal_color = document.forms['seal_form'].seal_color.options[document.forms['seal_form'].seal_color.options.selectedIndex].value;
		var seal_text = document.forms['seal_form'].seal_text.options[document.forms['seal_form'].seal_text.options.selectedIndex].value;
		var seal_orientation = document.forms['seal_form'].seal_orientation.options[document.forms['seal_form'].seal_orientation.options.selectedIndex].value;
		var seal_border = document.forms['seal_form'].seal_border.checked?"border":"noborder";

		var country = document.forms['seal_form'].country.options[document.forms['seal_form'].country.options.selectedIndex].value;

		var image_name = "https://reporting.sitesecuritymonitor.com/img_wp/{$_SERVER['HTTP_HOST']}/" + seal_color + "_" + seal_text + "_" + seal_orientation + "_notext_" +  seal_border  + ".png";
		document.seal_preview.src = image_name;
		var gen_code = "<!-- Start sitesecuritymonitor.com code -->\\n";
		gen_code += "<a target='_blank' href='https://reporting.sitesecuritymonitor.com/clients/go.x?i=l0&site={$_SERVER['HTTP_HOST']}&l=" + country + "' title='Web Site Security Scanning - www.sitesecuritymonitor.com' alt='sitesecuritymonitor.com Security Seal'>\\n";
		gen_code += "<img src='" + image_name +  "' oncontextmenu='return false;' border='0' alt='sitesecuritymonitor.com seal' />\\n";
		gen_code += "</a>\\n";
		gen_code += "<br />\\n";
		gen_code += "<span style=\"font-size:8px; font-face:Arial;\">Protected by WP-Secure Plugin<BR><a href='http://www.sitesecuritymonitor.com'>SiteSecurityMonitor.com</a></span>\\n";
		gen_code += "<!-- End sitesecuritymonitor.com code -->\\n";

		document.getElementById('seal_code').value = gen_code;
	}
</script>



<form name='seal_form' action='javascript:void(0);' method='post' onsubmit="return false;">
	<table border="0" width="100%">
		<tr>
			<td>
				<table border="0">
					<tr>
						<td>
							Select Seal color:
						</td>
						<td>
							<select name="seal_color" onchange="javascript:updateSealPreview();">
								<option value="green" selected>Green</option>
								<option value="blue">Blue</option>
								<option value="red">Red</option>
								<option value="brown">Brown</option>
								<option value="gray">Gray</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Select Seal Text:
						</td>
						<td>
							<select name="seal_text" onchange="javascript:updateSealPreview();">
								<option value="pr" selected>Protected</option>
								<option value="se">Secured</option>
								<option value="sc">Scanned</option>
								<option value="pb">Protected By</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Select Seal orientation:
						</td>
						<td>
							<select name="seal_orientation" onchange="javascript:updateSealPreview();">
								<option value="h" selected>Horizontal</option>
								<option value="v">Vertical</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Image border:
						</td>
						<td>
							<input type="checkbox" name="seal_border"  onchange="javascript:updateSealPreview();" />
						</td>
					</tr>

				</table>
			</td>
			<td>
				<img src="" name="seal_preview"  oncontextmenu='return false;'/>
			</td>
		</tr>
	</table>

	<h6>Language <br></be><select name='country' onchange="javascript:updateSealPreview();">
	<option value='EN-US' selected='selected'>English (US)</option>
	<option value='EN-GB'>English (UK)</option>
	<option value='ES'>Spanish</option>
	<option value='FR'>French</option>
	<option value='DE'>German</option>
	<option value='IT'>Italian</option>
	<option value='JP'>Japanese</option>
	<option value='CN'>Chinese (Simplified)</option>
	<option value='CNT'>Chinese (Traditional)</option>
	</select></h6>
</form>





<p><b><br>Here is your generated code. Place it on your website (as html widget) to show that you are protected.</b></p>
<textarea id="seal_code" name="seal_code" style="width:500px; height:200px;" readonly></textarea>





<script type="text/javascript">
	updateSealPreview();
</script>


</TH>
<TH>

<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US"></script><script type="text/javascript">FB.init("beee2afaec03701259165c628e3b963c");</script><fb:fan profile_id="346589752350" stream="0" connections="10" logobar="0" width="300"></fb:fan><div style="font-size:8px; padding-left:10px"><a href="http://www.facebook.com/pages/SiteSecurityMonitorcom/346589752350">SiteSecurityMonitor.com</a> on Facebook</div>

<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 4,
  interval: 6000,
  width: 'auto',
  height: 300,
  theme: {
    shell: {
      background: '#333333',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#4aed05'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('sitesecuritymon').start();
</script>

</TH>
</TR>
</TABLE>

END;

}
?>
