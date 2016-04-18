<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoomTable */

$this->title = 'Изменить комнату: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Room Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="room-table-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
