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
            <div class="large-6 large-centered columns login-container">
                <?php echo form_open('user/login/do_login'); ?>
                <fieldset class="fieldset">
                    <h4 class="text-center">Log in with your account</h4>
                    <div class="large-12">
                        <label>Username
                        <input type="text" name="username" placeholder="Username" />
                        <?php echo form_error('username', '<small class="error">', '</small>'); ?>
                        </label>
                    </div>
                    <div class="large-12">
                        <label>Password
                        <input type="password" name="password" placeholder="Password" />
                        <?php echo form_error('password', '<small class="error">', '</small>'); ?>
                        </label>
                    </div>
                    <div class="large-12">
                        <input class="button expanded" type="submit" value="Login"/>
                    </div>
                </fieldset>

                </form>
            </div>
        </div>

        <?=$footer?>
    </body>
</html>