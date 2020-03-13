<?php

namespace agungsugiarto\boilerplate\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
{
    public function up()
    {
        // TODO: menu item
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'parent_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'active'     => ['type' => 'tinyint', 'constraint' => '1', 'default' => 1],
            'title'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'icon'       => ['type' => 'varchar', 'constraint' => 55, 'null' => true],
            'route'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'sequence'   => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey(['id', 'parent_id']);
        $this->forge->addUniqueKey('title');
        $this->forge->addForeignKey('parent_id', 'menu', 'id', false, 'SET NULL');
        $this->forge->createTable('menu', true);

        // TODO: group menu item
        $this->forge->addField([
            'id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'group_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'menu_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
        ]);

        $this->forge->addKey('id', 'group_id', 'menu_id');
        $this->forge->addForeignKey('menu_id', 'menu', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', false, 'CASCADE');
        $this->forge->createTable('groups_menu', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('menu');
        $this->forge->dropTable('groups_menu');
    }
}
