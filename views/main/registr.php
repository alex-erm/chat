<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserTable */
/* @var $form ActiveForm */
$this->title = 'Форма регистрации в чате';
?>
<main class="col-xs-12 col-sm-6 col-sm-offset-3">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
    ]); ?>

        <?= $form->field($model, 'username')->label('Ваше имя:') ?>
        <?= $form->field($model, 'email')->label('Ваш E-mail:') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Пароль:') ?>

        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</main>
