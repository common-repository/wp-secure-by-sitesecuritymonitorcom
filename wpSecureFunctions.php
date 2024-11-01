<?php
@session_start();
ob_start();
function wpseInitActionBackEnd()
{
	$m_wpseHiddenCoreUpdate = get_option('wpseHiddenCoreUpdate');
	if ($m_wpseHiddenCoreUpdate == "YES")
	{
		//remove_filter('update_footer', 'core_update_footer');
		add_filter('update_footer', create_function('$m_wpseRemoveFooterVersion', 'return false;' ));
		//remove_action( 'update_footer', 'core_update_footer' );
	}
	$m_wpseHiddenPluginUpdate = get_option('wpseHiddenPluginUpdate');
	if ($m_wpseHiddenPluginUpdate == 'YES')
	{
		remove_action('admin_init','wp_plugin_update_rows');
		remove_action('admin_init','_maybe_update_plugins');
		remove_action('admin_init','wp_update_plugins');
	}

	$m_wpseHiddenThemeUpdate = get_option('wpseHiddenThemeUpdate');
 	if ($m_wpseHiddenThemeUpdate == 'YES')
 	{
		if (!current_user_can('administrator'))
		{
			remove_action('admin_init', '_maybe_update_themes');
		}
 	}

}

function wpseInitActionFrontEnd()
{
	wpseActionsFrontEnd();

}


