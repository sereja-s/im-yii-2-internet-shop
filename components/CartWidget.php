<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class CartWidget extends Widget
{

	public $count;

	// инициализируем сессию (для этого воспользуемся конструктором):
	function __construct()
	{
		$session = Yii::$app->session;

		// затем откроем сессию:
		$session->open();

		// проверим есть ли в соответствующем глобальном массиве нужная нам сессия(здесь- productsSession):
		if ($session->has('productsSession')) {

			// получим из сессии данные (в сессии будут храниться последовательность товаров и их кол-во(массив)):
			$productsSession = $session->get('productsSession');
		}


		if (isset($productsSession) && is_array($productsSession) && count($productsSession) > 0) {

			// запишем кол-во товаров в сессии:
			$this->count = count($productsSession);
		} else {

			$this->count = 0;
		}
	}

	public function run()
	{
		echo '<a href="' . Url::toRoute('page/cart') . '">
		<i class="glyphicon glyphicon-shopping-cart"></i>
		<span>' . $this->count . '</span>						
		  </a>';
	}
}
