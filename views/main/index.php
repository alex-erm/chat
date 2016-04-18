<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Главная страница тестового чата';
?>
<aside class="col-xs-12 col-sm-3">
    <h2>Комнаты</h2>
    <ul class="list-group">
        <?php
            foreach ($modelRoom as $room){
                if($room['type']==='yes'){
                    echo "<li class=\"list-group-item list-group-item-success\"><a href='/main/chat/{$room['id']}'>{$room['name']}</a></li>";
                }
                else{
                    echo "<li class=\"list-group-item list-group-item-danger\"><a href='/main/chat/{$room['id']}'>{$room['name']}</a></li>";
                }
                if ($room['id']=== 1){
                    $allRoom =$room['name'];
                    $idRoom = $room['id'];
                }
            }
        ?>
    </ul>
</aside>
<main class="col-xs-12 col-sm-9">
    <h1><a href="/main/chat/<?= $idRoom?>"><?=$allRoom ?></a></h1>
    <div class="chat-window">
        <?php
            foreach ($modelArhiv as $message){

                echo "<p>";
                echo '<span class="user-date">' . $message['create_at'] . '</span><br>';
                echo $message['user_id']===2 ? ( '<span class="user">Гость('. $message['user_name'] . '): </span>'):('<span class="user">' . $message['user_name'] . ': </span>');
                echo $message['message'];
                echo "</p>";
            }
        ?>
    </div>
    <div>
        <?php $form = ActiveForm::begin([
            'enableAjaxValidation'=> false,
            'enableClientValidation'=>false,
            'action' => ['main/message'],
        ]);
        ?>
        <?=$form->field($modelMessage, 'room_id')->hiddenInput()->label('');?>
        <?php
            if (Yii::$app->user->isGuest){
                echo $form->field($modelMessage, 'user_name')->label('Ваше имя: ');
                echo $form->field($modelMessage, 'message')->textarea()->label('Сообщение: ');
            }
            else{
                //$id = Yii::$app->user->id;
                //$modelUser = \app\models\UserTable::find()->where(['id'=>$id])->one();
                echo $form->field($modelMessage, 'message')->textarea()->label($modelUser->username . ' введите cообщение: ');
            }
        ?>
        <div class="form-group">
            <?php
                if ($modelUser->block === 'no' || Yii::$app->user->isGuest){
                    echo Html::submitButton('Отправить сообщение', ['class' => 'btn btn-primary']);
                } else {
                    echo 'Извините Вы заблокированы и не можете отправлять сообщения';
                }
            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</main>


