<?php echo $this->set('title_for_layout', $content['post_title']); ?>

<?php
//$this->Html->addCrumb( "Pages", array('controller' => 'pages', 'action' => 'index'));
$this->Html->addCrumb($content['post_title']);
?>

<?php if(!isset($nosidebar)){ ?>
    <div class="productview">
<?php } ?>

    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $content['post_title']; ?></h2>
        </div>
        <div class="col-md-12">
            <?php echo $content['post_content']; ?>
        </div>
    </div>

<?php if(!isset($nosidebar)){ ?>
    </div>
<?php } ?>

<?php if(!isset($nosidebar)){ ?>
<div id="sidebar">
    <div class="quicklinks">
        <?php
        if(isset($ad_250x250) && count($ad_250x250)>0){
            foreach($ad_250x250 as $ad250){
                if($ad250['AdSpace']['adtype'] == 'code'){
                    echo $ad250['AdSpace']['code_info'];
                } else {
                    $image = !empty($ad250['AdSpace']['banner_img']) ? '../bannerpics/'.$ad250['AdSpace']['banner_img'] : '../img/img-0.jpg' ;
                    $image_tag = $this->Html->image($image, array('width'=>'200'));
                    echo $this->Html->link( $image_tag, $ad250['AdSpace']['banner_url'], array('escape' => false) );
                }
            }
        }
        ?>
    </div>
    <div class="nf-ads">
        <?php
        if(isset($ad_skyscraper) && count($ad_skyscraper)>0){
            foreach($ad_skyscraper as $adSky){
                if($adSky['AdSpace']['adtype'] == 'code'){
                    echo $adSky['AdSpace']['code_info'];
                } else {
                    $image = !empty($adSky['AdSpace']['banner_img']) ? '../bannerpics/'.$adSky['AdSpace']['banner_img'] : '../img/img-0.jpg' ;
                    $image_tag = $this->Html->image($image, array('width'=>'200'));
                    echo $this->Html->link( $image_tag, $adSky['AdSpace']['banner_url'], array('escape' => false) );
                }
            }
        }
        ?>
    </div>
</div>
<?php } ?>