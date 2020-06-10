<!--slider-starts-->
<div class="main-slider" id="home">
    <div id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt="">
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt="">
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt="">
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<!--slider-ends-->
<?php if (!empty($brands)): ?>
    <!--about-starts-->
    <div class="about">
        <div class="container">
            <div class="about-top grid-1">
					<?php foreach ($brands as $brand): ?>
                   <div class="col-md-4 about-left">
                       <figure class="effect-bubba">
                           <img class="img-responsive" src="images/<?= $brand['img']; ?>"
                                alt="<?= $brand['title']; ?>">
                           <figcaption>
                               <h2><?= $brand['title']; ?></h2>
                               <p><?= $brand['description']; ?></p>
                           </figcaption>
                       </figure>
                   </div>
					<?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--about-end-->
<?php endif; ?>
<?php if (!empty($hits)): ?>
    <!--product-starts-->
    <div class="product">
        <div class="container">
            <div class="product-top">
                <div class="product-one">
						 <?php foreach ($hits as $hit): ?>
                       <div class="col-md-3 product-left">
                           <div class="product-main simpleCart_shelfItem">
                               <a href="product/<?= $hit->alias; ?>" class="mask"><img
                                           class="img-responsive zoom-img" src="images/<?= $hit->img; ?>"
                                           alt="<?= $hit->title; ?>"></a>
                               <div class="product-bottom">
                                   <h3><a href="product/<?= $hit->alias; ?>" class="mask"><?= $hit->title; ?></a>
                                   </h3>
                                   <p>Explore Now</p>
                                   <h4>
                                       <a data-id="<?= $hit->id; ?>" class="add-to-cart-link" href="cart/add?id=<?= $hit->id; ?>"><i></i></a>
                                       <span class="item_price"><?= app\controllers\CurrencyController::getPriceString($hit->price); ?></span>
												  <?php if ($hit->old_price): ?>
                                          <small>
                                              <del><?= app\controllers\CurrencyController::getPriceString($hit->old_price); ?></del>
                                          </small>
												  <?php endif; ?>
                                   </h4>
                               </div>
										<?php if ($hit->old_price): ?>
                                  <div class="srch">
                                      <span><?= 100 * (1 - round($hit->price / $hit->old_price, 3)); ?>%</span>
                                  </div>
										<?php endif; ?>
                           </div>
                       </div>
						 <?php endforeach; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!--product-end-->
<?php endif; ?>
<script src="js/responsiveslides.min.js"></script>
<script>
    $(function () {
        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });
    });
</script>