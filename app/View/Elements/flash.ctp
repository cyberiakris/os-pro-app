<?php if(isset($flash_msg)) { 
	$alert = $flash_msg['alert']; 
	$message = $flash_msg['msg']; 
?>
	<div class="alert alert-<?php echo (isset($alert)? $alert : 'info' ); ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<center>    <?php echo (isset($message)? $message : 'Something went wrong' ); ?></center>
	</div>
<?php
} 
?>
