<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoomTable */
/* @var $form ActiveForm */
?>
<div class="main-newroom">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->label('Название комнаты') ?>
        <?= $form->field($model, 'type')->checkbox(['value'=> 'no'], false)->label('Закрытая комната ') ?>

        <div class="form-group">
            <?= Html::submitButton('Создать комнату', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- main-newroom -->
