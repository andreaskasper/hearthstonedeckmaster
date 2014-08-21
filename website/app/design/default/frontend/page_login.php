<?php
PageEngine::html("html_head");
PageEngine::html("header");
PageEngine::html("breadcrumbs");
?>
<div id="page-content">
	<h3>anmelden/Registrieren</h3>
	<div class="row">
		<div class="col-md-6">
			<form method="POST"><INPUT type="hidden" name="act" value="login"/>
			<h4>altes System</h4>
						<div class="content-box-wrapper pad20A pad0B">
                            <div class="form-row">
                                <div class="form-label col-md-3">
                                    <label for="login_email">
                                        E-Mail/Benutzername:
                                        <span class="required">*</span>
                                    </label>
                                </div>
                                <div class="form-input col-md-9">
                                    <div class="form-input-icon">
                                        <i class="glyph-icon icon-envelope-o ui-state-default"></i>
                                        <input placeholder="max@mustermann.de" data-type="email" data-trigger="change" data-required="true" type="text" name="login_email" id="login_email">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label col-md-3">
                                    <label for="login_pass">
                                        Passwort:
                                    </label>
                                </div>
                                <div class="form-input col-md-9">
                                    <div class="form-input-icon">
                                        <i class="glyph-icon icon-unlock-alt ui-state-default"></i>
                                        <input placeholder="Passwort" data-trigger="keyup" data-rangelength="[3,25]" type="password" name="login_pass" id="login_pass">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-checkbox-radio col-md-6">
                                    <input type="checkbox" class="custom-checkbox" name="remember-password" id="remember-password">
                                    <label for="remember-password" class="pad5L">Erinnere dich an mich</label>
                                </div>
                                <div class="form-checkbox-radio text-right col-md-6">
                                    <a href="#" class="switch-button" switch-target="#login-forgot" switch-parent="#login-form" title="Recover password">Passwort vergessen?</a>
                                </div>
                            </div>
                        </div>
                        <div class="button-pane">
                            <button type="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="demo-form-valid" title="Validate!">
                                <span class="button-content">
                                    Login
                                </span>
                            </button>
                        </div>
						</form>
        </div>
		<div class="col-md-6">
			<h4>schneller Login</h4>
			<a href="?act=loginfacebook" class="btn large bg-facebook"><span class="glyph-icon icon-separator"><i class="glyph-icon icon-facebook"></i></span><span class="button-content">Facebook</span></a>
			<a href="?act=logingoogle" class="btn large bg-google"><span class="glyph-icon icon-separator"><i class="glyph-icon icon-google-plus"></i></span><span class="button-content">Google</span></a>
			<a href="?act=logintwitter" class="btn large bg-twitter"><span class="glyph-icon icon-separator"><i class="glyph-icon icon-twitter"></i></span><span class="button-content">Twitter</span></a>
		</div>




	</div>
</div><!-- #page-content -->
<?php
PageEngine::html("html_footer");
?>

