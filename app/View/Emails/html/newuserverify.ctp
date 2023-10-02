<p style="margin: 0  0  16px;">Thanks for creating an account on <?php echo WEBSITE_TITLE; ?>. Your username is
    <strong><?php echo $username; ?></strong>.</p>


<p style="margin: 0  0  16px;">You can access your account area to view your orders and change
    your password here: <a href="<?php echo WEBSITE; ?>/my-account/" target="_blank"><?php echo WEBSITE; ?>/my-account/</a>.</p>

<p>Next step, click here to verify your email.
    <a href="<?php echo WEBSITE; ?>/users/verify?code=<?php echo $verifycode; ?>" target="_blank"><?php echo WEBSITE; ?>/users/verify?code=<?php echo $verifycode; ?></a></p>