function wpseActionsFrontEnd()
{
	$m_wpseHiddenErrorOnLogin = get_option('wpseHiddenErrorOnLogin');
 	if ($m_wpseHiddenErrorOnLogin == 'YES')
 	{
		if ('wp-login.php' == basename($_SERVER['SCRIPT_FILENAME']))
		{
			if (!current_user_can('administrator'))
			{
				add_filter('login_errors',create_function( '$m_wpseRemoveErrorWhenLogin', 'return false;'));
				echo '<link rel="stylesheet" type="text/css" href="' . WP_PLUGIN_URL . '/wp-secure-by-sitesecuritymonitorcom/css/hiddenloginerror.css" />';
			}
		}
 	}

	$m_wpseHiddenCoreUpdate = get_option('wpseHiddenCoreUpdate');
	if ($m_wpseHiddenCoreUpdate == "YES")
	{
		if (!(current_user_can('administrator')))
		{
			wp_enqueue_style('wpseCSSRemoveAdminVerNotice', WP_PLUGIN_URL . '/wp-secure-by-sitesecuritymonitorcom/css/removenotice.css');
			if (is_admin())
			{
?>
			<script type="text/javascript">
			document.getElementById('wp-version-message').innerHTML = '';
			</script>
<?php
			}
			//remove_filter('update_footer', 'core_update_footer');
			add_filter('update_footer', create_function('$m_wpseRemoveFooterVersion', 'return false;' ));
			//remove_action( 'update_footer', 'core_update_footer' );
			remove_action('admin_notices','maintenance_nag');
			remove_action('admin_notices', 'update_nag',3);
			remove_action('admin_init', '_maybe_update_core');
			remove_action('init','wp_version_check');
			add_filter('pre_option_update_core',create_function('$m_wpseRemovePreOptionUpdateCore', 'return false;' ));
		}
	}

	$m_wpseHiddenPluginUpdate = get_option('wpseHiddenPluginUpdate');
	if ($m_wpseHiddenPluginUpdate == 'YES')
	{
		wp_enqueue_style('wpseCSSRemoveAdminVerNotice', WP_PLUGIN_URL . '/wp-secure-by-sitesecuritymonitorcom/css/removenotice.css');
		remove_action('load-plugins.php','wp_update_plugins');
		remove_action( 'init','wp_update_plugins');
		//add_filter( 'pre_option_update_plugins', create_function( '$a', "return null;" ) );
	}

	$m_wpseHiddenWpWindowLiveWriter = get_option('wpseHiddenWpWindowLiveWriter');
	if ($m_wpseHiddenWpWindowLiveWriter == 'YES')
	{
		remove_action('wp_head','wlwmanifest_link');
	}

	$m_wpseHiddenWpRSDFront = get_option('wpseHiddenWpRSDFront');
	if ($m_wpseHiddenWpRSDFront == 'YES')
	{
		remove_action('wp_head','rsd_link');
	}

	$m_wpseHiddenWpVersionDashboard = get_option('wpseHiddenWpVersionDashboard');
 	if ($m_wpseHiddenWpVersionDashboard == 'YES')
 	{
 		wpseHiddenWPVersionDashboard();
 	}

 	$m_wpseHiddenWpVersionFrontend = get_option('wpseHiddenWpVersionFrontend');
 	if ($m_wpseHiddenWpVersionFrontend == 'YES')
 	{
 		wpseHiddenWPVersionFront();
 	}

 	$m_wpseHiddenThemeUpdate = get_option('wpseHiddenThemeUpdate');
 	if ($m_wpseHiddenThemeUpdate == 'YES')
 	{
		if ( !current_user_can('administrator'))
		{
			remove_action('load-themes.php','wp_update_themes');
			remove_action('load-update.php','wp_update_themes');
			remove_action('wp_update_themes','wp_update_themes');
			add_filter('pre_transient_update_themes',create_function('$m_wpseHiddenPreUpdateTheme', 'return false;'));
		}
 	}

	$m_wpseAddIndexForPluginDirectory = get_option('wpseAddIndexForPluginDirectory');
 	if ($m_wpseAddIndexForPluginDirectory == 'YES')
 	{
 		$m_indexPluginDirectory = ABSPATH."/wp-content/plugins/index.php";
 		if ((is_file($m_indexPluginDirectory)))
 		{
 			if ((filesize($m_indexPluginDirectory)) != 0)
 			{
 				@unlink($m_indexPluginDirectory);
				$m_indexPluginHandle = @fopen($m_indexPluginDirectory, 'w');
				if ($m_indexPluginHandle)
				{
					@fclose($m_indexPluginHandle);
				}
 			}
 		}
 		else
 		{
			$m_indexPluginHandle = @fopen($m_indexPluginDirectory, 'w');
			if ($m_indexPluginHandle)
			{
				@fclose($m_indexPluginHandle);
			}
 		}
 	}

 	if ($m_wpseAddIndexForPluginDirectory == 'NO')
 	{
 		$m_indexPluginDirectory = ABSPATH."/wp-content/plugins/index.php";
 		if ((is_file($m_indexPluginDirectory)))
 		{
			@unlink($m_indexPluginDirectory);
 		}
 	}



	$m_wpseHideYourPluginsFolder = get_option('wpseHideYourPluginsFolder');
 	if ($m_wpseHideYourPluginsFolder == 'YES')
 	{
 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/plugins/.htaccess";
 		if ((is_file($m_wpseHideYourPluginsDirectory)))
 		{

 		}
 		else
 		{
			$m_hiddenPluginHandle = @fopen($m_wpseHideYourPluginsDirectory, 'w');
			if ($m_hiddenPluginHandle)
			{
				@fwrite($m_hiddenPluginHandle,"Options -Indexes");
				@fclose($m_indexPluginHandle);
			}
 		}
 	}

 	if ($m_wpseHideYourPluginsFolder == 'NO')
 	{
 		$m_wpseHideYourPluginsDirectory = ABSPATH."/wp-content/plugins/.htaccess";
 		if ((is_file($m_wpseHideYourPluginsDirectory)))
 		{
			@unlink($m_wpseHideYourPluginsDirectory);
 		}
 	}



}

/**
/*  Show guide and system status
**/

