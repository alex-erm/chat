<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use app\models\UserTable;
class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        //Получаем массив пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', UserTable::findOne($user));
        if ($user) {
            $role = $user->role; //Значение из поля role базы данных
            if ($item->name === 'admin') {
                return $role == UserTable::ROLE_ADMIN;
            } elseif ($item->name === 'moder') {
                //moder является потомком admin, который получает его права
                return $role == UserTable::ROLE_ADMIN || $role == UserTable::ROLE_MODER;
            }
            elseif ($item->name === 'user') {
                return $role == UserTable::ROLE_ADMIN || $role == UserTable::ROLE_MODER
                || $role == UserTable::ROLE_USER;
            }
        }
        return false;
    }
}