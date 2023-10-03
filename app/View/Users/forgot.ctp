<?php
// hide on ajax
if ( ($this->request->is('ajax') || isset($this->request->data['ajax'])) == false ) {
	$this->Html->addCrumb("Forgot Password");
?>
	<h2>Forgot Password</h2>
	<hr />
<?php
}
?>
<?php 
if( isset($response) && $response['status'] ){
	echo "<div class='alert alert-success'> 
           {$response['data']}
    </div>";
}
else if( isset($response) && empty($response['status']) ){
	echo "<div class='alert alert-danger'> 
           {$response['data']}
    </div>";
} ?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
		<form method="post" action="<?php echo $this->Html->url('/users/forgot'); ?>">
			<div class="form-group">
			 <input type="text" name="email" id="fgt" class="form-control" placeholder="email address">
			</div>
			<button id="getPwd"  class="btn btn-success btn-lg">Submit</button>
		</form>
    </div>
    <div class="col-md-2"></div>
</div>
