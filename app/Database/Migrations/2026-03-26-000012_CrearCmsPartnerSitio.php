<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearCmsPartnerSitio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'par_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'sit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey(['par_id', 'sit_id'], true);
        $this->forge->addForeignKey('par_id', 'cms_partner', 'par_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sit_id', 'cms_sitio', 'sit_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cms_partner_sitio');
    }

    public function down()
    {
        $this->forge->dropTable('cms_partner_sitio');
    }
}
