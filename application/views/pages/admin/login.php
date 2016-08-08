<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url();?>"><b>APK2I</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login</p>
    <!-- Notif Error -->
    <div class="alert alert-danger" role="alert" style="display:none">
            
    </div>
    <!-- end Notif Error -->

    <?php echo form_open("admin/user/do_login", array('id'=> 'form-login'));?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="identity" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="remember" value="1" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close();?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->