    <!--container start-->
    <div class="login-bg">
        <div class="container">
			<?php 
			echo $message;							
			
			if (validation_errors()) { ?>
				<div class="alert alert-error text-warning panel">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<?php 
					echo validation_errors(); 
				?>
				</div>
			<?php }; ?>
            <div class="form-wrapper">
            <form class="form-signin wow fadeInUp" method='post'
				action="<?=base_url()?>sekolah/login/verify">
            <h2 class="form-signin-heading">sign in now</h2>
            <div class="login-wrap">
                <input name='user_id' id='user_id' type="text" class="form-control" placeholder="User ID" autofocus>
                <input name='password' id='password' type="password" class="form-control" placeholder="Password">
                <label class="checkbox">
                    <input type="checkbox" value="1" name='rememberme'> Remember me
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                    </span>
                </label>
                <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                <p>or you can sign in via social network</p>
                <div class="login-social-link">
                    <a href="#" class="facebook">
                        <i class="fa fa-facebook"></i>
                        Facebook
                    </a>
                    <a href="#" class="twitter">
                        <i class="fa fa-twitter"></i>
                        Twitter
                    </a>
                </div>
                <div class="registration">
                    Don't have an account yet?
                    <a class="" href="<?=base_url()?>sekolah/register">
                        Create an account
                    </a>
                </div>

            </div>

              <!-- Modal -->
              <div aria-hidden="true" aria-labelledby="myModal" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Forgot Password ?</h4>
                          </div>
                          <div class="modal-body">
                              <p>Enter your e-mail address below to reset your password.</p>
                              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-success" type="button">Submit</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- modal -->

          </form>
          </div>
        </div>
    </div>
    <!--container end-->
