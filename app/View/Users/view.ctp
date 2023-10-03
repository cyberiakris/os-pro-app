<h2>My Account</h2>
<hr />
<h3>View Account</h3>
<br />
<br />

<div>
    <?php
    if (isset($status)) {
        if ($status['status']) {
            ?>
            <div class="alert alert-success">
                <?php echo $status['data']; ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> 
                <ol>
                    <?php
                    if (is_array($status['data'])) {
                        foreach ($status['data'] as $msg) {
                            ?>
                            <li><?php echo $msg; ?></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li><?php echo $status['data']; ?></li>
                    <?php } ?>
                    <!--Due to some black magic, your order has failed. Nevertheless, our developers are cooking up a spell to counter this. Please try again.-->
                </ol>
            </div>
            <?php
        }
    }
    ?>
</div>

<div class="row">
    <div class="col-md-8">
        <table class="table table-condensed table-hover table-striped">
            <tr>
                <td>First Name</td>
                <td><?php echo $updated_user_info['first_name']; ?> </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><?php echo $updated_user_info['last_name']; ?> </td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><?php echo $updated_user_info['phone']; ?> </td>
            </tr>
        </table>

    </div>
    <div class="col-md-3">
        <a href="#editbox" class="btn btn-success" data-toggle="modal">EDIT</a>
    </div>
</div>

<hr />

<table class="table table-condensed table-hover table-striped">
    <tr>
        <td>Email</td>
        <td><?php echo $updated_user_info['email']; ?> </td>
        <td>
            <!-- <a href="#change-email" class="btn btn-success" data-toggle="modal">Change</a> -->
            <?php if($updated_user_info['verified'] == 1){ echo '<em class="green">Verified</em>'; } ?>
        </td>
    </tr>
    <tr>
        <td>Password</td>
        <td>******</td>
        <td>
            <a href="#pwdbox" class="btn btn-success" data-toggle="modal">Change</a>
        </td>
    </tr>
</table>
<div class="modal" id="editbox">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3>Edit Info</h3>
    </div>
    <div class="modal-body" id="editboxPreview">

        <form method="post" action="<?php echo $this->Html->url('/users/view'); ?>" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label> <input type="text" id="first_name" name="first_name"  class="form-control" placeholder="first name" value="<?php echo $updated_user_info['first_name']; ?>" />
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label> <input type="text" id="last_name" name="last_name"  class="form-control" placeholder="last name" value="<?php echo $updated_user_info['last_name']; ?>" />
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label> <input type="text" id="phone" name="phone"  class="form-control" onkeyup="digitsOnly(this)" onblur="digitsOnly(this)" placeholder="phone number" value="<?php echo $updated_user_info['phone']; ?>" />
            </div>
            <input type="submit" value="Update" class="btn btn-success btn-lg btn-block" />
            <input type="hidden" name="edit" value="1" />
        </form>


    </div>
    <div class="modal-footer">
    </div>
</div>

<div class="modal" id="pwdbox">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3>Change Password</h3>
    </div>
    <div class="modal-body" id="pwdboxPreview">

        <form method="post" action="<?php echo $this->Html->url('/users/view'); ?>" method="post">
            <div class="form-group">
                <label for="oldpass">Current Password:</label> <input type="password" id="oldpass" name="oldpwd" class="form-control" />
            </div>
            <div class="form-group">
                <label for="newpass">New Password:</label> <input type="password" id="newpass" name="newpwd1" class="form-control" />
            </div>
            <div class="form-group">
                <label for="newpass2">Confirm New Password:</label> <input type="password" id="newpass2" name="newpwd2" class="form-control" />
            </div>
            <input type="submit" value="Update" class="btn btn-success btn-lg btn-block" />
        </form>


    </div>
    <div class="modal-footer">
    </div>
</div>
