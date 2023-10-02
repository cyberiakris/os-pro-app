<h1>Reset Password</h1>
<hr />
<?php 
if( isset($status) && ($status['status'] == true) ) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <form method="post">
            <table class="table">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <?php echo $status['data']['User']['email']; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">New Password</td>
                    <td>
                        <div class="form-group">
                            <input type="password" name="set_password" id="pass" class="validate[required] form-control" placeholder="password">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right">Confirm Password</td>
                    <td>
                        <div class="form-group">
                            <input type="password" name="confirm_password" id="pass2" class="validate[required] form-control" placeholder="password">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $status['data']['User']['id']; ?>" />
                        <input type="submit" value="Set Password" class="btn btn-default" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <?php
} else {
    $no_show = 'The reset process failed. Unknown account supplied.<br/> <b></b><a href="'.$this->Html->url('/register').'" class="btn">Click here</a></b> to create an account with us.';
    $status['data'] = !empty($status['data']) ? $status['data'] : $no_show ;
	echo "<div class='alert alert-danger'> 
           {$status['data']}
    </div>";
} ?>
