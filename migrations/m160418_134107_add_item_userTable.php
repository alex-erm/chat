<?php

use yii\db\Migration;

class m160418_134107_add_item_userTable extends Migration
{
    public function up()
    {
        $this->insert('userTable', [
            'username' => 'admin',
            'email' => 'admin@chat.ru',
            'password' => '$2y$13$tPonK8xY8gDpmHw8brjU3eT3MZlN.jE4AZEiEte9hcXmOiste/qb6',//admin
            'role' => 'admin',
        ]);
        $this->insert('userTable', [
            'username' => 'guest',
            'email' => 'guest@chat.ru',
            'password' => '$2y$13$Un/oaqjaNF585zCHuMI.9uFwJ.qgOhsm6TOkD35iZP4IMTfFSwi6C',//guest
            'role' => 'guest',
        ]);
    }

    public function down()
    {
        $this->delete('userTable', ['id' => 1]);
        $this->delete('userTable', ['id' => 2]);
        echo "m160418_134107_add_item_userTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
