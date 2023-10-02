<?php
$form_pads = '';
$form_col_size = 'col-md-12';
$btn_reg1_style = 'style="display:none"';
$btn_reg2_style = 'style="display:block; background-color:#e8e8e8;"';
$title_style = 'style="font-weight:bold; text-align:center; font-size:1.5em; margin-bottom:10px"';
$is_ajax = true;
// hide on ajax
if ( ($this->request->is('ajax') || isset($this->request->data['ajax'])) == false ) {
	$this->Html->addCrumb("Register");
    $form_pads = '<div class="col-md-2"></div>'; // pad form width
    $btn_reg1_style = 'style="display:block"';
    $btn_reg2_style = 'style="display:none"';
    $form_col_size = 'col-md-8';
    $is_ajax = false;
?>
	<h1>Register for a new account</h1>
	<hr />
<?php
}
?>
<?php
if ($response) {
    if ($response['status']) {

        $activate_intro = (isset($response['data']['User']['activated']) && ($response['data']['User']['activated']==1)) ? '' : ' A welcome email has been sent to the email address you provided.<br> Check your email inbox for the welcome email and an activation link therein. Click the activation link to activate your account.<br> If your account has already been activated, ' ;
        echo "<div class='alert alert-success'>
                <h4>Congratulations " . strtoupper($response['data']['User']['first_name']) . "!</h4>You have successfully created your account<br/>
                   ".$activate_intro." <a href='{$this->Html->url('/users/login')}'>Click here</a> to continue to your account.
            </div>";

    } else {
           
		echo '<div class="alert alert-danger validation-error-alert">
			<button type="button" class="close" data-dismiss="alert">×</button>';
		
		if (is_array($response['data'])) {
			echo "<h4>Please fill the form properly</h4><br /><ol>";
			foreach ($response['data'] as $error) {
				echo "<li>{$error}</li>";
			}
			echo "</ol>";
		} else {
			echo "Oops! " . $response['data'];
		} 
	   
		echo '</div>';
            
    }
}
?>

<?php if ( !$response || !$response['status'] ) { ?>

    <h3 <?php echo $title_style; ?>>Register</h3>

	<div class="row">
        <?php echo $form_pads; ?>
      <div id="register" class="<?php echo $form_col_size; ?>">
            <form method="post" id="form-register" class="form-register" action="<?php echo $this->Html->url('/signup'); ?>" method="post">
                <div class="row">
                    <div id="register" class="col-md-6">
                        <div class="form-group">
                            <?php if(!$is_ajax){ ?><label for="first_name">First Name:</label> <?php } ?>
                            <input type="text" id="first_name" name="first_name"  class="form-control" placeholder="first name" value="<?php if(isset($submitted['first_name']) && !empty($submitted['first_name'])){ echo $submitted['first_name']; } ?>" />
                        </div>

                    </div>
                    <div id="register" class="col-md-6">
                        <div class="form-group">
                            <?php if(!$is_ajax){ ?><label for="last_name">Last Name:</label> <?php } ?>
                            <input type="text" id="last_name" name="last_name"  class="form-control" placeholder="last name" value="<?php if(isset($submitted['last_name']) && !empty($submitted['last_name'])){ echo $submitted['last_name']; } ?>" />
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <?php if(!$is_ajax){ ?><label for="myemail">Email:</label> <?php } ?>
                    <input type="text" id="myemail" name="email"  class="form-control" placeholder="email address" value="<?php if(isset($submitted['email']) && !empty($submitted['email'])){ echo $submitted['email']; } ?>" />
				</div>
                <div class="form-group">
                    <?php if(!$is_ajax){ ?><label for="pass">Password:</label> <?php } ?>
                    <input type="password" id="pass" name="password"  class="form-control" placeholder="choose password" />
				</div>
                <div class="form-group">
                    <?php if(!$is_ajax){ ?><label for="confirm">Confirm Password:</label> <?php } ?>
                    <input type="password" id="confirm" name="password_confirm"  class="form-control" placeholder="confirm password" />
				</div>
                <?php /*
                <div class="form-group">
                    <?php if(!$is_ajax){ ?><label for="phone">Phone:</label> <?php } ?>
                    <input type="text" id="phone" name="phone"  class="form-control" onkeyup="digitsOnly(this)" onblur="digitsOnly(this)" placeholder="phone number" value="<?php if(isset($submitted['phone']) && !empty($submitted['phone'])){ echo $submitted['phone']; } ?>" />
                </div>
				*/ ?>
                <?php /*
				<br />
				<div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITEKEY; ?>"></div>
				*/ ?>
                <input type="hidden" value="" name="honeyPot" />
                <input type="submit" value="Register" class="btn btn-success btn-lg btn-block" />
                <!--
                <br />
                <a href="<?php echo $this->Html->url('/toc'); ?>" target="_blank">By clicking Register you are agreeing to our Terms and Conditions</a>
                -->
            </form>

          <hr />

          <div class="row">
              <div class="col-md-12 text-center">
                  <?php
                  echo $this->Html->image("login-facebook.jpg", array(
                      "alt" => "Signin with Facebook",
                      'url' => array('controller'=>'auth', 'action'=>'facebook')
                  ));
                  ?>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <?php /*
			echo $this->Html->image("login-google.jpg", array(
				"alt" => "Signin with Google",
				'url' => array('controller'=>'auth', 'action'=>'google')
			));	*/
                  ?>
              </div>
          </div>

          <div class="text-center">
              <div class="button-profile" <?php echo $btn_reg1_style; ?>><a href="<?php echo $this->Html->url('/login'); ?>">Already have an account? Signin</a></div>
              <a id="go2ajaxlogin" class="btn btn-default btn-xl btn-block" <?php echo $btn_reg2_style; ?> href="<?php echo $this->Html->url('/login'); ?>" data-toggle="modal" data-target="#ajaxlogin">Already have an account? Signin</a>
          </div>

      </div>
        <?php echo $form_pads; ?>
	</div>
        
<?php } ?>

<!--
<script type="text/javascript">
    function digitsOnly(obj){
        obj.value=obj.value.replace(/[^\d]/g,'');
    }
</script>
-->

<?php if ( ($this->request->is('ajax') || isset($this->request->data['ajax'])) == true ) { ?>
<script>
    $(function() {
        $('#go2ajaxlogin').click(function() {
            $('#ajaxsignup').modal('hide');
        });
    });
</script>
<?php } ?>