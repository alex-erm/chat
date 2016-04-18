<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userTable".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MessageTable[] $messageTables
 * @property RoomTable[] $roomTables
 */
class UserTable extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
//    for RBAC
    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';
    const ROLE_MODER = 'moder';
    const ROLE_ADMIN = 'admin';
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'userTable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required', 'message' => 'Заполните имя'],
            [['username'], 'string', 'max' => 50],

            [['email'], 'required', 'message' => 'Заполните E-mail'],
            [['email'], 'string', 'max' => 100],
            [['email'], 'filter', 'filter'=>'trim'],
            [['email'], 'email'],
            [['email'], 'unique', 'message' => 'Пользователь с таким E-mail существует.'],

            [['password'], 'required', 'message' => 'Заполните пароль'],
            [['password'], 'string', 'max' => 100],

            [['created_at', 'updated_at'], 'safe'],

            [['authKey', 'accessToken'], 'string', 'max' => 100],

            [['role','block'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'block' => 'Block',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageTables()
    {
        return $this->hasMany(MessageTable::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomTables()
    {
        return $this->hasMany(RoomTable::className(), ['user_id' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($email1)
    {
        $user = self::find()->where(['email'=> $email1])->one();
        if ($user != null){
            return $user;
        }
        return null;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
