<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RoomTable */

$this->title = 'Создать новую комнату';
$this->params['breadcrumbs'][] = ['label' => 'Room Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
