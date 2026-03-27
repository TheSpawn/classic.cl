<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsDocumento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doc_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'doc_titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'doc_categoria' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'doc_archivo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'doc_descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'doc_orden' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'doc_activo' => [
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
        $this->forge->addKey('doc_id', true);
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_documento');
    }

    public function down()
    {
        $this->forge->dropTable('cms_documento');
    }
}
