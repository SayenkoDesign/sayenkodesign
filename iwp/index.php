<?php

/************************************************************
 * InfiniteWP Admin panel									*
 * Copyright (c) 2012 Revmakx								*
 * www.revmakx.com											*
 *															*
 ************************************************************/

include("includes/app.php");
onBrowserLoad();
initMenus();

if(function_exists('multiUserStatus')){
    multiUserStatus();
}else{
    if(userStatus() != 'admin'){
            userLogout();
    }
}

$mainJson = jsonEncoder(panelRequestManager::getSitesUpdates());
$toolTipData = jsonEncoder(panelRequestManager::getUserHelp());
$favourites =  jsonEncoder(panelRequestManager::getFavourites());
$sitesData = jsonEncoder(panelRequestManager::getSites());
$sitesListData = jsonEncoder(panelRequestManager::getSitesList());
$groupData = jsonEncoder(panelRequestManager::getGroupsSites());
$updateAvailable = jsonEncoder(checkUpdate(false, false));
$updateAvailableNotify = jsonEncoder(panelRequestManager::isUpdateHideNotify());
$totalSettings =  jsonEncoder(array("data"=>panelRequestManager::requiredData(array("getSettingsAll"=>1))));
$fixedNotifications = jsonEncoder(getNotifications(true));
$cronFrequency = jsonEncoder(getRealSystemCronRunningFrequency());
$clientUpdatesAvailable=jsonEncoder(panelRequestManager::getClientUpdateAvailableSiteIDs());
$purchasedAddons = jsonEncoder(Reg::get('purchasedAddons'));
$allAddonsBought = jsonEncoder(Reg::get('addonDetails'));
//$allAddonsBought = jsonEncoder(Reg::get('activeAddons'));
//$allAddonsBought = jsonEncoder(Reg::get('allPurchasedAddonsNameAndSlug'));

$multiUserAllowAccess = jsonEncoder(panelRequestManager::requiredData(array("multiUserAllowAccess"=>1)));

//for notification center html
$notifCenterData = jsonEncoder(panelRequestManager::requiredData(array("updateNotificationContent"=>1)));
$favouritesGroupData = json_encode(panelRequestManager::getFavouritesGroups());

$isAddonSuiteMiniLimitExceeded = panelRequestManager::checkIsAddonSuiteMiniLimitExceeded();
$isMiniExpired = panelRequestManager::checkIsMiniExpired();
$addonSuiteMiniActivity = panelRequestManager::getAddonSuiteMiniActivity();
$addonSuiteMiniLimit = panelRequestManager::getAddonSuiteMiniLimit();
$IDToBeUpgradedFromMini = panelRequestManager::getIDToBeUpgradedFromMini();
$IDForAddonSuite = panelRequestManager::getIDForAddonSuite();
$priceForSuiteUpgradedFromMini = panelRequestManager::getPriceForSuiteUpgradedFromMini();
$priceForAddonSuite = panelRequestManager::getPriceForAddonSuite();
$addonSuiteOrMiniPurchasedDate = panelRequestManager::getAddonSuiteOrMiniPurchasedDate();
$currentTimestamp = panelRequestManager::getCurrentTimestamp();
$addonSuiteLimitExceededIllegally = jsonEncoder(Reg::get('addonSuiteLimitExceededIllegally'));
$appRegisteredUser = getOption("appRegisteredUser");
$completedInitialSetup = panelRequestManager::isInitialSetupCompleted();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex">
<title>InfiniteWP</title>
<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/select2.css?<?php echo APP_VERSION; ?>" type="text/css" />
<link rel="stylesheet" href="css/core.css?<?php echo APP_VERSION; ?>" type="text/css" />
<link rel="stylesheet" href="css/datepicker.css?<?php echo APP_VERSION; ?>" type="text/css" />
<link rel="stylesheet" href="css/nanoscroller.css?<?php echo APP_VERSION; ?>" type="text/css" />
<link rel="stylesheet" href="css/jPaginator.css?<?php echo APP_VERSION; ?>" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/jquery-ui.min.css?<?php echo APP_VERSION; ?>" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery.qtip.css?<?php echo APP_VERSION; ?>" type="text/css" media="all" />
<link rel="stylesheet" href="css/custom_checkbox.css?<?php echo APP_VERSION; ?>" type="text/css" media="all" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie8nlr.css?<?php echo APP_VERSION; ?>" />
<![endif]-->
<script src="js/jquery.min.js?<?php echo APP_VERSION; ?>" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery-ui.min.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/ZeroClipboard.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/select2.min.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/fileuploader.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/apps.js?<?php echo APP_VERSION; ?>" type="text/javascript" charset="utf-8"></script>
<script src="js/load.js?<?php echo APP_VERSION; ?>" type="text/javascript" charset="utf-8"></script>
<script src="js/jPaginator-min.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/jquery.qtip.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/jquery.mousewheel.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>
<script src="js/jquery.unveil.js?<?php echo APP_VERSION; ?>" type="text/javascript"></script>

