<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', WEBSITE_TITLE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    echo $this->Html->charset();
    echo $this->Html->meta(array("name"=>"viewport","content"=>"width=device-width,  initial-scale=1, maximum-scale=1,, user-scalable=no"));
    ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900%7COxygen:400,700%7COpen+Sans%7CPT+Sans%7CPT+Sans+Narrow:400,700%7CDamion' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=CMontserrat:400,700%7COpen+Sans:400,300%7CLibre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>

    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('default/bootstrap.min');
    echo $this->Html->css('default/font-awesome.min');
    echo $this->Html->css('default/global');
    echo $this->Html->css('default/style');
    echo $this->Html->css('default/blog');
    echo $this->Html->css('default/responsive');
    echo $this->Html->css('default/transition-effect');

    echo $this->fetch('meta');
    echo $this->fetch('css');

    echo $this->Html->script('default/modernizr');
    echo $this->Html->script('default/jquery-1.11.3.min');

    ?>
    <link rel="stylesheet/less" type="text/css" href="<?php echo $this->webroot; ?>css/default/skin.less">

</head>
<body>
<div class="loader-block">
    <div class="loader">Loading...</div>
</div>
<!--Wrapper Section Start Here -->
<div id="wrapper">
    <?php echo $this->element('header'); ?>

    <!--content Section Start Here -->
    <div id="content">
        <div class="container">

            <!--Content Header -->
            <header class="content-header content-header-mini row ">
                <div class="heading col-xs-8">
                    <h1>Blank Page</h1>
                </div>
                <ul class="col-xs-4 breadcrumb ">
                    <li> <a href="#">Main Page</a> </li>
                    <li class="active"> Blank Page </li>
                </ul>
            </header>
            <!--Content Header -->
            <?php echo $this->Session->flash(); ?>
        </div>

        <!-- Main-Content Section  -->
        <section class="main-content-wrap blog-post-one  blog-one blog-post-four blog-post-five pad-sm-bottom">
            <div class="container">
                <div class="row main-content ">

                    <?php echo $this->fetch('content'); ?>

                </div>
            </div>
        </section>
        <!-- Main-Content  Section  -->

    </div>
    <!--content Section End Here -->

    <?php echo $this->element('footer'); ?>

    <a href="javascript:;" class="scroll-top"> <i class="fa fa-long-arrow-up"></i> </a> </div>
<!--Wrapper Section End Here -->

<?php
echo $this->Html->script('default/bootstrap.min');
echo $this->Html->script('default/less');
echo $this->Html->script('default/jquery.flexslider');
echo $this->Html->script('default/jquery.appear');
echo $this->Html->script('default/owl.carousel.min');
echo $this->Html->script('default/jquery.themepunch.tools.min');
echo $this->Html->script('default/jquery.themepunch.revolution.min');
echo $this->Html->script('default/jquery.revolution');
echo $this->Html->script('default/bootstrap-select');
echo $this->Html->script('default/site');
echo $this->fetch('script');
?>

</body>
</html>
