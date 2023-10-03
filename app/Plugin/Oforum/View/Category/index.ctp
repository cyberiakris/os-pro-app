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
        <div class="col-md-12 col-xs-12 forum-table">
            <form method="post" action="#" >
                <input type="search" placeholder="Search forum" />
            </form>
            <div class="table-wrapper">
                <?php
                if(isset($content['forum_topics']) && count($content['forum_topics'])){
                    echo '<table class="table">
                    <tr>
                        <th>Topic</th>
                        <th> </th>
                        <th class="forum-replies">Replies</th>
                        <th class="forum-views">Views</th>
                        <th>Activity</th>
                    </tr>';
                    foreach($content['forum_topics'] as $ft){
                        echo '<tr>
                        <td>
                            <strong class="h4"><a href="'.$this->Html->url('/forum/t/'.$ft['_id']).'">'.$ft['name'].'</a></strong>
                            <p>'.$this->CustomFunctions->trimText($ft['content'],100).' </p>
                        </td>
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
    </section>