<script>
var globalMessageFlagForMini=0;
var permissions = <?php echo $multiUserAllowAccess; ?>;
var systemURL = "<?php echo APP_URL;?>";
var serviceURL = "<?php echo getOption('serviceURL');?>";
$(document).ready(function(){
    iwpCronInvitied = "<?php echo getOption('iwpCronInvited');?>";
    var notifyUser = "<?php echo getOption('iwpCrontInvitedNotificationReq');?>";
    if(iwpCronInvitied && notifyUser){
        showIWPCronInviteDialog();
        resetBottomToolbar();
    }
});

var appVersion = "<?php echo APP_VERSION; ?>";
var appInstallHash = "<?php echo APP_INSTALL_HASH; ?>";
var IP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
var APP_PHP_CRON_CMD = "<?php echo APP_PHP_CRON_CMD; ?>";
var APP_ROOT = decodeURIComponent("<?php echo rawurlencode(APP_ROOT); ?>");
var tempCronFrequency = "<?php echo $cronFrequency; ?>";
if (tempCronFrequency == 0) {
  var CRON_FREQUENCY = '<div class="rep_sprite_backup block_fail_icon">Server cron is not running.</div>' ;
} else {
  var CRON_FREQUENCY = '<div class="rep_sprite_backup block_success_icon">This cron is running every '+tempCronFrequency+' min</div>' ;
}
var GAHelpTracking = "<?php echo GA_HELP_TRACKING ?>";
var supportURL = "<?php echo SUPPORT_URL ?>";
var WPChangeLogURL = "<?php echo WP_CHANGELOG_URL?>";
var WPPluginChangeLogURL = "<?php echo WP_PLUGIN_CHANGELOG_URL?>";
var mainJson = <?php echo $mainJson?>;
var sitesjson = mainJson.siteView;
var pluginsjson = mainJson.pluginsView.plugins;
var themesjson = mainJson.themesView.themes;
var translationsjson=mainJson.translationsView.translations;
var wpjson = mainJson.coreView.core;
var toolTipData = <?php echo $toolTipData;?>;
var favourites = <?php echo $favourites; ?>;
var site = <?php echo  $sitesData;?>;
var sitesList = <?php echo  $sitesListData;?>;
var group = <?php echo  $groupData;?>;
var favouritesGroupData = <?php echo $favouritesGroupData ?>;
var totalSites = getPropertyCount(site);
var totalGroups = getPropertyCount(group);
var totalUpdates =  getPropertyCount(mainJson);
var pluginsStatus,themesStatus;
var updateAvailable   = <?php echo $updateAvailable;?>;
var updateAvailableNotify=<?php echo $updateAvailableNotify;?>;
var fixedNotifications = <?php echo $fixedNotifications;?>;
var settingsData = <?php echo $totalSettings; ?>;
var fromEmailDetails = "<?php echo getDefaultFromEmail(); ?>";
var clientUpdatesAvailable=<?php echo $clientUpdatesAvailable;?>;
settingsData['data']['getSettingsAll']['settings']['timeZone'] = '';
var forcedAjaxInterval = <?php echo FORCED_AJAX_CALL_MIN_INTERVAL; ?>;	
var completedInitialSetup = <?php echo $completedInitialSetup; ?>;
var isShowBetaWelcome ="<?php echo isShowBetaWelcome();?>"
var isShow2_7AddonUpdatePopup ="<?php echo isShow2_7AddonUpdatePopup();?>"
//notification center JS object
var notifCenterAllData = {};
notifCenterAllData['data'] = {};
notifCenterAllData['data'] = <?php echo $notifCenterData;?>;
var isDisabled2FA = <?php echo (defined('DISABLE_2FA'))?1:0; ?>;
var isHTTPSDefined = <?php echo $GLOBALS['isHTTPSDefined']; ?>;
var currentUserAccessLevel = "<?php echo userStatus(); ?>";
var isDirectFS = "<?php echo getOption('isDirectFS');  ?>"
var isAddonSuiteMiniLimitExceeded = parseInt("<?php echo($isAddonSuiteMiniLimitExceeded); ?>");
var addonSuiteMiniActivity = "<?php echo($addonSuiteMiniActivity); ?>";
var addonSuiteMiniLimit = parseInt("<?php echo($addonSuiteMiniLimit); ?>");
var addonSuiteLimitExceededIllegally = parseInt("<?php echo($addonSuiteLimitExceededIllegally); ?>");
var isAddonSuiteLimitExceededAttempt = 0;
var IDToBeUpgradedFromMini = parseInt("<?php echo($IDToBeUpgradedFromMini); ?>");
var IDForAddonSuite = parseInt("<?php echo($IDForAddonSuite); ?>");
var isMiniExpired = parseInt("<?php echo($isMiniExpired); ?>");
var isConfigWritable=<?php echo isConfigWritable(); ?>;
var isFSMethodDefined=<?php echo defined('FS_METHOD')?1 :0; ?>;
var priceForSuiteUpgradedFromMini = parseInt("<?php echo($priceForSuiteUpgradedFromMini); ?>");
var priceForAddonSuite = parseInt("<?php echo($priceForAddonSuite); ?>");
var addonSuiteOrMiniPurchasedDate = parseInt("<?php echo($addonSuiteOrMiniPurchasedDate); ?>");
var currentTimestamp = parseInt("<?php echo($currentTimestamp); ?>");
var appRegisteredUser = "<?php echo($appRegisteredUser); ?>";
var IWPSiteURL = "<?php echo(IWP_SITE_URL); ?>";
var googleSettings='';
var cpBrandingSettings='';
var uptimeMonitoringSettings='';
var googleAnalyticsAccess='';
var googleWebMastersAccess='';
var googlePageSpeedAccess='';
var scheduledBackupSettings = '';
var purchasedAddonsGlobal = <?php echo $allAddonsBought; ?>;
var markBottomLines = <?php echo jsonEncoder(json_decode(getOption('markBottomLines'), true)); ?>;// jsonEncoder(json_decode()) this will help empty content to hv null data
var threeSitesTweetStatus = '<?php if(!getOption("tweet_status_three_sites")){ echo "no"; }else{ echo getOption("tweet_status_three_sites"); } ?>';  //storing global variable for displaying tweet
var updateAllTweetStatus = '<?php if(!getOption("tweet_status_update_all")){ echo "no"; }else{ echo getOption("tweet_status_update_all"); } ?>';

