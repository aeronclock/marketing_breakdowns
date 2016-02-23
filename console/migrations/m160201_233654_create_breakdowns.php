<?php

use yii\db\Schema;
use yii\db\Migration;

class m160201_233654_create_breakdowns extends Migration
{
    public function up()
    {
        $this->createTable('breakdowns', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'style' => $this->string(),
            'body' => $this->string(),
            'drawsing' => $this->string(),
            'description' => $this->text(),
            'purchase_order_number' => $this->string(),
            'delivery_date' => $this->date(),
            'receive_date_1' => $this->date(),
            'receive_date_2' => $this->date(),
            'created_at' => $this->datetime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->datetime(),
            'updated_by' => $this->integer()
        ]);
        $this->addForeignKey ( 'customer_brekadowns', 'breakdowns', 'customer_id', 'master_customers', 'id', $delete = 'CASCADE', $update = 'CASCADE' );
    }

    public function down()
    {
        $this->dropTable('breakdowns');
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
