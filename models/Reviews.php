<?php
<<<<<<< HEAD
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/23
 * Time: 19:58
 */
namespace app\models;
use yii\db\ActiveRecord;
class Reviews extends ActiveRecord{
=======

namespace app\models;

use Yii;

/**
 * This is the model class for table "REVIEWS".
 *
 * @property int $REVIEW_ID
 * @property int $HAS
 * @property int $WRITES
 * @property string $REVIEW_DATE
 * @property string $REVIEW_COMMENT
 *
 * @property USERS $wRITES
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
>>>>>>> 857fc7f2d1842b8cb2bf226508b99847ffd98560
    public static function tableName()
    {
        return 'REVIEWS';
    }
<<<<<<< HEAD
}
=======

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REVIEW_ID'], 'required'],
            [['REVIEW_ID', 'HAS', 'WRITES'], 'integer'],
            [['REVIEW_DATE'], 'string', 'max' => 7],
            [['REVIEW_COMMENT'], 'string', 'max' => 1000],
            [['REVIEW_ID'], 'unique'],
            [['WRITES'], 'exist', 'skipOnError' => true, 'targetClass' => USERS::className(), 'targetAttribute' => ['WRITES' => 'USER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REVIEW_ID' => 'Review  ID',
            'HAS' => 'Has',
            'WRITES' => 'Writes',
            'REVIEW_DATE' => 'Review  Date',
            'REVIEW_COMMENT' => 'Review  Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWRITES()
    {
        return $this->hasOne(USERS::className(), ['USER_ID' => 'WRITES']);
    }

    /**
     * @inheritdoc
     * @return ReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReviewsQuery(get_called_class());
    }
}
>>>>>>> 857fc7f2d1842b8cb2bf226508b99847ffd98560
