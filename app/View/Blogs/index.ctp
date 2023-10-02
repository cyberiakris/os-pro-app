<?php
$this->Html->addCrumb( "Blogs");
?>


<div class="productview">

    <h1>Blog</h1>
    <hr />

    <!--
    <div align="center">
    <?php
    //echo $this->element('custom_pagination');
    ?>
    </div>
    -->

    <?php if( isset($contents) && count($contents)>0 ){
        foreach($contents as $content){ ?>
            <div class="row">
                <div class="col-md-12">
                    <h3><a href="<?php echo $this->Html->url('/blogs/view/'.$content['tagline']); ?>"><?php echo $content['post_title']; ?></a></h3>
                    <?php
                    echo $content['summary'];
                    ?>
                </div>
            </div>
        <?php }
    } ?>

    <div align="center">
    <?php
    echo $this->element('custom_pagination');
    ?>
    </div>

</div>

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
