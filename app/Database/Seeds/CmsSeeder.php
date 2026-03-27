<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run()
    {
        // --- Usuario admin ---
        $this->db->table('cms_usuario')->insert([
            'usu_nombre'   => 'Administrador',
            'usu_apellido' => 'Classic',
            'usu_email'    => 'admin@classic.cl',
            'usu_password' => password_hash('Classic2025!', PASSWORD_DEFAULT),
            'usu_rol'      => 'SUPERADMIN',
            'usu_activo'   => 1,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
        $adminId = $this->db->insertID();

        // --- Sitios ---
        $sitios = [
            [
                'sit_nombre'        => 'Cheerleader Classic',
                'sit_slug'          => 'cheerleader',
                'sit_dominio'       => 'cheerleaderclassic.cl',
                'sit_email'         => 'cheer@classic.cl',
                'sit_color_primario' => '#e91e63',
                'sit_activo'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'sit_nombre'        => 'Dance Classic',
                'sit_slug'          => 'dance',
                'sit_dominio'       => 'danceclassic.cl',
                'sit_email'         => 'dance@classic.cl',
                'sit_color_primario' => '#9c27b0',
                'sit_activo'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'sit_nombre'        => 'Gym Classic',
                'sit_slug'          => 'gym',
                'sit_dominio'       => 'gymclassic.cl',
                'sit_email'         => 'gym@classic.cl',
                'sit_color_primario' => '#2196f3',
                'sit_activo'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('cms_sitio')->insertBatch($sitios);

        // Asignar admin a todos los sitios
        $sitioIds = $this->db->table('cms_sitio')->select('sit_id')->get()->getResultArray();
        foreach ($sitioIds as $sitio) {
            $this->db->table('cms_usuario_sitio')->insert([
                'usu_id' => $adminId,
                'sit_id' => $sitio['sit_id'],
            ]);
        }

        echo "Seeder CMS ejecutado: 1 admin + 3 sitios\n";
    }
}
