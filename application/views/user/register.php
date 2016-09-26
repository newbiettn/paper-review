<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<!--Include Head-->
    <?=$head?>
    <body>
        <?=$header?>

        <div class="row">
            <div class="large-8 large-centered columns container">
                <h3>Register new account</h3>
                <?php echo form_open('user/login/create_member'); ?>
                <fieldset>
                    <legend>iHotFood Register</legend>
                    <div class="large-12">
                        <label>Username <small>required</small></label>
                        <input name="username" required="required" type="text" placeholder="mysuperusername" />
                        <?php echo form_error('username', '<small class="error">', '</small>'); ?>
                    </div>
                    <div class="large-12">
                        <label>Email <small>required</small></label>
                        <input name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>
                        <?php echo form_error('email', '<small class="error">', '</small>'); ?>
                    </div>
                    <div class="large-12">
                        <label>Re-enter Email <small>required</small></label>
                        <input name="email_confirm" required="required" type="email" placeholder="mysupermail@mail.com"/>
                        <?php echo form_error('email_confirm', '<small class="error">', '</small>'); ?>
                    </div>
                    <div class="large-12">
                        <label>Password <small>required</small></label>
                        <input name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        <?php echo form_error('password', '<small class="error">', '</small>'); ?>
                    </div>
                    <div class="large-12">
                        <label>Re-enter Password <small>required</small></label>
                        <input name="password_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        <?php echo form_error('password_confirm', '<small class="error">', '</small>'); ?>
                    </div>
                    <div class="large-12">
                        Already a member ?
                        <a href="<?php echo base_url()?>index.php/user/login/show_login" class="to_register"> Go and log in </a>
                    </div>
                </fieldset>
                <div class="large-12">
                    <input class="button small" type="submit" value="Register"/>
                </div>
                </form>
            </div>
        </div>
        <?=$footer?>
    </body>
</html>