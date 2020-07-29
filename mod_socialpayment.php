<?php
/*-------------------------------------------------------------------------------
# mod_socialpayment module for Joomla 3.x v1.0.0
# -------------------------------------------------------------------------------
# author    JoomDev (Formerly GraphicAholic)
# copyright Copyright (C) 2020 Joomdev, Inc. All rights reserved.
# @license - GNU General Public License version 2 or later
# Websites: https://www.joomdev.com
--------------------------------------------------------------------------------*/
// No direct access
defined('_JEXEC') or die('Restricted access');
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
// Import the file / foldersystem
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
$document = JFactory::getDocument();
$modbase = JURI::base(true).'/modules/mod_socialpayment/';
$document->addStyleSheet($modbase.'css/socialpayment.css');
$moduleID 	 	= $module->id;
$twitterClick	= $params->get('twitterClick');
$multiClick	= $params->get('multiClick');
$facebookClick	= $params->get('facebookClick');
$googleClick	= $params->get('googleClick');
$newWindow	= $params->get('newWindow');
if($newWindow == "1") $newWindow = "blank";
if($newWindow == "2") $newWindow = "self";
?>
    <div id="fb-root"></div>
    <script type="text/javascript">	
        function graphicaholic() {
          // The file URL that visitors can download after their Like/tweet/+1
          var url = "<?php echo $params->get('URLdownload') ?>";  
          url = "<div class='btn btn-primary'><a href='" + url + "' target='_<?php echo $newWindow ?>'><?php echo $params->get('downloadText') ?></a></div>";	
          document.getElementById("restricted").innerHTML = url;
        }
 
        window.fbAsyncInit = function() {
          FB.init({ status : true, cookie : true, xfbml  : true });
          FB.Event.subscribe('edge.create', function(response) { graphicaholic(); });
        };
 
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
 
        window.twttr = (function (d,s,id) {
          var t, js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
          js.src="//platform.twitter.com/widgets.js"; 
          fjs.parentNode.insertBefore(js, fjs);
          return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
        }(document, "script", "twitter-wjs"));
 
        twttr.ready(function (twttr) {
          twttr.events.bind('tweet', function(event) {
            graphicaholic();
          });
        });
 
        (function() {
          var po = document.createElement('script'); 
          po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; 
          s.parentNode.insertBefore(po, s);
        })();
    </script>	
	<?php if ($params->get('preText') != "") { ?>	
		<?php echo $params->get('preText') ?>	
	<?php } ?>	
      <div id="restricted">
	<?php if ($twitterClick == "show"): ?>
      <?php echo $params->get('twitterText') ?> 
	  <?php if ($multiClick == "multi") : ?>
      <a href="https://twitter.com/share"	
          data-text="<?php echo $params->get('tweetText') ?> [<?php echo rand(1, 9999); ?>]" 
          data-via="<?php echo $params->get('twitterName') ?>" class="twitter-share-button" data-lang="en"></a>
	  <?php elseif ($multiClick == "once") : ?>
	  <a href="https://twitter.com/share"	
          data-text="<?php echo $params->get('tweetText') ?>" 
          data-via="<?php echo $params->get('twitterName') ?>" class="twitter-share-button" data-lang="en"></a>
		  <?php endif ; ?>
	<?php endif ; ?>
	<?php if ($facebookClick == "show"): ?>
	  <?php echo $params->get('fbText') ?> 
      <fb:like href="http://www.facebook.com/<?php echo $params->get('fbURL') ?>" send="false" 
          layout="button_count" width="220" show_faces="false"></fb:like>
	<?php endif ; ?>
	<?php if ($googleClick == "show"): ?>
	<?php echo $params->get('gText') ?>
      <g:plusone size="medium" callback="<?php echo $params->get('gName') ?>"
          href="<?php echo $params->get('gURL') ?>"></g:plusone>
	<?php endif ; ?>
     </div>	
	 <?php if ($params->get('postText') != "") { ?>	
		<?php echo $params->get('postText') ?>	
	 <?php } ?>