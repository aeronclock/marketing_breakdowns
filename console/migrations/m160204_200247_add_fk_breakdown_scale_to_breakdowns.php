<?php

use yii\db\Schema;
use yii\db\Migration;

class m160204_200247_add_fk_breakdown_scale_to_breakdowns extends Migration
{
    public function up()
    {
        $this->addForeignKey('scales_breakdown_color','breakdown_scales', 'breakdown_color_id', 'breakdown_colors', 'id', $delete = 'CASCADE', $update = 'CASCADE');
        $this->addForeignKey('scales_breakdown','breakdown_scales', 'breakdown_id', 'breakdowns', 'id', $delete = 'CASCADE', $update = 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('scales_breakdown_color', 'breakdown_scales');
        $this->dropForeignKey('scales_breakdown', 'breakdown_scales');
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
