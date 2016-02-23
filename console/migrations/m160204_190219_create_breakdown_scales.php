<?php

use yii\db\Schema;
use yii\db\Migration;

class m160204_190219_create_breakdown_scales extends Migration
{
    public function up()
    {
        $this->createTable('breakdown_scales', [
          'id' => $this->primaryKey(),
          'breakdown_color_id' => $this->integer(),
          'breakdown_id' => $this->integer(),
          'size' => $this->string(),
          'code' => $this->string(),
          'scale' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('breakdwon_scales');
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
