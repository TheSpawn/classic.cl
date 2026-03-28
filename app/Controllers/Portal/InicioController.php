<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use App\Models\SitioModel;
use App\Models\EventoModel;

class InicioController extends BaseController
{
    public function index()
    {
        $sitios = (new SitioModel())->obtenerActivos();
        $eventos = $this->obtenerEventosPortal($sitios);

        return view('portal/inicio', [
            'sitios'  => $sitios,
            'eventos' => $eventos,
        ]);
    }

    public function v2()
    {
        $sitios = (new SitioModel())->obtenerActivos();

        return view('portal/inicio_v2', [
            'sitios' => $sitios,
        ]);
    }

    /**
     * Obtiene los próximos eventos de todos los sitios activos,
     * incluyendo datos del sitio al que pertenecen.
     */
    private function obtenerEventosPortal(array $sitios): array
    {
        $sitiosIndex = [];
        foreach ($sitios as $s) {
            $sitiosIndex[$s['sit_id']] = $s;
        }

        $eventos = (new EventoModel())
            ->where('eve_activo', 1)
            ->whereIn('sit_id', array_keys($sitiosIndex))
            ->orderBy('eve_fecha', 'ASC')
            ->findAll(6);

        foreach ($eventos as &$evento) {
            $evento['_sitio'] = $sitiosIndex[$evento['sit_id']] ?? null;
        }

        return $eventos;
    }
}
