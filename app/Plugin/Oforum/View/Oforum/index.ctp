<?php
if(isset($current_user)){
    ?>
        <div class="">
            <a href="#newtopic" class="btn btn-default btn-lg pull-left"><i class="fa fa-plus"></i> New Topic</a>

            <a href="#" class="btn btn-primary btn-lg pull-right">Watching</a>
        </div>
        <div style="clear:both; margin-bottom: 30px"></div>
    <?php
}
?>

<section class="forum-section row">
    <div class="col-md-8 col-xs-12 forum-table">
        <form method="post" action="#" >
            <input type="search" placeholder="Search forum" />
        </form>
        <div class="table-wrapper">
            <?php
            if(isset($forum['forum_categories']) && count($forum['forum_categories'])){
                echo '<table class="table">
                    <tr>
                        <th>Category</th>
                        <th class="topic">Topic</th>
                        <th class="topic post">Posts</th>
                        <th>Activity</th>
                    </tr>';
                foreach($forum['forum_categories'] as $fc){
                    $fc_img = (isset($fc['image']) && !empty($fc['image'])) ? '<img src="'.$fc['image'].'" alt="" align="absmiddle" width="120px" />' : '' ;
                    echo '<tr>
                        <td><strong class="h4"><a href="'.$this->Html->url('/forum/c/'.$fc['_id']).'">'.$fc['name'].'</a></strong>
                            <p>'.$fc_img.' '.$fc['description'].' </p></td>
                        <td>'.$fc['topic_count'].'</td>
                        <td>'.$fc['post_count'].'</td>
                        <td><span class="h4"><a href="#">'. $this->CustomFunctions->timeAgo( strtotime($fc['modified']) ).'</a ></span><span class="user-line"> <i class="fa fa-user"> </i> <a href="#">Gifted Group</a> </span></td>
                    </tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
        <div class="table-wrapper">
            <?php
            if(isset($forum['forum_topics']) && count($forum['forum_topics'])){
                echo '<table class="table">
                    <tr>
                        <th>Topic</th>
                        <th> </th>
                        <th class="forum-replies">Replies</th>
                        <th class="forum-views">Views</th>
                        <th>Activity</th>
                    </tr>';
                foreach($forum['forum_topics'] as $ft){
                    echo '<tr>
                        <td><strong class="h4"><a href="'.$this->Html->url('/forum/t/'.$ft['_id']).'">'.$ft['name'].'</a></strong>
                            <p>'.$this->CustomFunctions->trimText($ft['content'],100).' </p>
                            <span class="label label-default">'.$ft['forum_category_id'].'</span></td>
                        <td>*contributors avatars</td>
                        <td>'.$ft['post_count'].'</td>
                        <td>'.$ft['view_count'].'</td>
                        <td><span class="h4"><a href="#">'. $this->CustomFunctions->timeAgo( strtotime($ft['modified']) ).'</a ></span><span class="user-line"> <i class="fa fa-user"> </i> <a href="#">Gifted Group</a> </span></td>
                    </tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
    </div>
    <div class="col-md-offset-1 col-md-3 col-xs-12">
        <aside class="aside">
            <article class="forum-article">
                <h2> <?php echo isset($forum['forum_name']) ? $forum['forum_name'] : 'Our Forum'; ?> </h2>
                <p> <?php echo isset($forum['forum_description']) ? $forum['forum_description'] : ''; ?> </p>
            </article>
            <section class="latest-posts">
                <?php if(isset($forum['forum_topics']) && count($forum['forum_topics'])){
                    echo '<h2>Latest Posts</h2>
                    <ul class="no-margin">';
                    foreach($forum['forum_topics'] as $ft){
                        echo '<li class="no-margin padding-bottom">
                        <h3><a href="#">'.$ft['name'].'</a></h3>
                        <div class="share-panel"> <span class="date">'.date('M d, Y', strtotime($ft['created'])).'</span>
                            <ul class="social-share">
                                <li> <a href="#"> <i class="fa fa-eye"></i> 350 </a> </li>
                                <li> <a href="#"> <i class="fa fa-comments"></i> 20 </a> </li>
                            </ul>
                        </div>
                    </li>';
                    }
                    echo '</ul>';
                }?>
            </section>
        </aside>
    </div>
</section>

<?php
//if(isset($current_user)){
    echo $this->element('new_topic');
//}
?>