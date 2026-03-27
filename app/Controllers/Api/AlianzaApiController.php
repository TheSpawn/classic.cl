<?php

namespace App\Controllers\Api;

use App\Models\AlianzaModel;

class AlianzaApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $alianzas = (new AlianzaModel())->obtenerPorSitio($sitId);

        $resultado = array_map(fn($a) => [
            'id'          => (int) $a['ali_id'],
            'nombre'      => $a['ali_nombre'],
            'descripcion' => $a['ali_descripcion'],
            'logo'        => $a['ali_logo'],
            'ubicacion'   => $a['ali_ubicacion'],
            'fechas'      => $a['ali_fechas'],
            'tipo'          => $a['ali_tipo'],
            'invitaciones'  => $a['ali_invitaciones'],
            'stats'         => json_decode($a['ali_stats'] ?? '[]', true) ?: [],
            'orden'         => (int) $a['ali_orden'],
        ], $alianzas);

        return $this->responderJson(['alianzas' => $resultado]);
    }
}
