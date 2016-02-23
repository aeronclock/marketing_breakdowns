<?php

use yii\db\Schema;
use yii\db\Migration;

class m160202_212021_breakdown_colors extends Migration
{
    public function up()
    {
      $this->createTable('breakdown_colors', [
        'id' => $this->primaryKey(),
        'breakdown_id' => $this->integer(),
        'color_name' => $this->string(),
        'created_at' => $this->datetime(),
        'created_by' => $this->integer(),
      ]);
    }

    public function down()
    {
      $this->dropTable('breakdown_colors');
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