function aboutWpSecure()
{
	wpseKeepNoticePlace();
	echo "<br />";
	$m_wpseTipsHiddenErrorOnLogin = $m_wpseTipsHiddenWpVersionFrontend = $m_wpseTipsHiddenWpVersionDashboard =
	$m_wpseTipsHiddenWpRSDFront = $m_wpseTipsHiddenWpWindowLiveWriter = $m_wpseTipsHiddenCoreUpdate =
	$m_wpseTipsHiddenPluginUpdate = $m_wpseTipsHiddenThemeUpdate = $m_wpseTipsAddIndexForPluginDirectory =
	$m_wpseTipsHideYourPluginsFolder = $m_wpseTipsRestrictWpconfig = $m_wpseTipsHideYourPluginsFolder =
	$m_wpseTipsRestrictWpIncludes = $m_wpseTipsRestrictWpContent = $m_wpseTipsRestrictWpAdminIP =
	$m_wpseTipsTestTheStrength = $m_wpseTipsRestrictAccessAdmin = $m_wpseTipsCheckFiles = '';

  	$m_wpseCurrentActive = 0;

	if (get_option('wpseHiddenErrorOnLogin') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenErrorOnLogin = '<br /><br />You should remove the error information on the login-page,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}

	if (get_option('wpseHiddenWpVersionFrontend') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenWpVersionFrontend = '<br /><br />You should hide your wordpress version(frontend),execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}
	if (get_option('wpseHiddenWpVersionDashboard') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenWpVersionDashboard = '<br /><br />You should hide your wordpress version(dashboard),execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}
	if (get_option('wpseHiddenWpRSDFront') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenWpRSDFront = '<br /><br />You should remove really simple discovery,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}
	if (get_option('wpseHiddenWpWindowLiveWriter') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenWpWindowLiveWriter = '<br /><br />You should remove Windows Live Writer,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}

	if (get_option('wpseHiddenCoreUpdate') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenCoreUpdate = '<br /><br />You should remove core update information,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}

	if (get_option('wpseHiddenPluginUpdate') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenPluginUpdate = '<br /><br />You should remove plugin update information,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}

	if (get_option('wpseHiddenThemeUpdate') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHiddenThemeUpdate = '<br /><br />You should remove theme update information,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-2">here</a>';
	}


	if (get_option('wpseAddIndexForPluginDirectory') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsAddIndexForPluginDirectory = '<br /><br />You should add index.php to plugin directory,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}

	if (get_option('wpseHideYourPluginsFolder') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHideYourPluginsFolder = '<br /><br />You should hide your plugins folder,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}

	if (get_option('wpseRestrictWpconfig') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsRestrictWpconfig = '<br /><br />You should restrict access to wp-config.php file,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}

	if (get_option('wpseRestrictWpconfig') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsHideYourPluginsFolder = '<br /><br />You should hide your plugins folder,execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}

	if (get_option('wpseRestrictWpIncludes') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsRestrictWpIncludes = '<br /><br />You should restrict access to wp-includes folder , execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}

	if (get_option('wpseRestrictWpContent') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsRestrictWpContent = '<br /><br />You should restrict access to wp-content folder , execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}


	if (get_option('wpseRestrictWpAdminIP') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsRestrictWpAdminIP = '<br /><br />You should restrict wp-admin for only your Ip, execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}

	if (get_option('wpseChangeAdminUsername') == 'YES')
	{
		$m_wpseCurrentActive++;
	}
	else
	{
		$m_wpseTipsChangeAdminUsername = '<br /><br />You should change the default admin username, execute <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	}



	$m_wpseTipsTestTheStrength = '<br /><br />You can test the strength of your password from <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	$m_wpseTipsRestrictAccessAdmin = '<br /><br />You can restrict access to wp-admin from <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	$m_wpseTipsCheckFiles = '<br /><br />You can check files and folder permissions from <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';
	$m_wpseTipsScanYourSite = '<br /><br />You can Scan your site for free from <a href="'. get_option('siteurl')  .'/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-3">here</a>';

	?>
	<div class="wrap">
		<h2><?php _e('Welcome To WP Secure - by SSM', ' WPSecure') ?></h2>
			<div style="width:90%;margin:0px 10px;">
				<A HREF="http://www.sitesecuritymonitor.com/" target="_newwindow"><IMG SRC="http://www.sitesecuritymonitor.com/Portals/78066/images/new%20logo.png"><BR><I>WP Secure by SiteSecurityMonitor.com</I> </A><BR>is a plugin that was developed as a benefit to the community for free from the leading Malware and Web vulnerability company - SiteSecurityMonitor.com. We developed this for our customers initially, and decided to release it to the community. If you have any questions about the plug-in, our solution or anything else related to web security <a href='http://www.sitesecuritymonitor.com/wordpress-secure-plugin/' target="_blank">please click HERE </a>
				<br />
				<br />
		<I>		We also recommend that you scan your site regularly for Malware and Web vulnerabilities. If you are a registered user of this plug-in your first scan is free! Click here to register and <a href='http://www.sitesecuritymonitor.com/wordpress-secure-plugin/' target="_blank">get your first free site scan</a>.
				<br /><P>
				Please see the <a href='<?php echo get_option("siteurl")."/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/readme.txt"  ?>' target="_blank">Read Me</a> file for more details
				<br />
				<br />
	</div>
		<div id="dashboard-widgets-wrap">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" style="width:90%;">
							<div class="postbox">
								<h3 class='hndle'><span>
									Security Report
								</span>
								</h3>

								<div class="inside" style='padding-left:5px;'>
									<br />
									You have completed <font size="+1"><a href="<?php echo get_option('siteurl')."/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php" ?>"><?php  echo $m_wpseCurrentActive ?></a></font> out of <font color="Red" size="+1">23</font> recommended security changes.
									<?php /*  echo realListingNumber('active'); ?> actived and <?php echo realListingNumber('inactived'); ?> inactived */ ?>
									<br />
									<br />
									<?php
										$m_wpseNeedUpgrade = get_preferred_from_update_core();
										if (!isset($m_wpseNeedUpgrade->response) || $m_wpseNeedUpgrade->response != 'upgrade')
										{
											echo "<I><font color='Gray'>You have the newest wordpress version.</font></I>";
										}
										else
										{
											echo "<I><font color='Gray'>You wordpress version is old now </font></I>, go to  <a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-1'>Here</a> to upgrade automaticly .";
										}
									?>
									<br />
									<br />
									<?php
										require_once(ABSPATH.WPINC."/update.php");
										$m_updatePlugins = false;

										wp_update_plugins();
										$m_updatePlugins =  get_plugin_updates();
										if (false != $m_updatePlugins)
										{
											echo "<I><font color='Gray'>You have plugins are out of date</font></I>, upgrade from <a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-secure-by-sitesecuritymonitorcom/securetools.php#tabs-1' ?>here</a>";
										}
									?>

									<?php
									if (!(empty($m_wpseTipsHiddenErrorOnLogin)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenErrorOnLogin</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenWpVersionFrontend)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenWpVersionFrontend</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenWpVersionDashboard)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenWpVersionDashboard</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenWpRSDFront)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenWpRSDFront</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenWpWindowLiveWriter)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenWpWindowLiveWriter</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenCoreUpdate)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenCoreUpdate</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenPluginUpdate)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenPluginUpdate</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHiddenThemeUpdate)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHiddenThemeUpdate</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsAddIndexForPluginDirectory)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsAddIndexForPluginDirectory</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHideYourPluginsFolder)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHideYourPluginsFolder</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsRestrictWpconfig)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsRestrictWpconfig</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsHideYourPluginsFolder)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsHideYourPluginsFolder</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsRestrictWpIncludes)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsRestrictWpIncludes</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsRestrictWpContent)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsRestrictWpContent</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsRestrictWpAdminIP)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsRestrictWpAdminIP</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsRestrictAccessAdmin)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsRestrictAccessAdmin</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsChangeAdminUsername)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsChangeAdminUsername</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsCheckFiles)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsCheckFiles</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsTestTheStrength)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsTestTheStrength</font></I>";
									}
									?>
									<?php
									if (!(empty($m_wpseTipsScanYourSite)))
									{
										echo "<I><font color='Gray'>$m_wpseTipsScanYourSite</font></I>";
									}
									?>

									<br />
									<br />
									<br />
								</div>
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
	<div style="clear:both"></div>
	<br />

	<?php
}

