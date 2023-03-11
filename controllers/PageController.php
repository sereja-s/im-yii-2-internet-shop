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
 * контроллер для страницы сайта
 */
class PageController extends Controller
{
  

   
    /**
     * Для страницы список
     *
     * @return string
     */
    public function actionListproducts()
    {
        if (isset($_GET['id']) && $_GET['id'] != '' && filter_var($_GET['id'],FILTER_VALIDATE_INT))
        {
            // id категория
            $id = $_GET['id'];
            $categories = Categories::find()->where(['id' => $id])->asArray()->one();

            if($categories != Null)
            {
                $model = new SortForm();

                $count_products = count( Products::find()
                    ->where(['category_id' => $id])
                    ->asArray()
                    ->all());

                $page = 1; //номер страницы
                $str = null; //сортировка
                $number = 12; //количество товаров на странице

                if (isset($_GET['page']) && $_GET['page'] != '' && filter_var($_GET['page'],FILTER_VALIDATE_INT)){
                    $page = $_GET['page'];
                }
                
                //ОБРАБОТЧИК ДЛЯ СОРТИРОВКИ
                if($model->load(Yii::$app->request->post()) && $model->validate())
                {
                

                  if (isset($model->str)){

                    switch($model->str){
                        case 0:
                            // $products_array = Products::find()
                            //     ->where(['category_id' => $_GET['id']])
                            //     ->asArray()
                            //     ->orderBy(['price'=>SORT_ASC])
                            //     ->limit($number)
                            //     ->all();
                            $products_array = $this->selectListProd($id,['price'=>SORT_ASC],$number,$page);
                        break;
                        case 1:
                            // $products_array = Products::find()
                            //     ->where(['category_id' => $_GET['id']])
                            //     ->asArray()
                            //     ->orderBy(['price'=>SORT_DESC])
                            //     ->limit($number)
                            //     ->all();
                                $products_array = $this->selectListProd($id,['price'=>SORT_DESC],$number,$page);
                        break;
                        case 2:
                            $products_array = $this->selectListProd($id,['name'=>SORT_ASC],$number,$page);
                        break;
                        case 3:
                            $products_array = $this->selectListProd($id,['name'=>SORT_DESC],$number,$page);
                        break;
                        default:
                        $products_array = $this->selectListProd($id,['id'=>SORT_ASC],$number,$page);
                        break;
                    }
                  }else{
                    $products_array = $this->selectListProd($id,['id'=>SORT_ASC],$number,$page);
                  }
                    
                }else {
                    $products_array = $this->selectListProd($id,['id'=>SORT_ASC],$number,$page);
                   
                }
                //количество страниц для пагинации
                $count_pages = ceil($count_products / $number);

                if(isset($_GET['view']) && $_GET['view'] == 1){
                    $view = 1;
                }else 
                    $view = 0;
                

                return $this->render('listproducts',compact('id','count_pages','model','categories','products_array','count_products','view'));
            }
               
        }
        return $this->redirect(['page/catalog']);
    }

    private function selectListProd($id, $field_sort, $limit,$start){
        if ($start == 1){
            $start = 0;
        }else {
            $start = ($start + 1) * $limit;
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
        
        return $this->render('catalog',compact('categories'));
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
        $this->layout = 'product';

        if(isset($_GET['id']) && !empty($_GET['id']) &&  filter_var($_GET['id'],FILTER_VALIDATE_INT)){
            $id = $_GET['id'];
        }else {
            throw new NotAcceptableHttpException;
        }

        $product_array = Products::find()->where(['id'=> $id])->asArray()->one();
        if(!is_array($product_array) || count($product_array)<0 ){
            throw new NotAcceptableHttpException;
        }
        return $this->render('product',compact('id','product_array'));
    }

    /**
     * Для страницы корзина
     * @return string
     */
    public function actionCart()
    {
        
        return $this->render('cart');
    }
}