<?php echo getAddonHeadJS(); ?>
<?php if(!empty($_REQUEST['page'])) {?>
	reloadStatsControl=0;
<?php } ?>

</script>
<script type="text/javascript" src="js/init.js?<?php echo APP_VERSION; ?>" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.nanoscroller.min.js?<?php echo APP_VERSION; ?>"></script>
<script type="text/javascript" src="js/datepicker.js?<?php echo APP_VERSION; ?>"></script>
<script type="text/javascript" src="js/eye.js?<?php echo APP_VERSION; ?>"></script>
<script type="text/javascript" src="js/utils.js?<?php echo APP_VERSION; ?>"></script>
<script type="text/javascript" src="js/layout.js?<?php echo APP_VERSION; ?>"></script>

<?php if(userStatus() != 'admin'){ ?>
<script>
$(function () {
	$(".settingsButtons").click();
});
</script>
<?php } ?>
<!-- addon ext src starts here -->
<?php 
if($addonSuiteLimitExceededIllegally==0) echo getAddonsHTMLHead(); 
?>
<?php if(!empty($_REQUEST['page']))
{ ?>
	<script>
    $(function () { 
        reloadStatsControl=0;
        <?php if($_REQUEST['page']=="addons") ?>
            $("#iwpAddonsBtn").click();		
        processPage("<?php echo $_REQUEST['page'];?>");
    
    });
    </script>
<?php } ?>
<style>
@media only screen and (max-width : 1360px) {
ul#header_nav li.resp_hdr_logout { display:inline; }
#header_bar a.logout { display:none;}
}
</style>
</head>
<body>
<div class="notification_cont"></div>
<div id="fb-root"></div>
<div id="updateOverLay" style='display:none;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)"; background-color:#000; opacity:0.7;position:fixed;top: 0;left: 0;width: 100%;height: 100%; z-index:1020'></div>
<div id="loadingDiv" style="display:none">Loading...</div>
<div id="modalDiv"></div>

