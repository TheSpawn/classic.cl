<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsPartner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'par_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'par_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'par_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'par_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'par_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'par_activo' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('par_id', true);
        $this->forge->createTable('cms_partner');
    }

    public function down()
    {
        $this->forge->dropTable('cms_partner');
    }
}
