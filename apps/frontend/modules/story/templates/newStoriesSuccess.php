<?php if($storyCount > 0): ?>
<ol id="stories" class="story-list hfeed ">
  <?php foreach($stories as $k => $story ): ?>
  <li>
    <?php
      include_partial('story',
        array(
          'story' => $story,
          'summary' => true,
          'compacted' => false === (false === ($k != 0 && $k % round(($storyCount/4)) == 0)),
          'count' => $k,
          'total' => $storyCount,
          'inlist' => true
        )
      );
    ?>
  </li>
  <?php endforeach; ?>
</ol>
<?php echo $pager->display(); ?>

<?php else: ?>
  <p class="error">Es wurden keine Nachrichten gefunden</p>
<?php endif; ?>

<?php slot('sidebar') ?>
  <?php include_component("comment","latestComments");?>
<?php end_slot();?>