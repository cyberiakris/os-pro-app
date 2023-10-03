<?php echo $this->set('title_for_layout', $content['post_title']); ?>

<?php
if(count($content['site_page_elements'])){
    $page_head = array();
    $page_foot = array();
    $page_before = array();
    foreach($content['site_page_elements'] as $page_extra){
        if($page_extra['widget_area']=='header'){
            $page_head = array_merge($page_head, $page_extra);
        }
        if($page_extra['widget_area']=='footer'){
            $page_foot = array_merge($page_foot, $page_extra);
        }
        if($page_extra['widget_area']=='before'){
            $page_before = array_merge($page_before, $page_extra);
        }
    }

    if(count($page_head)){
        $this->set('page_head', array($page_head));
    }
    if(count($page_foot)){
        $this->set('page_foot', array($page_foot));
    }
    if(count($page_before)){
        $this->set('page_before', array($page_before));
    }
}
?>

<?php
$page_title = isset($content['post_title']) ? $content['post_title'] : 'Page View';
echo $this->set('title_for_layout', $page_title);
echo $this->set('current_page_url', WEBSITE.'/'.$content['tagline']);
?>

<?php
echo $content['post_content'];
?>
