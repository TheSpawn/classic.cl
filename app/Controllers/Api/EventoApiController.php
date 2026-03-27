<?php

namespace App\Controllers\Api;

use App\Models\EventoModel;

class EventoApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $modelo  = new EventoModel();
        $eventos = $modelo->obtenerPorSitio($sitId);

        $db = \Config\Database::connect();
        $resultado = array_map(function($e) use ($db) {
            $datos = $this->formatearEvento($e);

            $datos['meta'] = array_map(fn($m) => [
                'icono' => $m['met_icono'],
                'texto' => $m['met_texto'],
            ], $db->table('cms_evento_meta')
                ->where('eve_id', $e['eve_id'])
                ->orderBy('met_orden')
                ->get()->getResultArray());

            $datos['highlights'] = array_map(
                fn($h) => $h['hig_texto'],
                $db->table('cms_evento_highlight')
                    ->where('eve_id', $e['eve_id'])
                    ->orderBy('hig_orden')
                    ->get()->getResultArray()
            );

            return $datos;
        }, $eventos);

        return $this->responderJson(['eventos' => $resultado]);
    }

    public function mostrar(string $sitioSlug, string $eventoSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $modelo = new EventoModel();
        $evento = $modelo->where('sit_id', $sitId)
                         ->where('eve_slug', $eventoSlug)
                         ->where('eve_activo', 1)
                         ->first();

        if (! $evento) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => 'Evento no encontrado']);
        }

        $evento = $modelo->obtenerConRelaciones((int) $evento['eve_id']);
        $datos  = $this->formatearEvento($evento);

        $datos['meta'] = array_map(fn($m) => [
            'icono' => $m['met_icono'],
            'texto' => $m['met_texto'],
        ], $evento['meta'] ?? []);

        $datos['highlights'] = array_map(fn($h) => $h['hig_texto'], $evento['highlights'] ?? []);

        // Incluir precios del evento
        $precioModel = new \App\Models\PrecioModel();
        $precios = $precioModel->obtenerPorEvento((int) $evento['eve_id']);
        $datos['precios'] = array_map(fn($p) => [
            'nombre'          => $p['pre_nombre'],
            'monto'           => (int) $p['pre_monto'],
            'moneda'          => $p['pre_moneda'],
            'fecha_inicio'    => $p['pre_fecha_inicio'],
            'fecha_fin'       => $p['pre_fecha_fin'],
            'caracteristicas' => json_decode($p['pre_caracteristicas'] ?? '[]', true) ?: [],
        ], $precios);

        return $this->responderJson(['evento' => $datos]);
    }

    private function formatearEvento(array $e): array
    {
        return [
            'id'                => (int) $e['eve_id'],
            'titulo'            => $e['eve_titulo'],
            'slug'              => $e['eve_slug'],
            'fecha'             => $e['eve_fecha'],
            'hora'              => $e['eve_hora'],
            'ubicacion'         => $e['eve_ubicacion'],
            'venue'             => $e['eve_venue'],
            'estado'            => $e['eve_estado'],
            'descripcion_corta' => $e['eve_descripcion_corta'],
            'descripcion'       => $e['eve_descripcion'],
            'icono'             => $e['eve_icono'],
            'imagen'            => $e['eve_imagen'],
            'video'             => $e['eve_video'],
            'orden'             => (int) $e['eve_orden'],
        ];
    }
}
