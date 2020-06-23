<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li>Регистрация</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one signup">
                    <div class="register-top heading">
                        <h2>ACCOUNT</h2>
                    </div>
                    <div class="register-main">
                        <div class="col-md-6 account-left">
                            <form method="post" action="user/login" id="signup" role="form" data-toggle="validator">
                                <div class="form-group has-feedback">
                                    <label for="login">Логин</label>
                                    <input type="text" name="login" class="form-control" id="login"
                                           placeholder="my_login" required
                                           value="<?= isset($_SESSION['form_data']['login']) ? safeHtmlChars($_SESSION['form_data']['login']) : ''; ?>">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="pasword">Password</label>
                                    <input type="password" name="password" class="form-control" id="pasword"
                                           placeholder="Password"
                                           data-error="Пароль должен включать не менее 6 символов" data-minlength="6"
                                           required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">Войти в аккаунт</button>
                            </form>
									<?php if (isset($_SESSION['form_data'])) {
										unset($_SESSION['form_data']);
									} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->
<script src="<?= PATH; ?>/js/validator.min.js"></script>