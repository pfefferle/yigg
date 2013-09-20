<?php

function social_counter($url, $options = array()) {
  $smc = new yiggSocialNetworkCounter($url);
  
  $facebook_count = $smc->get_facebook();
  $twitter_count = $smc->get_twitter();
  $google_count = $smc->get_google();
  $yigg_count = $smc->get_yigg();
  $spreadly_count = $smc->get_spreadly();
  $xing_count = $smc->get_xing();
  $linkedin_count = $smc->get_linkedin();
  $pinterest_count = $smc->get_pinterest();
?>
<ul class="social-share-counter">
  <li class="yigg"><span class="counter"><?php echo $yigg_count; ?></span> yiggs</li>
  <li class="spreadly"><span class="counter"><?php echo $spreadly_count; ?></span> shares</li>
  <li class="twitter"><span class="counter"><?php echo $twitter_count; ?></span> tweets</li>
  <li class="facebook"><span class="counter"><?php echo $facebook_count; ?></span> likes</li>
  <li class="google"><span class="counter"><?php echo $google_count; ?></span> +1s</li>
  <li class="xing"><span class="counter"><?php echo $xing_count; ?></span> <abbr title="XING">xs</abbr></li>
  <li class="linkedin"><span class="counter"><?php echo $linkedin_count; ?></span> <abbr title="LinkedIn">ins</abbr></li>
  <li class="pinterest"><span class="counter"><?php echo $pinterest_count; ?></span> pins</li>
</ul>
<?php
}

function social_counter_simple($url, $options = array()) {
  $smc = new yiggSocialNetworkCounter($url);
  
  $counter = $smc->get_facebook() + $smc->get_twitter() + $smc->get_google() + $smc->get_yigg() + $smc->get_spreadly() + $smc->get_xing() + $smc->get_linkedin() + $smc->get_pinterest();
?>
<div class="social-share-counter">Insgesamt <span class="counter"><?php echo $counter; ?></span> mal geteilt</div>
<?php
}