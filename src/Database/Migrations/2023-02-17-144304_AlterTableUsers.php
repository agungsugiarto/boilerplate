<?php

namespace agungsugiarto\boilerplate\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableUsers extends Migration
{
    public function up()
    {
        // add new identity info
        $fields = [
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'after' => 'id'],
            'last_name'  => ['type' => 'VARCHAR', 'constraint' => 255, 'after' => 'first_name'],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        // drop new columns
        $this->forge->dropColumn('users', 'first_name');
        $this->forge->dropColumn('users', 'last_name');
    }
}