<!--<div class="overlay_test"></div>-->
<div id="dynamic_resize">
<div id="header_bar"> <div class="header_container"><a href="<?php echo APP_URL; ?>" style="text-decoration:none;">
    <div id="logo"></div></a>
    <div id="admin_panel_label">Admin Panel v<?php echo APP_VERSION; ?></div>
    
    <a class="float-left fb_icon_hdr" href="//www.facebook.com/infinitewp" target="_blank"></a><a class="float-left twitter_icon_hdr" href="//twitter.com/infinitewp" target="_blank"></a>
    <ul id="header_nav">
      <!--<li><a href="">Suggest an Idea</a></li>-->
      <li class="notif_wrap" style="margin-right:16px; position:relative;"> <a class="notif_btn" style="display:none" ><i class="fa fa-bell-o"></i></a> <span class="notif_count" style="display:none" > </span>
        <div class="notification_centre_cont" style= "display:none">
          <div style="">
            <ul class="notif_data_list">
            </ul>
            <div class="weekly_deal_cont cf">
            </div>
          </div>
        </div>
      </li>
      <?php if(userStatus() == 'admin'){ ?><li class="restrictCronToggle"><a class="updates_centre first-level" id="updateCentreBtn">IWP Update Centre<span id="updateCenterCount" style="display:none" class="count">1</span></a>
      	
        <div id="updates_centre_cont" style="display:none">
                   
          <div class="th rep_sprite" style="border-top: 1px solid #C1C4C6; height: 38px; border-bottom: 0;">
            <div class="btn_action float-right"><a class="rep_sprite updateActionBtn">Check Now</a></div>
            
          </div>
        </div>
      </li>
       <li><a class="first-level" id="iwpAddonsBtn">Addons <span class="count" style="<?php if(($addonUpdate = getAddonAlertCount()) < 1){ ?>display:none;<?php } ?>"><?php echo $addonUpdate; ?></span></a></li><?php } ?>
       <li><a class="first-level" href="https://support.infinitewp.com/support/discussions/forums/290737?utm_source=application&utm_medium=userapp&utm_campaign=ideas" target="_blank">Got an idea?</a></li>
      <li class="help"><a class="first-level">Help <span style="font-size:7px;">▼</span></a>
      	<ul class="sub_menu_ul">
        	  <?php /* <li><a href="https://support.infinitewp.com/?utm_source=application&utm_medium=userapp&utm_campaign=support" target="_blank">Discussion Forum</a></li> */ ?>
            <li><a href="javascript:loadReport('',1)">Report Issue</a></li>
<!--             <li><a class="takeTour">Take the tour</a></li> -->
        </ul>
      </li>
      <li class="user_mail"><a id="user_email_acc" style="color:#e9e9e9;"><?php echo $GLOBALS['email']; ?> </a><li>
      <li class="settings" title="Settings" id="mainSettings">
        <a id="settings_btn">Settings</a>
      </li>
	  <li class="resp_hdr_logout"><a class="first-level" href="login.php?logout=now">Logout</a></li>
    </ul>
    <div class="clear-both"></div></div><a href="login.php?logout=now" class="logout">Logout</a>
  </div>
<div id="site_cont">
  
  <div id="main_cont">
    
    <ul class="site_nav">
    	<?php printMenus(); ?>
    </ul>
    
    <div class="btn_reload rep_sprite float-right"><a class="rep_sprite_backup user_select_no" id="reloadStats">Reload Data</a></div>
	<div class="checkbox user_select_no" style="float:right; width:70px; cursor:pointer;" id="clearPluginCache">Clear cache</div>
    <div id="lastReloadTime"></div>
    <ul class="site_nav single_nav float-left"><li class="l1 navLinks" page="history"><a>Activity Log</a></li></ul>
    <div class="clear-both"></div>
    <hr class="dotted" />
    <div class="page_section_title">UPDATES</div>
    <div id="pageContent">
      <div class="empty_data_set welcome">
        <div class="line1">Hey there. Welcome to InfiniteWP.</div>
        <div class="line2">Lets now manage WordPress, the IWP way!</div>
        <div class="line3">
          <div class="welcome_arrow"></div>
          Add a WordPress site to IWP.<br />
          <span style="font-size:12px">(Before adding the website please install and activate InfiniteWP Client Plugin in your WordPress site)</span> </div>
        <a href="//www.youtube.com/watch?v=q94w5Vlpwog" target="_blank">See How</a>. </div>
    </div>
  </div>
</div>
</div>
<div id="bottom_toolbar" class="siteSearch">
  <div id="activityPopup"> </div>
</div>
<script type="text/javascript" language="javascript">
	jQuery(document).ready(function() {
		if(!isNaN(addonSuiteLimitExceededIllegally) && addonSuiteLimitExceededIllegally==1) {
			globalMessageFlagForMini=1;
			addonSuiteMiniLimitExceeded('addonSuiteLimitExceededIllegally');
		}
	});
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

 (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = '//apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 
})();
	//to display notification center content
	processUpdateNotificationContent(notifCenterAllData);	
</script>
</body>
</html>