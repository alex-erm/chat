<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoomTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-table-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название комнаты:') ?>

    <?= $form->field($model, 'type')->dropDownList([ 'yes' => 'Да', 'no' => 'Нет', ], ['prompt' => ''])->label('Открытая комната') ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput()->label('ID создателя комнаты') ?>

<!--    --><?//= $form->field($model, 'count_user')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
