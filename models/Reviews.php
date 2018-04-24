<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/23
 * Time: 19:58
 */
namespace app\models;
use yii\db\ActiveRecord;
class Reviews extends ActiveRecord{
    public static function tableName()
    {
        return 'REVIEWS';
    }
}