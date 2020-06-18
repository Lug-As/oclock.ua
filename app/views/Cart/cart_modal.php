<?php
if (isset($_SESSION['cart']['list']) and $_SESSION['cart']['list']):
	$cart = $_SESSION['cart'];
	?>
<table class="table table-striped table-hover" id="cart-table">
    <thead>
    <tr>
        <th scope="col">Фото</th>
        <th scope="col">Название</th>
        <th scope="col">Количество</th>
        <th scope="col">Цена</th>
        <th scope="col">Стоимость</th>
        <th scope="col">Удаление</th>
    </tr>
    </thead>
    <tbody>
      <?php foreach ($cart['list'] as $id => $item): ?>
    <tr>
        <td><a href="product/<?= $item['alias']; ?>"><img class="table-img" src="images/<?= $item['img']; ?>"
                                                          alt="<?= $item['title']; ?>"></a></td>
        <td><a href="product/<?= $item['alias']; ?>"><?= $item['title']; ?></a></td>
        <td><?= $item['qty']; ?> шт.</td>
        <td><?= \app\controllers\CurrencyController::getPriceString($item['price']); ?></td>
        <td><?= \app\controllers\CurrencyController::getPriceString($item['price'] * $item['qty']); ?></td>
        <td class="text-danger">
            <button data-id="<?= $id; ?>" class="btn btn-danger del-item">&times;</button>
        </td>
    </tr>
      <?php endforeach; ?>
    <tr> 
        <td>Общее количество</td>
        <td colspan="5" class="text-right"><?= $cart['qty']; ?> шт.</td>
    </tr>
    <tr>
        <td>Общая сумма</td>
        <td colspan="5" class="text-right"><?= \app\controllers\CurrencyController::getPriceString($cart['sum']); ?></td>
    </tr>
    </tbody>
</table>
<?php else: ?>
<h3 class="text-center text-secondary">Корзина пуста</h3>
<?php endif; ?>