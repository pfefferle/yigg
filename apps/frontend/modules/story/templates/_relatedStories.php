<div id="bar_related_stories_label">
    <div class="related_stories">
    <?php
        $story = $stories->get(0);
        if($bar){
            echo link_to(
                avatar_tag($story->Author->Avatar, "icon.gif", 35,35),
                "@user_public_profile?username={$story->Author->username}");

            echo "Read Related Stories:";
            echo link_to($story['title'], url_for_story($story, "bar"), array("title" => $story->title, "rel" => "nofollow"));
            ?>
            <div id="show_stories">Toogle</div>
            <?php }else{
            ?>
            <div style="font-size: 108% !important; font-weight: bold; margin-top: 10px; margin-bottom:3px;">Das könnte Sie auch interessieren:</div>
            <?php } ?>
    <div class="clear"></div>
</div>
<div id="bar_related_stories_content">
    <ol class="avatar-list-style">
        <?php foreach ( $stories as $story): ?><li><?php
        if($bar){
            echo link_to(
                avatar_tag($story->Author->Avatar, "icon.gif", 14,14),
                "@user_public_profile?username={$story->Author->username}");
            echo link_to($story['title'], url_for_story($story, "bar"), array("title" => $story->title, "rel" => "nofollow"));
        }else{
            echo link_to($story['title'], url_for_story($story), array("title" => $story->title, "rel" => "nofollow"));
        }
        ?></li>
        <?php endforeach; ?>
    </ol>
</div>

<script type="text/javascript">
    <!--
    $(function() {
        if($("#bar_related_stories_content")){
            $("#bar_related_stories_content").hide();

            $("#show_stories").click(function() {
                $("#bar_related_stories_content").toggle();
            });
        }
    });
    //-->
</script>