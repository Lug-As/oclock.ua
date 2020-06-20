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
                                <div class="form-group">
                                    <label for="login">Логин</label>
                                    <input type="text" name="login" class="form-control" id="login"
                                           placeholder="my_login" required>
                                </div>
                                <div class="form-group">
                                    <label for="pasword">Пароль</label>
                                    <input type="password" name="password" class="form-control" id="pasword"
                                           placeholder="Password123" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Войти в аккаунт</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->
<script src="<?= PATH; ?>/js/validator.min.js"></script>