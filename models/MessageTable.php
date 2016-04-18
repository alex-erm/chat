<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messageTable".
 *
 * @property integer $id
 * @property string $message
 * @property integer $user_id
 * @property string $user_name
 * @property integer $room_id
 *
 * @property UserTable $user
 * @property RoomTable $room
 */
class MessageTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messageTable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'required'],//'message' => 'Пустое сообщение нельзя отправить'
            [['message'], 'string'],
            [['user_id', 'room_id'], 'integer'],
            [['user_name'], 'string', 'min' => 3, 'message' =>'Имя гостя должно быть длинее 3-х символов или зарегистрируйтесь'],
            [['user_name'], 'string', 'max' => 50, 'message' =>'Имя гостя должно быть короче 50 символов или зарегистрируйтесь'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserTable::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoomTable::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'room_id' => 'Room ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserTable::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(RoomTable::className(), ['id' => 'room_id']);
    }
}
