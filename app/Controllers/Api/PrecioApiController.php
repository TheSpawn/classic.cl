<?php

namespace App\Controllers\Api;

use App\Models\PrecioModel;
use App\Models\EventoModel;

class PrecioApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $modelo = new PrecioModel();

        // Filtrar por evento si se pasa ?evento=slug
        $eventoSlug = $this->request->getGet('evento');
        if ($eventoSlug) {
            $evento = (new EventoModel())
                ->where('sit_id', $sitId)
                ->where('eve_slug', $eventoSlug)
                ->first();

            if (! $evento) {
                return $this->response->setStatusCode(404)
                    ->setJSON(['error' => 'Evento no encontrado']);
            }

            $precios = $modelo->obtenerPorEvento((int) $evento['eve_id']);
        } else {
            $precios = $modelo->obtenerPorSitio($sitId);
        }

        $resultado = array_map(fn($p) => [
            'id'               => (int) $p['pre_id'],
            'eve_id'           => $p['eve_id'] ? (int) $p['eve_id'] : null,
            'nombre'           => $p['pre_nombre'],
            'monto'            => (int) $p['pre_monto'],
            'moneda'           => $p['pre_moneda'],
            'fecha_inicio'     => $p['pre_fecha_inicio'],
            'fecha_fin'        => $p['pre_fecha_fin'],
            'caracteristicas'  => json_decode($p['pre_caracteristicas'] ?? '[]', true) ?: [],
        ], $precios);

        return $this->responderJson(['precios' => $resultado]);
    }
}
