<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ProdAsset;
use yii\helpers\Url;

ProdAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
      <div class="container">
        <div class="row header_top">
          <div class="logo col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <a href="/"><img src="images/logo.png"></a>
          </div>
          <div class="btn_top_wrap col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="btn_and_search">
              <div class="btn_top">
                <a href="<?=Url::toRoute('page/feedback');?>"><i class="glyphicon glyphicon-map-marker"></i>Обратная связь</a>
                <a href="<?=Url::toRoute('page/personal');?>"><i class="glyphicon glyphicon-user"></i>Личный кабинет</a>
                <a href="<?=Url::toRoute('page/login');?>"><i class="glyphicon glyphicon-lock"></i>Войти</a>
              </div>
              <div class="search_top">
              	<form>
	                <input placeholder="Поиск" type="text">
	                <button type="submit" name="submit_search">
	                  <i class="glyphicon glyphicon-search"></i>
	                </button>
                </form>
              </div>
            </div>
            <div class="cart_top">
              <a href="#">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span>0</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid menu_top">
        <div class="container">
          <div class="row">
            
              <?php
    
                    NavBar::begin([
                       
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => ' ',
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav '],
                        'items' => [
                          ['label' => 'Главная', 'url' => ['/site/index']],
                          ['label' => 'Каталог', 'url' => ['/page/catalog']],
                          ['label' => 'Новости', 'url' => ['/page/news']],
                          ['label' => 'Контакты', 'url' => ['/page/contacts']],
                           
                        ],
                    ]);
                    NavBar::end();
                    
                    ?>
 
          </div>
        </div>
      </div>
    </header>

    <div class="container">
        <div class="row">
		    <div class="col-lg-12 contant_wrap">
		    	<div class="navigation">
		    		<ul>
		    			<li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
		    			<li><a href="#">Снаряжение</a></li>
		    			<li><span>Рюкзаки</span></li>
		    		</ul>
		    	</div>
		    </div>
    	</div>
    	<div class="row">
      
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 catalog">
  
          <div class="row content">
            <?=$content;?>
                  
          </div>
      </div>

       
    	
    	</div>
    </div>

    <div class="container-fluid write_email_and_sseti">
      <div class="container">
        <div class="row write_email_and_sseti_wrap">
          <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 write_email">
            <p>Рассылка</p>
            <form>
              <button type="submit">
                      <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
              <input type="text" placeholder="Введите E-mail">
            </form>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-5 hidden-xs sseti_wrap">
            <div>
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-vk"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid footer">
      <div class="container">
        <div class="row menu_footer_and_contact">
          <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="footer_menu">
              <h3>Категории</h3>
              <ul>
                <li><a href="#">Одежда</a></li>
                <li><a href="#">Обувь</a></li>
                <li><a href="#">Снаряжение</a></li>
                <li><a href="#">Амуниция</a></li>
                <li><a href="#">Сувениры</a></li>
              </ul>
            </div>
            <div class="footer_menu">
              <h3>Информация</h3>
              <ul>
		    				<li><a href="<?=Url::toRoute('page/delivery');?>">Доставка</a></li>
		    				<li><a href="<?=Url::toRoute('page/payment');?>">Оплата</a></li>
		    				<li><a href="<?=Url::toRoute('page/about');?>">О компании</a></li>
		    				<li><a href="<?=Url::toRoute('page/discount');?>">Скидки</a></li>
		    				<li><a href="<?=Url::toRoute('page/map');?>">Карта сайта</a></li>
		    			</ul>
            </div>
            <div class="footer_menu">
              <h3>Учетная запись</h3>
              <ul>
		    				<li><a href="<?=Url::toRoute('page/login');?>">Войти</a></li>
		    				<li><a href="<?=Url::toRoute('page/signup');?>">Зарегистрироваться</a></li>
		    				<li><a href="<?=Url::toRoute('page/orders');?>">Мои заказы</a></li>
		    				<li><a href="<?=Url::toRoute('page/wish-list');?>">Список желаний</a></li>
		    			</ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 contacts">
            <h3>Контакты</h3>
            <p><i class="glyphicon glyphicon-map-marker"></i>Адрес: ул. Ленина, 9 г. Москва, 603089</p>
            <p><i class="glyphicon glyphicon-phone-alt"></i>Служба поддержки: 8 (800) 000-00-00</p>
            <p><i class="glyphicon glyphicon-envelope"></i>E-mail: info@myshop.ru</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 copy">
            <p>© 2017 не является действующим интернет-магазином</p>
          </div>
        </div>
      </div>
    </div>







    <?php
    /*
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    */
    ?>

    
        <?php
        /* Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
         */
        ?>
      
        <?php
        /* $content
        */
         ?>


<?php $this->endBody() ?>
<script>

  $("a.disabled").on("click",function(e){
    e.preventDefault();
  })
  
var input_text = Number($(".input_text").val());
var count_prod = Number($(".count_prod").text());
    jQuery(".form_count_prod .plus").on("click",function(){
      if(input_text<count_prod){
        input_text = input_text + 1;
      $(".input_text").val(input_text);
      }
      
     
})
    jQuery(".form_count_prod .minus").on("click", function(){
      if(input_text>1){
        input_text = input_text - 1;
      $(".input_text").val(input_text);
      }
      
})

</script>

</body>
</html>
<?php $this->endPage() ?>
