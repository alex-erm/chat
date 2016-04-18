<?php

namespace app\controllers;

use Yii;
use app\models\RoomTable;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomController implements the CRUD actions for RoomTable model.
 */
class RoomController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'user';

    public $message = 'У вас недостаточно прав для входа в данную категорию';
    public $name = 'Доступ закрыт';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RoomTable models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('/room/index')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => RoomTable::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RoomTable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!\Yii::$app->user->can('/room/view')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RoomTable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('/room/create')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $model = new RoomTable();

        if ($model->load(Yii::$app->request->post())){
            $model->user_id = \Yii::$app->user->id;
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RoomTable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('/room/update')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RoomTable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('/room/delete')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RoomTable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RoomTable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoomTable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
