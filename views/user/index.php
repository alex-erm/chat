<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-table-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить нового пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'password',
            // 'authKey',
            // 'accessToken',
            'role',
            // 'created_at',
            // 'updated_at',
            'block',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {permission} {block}',
                'buttons'=>[
                    'permission'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['user/permission','id'=>$model['id'],'my'=>$my]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-user"></span>', $customurl,
                            ['title' => Yii::t('yii', 'Смена роли'), 'data-pjax' => '0']);
                    },

                    'block'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['user/block','id'=>$model['id'],'my'=>$my]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-lock"></span>', $customurl,
                            ['title' => Yii::t('yii', 'Блокировать'), 'data-pjax' => '0']);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
