<?php

namespace app\controllers;

use Yii;
use app\models\UserTable;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for UserTable model.
 */
class UserController extends Controller
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
     * Lists all UserTable models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('/user/index')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => UserTable::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserTable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!\Yii::$app->user->can('/user/view')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserTable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('/user/create')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $model = new UserTable();
        $model->load(Yii::$app->request->post());
        $hash = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
        $model->password = $hash;
        if ($model->validate()){
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserTable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('/user/update')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $model = $this->findModel($id);

        $password = $model->password;

        if ($model->load(Yii::$app->request->post())){
            if ($model->password !== $password){
                $hash = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $model->password = $hash;
            }
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserTable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('/user/delete')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserTable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }

    public function actionPermission($id)
    {
        if (!\Yii::$app->user->can('/user/permission')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('permission', [
                'model' => $model,
            ]);
        }
    }

    public function actionBlock($id)
    {
        if (!\Yii::$app->user->can('/user/block')) {
            return $this->render('error', ['name' => $this->name, 'message' => $this->message]);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('block', [
                'model' => $model,
            ]);
        }
    }
}
