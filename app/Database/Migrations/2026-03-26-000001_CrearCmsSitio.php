<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsSitio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sit_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sit_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'sit_dominio' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sit_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'sit_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'sit_color_primario' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'default'    => '#000000',
            ],
            'sit_activo' => [
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
        $this->forge->addKey('sit_id', true);
        $this->forge->addUniqueKey('sit_slug');
        $this->forge->createTable('cms_sitio');
    }

    public function down()
    {
        $this->forge->dropTable('cms_sitio');
    }
}
