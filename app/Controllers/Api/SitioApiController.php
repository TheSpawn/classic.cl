<?php

namespace App\Controllers\Api;

use App\Models\SitioModel;

class SitioApiController extends BaseApiController
{
    public function index()
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitios = (new SitioModel())->obtenerActivos();

        $resultado = array_map(fn($s) => [
            'id'       => (int) $s['sit_id'],
            'nombre'   => $s['sit_nombre'],
            'slug'     => $s['sit_slug'],
            'dominio'  => $s['sit_dominio'],
            'email'    => $s['sit_email'],
            'logo'     => $s['sit_logo'],
            'color'    => $s['sit_color_primario'],
        ], $sitios);

        return $this->responderJson(['sitios' => $resultado]);
    }

    public function mostrar(string $slug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitio = (new SitioModel())
            ->where('sit_slug', $slug)
            ->where('sit_activo', 1)
            ->first();

        if (! $sitio) {
            return $this->responderSitioNoEncontrado();
        }

        return $this->responderJson([
            'sitio' => [
                'id'       => (int) $sitio['sit_id'],
                'nombre'   => $sitio['sit_nombre'],
                'slug'     => $sitio['sit_slug'],
                'dominio'  => $sitio['sit_dominio'],
                'email'    => $sitio['sit_email'],
                'logo'     => $sitio['sit_logo'],
                'color'    => $sitio['sit_color_primario'],
            ],
        ]);
    }
}
