<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use App\Models\SitioModel;

class InicioController extends BaseController
{
    public function index()
    {
        $sitios = (new SitioModel())->obtenerActivos();

        return view('portal/inicio', [
            'sitios' => $sitios,
        ]);
    }

    public function v2()
    {
        $sitios = (new SitioModel())->obtenerActivos();

        return view('portal/inicio_v2', [
            'sitios' => $sitios,
        ]);
    }
}
