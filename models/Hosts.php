<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/23
 * Time: 19:56
 */
namespace app\models;
use yii\db\ActiveRecord;
class Hosts extends ActiveRecord{
    public static function tableName()
    {
        return 'HOSTS';
    }
}