function wpSecureAdminHead()
{
	$wpSecurePluginUrl = plugins_url();
	echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $wpSecurePluginUrl."/wp-secure-by-sitesecuritymonitorcom/css/adminarea.css");
	$m_is_secure = stripos($_SERVER['REQUEST_URI'],'wp-secure-by-sitesecuritymonitorcom/');
	if ($m_is_secure === false)
	{

	}
	else
	{
		echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $wpSecurePluginUrl."/wp-secure-by-sitesecuritymonitorcom/js/prettyCheckboxes/css/prettyCheckboxes.css");
		echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $wpSecurePluginUrl."/wp-secure-by-sitesecuritymonitorcom/js/tablesorter/tests/assets/css/new.css");
		echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $wpSecurePluginUrl."/wp-secure-by-sitesecuritymonitorcom/js/password_strength/style.css");
		echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $wpSecurePluginUrl."/wp-secure-by-sitesecuritymonitorcom/js/confirm/css/confirm.css");

		//echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', $realhradUrl."/wp-secure-by-sitesecuritymonitorcom/css/jquery.tabs.css");
		//echo sprintf('<link rel="stylesheet" href="%s" type="text/css" media="screen" />', "http://jqueryui.com/latest/themes/base/ui.all.css");

?>
		<script type="text/javascript">
		//if(typeof jQuery=='undefined')
		//{
			//document.write('<'+'script src="/wp-includes/js/jquery/jquery.js" type="text/javascript"></'+'script>')
		//}
		</script>
			<script src="http://www.google.com/jsapi" type="text/javascript"></script>
			<script type="text/javascript" charset="utf-8">
				google.load("jquery", "1.3.2");
			</script>
		<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/prettyCheckboxes/js/prettyCheckboxes.js"></script>

		<script type="text/javascript"  charset="utf-8">
		$(document).ready(function()
		{
		//jQuery('input[type=checkbox],input[type=radio]').prettyCheckboxes();
			$('input[type=checkbox],input[type=radio]').prettyCheckboxes
			({
				checkboxWidth: 17, // The width of your custom checkbox
				checkboxHeight: 17, // The height of your custom checkbox
				className : 'prettyCheckbox', // The classname of your custom checkbox
				display: 'list' // The style you want it to be display (inline or list)
			});
		});
		</script>

		<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.core.js"></script>
		<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-includes/js/jquery/ui.tabs.js"></script>
		<script type="text/javascript" src="<?php  echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/jquery.cookie.js"></script>
		<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs').tabs({cookie:{ expires: 30 }})});</script>
		<script src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/thickbox/thickbox.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/thickbox/thickbox.css" type="text/css" media="all" />
		<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/qtip/jquery.qtip-1.0.0-rc3.min.js"></script>
		<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/progressbar/js/jquery.progressbar.js"></script>
		<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/password_strength/password_strength_plugin.js"></script>
		<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/confirm/js/jquery.simplemodal.js"></script>
		<script type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/confirm/js/confirm.js"></script>
		<script type="text/javascript">
		//$(document).ready
		//(
		function wpseTips(pp_id,pp_content)
		{
			//alert(pp_id);
			//alert(pp_content);
			jQuery(pp_id).qtip
			(
				{
					content:pp_content,
					//content:'Before do this,we suggest you do a full backup or at least do a database backup.',
   					style:
   					{
      					width: 400,
      					padding: 5,
      					background: '#fcfeec',
      					color: 'green',
      					textAlign: 'left',
      					border:
      					{
         					width: 1,
         					radius: 8,
         					color: '#ddd'
      					}
    				},
    				position:
    				{
      					corner:
      					{
         					target: 'leftMiddle',
         					tooltip: 'rightMiddle'
      					}
    				},
					show:'mouseover',
					hide:'mouseout'
				}
			)
		}
		//wpseTips('#label-wordpress-upgrade','Before do this,we suggest you do a full backup or at least do a database backup.');
		//)

		</script>
