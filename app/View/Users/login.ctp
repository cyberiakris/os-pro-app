<script>
/*
  var recaptcha1;
  var myCallBack = function() {
	//Render the recaptcha1 on the element with ID "recaptcha1"
	recaptcha1 = grecaptcha.render('recaptcha1', {
	  'sitekey' : '<?php echo RECAPTCHA_SITEKEY; ?>', 
	  'theme' : 'light'
	});
  };
*/
</script>

<?php
$btn_wide ='btn-block';
$title_style = 'style="font-weight:bold; text-align:center; font-size:1.5em; margin-bottom:10px"';
$btn_reg1_style = 'style="display:none"';
$btn_reg2_style = 'style="display:block; background-color:#e8e8e8;"';
// hide on ajax
if ( ($this->request->is('ajax') || isset($this->request->data['ajax'])) == false ) {
	$this->Html->addCrumb("Login");
    $btn_wide = ""; // remove btn wide style
    $title_style = ''; // remove title style
    $btn_reg1_style = 'style="display:block"';
    $btn_reg2_style = 'style="display:none"';
?>
	<h2>My Account</h2>
	<hr />
<?php
}
?>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<?php 
if( isset($error) && empty($error['status']) ){
echo "<div class='alert alert-danger'> 
           {$error['data']}
      </div>";
}
?>

	<h3 <?php echo $title_style; ?>>Login</h3>
	<br />

	<form id="form-login" action="<?php echo $this->Html->url('/users/login'); ?>" class="formular" method="post">
		<div class="form-group">
		 <input type="text" name="email" id="req" class="validate[required] form-control" placeholder="email address">
		</div>
		<div class="form-group">
		 <input type="password" name="password" id="pass" class="validate[required] form-control" placeholder="password">
		</div>
		<!--
		<div class="checkbox">
		<label>
		 <input name="remember" type="checkbox" value="Remember Me">Remember Me
		</label>
		<br />
		<div id="recaptcha1"></div>
		<br />
		-->
		<button id="gologin"  class="btn btn-success btn-lg <?php echo $btn_wide; ?>">Login</button>
	</form>

    <!-- <hr /> -->

	<div style="text-align: left; margin: 20px 0;">
		<div class="button-profile"><a data-toggle="modal" href="#requestpwd">Lost your password?</a></div>
	</div>

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
        <div class="button-profile" <?php echo $btn_reg1_style; ?>><a href="<?php echo $this->Html->url('/register'); ?>">Register</a></div>
        <a id="go2ajaxsignup" class="btn btn-default btn-xl btn-block" <?php echo $btn_reg2_style; ?> href="<?php echo $this->Html->url('/register'); ?>" data-toggle="modal" data-target="#ajaxsignup">Register</a>
    </div>

</div>
<div class="col-md-2"></div>
</div>

<?php if ( ($this->request->is('ajax') || isset($this->request->data['ajax'])) == true ) { ?>
<script>
    $(function() {
        $('#go2ajaxsignup').click(function() {
            $('#ajaxlogin').modal('hide');
        });
    });
</script>
<?php } ?>