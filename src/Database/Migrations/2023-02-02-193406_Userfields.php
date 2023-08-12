<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Userfields extends Migration {

    public function up() {
        $fields = [
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 256
            ]
        ];
        
        $this->forge->addColumn('users',$fields);
        
    }

    public function down() {
        //
    }

}
