<!DOCTYPE html>
<html>
<head>
    <title><?= $meta['title']; ?></title>
    <base href="/">
    <meta name="description" content="<?= $meta['description']; ?>">
    <meta name="keywords" content="<?= $meta['keywords']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="css/bootstrap.css" rel="stylesheet" media="all">
    <link href="css/flexslider.css" rel="stylesheet" media="screen">
    <link href="megamenu/css/style.css" rel="stylesheet" media="all">
    <link href="megamenu/css/ionicons.min.css" rel="stylesheet" media="all">
    <link href="css/style.css" rel="stylesheet" media="all">
</head>
<body>
<!--top-header-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                <div class="drop">
                    <div class="box">
                        <select id="currencies-select" tabindex="4" class="dropdown drop">
									<?php new \app\widgets\currency\Currency(); ?>
                        </select>
                    </div>
                    <div class="box1">
                        <select tabindex="4" class="dropdown">
                            <option value="" class="label">English :</option>
                            <option value="1">English</option>
                            <option value="2">French</option>
                            <option value="3">German</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
                        <ul class="dropdown-menu">
									<?php if (!empty($_SESSION['user'])): ?>
                               <li><a href="#">Добро
                                       пожаловать, <?= htmlspecialchars($_SESSION['user']['name']); ?></a></li>
                               <li><a href="<?= PATH; ?>/user/logout">Выход</a></li>
									<?php else: ?>
                               <li><a href="<?= PATH; ?>/user/login">Вход</a></li>
                               <li><a href="<?= PATH; ?>/user/signup">Регистрация</a></li>
									<?php endif; ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 top-header-left">
                <div class="cart box_1">
                    <a href="cart/show" class="show-cart">
                        <img src="images/cart-1.png" alt="">
                        <div class="total">
									<?php if (isset($_SESSION['cart']['sum']) and $_SESSION['cart']['sum'] > 0): ?>
                               <span class="simpleCart_total"
                                     id="top_cart_price"><?= \app\controllers\CurrencyController::getPriceString($_SESSION['cart']['sum']); ?></span>
									<?php else: ?>
                               <span class="simpleCart_total" id="top_cart_price">Empty Cart</span>
									<?php endif; ?>
                        </div>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--start-logo-->
<div class="logo">
    <a href="/"><h1>Luxury Watches</h1></a>
</div>
<!--start-logo-->
<!--bottom-header-->
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="menu-container">
                    <div class="menu">
							  <?php new \app\widgets\menu\Menu([
								  'tpl' => WWW . "/menu/menu.php",
							  ]); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3 header-right">
                <form action="search" class="search-bar" method="GET" autocomplete="off">
                    <input type="text" name="query" id="typeahead" class="typeahead" placeholder="Search"
                           value="<?= isset($_GET['query']) ? safeHtmlChars(trim($_GET['query'])) : ''; ?>">
                    <input type="submit" value="">
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--bottom-header-->
<?php if (!empty($_SESSION['errors'])): ?>
    <div class="errors">
        <div class="container">
			  <?php getErrors(); ?>
        </div>
    </div>
<?php endif; ?>
<?php //debug($_SESSION, 'Session'); //session_destroy(); ?>
<?= $content; ?>
<!--information-starts-->
<div class="information">
    <div class="container">
        <div class="infor-top">
            <div class="col-md-3 infor-left">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                    <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                    <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Information</h3>
                <ul>
                    <li><a href="#"><p>Specials</p></a></li>
                    <li><a href="#"><p>New Products</p></a></li>
                    <li><a href="#"><p>Our Stores</p></a></li>
                    <li><a href="contact.html"><p>Contact Us</p></a></li>
                    <li><a href="#"><p>Top Sellers</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>My Account</h3>
                <ul>
                    <li><a href="account.html"><p>My Account</p></a></li>
                    <li><a href="#"><p>My Credit slips</p></a></li>
                    <li><a href="#"><p>My Merchandise returns</p></a></li>
                    <li><a href="#"><p>My Personal info</p></a></li>
                    <li><a href="#"><p>My Addresses</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Store Information</h3>
                <h4>The company name,
                    <span>Lorem ipsum dolor,</span>
                    Glasglow Dr 40 Fe 72.</h4>
                <h5>+955 123 4567</h5>
                <p><a href="mailto:example@email.com">contact@example.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->
<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
                <form>
                    <input type="text" value="Enter Your Email" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
                    <input type="submit" value="Subscribe">
                </form>
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2020 Luxury Watches. All Rights Reserved</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--footer-end-->
<!--modal-->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Корзина</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                <a href="cart/view" type="button" class="btn btn-primary">Оформить заказ</a>
                <button type="button" class="btn btn-danger clear-cart">Очистить корзину</button>
            </div>
        </div>
    </div>
</div>
<!--modal end-->
<!-- scripts -->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/jquery.easydropdown.js"></script>
<script>
    $(function () {
        var menu_ul = $('.menu_drop > li > ul'),
            menu_a = $('.menu_drop > li > a');
        menu_ul.hide();
        menu_a.click(function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                menu_a.removeClass('active');
                menu_ul.filter(':visible').slideUp('normal');
                $(this).addClass('active').next().stop(true, true).slideDown('normal');
            } else {
                $(this).removeClass('active');
                $(this).next().stop(true, true).slideUp('normal');
            }
        });
    });
</script>
<script src="js/imagezoom.js"></script>
<script defer src="js/jquery.flexslider.js"></script>
<script src="megamenu/js/megamenu.js"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>
<?php
foreach ($scripts as $script) {
	echo $script;
}
?>
<?php $curr = \oclock\App::$app->getProperty('currency'); ?>
<script>
    let path = "<?= PATH; ?>",
        course = "<?= $curr['value']; ?>",
        sLeft = "<?= $curr['symbol_left']; ?>";
    sRight = "<?= $curr['symbol_right']; ?>";
</script>
<script src="js/main.js"></script>
</body>
</html>