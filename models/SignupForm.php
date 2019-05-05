<?php
/**
 * @author Andrey Sergeev <nostromo690@gmail.com>
 */

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string Password
     */
    public $password;

    /**
     * @var string Confirm Password
     */
    public $confirmPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'email'],
            ['username', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app', 'This username has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['confirmPassword', 'required'],
            ['confirmPassword', 'string', 'min' => 8],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'confirmPassword' => Yii::t('app', 'Confirm Password'),
        ];        
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();

        $user->username = $this->username;
        $user->setPassword($this->password);

        return $user->save();
    }
}
