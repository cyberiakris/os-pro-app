<div class="modal" id="shopcart">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3>Cart</h3>
    </div>
	<div class="modal-body" id="shopcartPreview">
		
		<p>Loading content&hellip;</p>
		
	</div>
	<div class="modal-footer">
	</div>
</div>
<script>
$('#viewCart').click(function(){ 
	$('#shopcartPreview').html("<p>Loading content&hellip;</p>");
});
</script>

<div class="modal" id="confirmcheckout">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3>Confirm</h3>
    </div>
	<div class="modal-body" id="checkoutPreview">
		
		<p>Loading content...</p>
		
	</div>
	<div class="modal-footer">
		<!-- <span id="checkoutstats" class="pull-left"></span><button class="btn btn-primary" data-loading-text="please wait..." id="btncheckout">Checkout</button> -->
	</div>
</div>
<script>
$('.doCheckout').click(function(){ 
	$('#shopcart').modal('hide'); 
	$('#checkoutPreview').html("<p>Loading content...</p>");
});
</script>

<div class="modal narrow-modal" id="requestpwd" style="display:none;">
<form class="form-horizontal" id="forgotpwd4m" method="post" action="<?php echo $this->Html->url('/forgot'); ?>">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3>Forgot your password?</h3>
    </div>
	<div class="modal-body">

		<br />
		<div class="form-group" style="padding:0 15px;">
			<label>Your Email</label>
			<input type="text" name="email" class="form-control" id="emailreset4m"/>
			<p class="help-block"></p>
		</div>

	</div>
	<div class="modal-footer">
		<span id="forgotpwdstats" class="pull-left"></span><button class="btn btn-primary" data-loading-text="please wait..." id="btnforgotpwd4m">Reset</button>
	</div>
</form>
</div>
<script>
<!--
/*
$('#forgotpwd4m').submit(function(e){
    e.preventDefault();
	$('#btnforgotpwd4m').button('loading');
	$.get("<?php echo $this->Html->url("/users/forgot"); ?>", {q:$('#emailreset4m').val()}, function(data){
		$ema = $('#emailreset4m').val();
        alert('hi');
		if(data['status']){
			$('#forgotpwdstats').html("<div class=\"alert alert-success\" style=\"width:60%\">A password reset option has been sent to " + $ema + ". Please check your email</div>").fadeIn(1000);
			$('#btnforgotpwd4m').button('reset');
			//alert(data['data']);
		}else{
			//alert(data['data']);
			$('#btnforgotpwd4m').button('reset');
			$('#forgotpwdstats').html("<div class=\"alert alert-error\"><strong>Oops!</strong> "+data.data+"</div>");
		}
	}, 'json');
	return false;
});
*/
-->
</script>

<div class="modal narrow-modal" id="ajaxlogin">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3 class="text-center">Login with your account</h3>
    </div>
    <div class="modal-body" id="loginPreview">

        <p>Loading content...</p>

    </div>
    <div class="modal-footer">

    </div>
</div>
<?php
if(!isset($user)){
?>
<script>
    $(document).ready(function () {
        $('.buynow-link').click(function (e) {
            e.preventDefault();
            var buyurl = $(this).attr('href').split('buynow?')[1];
            var ajaxloginurl = '<?php echo $this->Html->url('/login'); ?>' + '?login_referer=/cart/buynow?' + buyurl;
            $('#ajaxlogin').modal({ toggle:true, remote:ajaxloginurl });
        });
        $('.download-link').click(function (e) {
            e.preventDefault();
            var downloadurl = $(this).attr('href').split('download')[1];
            var ajaxdownloadnurl = '<?php echo $this->Html->url('/login'); ?>' + '?login_referer=/download' + downloadurl;
            $('#ajaxlogin').modal({ toggle:true, remote:ajaxdownloadnurl });
        });
    });
</script>
<?php
}
?>

<div class="modal narrow-modal" id="ajaxsignup">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3 class="text-center">Register for a new account</h3>
    </div>
    <div class="modal-body" id="signupPreview">

        <p>Loading content...</p>

    </div>
    <div class="modal-footer">

    </div>
</div>

<div class="modal" id="pdfviewer">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3 class="text-center">PDF</h3>
    </div>
    <div class="modal-body" id="pdfPreview">

        <p>Loading content&hellip;</p>

    </div>
    <div class="modal-footer">
    </div>
</div>
<script>
    $('.pdfview-btn').click(function(){
        $('#pdfPreview').html("<p>Loading content&hellip;</p>");
    });
</script>

