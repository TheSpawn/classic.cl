<?php

namespace App\Controllers\Api;

use App\Models\HitoModel;

class HitoApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $hitos = (new HitoModel())->obtenerPorSitio($sitId);

        $resultado = array_map(fn($h) => [
            'id'          => (int) $h['hit_id'],
            'anio'        => (int) $h['hit_anio'],
            'titulo'      => $h['hit_titulo'],
            'descripcion' => $h['hit_descripcion'],
            'imagen'      => $h['hit_imagen'],
            'icono'       => $h['hit_icono'],
            'orden'       => (int) $h['hit_orden'],
        ], $hitos);

        return $this->responderJson(['hitos' => $resultado]);
    }
}
