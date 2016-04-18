<?php

use yii\db\Migration;

class m160331_084216_create_User extends Migration
{
    public function up()
    {
        $this->createTable('userTable', [
            'id' => $this->primaryKey()->notNull(),
            'username' =>$this->string(50)->notNull(),
            'email' => $this->string(100)->notNull(),
            'password' => $this->string(100)->notNull(),
            'authKey' => $this->string(100),
            'accessToken' => $this->string(100),
            'role' => "ENUM('guest', 'user', 'moder', 'admin') NOT NULL DEFAULT 'user'",
            'block' => "ENUM('yes', 'no') NOT NULL DEFAULT 'no'",
            'created_at'=>$this->timestamp(),
            'updated_at'=>$this->timestamp(),
        ]);
    }

    public function down()
    {
        $this->dropTable('userTable');
    }
}
