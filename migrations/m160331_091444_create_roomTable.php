<?php

use yii\db\Migration;

class m160331_091444_create_roomTable extends Migration
{
    public function up()
    {
        $this->createTable('roomTable', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'type' => "ENUM('yes', 'no') NOT NULL DEFAULT 'yes'",
            'user_id' => $this->integer(11)->notNull(),
            'count_user' => $this->integer(5),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'FOREIGN KEY (user_id) REFERENCES userTable(id) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
    }

    public function down()
    {
        $this->dropTable('roomTable');
    }
}
