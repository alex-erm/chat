<?php

use yii\db\Migration;

class m160331_093300_create_messageTable extends Migration
{
    public function up()
    {
        $this->createTable('messageTable', [
            'id' => $this->primaryKey(),
            'message' => $this->text()->notNull(),
            'user_id' => $this->integer(11),
            'user_name' => $this->string(50),
            'type' => "ENUM('yes', 'no') NOT NULL DEFAULT 'yes'",
            'room_id' =>$this->integer(11),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'FOREIGN KEY (user_id) REFERENCES userTable(id) ON DELETE SET NULL ON UPDATE CASCADE',
            'FOREIGN KEY (room_id) REFERENCES roomTable(id) ON DELETE CASCADE ON UPDATE CASCADE',
        ]);
    }

    public function down()
    {
        $this->dropTable('messageTable');
    }
}
