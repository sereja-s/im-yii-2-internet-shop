<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\SortForm;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Categories;
use app\models\Products;
use phpDocumentor\Reflection\Types\Null_;
use yii\web\NotAcceptableHttpException;

/**
 * контроллер для страниц сайта
 */
class PageController extends Controller
{
	/**
	 * Для страницы списка товаров
	 *
	 * @return string
	 */
	public function actionListproducts()
	{
		if (isset($_GET['id']) && $_GET['id'] != '' && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {

			// id категории
			$id = $_GET['id'];

			$categories = Categories::find()->where(['id' => $id])->asArray()->one();

			if (count($categories) > 0) {

				// сохраняем в переменной объект для формы сортировки товаров на странице
				$model = new SortForm();

				$count_products = count(Products::find()
					->where(['category_id' => $id])
					->asArray()
					->all());

				$page = 1; // номер страницы (по умолчанию)
				$str = null; // сортировка (по умолчанию)

				$number = 3; // количество товаров на странице (по умолчанию)

				if (isset($_GET['page']) && $_GET['page'] != '' && filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
					$page = $_GET['page'];
				}


				// ОБРАБОТЧИК ДЛЯ СОРТИРОВКИ

				if ($model->load(Yii::$app->request->post()) && $model->validate()) {

					// echo "<pre>";
					// print_r($model);
					// echo "</pre>";

					if (isset($model->number) && !empty($model->number)) {
						$number = $model->number;
					}

					if (isset($model->str)) {

						switch ($model->str) {
							case 0:
								// $products_array = Products::find()
								//     ->where(['category_id' => $_GET['id']])
								//     ->asArray()
								//     ->orderBy(['price'=>SORT_ASC])
								//     ->limit($number)
								//     ->all();
								$products_array = $this->selectListProd($id, ['price' => SORT_ASC], $number, $page);
								break;
							case 1:
								// $products_array = Products::find()
								//     ->where(['category_id' => $_GET['id']])
								//     ->asArray()
								//     ->orderBy(['price'=>SORT_DESC])
								//     ->limit($number)
								//     ->all();
								$products_array = $this->selectListProd($id, ['price' => SORT_DESC], $number, $page);
								break;
							case 2:
								$products_array = $this->selectListProd($id, ['name' => SORT_ASC], $number, $page);
								break;
							case 3:
								$products_array = $this->selectListProd($id, ['name' => SORT_DESC], $number, $page);
								break;
							default:
								$products_array = $this->selectListProd($id, ['id' => SORT_ASC], $number, $page);
								break;
						}
					} else {
						$products_array = $this->selectListProd($id, ['id' => SORT_ASC], $number, $page);
					}
				} else {
					$products_array = $this->selectListProd($id, ['id' => SORT_ASC], $number, $page);
				}

				// количество страниц для пагинации
				$count_pages = ceil($count_products / $number);


				// Реализация переключения вида отображения товаров категории (сетка или список)
				if (isset($_GET['view']) && $_GET['view'] == 1) {
					$view = 1;
				} else
					$view = 0;


				return $this->render('listproducts', compact('id', 'count_pages', 'model', 'categories', 'products_array', 'count_products', 'view'));
			}
		}
		return $this->redirect(['page/catalog']);
	}

	private function selectListProd($id, $field_sort, $limit, $start)
	{
		if ($start == 1) {
			$start = 0;
		} else {
			$start = ($start - 1) * $limit;
		}
		return  Products::find()
			->where(['category_id' => $id])
			->asArray()
			->orderBy($field_sort)
			->limit($limit)
			->offset($start)
			->all();
	}

	/**
	 * Для страницы каталога
	 *
	 * @return string
	 */
	public function actionCatalog()
	{
		$categories = Categories::find()->asArray()->all();

		return $this->render('catalog', compact('categories'));
	}


	/**
	 * Для страницы новости
	 *
	 * @return string
	 */
	public function actionNews()
	{

		return $this->render('news');
	}

	/**
	 * Для страницы контакты
	 *
	 * @return string
	 */
	public function actionContacts()
	{

		return $this->render('contacts');
	}

	/**
	 * Для страницы логин
	 *
	 * @return string
	 */
	public function actionLogin()
	{

		return $this->render('login');
	}

	/**
	 * Для страницы личный кабинет
	 *
	 * @return string
	 */
	public function actionPersonal()
	{

		return $this->render('personal');
	}


	/**
	 * Для страницы обратная связь
	 *
	 * @return string
	 */
	public function actionFeedback()
	{

		return $this->render('feedback');
	}


	/**
	 * Для страницы доставка
	 * @return string
	 */
	public function actionDelivery()
	{

		return $this->render('delivery');
	}

	/**
	 * Для страницы оплата
	 * @return string
	 */
	public function actionPayment()
	{

		return $this->render('payment');
	}
	/**
	 * Для страницы о компании
	 * @return string
	 */
	public function actionAbout()
	{

		return $this->render('about');
	}
	/**
	 * Для страницы скидки
	 * @return string
	 */
	public function actionDiscount()
	{

		return $this->render('discount');
	}
	/**
	 * Для страницы карты сайта
	 * @return string
	 */
	public function actionMap()
	{

		return $this->render('map');
	}
	/**
	 * Для страницы зарегистрироваться
	 * @return string
	 */
	public function actionSignup()
	{

		return $this->render('signup');
	}
	/**
	 * Для страницы мои заказы
	 * @return string
	 */
	public function actionOrders()
	{

		return $this->render('orders');
	}
	/**
	 * Для страницы список желаний
	 * @return string
	 */
	public function actionWishList()
	{
		return $this->render('wish-list');
	}

	/**
	 * Для страницы продукт
	 * @return string
	 */
	public function actionProduct()
	{
		// подключаем соответствующий шаблон:
		$this->layout = 'product';

		if (isset($_GET['id']) && !empty($_GET['id']) &&  filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
			$id = $_GET['id'];
		} else {
			throw new NotAcceptableHttpException;
		}

		$product_array = Products::find()->where(['id' => $id])->asArray()->one();
		if (!is_array($product_array) || count($product_array) < 0) {
			throw new NotAcceptableHttpException;
		}
		return $this->render('product', compact('id', 'product_array'));
	}

	/**
	 * Для страницы корзина
	 * @return string
	 */
	public function actionCart()
	{
		$session = Yii::$app->session;

		//$session->destroy();

		// затем откроем сессию:
		$session->open();

		// проверим есть ли в соответствующем глобальном массиве нужная нам сессия(здесь- productsSession):
		if ($session->has('productsSession')) {

			// получим из сессии данные (в сессии будут храниться последовательность товаров и их кол-во(массив)):
			$productsSession = $session->get('productsSession');
		} else {

			$productsSession = array();
		}

		// реализуем добавление товаров в корзину:
		if (isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {

			$productsArray = Products::find()->where(['id' => $_GET['id']])->asArray()->one();

			if (is_array($productsArray) && count($productsArray) > 0) {

				$flag = false;

				// организуем проверку есть ли в сессии конкретый товар (если он есть увеличим его кол-во на единицу):
				for ($i = 0; $i < count($productsSession); $i++) {

					if ($productsSession[$i]['id'] == $_GET['id']) {

						$flag = true;

						// проверим допускается ли увеличение конкретного товара в корзине (остатки на складе):
						if ($productsArray['count'] >= $productsSession[$i]['count'] + 1) {

							$productsSession[$i]['count']++;
						}
						break;
					}
				}

				// если флаг в значении не истина (ложь) значит добавления не было
				if (!$flag) {

					array_push($productsSession, ['id' => $_GET['id'], 'count' => 1]);
				}
			}
		}

		// в сессию запишем полученный массив
		$session->set('productsSession', $productsSession);

		// занесём содержимое из сессии в соответствующую переменную:
		$productsSession = $session->get('productsSession');

		// echo "<pre>";
		// print_r($productsSession);
		// echo "</pre>";

		// Выведем записанные в корзину товары в представление

		// инициализируем массив в котором будут храниться идентификаторы(id) товаров в корзине:
		$arrayId = array();


		foreach ($productsSession as $value) {

			array_push($arrayId, $value['id']);
		}

		// на основе полученных данных сделаем выборку всех нужных товаров в корзине:
		$products = Products::find()->where(['id' => $arrayId])->asArray()->all();

		// реализуем подсчёт сколько товаров мы хотим заказать
		foreach ($products as $key => $value) {

			$products[$key]['count_cart'] = $productsSession[$key]['count'];
		}


		return $this->render('cart', compact('products'));
	}

	/** 
	 * Авторизация и регистрация (адрес)
	 */
	public function actionCheckout()
	{
		return $this->render('checkout');
	}
}
