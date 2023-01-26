<?php

namespace julio101290\boilerplate\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Class CreateMenuTable.
 */
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('menu', true);

        // TODO: group menu item
        $this->forge->addField([
            'id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'group_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'menu_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ]);

        $this->forge->addKey(['id', 'group_id', 'menu_id']);
        $this->forge->addForeignKey('menu_id', 'menu', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', false, 'CASCADE');
        $this->forge->createTable('groups_menu', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('groups_menu');
        $this->forge->dropTable('menu');
    }
}
