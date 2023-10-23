<!--header Section Start Here -->
<header id="header">

    <!--headerBox Start Here -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 top">
                            <a href="" class="logo"><img src="<?php echo $this->webroot; ?>img/default/logo.png" alt="" /></a>
                            <section class="menu-wrap">
                                <ul class="nav">
                                    <?php
                                    if(isset($sitemenu) && count($sitemenu)){
                                        foreach ($sitemenu as $m){
                                            echo '<li class="menu-sec-parent">
                                            <a href="'.$m['meta']['url'].'">'.$m['text'].'</a>
                                            </li>';
                                        }
                                    }
                                    else {

                                    }
                                    ?>
                                    <!-- sample --
                                    <li>
                                        <a href="#">Single</a>
                                    </li>
                                    <li>
                                        <a href="#">Default</a>
                                        <div class="flyout-menu menu-type-1 menu-container">
                                            <ul class="page-menu">
                                                <li>
                                                    <a href="#">header-1</a>
                                                </li>
                                                <li>
                                                    <a href="#">header-2</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-sec-parent">
                                        <a href="#">Home</a>
                                        <div class="menu-container menu-big">
                                            <div class="menu-type-2 menu-type-5 big-menu-wrap style-menu ">
                                                <section class="link-section-wrapper clearfix">
                                                    <div class="link-section">
                                                        <ul>
                                                            <li>
                                                                <a href="../Corporate/index.html" data-background="<?php echo $this->webroot; ?>img/default/corporate.png"  >Corporate</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Education/education.html" data-background="<?php echo $this->webroot; ?>img/default/education.png">Education</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Wedding/wedding.html" data-background="<?php echo $this->webroot; ?>img/default/wedding.png"> Wedding</a>
                                                            </li>
                                                            <li>
                                                                <a href="../FoodDelivery/food-delivery.html" data-background="<?php echo $this->webroot; ?>img/default/food-deliver.png">Food Delivery</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Medical/medical.html"  data-background="<?php echo $this->webroot; ?>img/default/medical.png">Medical</a>
                                                            </li>
                                                            <li>
                                                                <a href="../church/church.html" data-background="<?php echo $this->webroot; ?>img/default/church.png">Church</a>
                                                            </li>

                                                            <li>
                                                                <a href="../Logistics/logistic.html" data-background="<?php echo $this->webroot; ?>img/default/logistic.png">Logistic</a>
                                                            </li>

                                                            <li>
                                                                <a href="../Restaurant/restaurant.html" data-background="<?php echo $this->webroot; ?>img/default/resturant.png"> restaurant</a>
                                                            </li>

                                                            <li>
                                                                <a href="../taxi/taxi.html" data-background="<?php echo $this->webroot; ?>img/default/taxi.png"> Taxi </a>
                                                            </li>

                                                            <li>
                                                                <a href="../Lawyers/lawyer.html" data-background="<?php echo $this->webroot; ?>img/default/lawyer.png">Lawyer</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Realestate/real-estate.html" data-background="<?php echo $this->webroot; ?>img/default/real-estate.png">Real Estate</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="link-section">
                                                        <ul>
                                                            <li>
                                                                <a href="../Mechanic/mechanic.html" data-background="<?php echo $this->webroot; ?>img/default/mechanic.png">Mechanic</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Hotel/hotel.html" data-background="<?php echo $this->webroot; ?>img/default/hotel.png">Hotel</a>
                                                            </li>

                                                            <li>
                                                                <a href="../Beauty/beauty.html" data-background="<?php echo $this->webroot; ?>img/default/beauty.png">Beauty</a>
                                                            </li>
                                                            <li>
                                                                <a href="../sport/sport-team.html" data-background="<?php echo $this->webroot; ?>img/default/sports.png">Sport Team</a>
                                                            </li>
                                                            <li>
                                                                <a href="../MusicBand/music-band.html" data-background="<?php echo $this->webroot; ?>img/default/music.png">Music Band</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Cooking/cooking.html" data-background="<?php echo $this->webroot; ?>img/default/cooking.png">Cooking</a>
                                                            </li>

                                                            <li>
                                                                <a href="../AutoDealer/autodealer.html" data-background="<?php echo $this->webroot; ?>img/default/auto-dealer.png"> AutoDealer </a>
                                                            </li>

                                                            <li>
                                                                <a href="../eCommerce/ecommerce.html" data-background="<?php echo $this->webroot; ?>img/default/e-commerce.png"> Ecommerce </a>
                                                            </li>
                                                            <li>
                                                                <a href="../Petshop/petshop.html" data-background="<?php echo $this->webroot; ?>img/default/pet-shop.png"> Pet Shop </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog.html" data-background="<?php echo $this->webroot; ?>img/default/blog.png"> Blog </a>
                                                            </li>
                                                            <li>
                                                                <a href="../Portfolio/portfolio-1.html" data-background="<?php echo $this->webroot; ?>img/default/portfolio.png"> Portfolio </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </section>
                                            </div>

                                            <figure class="theme-overview">
                                                <div class="theme-img-wrapper">
                                                    <img src="<?php echo $this->webroot; ?>img/default/corporate.png" alt=""/>
                                                </div>
                                            </figure>

                                        </div>
                                    </li>
                                    <li class="menu-sec-parent">
                                        <a href="#">Mega</a>
                                        <div class="menu-container">
                                            <div class="menu-type-2 menu-type-5  style-menu ">
                                                <section class="link-section-wrapper clearfix">
                                                    <div class="link-section">
                                                        <ul>
                                                            <li>
                                                                <a href="../about.html">about</a>
                                                            </li>
                                                            <li>
                                                                <a href="../career.html">career</a>
                                                            </li>
                                                            <li>
                                                                <a href="../coming-soon.html">coming-soon</a>
                                                            </li>
                                                            <li>
                                                                <a href="../contact.html">contact</a>
                                                            </li>
                                                            <li>
                                                                <a href="../help-center.html">help-center</a>
                                                            </li>
                                                            <li>
                                                                <a href="../how-it-works.html">how-it-works</a>
                                                            </li>
                                                            <li>
                                                                <a href="../job-detail-1.html">job-detail-1</a>
                                                            </li>
                                                            <li>
                                                                <a href="../job-detail-2.html">job-detail-2</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="link-section">
                                                        <ul>

                                                            <li>
                                                                <a href="../job-detail-3.html">job-detail-3</a>
                                                            </li>
                                                            <li>
                                                                <a href="../job-detail-4.html">job-detail-4</a>
                                                            </li>
                                                            <li>
                                                                <a href="../job-detail-5.html">job-detail-5</a>
                                                            </li>
                                                            <li>
                                                                <a href="../loop-contents.html">loop-contents</a>
                                                            </li>
                                                            <li>
                                                                <a href="../menu.html">menu</a>
                                                            </li>
                                                            <li>
                                                                <a href="../forums.html">forums</a>
                                                            </li>
                                                            <li>
                                                                <a href="../our-teams.html">our-teams</a>
                                                            </li>
                                                            <li>
                                                                <a href="../press.html">press</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="link-section">
                                                        <ul>
                                                            <li>
                                                                <a href="../pricing.html">pricing</a>
                                                            </li>
                                                            <li>
                                                                <a href="../404-error.html">404-error</a>
                                                            </li>
                                                            <li>
                                                                <a href="../church/church-one.html">Church One</a>
                                                            </li>
                                                            <li>
                                                                <a href="../FoodDelivery/food-delivery-two.html" >Food Delivery Two</a>
                                                            </li>
                                                            <li>
                                                                <a href="../FoodDelivery/food-delivery-three.html">Food Delivery Three</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Medical/medical-two.html">Medical Two</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Medical/medical-three.html">Medical Three</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Realestate/real-estate-two.html">Real Estate Two</a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                    <div class="link-section">
                                                        <ul>
                                                            <li>
                                                                <a href="../Logistics/logistic-two.html">Logistic Two</a>
                                                            </li>
                                                            <li>
                                                                <a href="../taxi/taxi-two.html"> Taxi Two </a>
                                                            </li>
                                                            <li>
                                                                <a href="../Hotel/hotel-two.html" >Hotel Two</a>
                                                            </li>
                                                            <li>
                                                                <a href="../Hotel/hotel-three.html">Hotel Three</a>
                                                            </li>
                                                            <li>
                                                                <a href="../AutoDealer/autodealer-two.html" > AutoDealer Two </a>
                                                            </li>
                                                            <li>
                                                                <a href="../AutoDealer/autodealer-three.html"> AutoDealer Three </a>
                                                            </li>
                                                            <li>
                                                                <a href="../Portfolio/portfolio-2.html"> Portfolio Two </a>
                                                            </li>

                                                            <li>
                                                                <a href="../Cooking/cooking-two.html">Cooking Two</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </li>
                                    -->
                                </ul>
                                <div class="header-widget">
                                    <button class="glyphicon glyphicon-search search">
                                        &nbsp;
                                    </button>
                                    <div class="header-search-box">
                                        <input type="text" />
                                    </div>
                                    <div class="navbar-header visible-xs">
                                        <button type="button" class="navbar-toggle">
                                            <span class="icon-bar">&nbsp;</span><span class="icon-bar">&nbsp;</span><span class="icon-bar">&nbsp;</span>
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--headerCntr End Here -->
</header>
<!--header Section End Here -->

<?php //debug(@$sitemenu); ?>