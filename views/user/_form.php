<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-table-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if (!$role && !$block){
        echo $form->field($model, 'username')->textInput(['maxlength' => true])->label('Имя: ');
        echo $form->field($model, 'email')->textInput(['maxlength' => true])->label('E-mail: ');
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Пароль: ');
    }
    ?>
<!--    --><?//= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Имя: ') ?>

<!--    --><?//= $form->field($model, 'email')->textInput(['maxlength' => true])->label('E-mail: ') ?>

<!--    --><?//= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Пароль: ') ?>

<!--    --><?//= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>
    <?php
        if ($role){
            echo $form->field($model, 'role')->dropDownList([ 'guest' => 'Гость', 'user' => 'Пользователь', 'moder' => 'Модератор', 'admin' => 'Администратор', ], ['prompt' => ''])->label('Роль');
        }
    ?>
<!--    --><?//= $form->field($model, 'role')->dropDownList([ 'guest' => 'Guest', 'user' => 'User', 'moder' => 'Moder', 'admin' => 'Admin', ], ['prompt' => '']) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>
    <?php
        if ($block){
            echo $form->field($model, 'block')->dropDownList([ 'yes' => 'Да', 'no' => 'Нет', ], ['prompt' => ''])->label('Блокировать пользователя');
        }
    ?>
<!--    --><?//= $form->field($model, 'block')->dropDownList([ 'yes' => 'Да', 'no' => 'Нет', ], ['prompt' => ''])->label('Блокировать пользователя') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