<?php
		//echo '<script type="text/javascript" src="'.get_option('siteurl').'/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/js/jquery.cookie.js"></script>';
		//echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#tabs').tabs({cookie:{ expires: 30 }})});</script>";

	}
}

function wpseIsSafeMode()
{
	if ((!ini_get("safe_mode")) || (strtolower( ini_get('safe_mode') == "off")))
	{
		return false;
	}
	else
	{
		wpseNotice('Sorry,You hosting working under "PHP Safe Mode", it maybe cause some problems, please disable php "PHP Safe Mode" when we upgrade the wordpress automaticly',$p_log = null);
		return true;
	}
}


function wpseCheckFTP()
{
	$m_ftphost = $m_ftp_path = $m_ftpusername = $m_ftppassword = '';
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

	//include get_option('siteurl')."/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/pemftp-2008-09-17/ftp_class.php";
	require_once("lib/pemftp-2008-09-17/ftp_class.php");

	$ftp = new ftp(False,False);
	$ftp->Verbose = False;
	$ftp->LocalEcho = False;
	if(!$ftp->SetServer($m_ftphost))
	{
		$ftp->quit();
		$p_message = 'Setiing ftp server failed.';
		wpseNotice($p_message);
		return false;
	}

	if (!$ftp->connect())
	{
		$ftp->quit();
		$p_message = 'Cannot connect this ftp server.';
		wpseNotice($p_message);
		return false;
	}

	if (!$ftp->login($m_ftpusername, $m_ftppassword))
	{
		$ftp->quit();
		$p_message = 'Login fails at this ftp server.';
		wpseNotice($p_message);
		return false;
	}

	if(!$ftp->SetType(FTP_AUTOASCII))
	{
		$ftp->quit();
		$p_message = 'SetType fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	if(!$ftp->Passive(FALSE))
	{
		$ftp->quit();
		$p_message = 'Passive fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	$ftp->chdir($m_ftp_path);
	$ftp->cdup();

	$ftp->nlist("-la");

	$list=$ftp->rawlist(".", "-lA");
	if($list===false)
	{
		$ftp->quit();
		$p_message = 'List fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	$ftp->chdir($m_ftp_path);
	$filename  = "wp-config.php";
	if(FALSE === $ftp->get($filename))
	{
		$ftp->quit();
		$p_message = 'Can not find old wordpress in this path!';
		wpseNotice($p_message);
		return false;
	}

	$ftp->nlist("-la");
	$ftp->chdir($m_ftp_path);
	$filename  = ABSPATH."wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/images/progressbar.gif";
	$remotefilename = "/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/images/progressbar.gif";

	if(FALSE === $ftp->put($filename, $remotefilename."new-"))
	{
		$ftp->quit();
		$p_message = 'Can not upload files to this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	if( FALSE === $ftp->delete($remotefilename."new-"))
	{
		$ftp->quit();
		$p_message = 'Can not delete files at this ftp server!';
		wpseNotice($p_message);
		return false;
	}
	$ftp->quit();
	return true;
}



function wpseOpenFtp()
{
	$m_ftphost = $m_ftp_path = $m_ftpusername = $m_ftppassword = '';
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

	require_once("lib/pemftp-2008-09-17/ftp_class.php");

	$ftp = new ftp(False,False);
	$ftp->Verbose = FALSE;
	$ftp->LocalEcho = FALSE;
	if(!$ftp->SetServer($m_ftphost))
	{
		$ftp->quit();
		$p_message = 'Setiing ftp server failed.';
		wpseNotice($p_message);
		return false;
	}

	if (!$ftp->connect())
	{
		$ftp->quit();
		$p_message = 'Cannot connect this ftp server.';
		wpseNotice($p_message);
		return false;
	}

	if (!$ftp->login($m_ftpusername, $m_ftppassword))
	{
		$ftp->quit();
		$p_message = 'Login fails at this ftp server.';
		wpseNotice($p_message);
		return false;
	}

	if(!$ftp->SetType(FTP_AUTOASCII))
	{
		$ftp->quit();
		$p_message = 'SetType fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	if(!$ftp->Passive(FALSE))
	{
		$ftp->quit();
		$p_message = 'Passive fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}
	return $ftp;
}

function wpseFtpUpload($ftp,$p_sourcefile,$p_goalfile)
{

	$m_ftphost = $m_ftp_path = $m_ftpusername = $m_ftppassword = '';
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
/*
	require_once(get_option('siteurl')."/wp-content/plugins/wp-secure-by-sitesecuritymonitorcom/lib/pemftp-2008-09-17/ftp_class.php");

	$ftp = new ftp(TRUE);
	$ftp->Verbose = TRUE;
	$ftp->LocalEcho = TRUE;
	if(!$ftp->SetServer($m_ftphost))
	{
		$ftp->quit();
		$p_message = 'Setiing ftp server failed.';
		wpseNotice($p_message);
		return false;
	}

	if (!$ftp->connect())
	{
		$ftp->quit();
		$p_message = 'Cannot connect this ftp server.';
		wpseNotice($p_message);
		return false;
	}

	if (!$ftp->login($m_ftpusername, $m_ftppassword))
	{
		$ftp->quit();
		$p_message = 'Login fails at this ftp server.';
		wpseNotice($p_message);
		return false;
	}

	if(!$ftp->SetType(FTP_AUTOASCII))
	{
		$ftp->quit();
		$p_message = 'SetType fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	if(!$ftp->Passive(FALSE))
	{
		$ftp->quit();
		$p_message = 'Passive fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}
*/
	$ftp->chdir($m_ftp_path);
/*
	$ftp->cdup();

	$ftp->nlist("-la");

	$list=$ftp->rawlist(".", "-lA");
	if($list===false)
	{
		$ftp->quit();
		$p_message = 'List fails at this ftp server!';
		wpseNotice($p_message);
		return false;
	}

	$ftp->chdir($m_ftp_path);

	$filename  = "wp-config.php";
	if(FALSE === $ftp->get($filename))
	{
		$ftp->quit();
		$p_message = 'Can not find old wordpress in this path!';
		wpseNotice($p_message);
		return false;
	}
	$ftp->nlist("-la");
	*/

	$filename  = $p_sourcefile;
	if (is_file($p_sourcefile))
	{
		if(FALSE === $ftp->put($filename, $p_goalfile))
		{
			@$ftp->quit();
			$p_message = 'Can not upload files to this ftp server!';
			wpseNotice($p_message,"YES");
			return false;
		}
	}
	if (is_dir($p_sourcefile))
	{
		if(FALSE === $ftp->mput($p_sourcefile, $p_goalfile,true))
		{
			@$ftp->quit();
			$p_message = 'Can not upload files to this ftp server!';
			wpseNotice($p_message,"YES");
			return false;
		}
	}
	/*
	if( FALSE === $ftp->delete("new-".$filename))
	{
		$ftp->quit();
		$p_message = 'Can not delete files at this ftp server!';
		wpseNotice($p_message,"YES");
		return false;
	}
	*/
	//$ftp->quit();
	return true;
}

function wpseDownload($p_local,$p_remote)
{
	require_once (ABSPATH.WPINC.'/class-snoopy.php');

    if (file_exists($p_local))
    {
		$p_message = "The file($p_local) is exist and can not be deleted!";
		wpseNotice($p_message,"YES","fail");
		return false;
	}

    $m_handle = fopen($p_local, 'w');
    if( ! $m_handle )
    {
		$p_message = "Can not write to file $p_local!";
		wpseNotice($p_message,"YES","fail");
     	return false;
	}

	$m_snoopy = new Snoopy();
	$m_snoopy->read_timeout = 60;
	@$m_snoopy->fetch($p_remote);

	if( $m_snoopy->status != '200' )
	{
      	return false;
	}

    //write the downloaded file to disk
    fwrite($m_handle, $m_snoopy->results);
  	fclose($m_handle);
	//$p_message = "Download the file $p_remote finished.";
	//wpseNotice($p_message,"YES");
	//!!! there should use log,do not need to show notice.
    return true;
}






function wpseDownloadNewestWP()
{

}




function wpseWpUpgradeCheck()
{
	$m_is_safe_mode = wpseIsSafeMode();
	if ($m_is_safe_mode === true)
	{
		return false;
	}

	set_time_limit(1000);

	$m_ftp_is_ok = wpseCheckFTP($m_ftpusername,$m_ftppassword);
	if ($m_ftp_is_ok === false)
	{
		return false;
	}
	//??? wpseRemoveDir();
	return true;
}

function wpseRemoveDir($p_dir)
{
    $result = false;
    if(! is_dir($p_dir))
    {
        return true;
    }
    $m_handle = opendir($p_dir);
    while(($file = readdir($m_handle)) !== false)
    {
        if($file != '.' && $file != '..')
        {
            $dir = $p_dir . DIRECTORY_SEPARATOR . $file;
            is_dir($dir) ? wpseRemoveDir($dir) : unlink($dir);
        }
    }
    closedir($m_handle);
    $result = rmdir($p_dir) ? true : false;
    return $result;

}


function wpseCopyDir($p_sourcedir,$p_goaldir)
{
	if (!(is_dir($p_goaldir)))
	{
		if (@mkdir($p_goaldir) == false)
		{
			$p_message = "Errors happen when copying,Can not create direcory $p_goaldir!";
			wpseNotice($p_message,"YES","fail");
        	return false;
		}
	}
    if ((!is_dir($p_sourcedir)) || (!is_dir($p_goaldir)))
    {
		$p_message = "$p_sourcedir or $p_goaldir is not a normal directory!";
		wpseNotice($p_message,"YES","fail");
        return false;
    }

    $m_handle = opendir($p_sourcedir);
    while(($file = readdir($m_handle)) !== false)
    {
        if($file != '.' && $file != '..')
        {
        	if (is_file($p_sourcedir."/".$file))
        	{
        		if (@copy($p_sourcedir."/".$file,$p_goaldir."/".$file) == false )
        		{
					$p_message = "Can not copy file from ".$p_sourcedir."/".$file." to ".$p_goaldir."/".$file;
					wpseNotice($p_message,"YES","fail");
        			return false;
        		}

        	}
            if (is_dir($p_sourcedir."/".$file))
            //if (is_dir($file))
            {
            	if ( false === (strpos($p_sourcedir."/".$file,"wpseBackupDir")))
            	{
            		wpseCopyDir($p_sourcedir."/".$file,$p_goaldir."/".$file);
            	}

            	//$m_gfile = str_replace($p_sourcedir,$p_goaldir,$file);
            	//wpseCopyDir($file,$m_gfile);
            }
        }
    }
    closedir($m_handle);
    return true;
}


function wpseMakeDir($p_dir)
{
	$m_result = @mkdir($p_dir);
	return $m_result;
}


function wpseChangeMaintenance($p_model)
{
	if ($p_model == "YES")
	{
		$m_maintainHandle = @fopen(ABSPATH.".maintenance","w");
		if ($m_maintainHandle == false)
		{
			$p_message = "Can not create maintenance file!";
			wpseNotice($p_message,"YES","fail");
     		return false;
		}

		$m_text = '<?php $upgrading = time(); ?>';
		$m_wroten = fwrite($m_maintainHandle,$m_text);
		if ($m_wroten === false)
		{
			$p_message = "Can not write into maintenance file!";
			wpseNotice($p_message,"YES");
     		return false;
		}
		else
		{
			return true;
		}
	}

	if ($p_model == "NO")
	{
		$m_maintainFile = ABSPATH.".maintenance";
		if (!(is_file($m_maintainFile)))
		{
			return true;
		}
		else
		{
			$m_delete = unlink($m_maintainFile);
			if ($m_delete === false)
			{
				$p_message = "Can not delete maintenance file!";
				wpseNotice($p_message,"YES");
     			return false;
			}
			else
			{
				return true;
			}
		}

	}
}

function wpseHiddenWPVersionFront()
{
	global $wp_version, $ver;

	$wpseRandomVersion = rand(100,500);
	remove_action('wp_head',wp_generator);
	/*
	if (function_exists('the_generator'))
	{

		//add_filter('the_generator',create_function('$wpseNothing', "return false;"));
	}
	*/
	if (!is_admin())
	{
		$wp_version = $wpseRandomVersion;
	}
}


function wpseHiddenWPVersionDashboard()
{
	global $wp_version, $ver;

	$wpseRandomVersion = rand(100,500);

	if (is_admin())
	{
		$wp_version = $wpseRandomVersion;
	}
}


function wpseKeepNoticePlace()
{
	echo "<div id='wpseNotice' style='display:none;margin-top:15px;'></div>";
}

function wpseNotice($p_message,$p_log = null,$p_status = null)
{
?>

<script type="text/javascript">
	document.getElementById('wpseNotice').style.display='block';
	document.getElementById('wpseNotice').innerHTML = '<div id="message" class="updated fade"><p><strong><?php echo $p_message; ?></strong></p></div>'
</script>
<?php
	if ($p_log == 'YES')
	{
		if (empty($p_status))
		{
			$p_status = "success";
		}
		wpseLog($p_message,$p_status);
	}
}

function wpseLog($p_message,$p_status = null)
{
	global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
	get_currentuserinfo();
	if (empty($p_status))
	{
		$p_status = false;
	}
	$m_table = $table_prefix."wpselog";
	$m_sql = "insert into `".$m_table."`  (`status`,`errorreason` , `errordate` , `valid`) values('".$p_status."','".$p_message."','". date("Y-m-d H:i:s") ."','YES')";
	$m_result = $wpdb->query($m_sql);
}


?>