<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsContenido extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'con_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'con_seccion' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'con_clave' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'con_valor' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'con_tipo' => [
                'type'       => 'ENUM',
                'constraint' => ['TEXTO', 'HTML', 'JSON'],
                'default'    => 'TEXTO',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('con_id', true);
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('cms_contenido');
    }

    public function down()
    {
        $this->forge->dropTable('cms_contenido');
    }
}
