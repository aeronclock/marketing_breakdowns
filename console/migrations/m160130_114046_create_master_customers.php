<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_114046_create_master_customers extends Migration
{
    public function up()
    {
      $this->createTable('master_customers', [
          'id' => $this->primaryKey(),
          'name' => $this->string(),
          'contact_person_name' => $this->string(),
          'contact_person_mail' => $this->string(),
          'address' => $this->text(),
          'created_at' => $this->datetime(),
          'updated_at' => $this->datetime()
      ]);
    }

    public function down()
    {
      $this->dropTable('master_customers');
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
