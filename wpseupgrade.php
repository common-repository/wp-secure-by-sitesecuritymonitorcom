<?php
@session_start();

ob_start();

require_once('wpSecureFunctions.php');
wpSecureUpgard();
function wpSecureUpgard()
{
	// running statu
?>
	<script type='text/javascript'>
	//$(document).ready
	//{
		//wpseTips('#label-wordpress-upgrade','Before do this,we suggest you do a full backup or at least do a database backup.');
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
	<input type="submit" id="wpseSubmitUpgrade" name="wpseSubmitUpgrade" value="Check Now" style="background:#4682b4;color:#fff; text-align:right; margin-right:20px;">
	</div>
	<br />
</form>

<script type='text/javascript'>
	$(document).ready
	{
		wpseTips('#label-wordpress-upgrade','Before do this,we suggest you do a full backup or at least do a database backup.And if you had active "Hide your wordpress version(dashboard)" option, please unselect it temporary');
	}
</script>
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
		echo "showProgress(20,'Downing the latest version of wordpress file')";
		echo "})</script>";
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
		echo "showProgress(25,'Unzip the wordpress.zip')";
		echo "})</script>";
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
		echo "showProgress(60,'Install new files..')";
		echo "})</script>";		
	}
	$m_nowFtp->mput($m_newestWPUrl,$m_ftp_path,true);
	if ("NO" == get_option("wpseFinishedUpgrade"))
	{	
		echo "<script type='text/javascript'>";
		echo "$(document).ready(function(){";
		echo "showProgress(90,'Nearly finished..')";
		echo "});";
		//echo "document.getElementById('pbl').style.display='none';";
		echo "alert('11');";
		//echo "document.getElementById('wpsepbl').style.display='none';";
		echo "alert('22');";
		//echo "document.getElementById('wpsepbl').innerHTML = ''£»";		
		echo "alert('33');";
		echo "</script>";
	}
	update_option("wpseFinishedUpgrade","YES");
	$p_message = "Upgrade wordpress finished.";
	//wpseNotice($p_message,"YES","success");
	wpseLog($p_message,"success");
	
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
			echo "document.getElementById('wpsepbl').innerHTML = ''£»";			
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
			echo "document.getElementById('wpsepbl').innerHTML = ''£»";
			
			
			echo "</script>";
		}
		update_option("wpseFinishedUpgrade","YES");
	}
}
?>