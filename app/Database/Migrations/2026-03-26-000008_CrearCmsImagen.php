<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsImagen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ima_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'gal_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'ima_archivo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'ima_titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'ima_alt' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'ima_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'ima_activo' => [
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
        $this->forge->addKey('ima_id', true);
        $this->forge->addForeignKey('gal_id', 'cms_galeria', 'gal_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cms_imagen');
    }

    public function down()
    {
        $this->forge->dropTable('cms_imagen');
    }
}
