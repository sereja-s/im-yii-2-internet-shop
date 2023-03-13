<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Корзина';

?>

<div class="col-lg-12 top_cart_block">
	<div>
		<p>Состояние корзины</p>
		<p>Ваша корзина содержит: <?= count($products); ?> товаров</p>
	</div>
</div>
<div class="col-lg-12">
	<ul class="cart_status">
		<li class="active"><span>1. Заказ</span></li>
		<li><span>2. Адрес</span></li>
		<li><span>3. Доставка</span></li>
		<li><span>4. Оплата</span></li>
	</ul>
</div>
<div class="col-lg-12">

	<?php if (count($products) == 0) : ?>

		<p>В корзине нет товаров</p>

</div>

<?php else : $sum = 0; ?>

	<table class="table table-bordered">
		<tr class="cart_prod_head">
			<td class="img_cart">Товар</td>
			<td class="title_cart">Описание</td>
			<td class="price_cart">Цена за единицу</td>
			<td class="value_cart">Кол-во</td>
			<td class="rez_price_cart">Стоимость</td>
		</tr>

		<?php foreach ($products as $product) : ?>

			<tr class="cart_prod_content">
				<td class="img_cart"><img src="images/<?= $product['img'] ?>"></td>
				<td class="title_cart"><?= $product['name'] ?></td>
				<td class="price_cart"><?= $product['price'] ?> руб</td>
				<td class="value_cart">
					<div>
						<input type="text" value="<?= $product['count_cart'] ?>">
						<span>-</span>
						<span>+</span>
					</div>
				</td>
				<td class="rez_price_cart"><?php
													$sum += $product['price'] * $product['count_cart'];
													echo $product['price'] * $product['count_cart']; ?> руб</td>
			</tr>

		<?php endforeach; ?>

		<tr class="cart_prod_footer">
			<td colspan="2" class="null_cart"></td>
			<td colspan="2" class="rez_title_cart">Итого, к оплате:</td>
			<td class="rez_price_cart"><?= $sum ?> руб</td>
		</tr>
	</table>
	</div>
	<div class="col-lg-12 btn_cart_wrap">
		<a href="#" class="btn_cart_im"><i class="glyphicon glyphicon-chevron-left"></i>Продолжить покупки</a>
		<a href="<?= Url::toRoute('page/checkout') ?>" class="btn_cart_zakaz">Оформить заказ<i class="glyphicon glyphicon-chevron-right"></i></a>
	</div>

<?php endif; ?>