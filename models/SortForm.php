<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SortForm extends Model
{
    public $str;// сортировка по правилу
    public $number;//по сколько товаров на странице
  
  


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['str', 'number'], 'trim'],
        
        ];
    }

   
}
