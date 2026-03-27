<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsGaleria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'gal_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'gal_titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'gal_descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'gal_imagen_portada' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'gal_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'gal_activo' => [
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
        $this->forge->addKey('gal_id', true);
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_galeria');
    }

    public function down()
    {
        $this->forge->dropTable('cms_galeria');
    }
}
