<?php echo $this->set('title_for_layout', 'Home'); ?>

<?php
$this_webroot = $this->webroot;
$ip_record_cc = isset($locale) ? $locale : '' ;
?>

<?php if(isset($sliders) && count($sliders)): ?>
<!--slider Section Start Here -->
<section id="slider">
    <div class="container-fluid">
        <div class="row">
            <div class="slider-sec shop-slider large ">
                <!--   Shop Sider Two  -->


                <div class="owl-carousel blog-banner">
                <?php $slideCount=0;
                foreach($sliders as $slide){
                    echo '<div class="gallery-item">
                        <figure><img src="'.$slide['img_path'].$slide['banner_img'].'" alt="" />
                            <figcaption>
                                <h3><a href="'.$slide['banner_url'].'">'.$slide['name'].'</a></h3>
                                <p> '.$slide['html_content'].'. <a href="'.$slide['banner_url'].'"> <i class="arrow-right"> <img src="'.$this->webroot.'svg/arrow-1.svg" class="svg" alt="" /> </i> </a> </p>
                            </figcaption>
                        </figure>
                    </div>'; 
                    $slideCount++;
                } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--slider Section End Here -->
<?php endif; ?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <!-- section class="page-blog-sec">
                    <div class="page-blog-sec-slider zoom">
                        <ul class="slides">
                            <li>
                                <article>
                                    <figure> <img src="<?php echo $this->webroot; ?>img/default/blog-img-1.jpg" alt="" />
                                        <figcaption class="date-caption"> <i class="fa fa-camera"></i> Aug 13’2014 </figcaption>
                                    </figure>
                                    <div class="img-description">
                                        <h3><a href="blog-post-1.html">Vitae adipiscing turpis1.  Aenean ligula nibh in, molestie</a></h3>
                                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut. Lorem ipsum dolor sit amet, consectetuer adipiscing. </p>
                                        <ul class="blog-tags">
                                            <li> <a href="#">#photo</a> </li>
                                            <li> <a href="#">#traveling</a> </li>
                                            <li> <a href="#">#nature</a> </li>
                                            <li> <a href="#">#people</a> </li>
                                        </ul>
                                        <div class="blog-article-widget clearfix">
                                            <ul class="social-share clearfix">
                                                <li> <a href="#"> <i class="fa fa-eye"></i> 350 </a> </li>
                                                <li> <a href="#"> <i class="fa fa-comments"></i> 20 </a> </li>
                                            </ul>
                                            <a href="blog-post-1.html" class="blog-more"> More <i class="fa fa-caret-right"></i> </a> </div>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article>
                                    <figure> <img src="<?php echo $this->webroot; ?>img/default/blog-img-1.jpg" alt="" />
                                        <figcaption class="date-caption"> <i class="fa fa-camera"></i> Aug 13’2014 </figcaption>
                                    </figure>
                                    <div class="img-description">
                                        <h3><a href="blog-post-1.html">Vitae adipiscing turpis2.  Aenean ligula nibh in, molestie</a></h3>
                                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut. Lorem ipsum dolor sit amet, consectetuer adipiscing. </p>
                                        <ul class="blog-tags">
                                            <li> <a href="#">#photo</a> </li>
                                            <li> <a href="#">#traveling</a> </li>
                                            <li> <a href="#">#nature</a> </li>
                                            <li> <a href="#">#people</a> </li>
                                        </ul>
                                        <div class="blog-article-widget clearfix">
                                            <ul class="social-share clearfix">
                                                <li> <a href="#"> <i class="fa fa-eye"></i> 350 </a> </li>
                                                <li> <a href="#"> <i class="fa fa-comments"></i> 20 </a> </li>
                                            </ul>
                                            <a href="blog-post-1.html" class="blog-more"> More <i class="fa fa-caret-right"></i> </a> </div>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article>
                                    <figure> <img src="<?php echo $this->webroot; ?>img/default/blog-img-1.jpg" alt="" />
                                        <figcaption class="date-caption"> <i class="fa fa-camera"></i> Aug 13’2014 </figcaption>
                                    </figure>
                                    <div class="img-description">
                                        <h3><a href="blog-post-1.html">Vitae adipiscing turpis3.  Aenean ligula nibh in, molestie</a></h3>
                                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut. Lorem ipsum dolor sit amet, consectetuer adipiscing. </p>
                                        <ul class="blog-tags">
                                            <li> <a href="#">#photo</a> </li>
                                            <li> <a href="#">#traveling</a> </li>
                                            <li> <a href="#">#nature</a> </li>
                                            <li> <a href="#">#people</a> </li>
                                        </ul>
                                        <div class="blog-article-widget clearfix">
                                            <ul class="social-share clearfix">
                                                <li> <a href="#"> <i class="fa fa-eye"></i> 350 </a> </li>
                                                <li> <a href="#"> <i class="fa fa-comments"></i> 20 </a> </li>
                                            </ul>
                                            <a href="blog-post-1.html" class="blog-more"> More <i class="fa fa-caret-right"></i> </a> </div>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </div>
                </section -->
                <section class="blog-section-wrapper ">
                    <div class="row">
                        <?php 
                        if(isset($specials) && count($specials)){
                            foreach($specials as $sp){
                                if($sp['post_type']=='page'){
                                    echo '<div class="col-md-6 ">
                                        <article class="page-blog-sec quotation description">
                                            <blockquote class="quote-article"> <i class="fa fa-file-text"></i> 
                                            <a href="'.$this->Html->url('/page/'.$sp['id']).'" style="color:#fff">'.$sp['post_title'].'</a>
                                                <div class="blog-article-widget clearfix"> <span class="date-caption"> <i class="fa fa fa-comment-o"></i> '.date('m d Y',strtotime($sp['schedule_publish'])).' </span>
                                                    <ul class="social-share pull-right clearfix">
                                                        <li> <a href="#"> <i class="fa fa-eye"></i> '.@$sp['views'].' </a> </li>
                                                    </ul>
                                                </div>
                                            </blockquote>
                                        </article>
                                    </div>';

                                } else if($sp['post_type']=='blog'){
                                    $cover_image = '';
                                    if(isset($sp['cover_image']) && !empty($sp['cover_image'])) { $cover_image = '<img src="'.$sp['cover_image'].'" alt="" />'; }
                                    else if(isset($sp['coverimage']) && !empty($sp['coverimage'])) { $cover_image = '<img src="'.$sp['coverimage'].'" alt="" />'; }
                                    echo '<div class="col-md-6 ">
                                        <article class="page-blog-sec  description zoom">
                                            '.$cover_image.'
                                            <div class="img-description">
                                                <h3><a href="'.$this->Html->url('/blogs/view/'.$sp['id']).'">'.$sp['post_title'].'</a></h3>
                                                <p> '.$sp['summary'].' </p>
                                                <div class="blog-article-widget clearfix"> <span class="date-caption"> <i class="fa fa fa-comment-o"></i> '.date('m d Y',strtotime($sp['schedule_publish'])).' </span>
                                                    <ul class="social-share pull-right clearfix">
                                                        <li> <a href="#"> <i class="fa fa-eye"></i> '.@$sp['views'].' </a> </li>
                                                        <li> <a href="#"> <i class="fa fa-comments"></i> '.@$sp['comments_count'].' </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </article>
                                    </div>';

                                } else {
                                    $cover_image = '';
                                    if(isset($sp['cover_image']) && !empty($sp['cover_image'])) { $cover_image = '<img src="'.$sp['cover_image'].'" alt="" />'; }
                                    else if(isset($sp['coverimage']) && !empty($sp['coverimage'])) { $cover_image = '<img src="'.$sp['coverimage'].'" alt="" />'; }
                                    $tags = '';
                                    if(isset($sp['site_categories']) && count($sp['site_categories'])){
                                        $tags = '<ul class="blog-tags">';
                                        foreach($sp['site_categories'] as $tag){
                                            $tags .= '<li> <a href="#">#'.$tag['name'].'</a> </li>';
                                        }
                                        $tags .= '</ul>';
                                    }
                                    echo '<div class="col-md-12">
                                    <article class="page-blog-sec zoom">
                                        <figure class="video-wrap"> '.$cover_image.' 
                                            <figcaption class="date-caption"> <i class="fa fa-picture-o"></i> '.date('m d Y',strtotime($sp['schedule_publish'])).' </figcaption>
                                        </figure>
                                        <div class="img-description">
                                            <h3><a href="'.$this->Html->url('/post/'.$sp['id']).'">'.$sp['post_title'].'</a></h3>
                                            <p> '.$sp['summary'].' </p>
                                            '.$tags.'
                                            <div class="blog-article-widget clearfix">
                                                <ul class="social-share clearfix">
                                                    <li> <a href="#"> <i class="fa fa-eye"></i> '.@$sp['views'].' </a> </li>
                                                    <li> <a href="#"> <i class="fa fa-comments"></i> '.@$sp['comments_count'].' </a> </li>
                                                </ul>
                                                <a href="'.$this->Html->url('/post/'.$sp['id']).'" class="blog-more"> More <i class="fa fa-caret-right"></i> </a> </div>
                                        </div>
                                    </article>
                                    </div>';

                                }
                            }
                        }
                        ?>
                                                
                    </div>
                </section>
            </div>
            <aside class="col-sm-4 col-md-3  col-md-push-1 aside">
                <!--
                <section class="blog-archive">
                    <h2 class="h3"> Archive </h2>
                    <h4> 2014 </h4>
                    <ul>
                        <li> <a href="#">january</a> </li>
                        <li> <a href="#">fabruary</a> </li>
                        <li> <a href="#">march</a> </li>
                        <li> <a href="#">april</a> </li>
                        <li> <a href="#">may</a> </li>
                    </ul>
                </section>
                <a class="blog-more" href="#"> Older <i class="fa fa-caret-right"></i> </a>
                <section class="popular-blog">
                    <h2 class="h3">Most Popular</h2>
                    <ul>
                        <li class="active">
                            <div class="page-blog-thumb small">
                                <figure> <img src="<?php echo $this->webroot; ?>img/default/small-blog-thumb-1.jpg" alt="" /> </figure>
                                <div class="img-description">
                                    <h4><a href="blog-post-1.html">Vitae adipiscing turpis</a></h4>
                                    <ul class="social-share clearfix">
                                        <li> <a href="#"> <i class="fa fa-eye"></i> 30 </a> </li>
                                        <li> <a href="#"> <i class="fa fa-comments"></i> 255 </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <figure> <img src="<?php echo $this->webroot; ?>img/default/small-blog-thumb-2.jpg" alt="" /> </figure>
                                <div class="img-description">
                                    <h4><a href="blog-post-1.html">Vivamus leo ante</a></h4>
                                    <ul class="social-share clearfix">
                                        <li> <a href="#"> <i class="fa fa-eye"></i> 30 </a> </li>
                                        <li> <a href="#"> <i class="fa fa-comments"></i> 255 </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <figure> <img src="<?php echo $this->webroot; ?>img/default/small-blog-thumb-3.jpg" alt="" /> </figure>
                                <div class="img-description">
                                    <h4><a href="blog-post-1.html">Vitae adipiscing turpis</a></h4>
                                    <ul class="social-share clearfix">
                                        <li> <a href="#"> <i class="fa fa-eye"></i> 30 </a> </li>
                                        <li> <a href="#"> <i class="fa fa-comments"></i> 255 </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <figure> <img src="<?php echo $this->webroot; ?>img/default/small-blog-thumb-4.jpg" alt="" /> </figure>
                                <div class="img-description">
                                    <h4><a href="blog-post-1.html">Vitae adipiscing turpis</a></h4>
                                    <ul class="social-share clearfix">
                                        <li> <a href="#"> <i class="fa fa-eye"></i> 30 </a> </li>
                                        <li> <a href="#"> <i class="fa fa-comments"></i> 255 </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <figure> <img src="<?php echo $this->webroot; ?>img/default/small-blog-thumb-5.jpg" alt="" /> </figure>
                                <div class="img-description">
                                    <h4><a href="blog-post-1.html">Vitae adipiscing turpis</a></h4>
                                    <ul class="social-share clearfix">
                                        <li> <a href="#"> <i class="fa fa-eye"></i> 30 </a> </li>
                                        <li> <a href="#"> <i class="fa fa-comments"></i> 255 </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
                <section class="page-recent-comments popular-blog">
                    <h2 class="h3"> Recent Comments </h2>
                    <ul>
                        <li class="active">
                            <div class="page-blog-thumb small">
                                <h4><a href="blog-post-1.html">Aenean ligula nibh, molestie id viverra a, dapibus at dolor..</a></h4>
                                <span> 2 hours ago </span> </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <h4><a href="blog-post-1.html">Vivamus leo ante</a></h4>
                                <span> 2 hours ago </span> </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <h4><a href="blog-post-1.html">In iaculis viverra neque, ac eleifend ante lobortis id.</a></h4>
                                <span> 2 hours ago </span> </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <h4><a href="blog-post-1.html">Dapibus at dolor. In iaculis viverra neque, ac eleifend ante lobortis id.</a></h4>
                                <span> 2 hours ago </span> </div>
                        </li>
                        <li>
                            <div class="page-blog-thumb small">
                                <h4><a href="blog-post-1.html">Vitae adipiscing turpis</a></h4>
                                <span> 2 hours ago </span> </div>
                        </li>
                    </ul>
                </section>
                -->
            </aside>
        </div>
    </div>
</div>

<!--subscription Start Here -->
<section class="subscription anim-section clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Sign Up Today for Company Newsletter</h2>
            </div>
            <div class="col-md-6 col-sm-12 subscription-field">
                <input type="text" placeholder="Enter your e-mail" class="subscription-input" />
                <button class="btn btn-default btn-sale" type="button"> submit<i> <span class="fa fa-caret-right"> </span> </i> </button>
            </div>
        </div>
    </div>
</section>
<!--subscription End Here -->
