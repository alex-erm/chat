<?php
namespace app\commands;

use app\models\UserTable;
use Yii;
use yii\console\Controller;
use app\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //удаляем старые данные

        //Создаем роли
        $guest  = $auth->createRole('guest');
        $user  = $auth->createRole('user');
        $moder = $auth->createRole('moder');
        $admin  = $auth->createRole('admin');

        //Создаем разрешения
        $adminIndex = $auth->createPermission('/admin/index');

        $userIndex = $auth->createPermission('/user/index');
        $userView = $auth->createPermission('/user/view');
        $userUpdate = $auth->createPermission('/user/update');
        $userDelete = $auth->createPermission('/user/delete');
        $userCreate = $auth->createPermission('/user/create');
        $userPermission = $auth->createPermission('/user/permission');
        $userBlock = $auth->createPermission('/user/block');

        $roomIndex = $auth->createPermission('/room/index');
        $roomView = $auth->createPermission('/room/view');
        $roomUpdate = $auth->createPermission('/room/update');
        $roomDelete = $auth->createPermission('/room/delete');
        $roomCreate = $auth->createPermission('/room/create');

        $error = $auth->createPermission('error');//обработчик ошибок

        //Добавляем разрешения
        $auth->add($adminIndex);

        $auth->add($userIndex);
        $auth->add($userView);
        $auth->add($userUpdate);
        $auth->add($userDelete);
        $auth->add($userCreate);
        $auth->add($userPermission);
        $auth->add($userBlock);

        $auth->add($roomIndex);
        $auth->add($roomView);
        $auth->add($roomUpdate);
        $auth->add($roomDelete);
        $auth->add($roomCreate);

        $auth->add($error);

        //Добавляем обработчик правил UserRoleRule в модели UserTable
        $rule = new UserRoleRule();
        $auth->add($rule);

        //Добавляем правила для ролей
        $guest->ruleName = $rule->name;
        $user->ruleName = $rule->name;
        $moder->ruleName = $rule->name;
        $admin->ruleName = $rule->name;

        //Добавляем роли
        $auth->add($guest);
        $auth->add($user);
        $auth->add($moder);
        $auth->add($admin);

        //Добавляем разрешения для ролей
        //Для гостя
        $auth->addChild($guest, $error);

        //Для юзера
        $auth->addChild($user, $guest);

        //Для модератора
        $auth->addChild($moder, $adminIndex);
        $auth->addChild($moder, $userIndex);
        $auth->addChild($moder, $userView);
        $auth->addChild($moder, $userUpdate);
        $auth->addChild($moder, $userBlock);
        $auth->addChild($moder, $roomIndex);
        $auth->addChild($moder, $roomView);
        $auth->addChild($moder, $roomUpdate);
        $auth->addChild($moder, $roomDelete);
        $auth->addChild($moder, $roomCreate);
        $auth->addChild($moder, $user);

        //Для админа
        $auth->addChild($admin, $userCreate);
        $auth->addChild($admin, $userDelete);
        $auth->addChild($admin, $userPermission);
        $auth->addChild($admin, $moder);

        echo 'DONE!!!';
    }
}