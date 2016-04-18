<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roomTable".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $user_id
 * @property integer $count_user
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MessageTable[] $messageTables
 * @property UserTable $user
 */
class RoomTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roomTable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'],
            [['type'], 'string'],
            [['user_id', 'count_user'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserTable::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'user_id' => 'User ID',
            'count_user' => 'Count User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageTables()
    {
        return $this->hasMany(MessageTable::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserTable::className(), ['id' => 'user_id']);
    }
}
