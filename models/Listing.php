<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/19
 * Time: 23:45
 */
namespace app\models;
use yii\db\ActiveRecord;
class Listing extends ActiveRecord{
    public static function tableName()
    {
        return 'LISTING';
    }
}