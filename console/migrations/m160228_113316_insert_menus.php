<?php

use yii\db\Schema;
use yii\db\Migration;

class m160228_113316_insert_menus extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
      $table = 'menu';
      $this->insert($table, ["id" => 1, "name" => "Admin", "parent" => null]);
      $this->insert($table, ["id" => 2, "name" => "Menu", "parent" => 1, "route" => "/admin/menu/index"]);
      $this->insert($table, ["id" => 3, "name" => "Role", "parent" => 1, "route" => "/admin/role/index"]);
      $this->insert($table, ["id" => 4, "name" => "Route", "parent" => 1, "route" => "/admin/route/index"]);
      $this->insert($table, ["id" => 5, "name" => "Permission", "parent" => 1, "route" => "/admin/permission/index"]);
      $this->insert($table, ["id" => 6, "name" => "Assignment", "parent" => 1, "route" => "/admin/assignment/index"]);
      $this->insert($table, ["id" => 7, "name" => "Setup", "parent" => null]);
      $this->insert($table, ["id" => 8, "name" => "Gii", "parent" => 7, "route" => "/gii/default/index"]);
      $this->insert($table, ["id" => 9, "name" => "Master", "parent" => null]);
      $this->insert($table, ["id" => 10, "name" => "Customer", "parent" => 9, "route" => "/master/customer/index"]);
      $this->insert($table, ["id" => 11, "name" => "Breakdown", "parent" => null, "route" => "/breakdown/index"]);
    }

    public function safeDown()
    {
      
    }

}
