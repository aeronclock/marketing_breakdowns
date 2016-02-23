<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_201303_create_breakdown_details extends Migration
{
    public function up()
    {
        $this->createTable('breakdown_details', [
          'id' => $this->primaryKey(),
          'breakdown_color_id' => $this->integer(),
          'breakdown_id' => $this->integer(),
          'hangtag' => $this->string(),
          'unit_quantity' => $this->float(),
          'code' => $this->string(),
          'quantity' => $this->float(),
          'allowance' => $this->float(),
          'excel_file' => $this->string(),
          'created_at' => $this->datetime(),
          'created_by' => $this->integer(),
        ]);
        $this->addForeignKey ( 'details_color', 'breakdown_details', 'breakdown_color_id', 'breakdown_colors', 'id', $delete = 'CASCADE', $update = 'CASCADE' );
        $this->addForeignKey ( 'details_breakdown', 'breakdown_details', 'breakdown_id', 'breakdowns', 'id', $delete = 'CASCADE', $update = 'CASCADE' );
    }

    public function down()
    {
        $this->dropTable('breakdwon_details');
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
