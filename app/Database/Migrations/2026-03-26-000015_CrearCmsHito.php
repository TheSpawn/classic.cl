<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsHito extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hit_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'hit_anio' => [
                'type' => 'INT',
            ],
            'hit_titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'hit_descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'hit_imagen' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'hit_icono' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'hit_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'hit_activo' => [
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
        $this->forge->addKey('hit_id', true);
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_hito');
    }

    public function down()
    {
        $this->forge->dropTable('cms_hito');
    }
}
