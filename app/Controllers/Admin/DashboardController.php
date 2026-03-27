<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        helper('cms');
        $sitioActivo = session()->get('sitio_activo');
        $datos = ['tituloPagina' => 'Dashboard'];

        if ($sitioActivo) {
            $db = \Config\Database::connect();
            $sitId = (int) $sitioActivo['sit_id'];

            $datos['contadores'] = [
                'eventos'    => $db->table('cms_evento')->where('sit_id', $sitId)->where('deleted_at', null)->countAllResults(),
                'galerias'   => $db->table('cms_galeria')->where('sit_id', $sitId)->where('deleted_at', null)->countAllResults(),
                'alianzas'   => $db->table('cms_alianza')->where('sit_id', $sitId)->where('deleted_at', null)->countAllResults(),
                'documentos' => $db->table('cms_documento')->where('sit_id', $sitId)->where('deleted_at', null)->countAllResults(),
                'partners'   => $db->table('cms_partner_sitio')->where('sit_id', $sitId)->countAllResults(),
                'precios'    => $db->table('cms_precio')->where('sit_id', $sitId)->where('deleted_at', null)->countAllResults(),
                'hitos'      => $db->table('cms_hito')->where('sit_id', $sitId)->where('deleted_at', null)->countAllResults(),
            ];
        }

        return view('admin/dashboard', $datos);
    }

    public function cambiarSitio()
    {
        $sitId = (int) $this->request->getPost('sit_id');
        $sitios = session()->get('sitios_usuario') ?? [];

        foreach ($sitios as $sitio) {
            if ((int) $sitio['sit_id'] === $sitId) {
                session()->set('sitio_activo', $sitio);
                break;
            }
        }

        return redirect()->to('/');
    }
}
