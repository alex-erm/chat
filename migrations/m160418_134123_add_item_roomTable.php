<?php

use yii\db\Migration;

class m160418_134123_add_item_roomTable extends Migration
{
    public function up()
    {
        $this->insert('roomTable',[
            'name' =>'Общая комната',
            'type' => 'yes',
            'user_id' => 1,
        ]);
    }

    public function down()
    {
        $this->delete('roomTable', ['id' => 1]);
        echo "m160418_134123_add_item_roomTable cannot be reverted.\n";

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
