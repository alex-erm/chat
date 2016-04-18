<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RoomTable */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Room Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-table-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту комнату?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'type',
            'user_id',
            'count_user',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
