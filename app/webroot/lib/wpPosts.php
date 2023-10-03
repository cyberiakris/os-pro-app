<?php /* */
function getPostList($db, $params = array()) {

/* old version query *
    $sql = 'SELECT p.post_title, p.post_content, p.post_date, p.guid, p.post_name
			FROM wp_posts p
			WHERE p.post_status="publish" AND p.post_content LIKE "%<img %"';


/* new version query */
    $sql = "SELECT f.*, p.post_title, p.post_content, p.post_date, p.guid, p.post_name
			FROM wp_posts p LEFT JOIN wp_postmeta m ON (m.post_id=p.id AND m.meta_key='_thumbnail_id')
            LEFT JOIN wp_posts g ON g.id=m.meta_value
            LEFT JOIN wp_postmeta f ON (f.post_id=g.id AND f.meta_key='_wp_attached_file')
			WHERE p.post_status='publish'";


    if(!empty($params['where']))
        foreach($params['where'] as $where)
            $sql .= ' AND ' . $where . ' ';

    if(empty($params['order'])) $sql .= ' ORDER BY p.post_date DESC ';
    if(!empty($params['limit'])) $sql .= ' LIMIT 0,' . $params['limit'];

    $result = mysql_query($sql, $db);

    $return = array();
    while($row = @mysql_fetch_array($result)){
        //var_dump($row['post_title']);
        $return[] = $row;
    }

    return $return;
}

//connect to blog
$dbhostname = WP_HOST;
$dbname = WP_DB;
$dbusername = WP_USER;
$dbpassword = WP_PASS;

$connect = mysql_connect($dbhostname, $dbusername, $dbpassword);
mysql_select_db($dbname);
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
$dbBlog = $connect;

$query_limit = 10;
$return_limit = 7;
/* do not edit below this line */
//get list of posts
$listPosts = getPostList($dbBlog, array('limit' => $query_limit));
$tagPattern = '~<[^>]*>~';
$bracketPattern = '~\[[^\]]*\]~';
$szSearchPattern = '~<img [^>]* />~'; // img pattern
$imgWpattern = '~width=\"*\"~';
$imgHpattern = '~height=\"*\"~';

//output list of WP posts
$blogArray = array(); // init

foreach($listPosts as $post) {

    $postContent = $post['post_content'];
    $postContent = preg_replace($bracketPattern, '', $postContent); // remove brackets
    //remove tags
    $sumContent = preg_replace($tagPattern, '', $postContent);
    // get image tag
    // Run preg_match_all to grab all the images and save the results in $aPics
    preg_match_all( $szSearchPattern, $postContent, $aPics );

    // Check to see if we have at least 1 image
    $iNumberOfPics = count($aPics[0]);

    $imgFile = '';

    if ( !empty($post['meta_value']) ) {
        $imgFile = WEBSITE.'/b/wp-content/uploads/'.$post['meta_value'];
    }
    else if ( $iNumberOfPics > 0 ) {
        $imgTag = $aPics[0][0]; // get first pic
        preg_match_all('/(src)=("[^"]*")/i',$imgTag, $imgSrc);
        $imgFile = $imgSrc[0][0];
        $imgFile = preg_replace('~src=~', '', $imgFile);
        $imgFile = preg_replace('~"~', '', $imgFile);
    };

    $postDate = $post['post_date'];
    $post_ts = strtotime($postDate);

    if ( !empty($imgFile) ) {
        // add only if image is present
        array_push($blogArray,
            array(
                'posted'=>$post_ts,
                'img'=>$imgFile,
                'topic'=> $post['post_title'],
                //'topic'=>substr($post['post_title'], 0, 26),
                'descr'=>' &nbsp; ' . substr($sumContent, 0, 300),
                'url'=>$post['guid']
            )
        );
    }
    // skip if there are at least 3 valid blog posts found
    if(count($blogArray) >= $return_limit) { break; }

}

// returns $blogArray
//echo '<br><br><br><br>result:<br>';
//var_dump($blogArray); exit;
?>