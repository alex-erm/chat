<?php

namespace app\controllers;

use app\models\UserTable;
use app\models\RoomTable;
use app\models\MessageTable;
use yii\data\ActiveDataProvider;
class AdminController extends \yii\web\Controller
{
    public $layout = 'admin';

    public $message = 'У вас недостаточно прав для входа в данную категорию';
    public $name = 'Доступ закрыт';

    public function actionIndex()
    {
        if (!\Yii::$app->user->can('/admin/index')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $modelRoom = RoomTable::find()->orderBy('id')->all();
        $modelArhiv = MessageTable::find()->where(['room_id'=> 1])->orderBy('create_at')->all();

        $modelMessage = new MessageTable();

        $id = \Yii::$app->user->id;
        $modelUser = UserTable::find()->where(['id'=>$id])->one();

        return $this->render('../main/index',[
            'modelRoom' => $modelRoom,
            'modelMessage' => $modelMessage,
            'modelUser' => $modelUser,
            'modelArhiv' => $modelArhiv,
        ]);

        return $this->render('index');

    }
}
