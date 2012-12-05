<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="de" xmlns="http://www.w3.org/1999/xhtml">
  <head profile='http://www.w3.org/2006/03/hcard'>
    <script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
     
    <script type='text/javascript'>                        
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
        (function() {
        var gads = document.createElement('script');
        gads.async = true;
        gads.type = 'text/javascript';
        var useSSL = 'https:' == document.location.protocol;
        gads.src = (useSSL ? 'https:' : 'http:') + 
        '//www.googletagservices.com/tag/js/gpt.js';
        var node = document.getElementsByTagName('script')[0];
        node.parentNode.insertBefore(gads, node);
        })();
    </script>
    
    <script type='text/javascript'>
        (function () { 
            var scriptProto = 'https:' == document.location.protocol ? 'https://' : 'http://';
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.async = true;
            script.src = scriptProto+'js.cdn.yieldkit.com/v1/js?api_key=5561bd81c7f3309dd647804cde2fe543&site=http://www.'+document.domain+'';
            (document.getElementsByTagName('head')[0] || document.body).appendChild(script); 
        })();
    </script>

    <script type='text/javascript'>
        googletag.cmd.push(function() {
        /*googletag.defineSlot('/1043423/Yigg-Button-1L', [170, 125], 'div-gpt-ad-1342004948184-0').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-1R', [170, 125], 'div-gpt-ad-1342004948184-1').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-2L', [170, 125], 'div-gpt-ad-1342004948184-2').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-2R', [170, 125], 'div-gpt-ad-1342004948184-3').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-3L', [170, 125], 'div-gpt-ad-1342004948184-4').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-3R', [170, 125], 'div-gpt-ad-1342004948184-5').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-4L', [170, 125], 'div-gpt-ad-1342004948184-6').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-4R', [170, 125], 'div-gpt-ad-1342004948184-7').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-5L', [170, 125], 'div-gpt-ad-1342004948184-8').addService(googletag.pubads());
        googletag.defineSlot('/1043423/Yigg-Button-5R', [170, 125], 'div-gpt-ad-1342004948184-9').addService(googletag.pubads());*/
        googletag.defineSlot('/1043423/rectangle', [300, 250], 'div-gpt-ad-1346766539123-0').addService(googletag.pubads());
        googletag.defineSlot('/1043423/rectangle2', [300, 250], 'div-gpt-ad-1347010073546-1').addService(googletag.pubads());
        googletag.pubads().enableSingleRequest();
        //googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
        });
    </script>
    <link rel="shortcut icon" href="/favicon.png" />
    <base href="http<?php echo $sf_request->isSecure() ? "s" :"" ?>://<?php echo $sf_request->getHost() . $sf_request->getRelativeUrlRoot();  ?>/" />

    <?php include_http_metas(); ?>
    <?php include_metas() ?>
    <?php include_component('system','Feeds') ?>
    <?php include_title() ?>
    <?php use_javascript('jquery-1.7.1.js') ?>
    <?php include_javascripts() ?>

    <?php //<script type='text/javascript' src='http://button.spread.ly/js/v1/loader.js'></script> ?>
    <?php /*<script>
		window.onload = function(){
			var head = document.getElementsByTagName("head")[0];
			var css = document.createElement('link');
			css.type = 'text/css';
			css.rel = 'stylesheet';
			css.href = '//button.spread.ly/css/v1/button.css';
			head.appendChild(css);
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.src = '//button.spread.ly/js/v1/button.js';
			head.appendChild(s);
			//var a = document.createElement('script');
			//a.type = 'text/javascript';
			//a.src = '//button.spread.ly/js/v1/advertisement.js';
			//head.appendChild(a);
		};
	</script>*/?>
    
    <script type="text/javascript" src="http://static.plista.com/fullplista/54257f4f1c2c966980b63b2c.js"></script> 
    
    <?php include_stylesheets() ?>    
    <script type='text/javascript'>
    $(document).ready(function(){
       // alert('test jquery');       
        
    });
    </script>

      <!-- START FACEBOOK JAVASCRIPT SDK -->
      <div id="fb-root"></div>
      <script>
          window.fbAsyncInit = function() {
              FB.init({
                  appId        : <?php echo sfConfig::get('app_facebook_app_id') ?>,
                  status       : false,
                  cookie       : true,
                  xfbml        : true,
                  oauth        : true
              });
          };

          // Load the SDK Asynchronously
          (function(d){
              var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
              if (d.getElementById(id)) {return;}
              js = d.createElement('script'); js.id = id; js.async = true;
              js.src = "//connect.facebook.net/en_US/all.js";
              ref.parentNode.insertBefore(js, ref);
          }(document));

          function onClickloginfb() {
              FB.login(function(response) {
                  if (response.authResponse) {
                      window.location = "/fb_login"
                  }
              }, {perms:'email,user_interests,user_likes'});


          }
      </script>
      <!-- END FACEBOOK JAVASCRIPT SDK -->
    
    <link href="/css/yigg-styles-v8.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="<?=( $sf_user->isAuthenticated() ? "user-auth" : "user-anon" )?>">
    <div class="bg_top">
    <div class="bg_bt">
    <div class="bg_mid">
      <div id="container">          
        <div class="header">
            <div class="header_data">                
                <div class="login_box">
                    <div class="logo_box">
                        <a tabindex="1" href="#content" class="hidden">Direkt zum Inhalt </a>
                        <?php
                        echo link_to(img_tag('yigg_logo.png', array(
                                    'alt' => 'YiGG Nachrichten zum Mitmachen: Lesen - Bewerten - Schreiben',
                                    'width' => 90,
                                    'height' => 53
                                )), '@best_stories', array(
                            'title' => 'YiGG Nachrichten zum Mitmachen: Lesen - Bewerten - Schreiben',
                            'rel' => 'home',
                            'class' => 'logo'
                        ));
                        ?>
                    </div>
                    <div class="login_box_cont">
                        <?php include_partial("system/navigation"); ?>
                        <?php if(true === $sf_user->hasUser()):?>
                            <?php //echo link_to("Abmelden","@user_logout");?>
                            <div class="login_link">
                                <a href="<?php echo url_for('@user_logout');?>">Logout</a>                                
                            </div>
                        <?php else: ?>
                            <div class="login_link">
                                <a href="<?php echo url_for('@user_login');?>">Login</a>
                                <div class="login_fb" onclick="onClickloginfb(); return false;"></div>
                                <div class="login_box">
                                    <a class="fb_cnct" href="#" onclick="onClickloginfb(); return false;"></a>
                                    <a class="yigg_cnct" href="<?php echo url_for('@user_login');?>"></a>
                                </div>
                            </div>
                        <?php endif; ?>                                                                           
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>        
      <div id="content">
          <div class="content_data">
          <?php if(true === has_slot("sponsoring")): ?>
          <?php include_slot("sponsoring"); ?>
        <?php endif; ?>
        
        <div class="twoThree clr">
        <div class="twoThree-left">
         <!-- <script type="text/javascript" src="http://a.ligatus.com/?ids=33680&t=js"></script>  -->
         <!--  google_ad_section_start -->
          <?php echo $sf_data->getRaw('sf_content'); ?>
          <!--  google_ad_section_end -->          
        </div>
        <div class="twoThree-right">
          <?php include_partial("user/userinfo"); ?>
          <?php include_component("story", "bestVideos", array( "height"=> 285, "width" => 370)); ?>
            <?php //if(true === has_slot("sidebar_sponsoring")): ?>
            <?php //include_slot("sidebar_sponsoring");  ?>
          <?php //endif; ?>
          <?php if(true === has_slot("sidebar")): ?>
            <?php include_slot("sidebar"); ?>
          <?php endif; ?> 
            <div class="fb-like-box"
                 data-href="http://www.facebook.com/yiggde"
                 data-width="300"
                 data-height="300"
                 data-show-faces="true"
                 data-stream="false"
                 data-header="false">
            </div>
            <?php include_partial("user/anzeigeBottom"); ?>
          <?php include_component("story", "bestVideosBottom", array( "height"=> 285, "width" => 370)); ?>
        </div>
      </div>

        </div>
      </div>
      <div class="hr_bt"></div>
      <div class="hr_bt"></div>
  <?php include_partial("system/footer");?>
        </div>
  </div>
  </div>
  </div>
        <script type="text/javascript">
            var _sf_async_config={uid:23222,domain:"yigg.de"};
            (function(){
                function loadChartbeat() {
                    window._sf_endpt=(new Date()).getTime();
                    var e = document.createElement('script');
                    e.setAttribute('language', 'javascript');
                    e.setAttribute('type', 'text/javascript');
                    e.setAttribute('src',
                    (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") + "js/chartbeat.js");
                    document.body.appendChild(e);
                }
                var oldonload = window.onload;
                window.onload = (typeof window.onload != 'function') ?
                    loadChartbeat : function() { oldonload(); loadChartbeat(); };
            })();

        </script>

        <script type="text/javascript">
            var uvOptions = {};
            (function() {
                var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
                uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://' ) + 'widget.uservoice.com/ivhHCap8jZkAWPJveHWCaw.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
            })();
        </script>                
  </body>
</html>
