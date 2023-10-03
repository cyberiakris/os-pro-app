<?php
echo $this->set('title_for_layout', 'My Account');

if(!empty($current_user['first_name'])){
	$display_name = ucfirst($current_user['first_name']);
} else {
	$get_display_name = explode('@',$current_user['email']);
	$display_name = $get_display_name[0];
}
?>
<h2>My Account</h2>
<p>Hello <a href="<?php echo $this->Html->url('/users/view'); ?>"><span class="branded"><?php echo $display_name; ?></span></a> &nbsp; 
(not <span class="branded"><?php echo $display_name; ?></span>? &nbsp; <a href="<?php echo $this->Html->url('/users/logout'); ?>">Sign out</a>).<p> 
<p>From your account dashboard you can view your recent orders, 
manage your shipping and billing addresses and <a href="<?php echo $this->Html->url('/users/view'); ?>">edit your password and account details</a>.</p>
<?php if(isset($provider)){ ?>
    <h2>Sub Creators</h2>
    <p><a href="<?php echo $this->Html->url('/users/provider'); ?>">manage sub creators here</a>.</p>
<?php } ?>

<h2>My Addresses</h2>
<p>The following addresses will be used on the checkout page by default.</p>
<br />
<br />

<div class="row">
	<div class="col-sm-6 white-bg">
	<a class="btn btn-default btn-sm pull-right inner-btn" href="<?php echo $this->Html->url('/users/billing'); ?>">Edit</a>
	<h4>Billing Address</h4>
	<?php if(isset($updated_user_info) && !empty($updated_user_info['billing_address'])){ ?>
		<p><br />
		<strong>Address:</strong> <?php echo $updated_user_info['billing_address'];?><br />
		<strong>Address 2:</strong> <?php echo $updated_user_info['billing_address2'];?><br />
		<strong>City:</strong> <?php echo $updated_user_info['billing_city'];?><br />
		<strong>State:</strong> <?php echo $updated_user_info['billing_state'];?><br />
		<!-- <strong>Zip:</strong> <?php //echo $updated_user_info['billing_zip'];?><br /> -->
		<strong>Country:</strong> <?php echo $updated_user_info['billing_country'];?></p>
	<?php } else { ?>
		<p>You have not set up this type of address yet.</p>
	<?php } ?>
	</div>

    <div class="col-sm-1"></div>

    <!-- div class="col-sm-5">
        <div class="col-sm-12 pull-right white-bg-only">
            <a class="btn btn-default btn-sm pull-right inner-btn" href="<?php echo $this->Html->url('/my_orders'); ?>">View All</a>
            <h4>Recent Orders</h4>
        </div>

    </div -->

</div>

