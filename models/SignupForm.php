<?php
namespace app\models;

use yii\base\Model;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $save_result = User::save($this->username, $this->password);
        return $save_result;
    }
}
