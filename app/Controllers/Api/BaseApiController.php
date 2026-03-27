<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SitioModel;

class BaseApiController extends BaseController
{
    /**
     * Verifica Bearer token contra API_SECRET_KEY del .env.
     */
    protected function autenticar(): bool
    {
        $claveEsperada = env('API_SECRET_KEY', '');

        if ($claveEsperada === '' || $claveEsperada === 'cambiar_por_clave_generada') {
            return false;
        }

        $authHeader = $this->request->getHeaderLine('Authorization');

        if (! preg_match('/^Bearer\s+(.+)$/i', $authHeader, $m)) {
            return false;
        }

        return hash_equals($claveEsperada, $m[1]);
    }

    /**
     * Responde 401 si no está autenticado.
     */
    protected function verificarAuth()
    {
        if (! $this->autenticar()) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['error' => 'No autorizado']);
        }

        return null;
    }

    /**
     * Obtiene sit_id a partir del slug del sitio. Retorna null si no existe.
     */
    protected function obtenerSitioId(string $slug): ?int
    {
        $sitio = (new SitioModel())
            ->where('sit_slug', $slug)
            ->where('sit_activo', 1)
            ->first();

        return $sitio ? (int) $sitio['sit_id'] : null;
    }

    /**
     * Responde 404 si el sitio no existe.
     */
    protected function responderSitioNoEncontrado()
    {
        return $this->response
            ->setStatusCode(404)
            ->setJSON(['error' => 'Sitio no encontrado']);
    }

    /**
     * Respuesta JSON exitosa.
     */
    protected function responderJson(array $datos, int $codigo = 200)
    {
        return $this->response
            ->setStatusCode($codigo)
            ->setJSON($datos);
    }
}
