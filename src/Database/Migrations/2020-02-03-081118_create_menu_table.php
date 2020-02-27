<?php

namespace agungsugiarto\boilerplate\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
{
    public function up()
    {
        // TODO: menu item
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'parent_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'title'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'icon'       => ['type' => 'varchar', 'constraint' => 55, 'null' => true],
            'route'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'sequence'   => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey(['id', 'parent_id']);
        $this->forge->createTable('menu', false, ['ENGINE' => 'InnoDB']);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
