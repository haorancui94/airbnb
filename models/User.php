<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $attribute_map = [
        'user_id' => 'id',
        'email' => 'username',
    ];

	public static function getConn()
	{
		return new OricalDb();
	}

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
    	if (empty($id)){
    		return null;
		}
		$user = self::getConn()->getUserByFile('user_id,email,password', 'user_id', $id);
		if (!empty($user)){
			foreach ($user as $k=>$v){
				if (isset(self::$attribute_map[$k])) {
					$user[self::$attribute_map[$k]] = $v;
					unset($user[$k]);
				}
			}
		}
        return !empty($user) ? new static($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
		if (empty($username)){
			return null;
		}
		$user = self::getConn()->getUserByFile('user_id,email,password', 'email', $username);
		if (!empty($user)){
			foreach ($user as $k=>$v){
				if (isset(self::$attribute_map[$k])){
					$user[self::$attribute_map[$k]] = $v;
					unset($user[$k]);
				}
			}
		}
		return !empty($user) ? new static($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

	public static function save($username, $password)
	{
		$user = [
			'username' => $username,
			'password' => $password,
		];
		$save_result = self::getConn()->saveUser($username, $password);
		return $save_result?new static($user):false;
	}
}
