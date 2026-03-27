<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsUsuarioSitio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'usu_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey(['usu_id', 'sit_id'], true);
        $this->forge->addForeignKey('usu_id', 'cms_usuario', 'usu_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cms_usuario_sitio');
    }

    public function down()
    {
        $this->forge->dropTable('cms_usuario_sitio');
    }
}
