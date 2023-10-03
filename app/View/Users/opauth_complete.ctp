
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<?php 
if( isset($error) && empty($error['status']) ){
	echo "<div class='alert alert-danger'> 
           {$error['data']}
    </div>";

	echo '<br /><h4>Try Again?</h4><br />';
	echo $this->Html->image("login-facebook.jpg", array(
		"alt" => "Signin with Facebook",
		'url' => array('controller'=>'auth', 'action'=>'facebook')
	));

} 
else if( isset($opauth_response) ) { 
	$get_image = explode('?',$opauth_response['auth']['info']['image']);
	$profile_pic = $get_image[0].'?width=200&height=200';
?>
	<div style="text-align:center">
		<img src="<?php echo $profile_pic; ?>" class="img-circle img-responsive" alt="" style="display:block; margin:20px auto" />
		<div class="progress">
		  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
			<span class="sr-only">100% Complete</span>
		  </div>
		</div>
		<p>Welcome back <strong><?php echo $opauth_response['auth']['raw']['name']; ?></strong>,<br />
		You will be logged in shortly.</p><br />
		<hr>
		<p>If you are not logged in after a few seconds, please click the button below to continue</p><br />
		<form method="post" action="<?php echo $this->Html->url('/users/authlogin'); ?>" id="facebooklogin">
			<input type="hidden" name="email" value="<?php echo $opauth_response['auth']['raw']['email']; ?>" />
			<input type="hidden" name="facebook_token" value="<?php echo $opauth_response['auth']['credentials']['token']; ?>" />
			<button id="authlogin"  class="btn btn-success btn-lg">Continue ...</button>
		</form>
	</div>
	<script>
		$(function() {
			setTimeout(
				function() { $('#facebooklogin').delay(2000).submit(); }, 
				5000
			);
		});
	</script>
<?php
} 
else { 
?>

	<br /><br />
	<?php
		echo $this->Html->image("login-facebook.jpg", array(
			"alt" => "Signin with Facebook",
			'url' => array('controller'=>'auth', 'action'=>'facebook')
		));
	?>	
	<br /><br />
	
<?php
}
?>

</div>
<div class="col-md-2"></div>
</div>