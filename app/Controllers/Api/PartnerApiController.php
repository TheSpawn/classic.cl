<?php

namespace App\Controllers\Api;

use App\Models\PartnerModel;

class PartnerApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $partners = (new PartnerModel())->obtenerPorSitio($sitId);

        $resultado = array_map(fn($p) => [
            'id'     => (int) $p['par_id'],
            'nombre' => $p['par_nombre'],
            'logo'   => $p['par_logo'],
            'url'    => $p['par_url'],
            'orden'  => (int) $p['par_orden'],
        ], $partners);

        return $this->responderJson(['partners' => $resultado]);
    }
}
