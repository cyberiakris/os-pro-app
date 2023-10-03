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
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

        echo $this->Html->css('os.404');

        echo $this->fetch('meta');
        echo $this->fetch('css');
		//echo $this->fetch('script');
	?>
</head>
<body>
    <div class="error-page-wrap">
        <article class="error-page gradient">
            <hgroup>
                <h1>404</h1>
                <h2>oops! page not found</h2>
            </hgroup>
            <a href="javascript:history.back()" title="Back to site" class="error-back">back</a>

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>

            <?php echo $this->Html->link(
                $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
                WEBSITE,
                array('target' => '_blank', 'escape' => false)
            );
            ?>
        </article>
    </div>
</body>
</html>
