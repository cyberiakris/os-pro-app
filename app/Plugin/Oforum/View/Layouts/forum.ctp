<?php
$cakeDescription = __d('cake_dev', WEBSITE_TITLE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->element('google_analytics'); ?>
    <?php
    echo $this->Html->charset();
    echo $this->Html->meta(array("name"=>"viewport","content"=>"width=device-width,  initial-scale=1, maximum-scale=1,, user-scalable=no"));
    ?>
    <title>
        <?php echo $title_for_layout; ?>:
        <?php echo $cakeDescription ?>
    </title>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900%7COxygen:400,700%7COpen+Sans%7CPT+Sans%7CPT+Sans+Narrow:400,700%7CDamion' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=CMontserrat:400,700%7COpen+Sans:400,300%7CLibre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>

    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('default/bootstrap.min');
    echo $this->Html->css('default/font-awesome.min');
    echo $this->Html->css('default/global');
    echo $this->Html->css('default/style');
    //echo $this->Html->css('default/blog');
    echo $this->Html->css('default/responsive');
    echo $this->Html->css('default/transition-effect');

    echo $this->Html->css($this->plugin.'.forumstyle.css');

    echo $this->fetch('meta');
    echo $this->fetch('css');

    echo $this->Html->script('default/modernizr');
    echo $this->Html->script('default/jquery-1.11.3.min');

    ?>
    <link rel="stylesheet/less" type="text/css" href="<?php echo $this->webroot; ?>css/default/skin.less">

</head>

<?php
$homepage_bodyclass = '';
if ($this->request->here == '/') {
    $homepage_bodyclass = 'homepage-20';
}
?>
<body class=" <?= $homepage_bodyclass; ?>">
<div class="loader-block">
    <div class="loader">Loading...</div>
</div>
<!--Wrapper Section Start Here -->
<div id="wrapper">
    <?php echo $this->element('navmain'); ?>

    <!--content Section Start Here -->
    <div id="content" class="margin-bottom">
        <div class="container forums ">

            <?php echo $this->element('breadcrumb_nav'); ?>

            <!-- Forums	Section -->

                <?php echo $this->fetch('content'); ?>

            <!-- Forums	Section -->

            <?php echo $this->element('placeholder_ui'); ?>

        </div>
    </div>
    <!--content Section End Here -->

    <?php echo $this->element('f_footer'); ?>

    <a href="javascript:;" class="scroll-top"> <i class="fa fa-long-arrow-up"></i> </a>

</div>
<!--Wrapper Section End Here -->

<?php
echo $this->Html->script('default/bootstrap.min');
echo $this->Html->script('default/less');
echo $this->Html->script('default/site');
echo $this->fetch('script');
?>

</body>
</html>