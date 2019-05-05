<?php
/**
 * @author Andrey Sergeev <nostromo690@gmail.com>
 */

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Returns the table name for this ActiveRecord model
     * 
     * @return string the table name
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * Declares user-friendly labels (with localization).
     * 
     * @return array attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'Username'),
        ];
    }

    /**
     * Find identity object that matches the given ID
     * 
     * @param string|int $id the ID to be looked for
     * 
     * @return IdentityInterface
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Method not implemented, throws NotSupported exception when calling
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /** 
     * Finds user by username
     *
     * @param string $username Username to looked for
     * 
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Returns ID that uniquely identifies a user identity
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Method not implemented, throws NotSupported exception when calling
     */
    public function getAuthKey()
    {
        throw new NotSupportedException('"getAuthKey" is not implemented.');
    }

    /**
     * Method not implemented, throws NotSupported exception when calling
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('"validateAuthKey" is not implemented.');
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
