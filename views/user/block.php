<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserTable */

$this->title = 'Блокировать пользователя с ID: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Block';
?>
<div class="user-table-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'block' =>true,
    ]) ?>

</div>
