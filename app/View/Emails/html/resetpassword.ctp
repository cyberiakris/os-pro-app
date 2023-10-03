
<p style="margin: 0  0  16px;">Hello <strong><?php echo $name; ?></strong>, <br/>
You have requested a password reset. If you did not authorize such, please ignore this message</p>


<p style="margin: 0  0  16px;">Click on the link below to change your password: <br />
<a href="<?php echo WEBSITE; ?>/resetpassword?code=<?php echo $code; ?>" target="_blank"><?php echo WEBSITE; ?>/resetpassword?hash=<?php echo $code; ?></a>.</p>

