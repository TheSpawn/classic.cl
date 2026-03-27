<?php

namespace App\Controllers\Api;

class CacheApiController extends BaseApiController
{
    /**
     * POST /v1/cache/purgar
     * Endpoint para que los frontends limpien su caché local.
     */
    public function purgar()
    {
        if ($error = $this->verificarAuth()) return $error;

        return $this->responderJson([
            'purged'  => true,
            'message' => 'Los frontends deben limpiar su caché local.',
        ]);
    }
}
