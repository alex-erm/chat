<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\MessageTable;
use app\models\RoomTable;
use app\models\UserTable;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class MainController extends \yii\web\Controller
{
    public $layout = 'layout';
    public $message = 'У вас недостаточно прав для входа в данную категорию';
    public $name = 'Доступ закрыт';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $modelRoom = RoomTable::find()->orderBy('id')->all();
        $modelArhiv = MessageTable::find()->where(['room_id'=> 1])->orderBy('create_at')->all();

        $modelMessage = new MessageTable();

        $id = \Yii::$app->user->id;
        $modelUser = UserTable::find()->where(['id'=>$id])->one();

        return $this->render('index',[
            'modelRoom' => $modelRoom,
            'modelMessage' => $modelMessage,
            'modelUser' => $modelUser,
            'modelArhiv' => $modelArhiv,
        ]);
    }

    public function actionMessage()
    {
        $modelMessage = new MessageTable();

        $modelMessage->load(\Yii::$app->request->post());

        if (\Yii::$app->user->isGuest){
            $modelMessage->user_id = 2;
        }
        else{
            $id = \Yii::$app->user->id;
            $modelUser = UserTable::find()->where(['id'=>$id])->one();
            $modelMessage->user_id = $id;
            $modelMessage->user_name = $modelUser->username;
        }
        $id = \Yii::$app->user->id;
        $modelUser = UserTable::find()->where(['id'=>$id])->one();

        if ($modelMessage->validate() && $modelUser->block==='no'){
            $modelMessage->save();
        }
    }

    public function actionRoom($id=1){
        $modelRoom = RoomTable::find()->where(['id' =>  $id])->one();
        $modelArhiv = MessageTable::find()->where(['room_id'=> $id])->orderBy('create_at')->asArray()->all();
        return $this->renderAjax('room', ['modelRoom' => $modelRoom, 'modelArhiv' => $modelArhiv]);
    }

    public function actionGet($room=1, $time ='2016-04-05 12:21:59' )
    {
        $sql = "SELECT * FROM  `messageTable` WHERE  `room_id` ={$room} AND  `create_at` >  '{$time}' LIMIT 0 , 50";
        $modelArhiv = MessageTable::findBySql($sql)->all();
        //$modelArhiv = MessageTable::find()->where(['room_id'=> $room, 'create_at'=> $time])->orderBy('create_at')->all();
        return $this->renderAjax('get',['modelArhiv'=>$modelArhiv]);
    }

    public function actionRegistr()
    {
        $model = new UserTable();
        $model->load(\Yii::$app->request->post());
        if ($model->validate()){
           //если валидация успешно прошла
            $hash = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->password = $hash;
            $model->save();
            return $this->actionLogin();
        }
        else{
            $error = $model->errors;
        }
        return $this->render('registr', ['model' => $model]);
    }

    public function actionNewroom()
    {
        $model = new RoomTable();
        $model->load(\Yii::$app->request->post());
        $model->user_id = \Yii::$app->user->id;
        if($model->type !== 'no'){
            $model->type = 'yes';
        }
        if ($model->validate()){
            $model->save();
            return $this->goHome();
        }
        return $this->render('newroom', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->load(\Yii::$app->request->post());

        if ($model->validate() && $model->login()) {
            $id = \Yii::$app->user->id;
            $modelUser = UserTable::find()->where(['id'=>$id])->one();
            if ($modelUser->role === 'admin' || $modelUser->role === 'moder'){
                return $this->redirect('/admin');
            }
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }
}
