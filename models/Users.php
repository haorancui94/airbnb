<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "USERS".
 *
 * @property int $USER_ID
 * @property string $FIRST_NAME
 * @property string $LAST_NAME
 * @property int $PHONE
 * @property string $GENDER
 * @property string $EMAIL
 * @property string $BIRTH_DATE
 * @property string $PASSWORD
 * @property string $USER_PICTURE
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USERS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID'], 'required'],
            [['USER_ID', 'PHONE'], 'integer'],
            [['FIRST_NAME', 'LAST_NAME', 'EMAIL'], 'string', 'max' => 50],
            [['GENDER'], 'string', 'max' => 10],
            [['BIRTH_DATE'], 'string', 'max' => 7],
            [['PASSWORD'], 'string', 'max' => 20],
            [['USER_PICTURE'], 'string', 'max' => 200],
            [['USER_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USER_ID' => 'User  ID',
            'FIRST_NAME' => 'First  Name',
            'LAST_NAME' => 'Last  Name',
            'PHONE' => 'Phone',
            'GENDER' => 'Gender',
            'EMAIL' => 'Email',
            'BIRTH_DATE' => 'Birth  Date',
            'PASSWORD' => 'Password',
            'USER_PICTURE' => 'User  Picture',
        ];
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
