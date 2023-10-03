<div class="span5">
    <div>&nbsp;</div>
    <h1>Account Verification</h1>
    <?php 
        if(isset($status)){
            if(isset($status['status']) && $status['status']){
    ?>
    <div class="alert alert-success">
        Hello <?php echo $status['data']['User']['first_name']; ?>, your has been verified. Please login to continue.
    </div>
    <?php
            }else{
    ?>
    <div class="alert alert-error">
        The verification process failed.<br>
        REASONS:
        Unknown account supplied OR user account is already verified.<br/> Click <a href="<?php echo $this->Html->url('/signup'); ?>" class="btn btn-default">here</a> to create an account with us.

    </div>
    <?php
            }
        }
    ?>
</div>