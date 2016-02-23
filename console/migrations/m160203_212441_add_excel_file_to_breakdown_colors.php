<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_212441_add_excel_file_to_breakdown_colors extends Migration
{
    public function up()
    {
        $this->addColumn('breakdown_colors', 'excel_file', Schema::TYPE_STRING); 
    }

    public function down()
    {
        $this->dropColumn('breakdown_colors', 'excel_file');
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
