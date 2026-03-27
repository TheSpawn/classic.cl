<?php

namespace App\Controllers\Api;

use App\Models\GaleriaModel;
use App\Models\ImagenModel;

class GaleriaApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $galerias = (new GaleriaModel())->obtenerPorSitio($sitId);

        $resultado = array_map(fn($g) => [
            'id'              => (int) $g['gal_id'],
            'titulo'          => $g['gal_titulo'],
            'descripcion'     => $g['gal_descripcion'],
            'imagen_portada'  => $g['gal_imagen_portada'],
            'orden'           => (int) $g['gal_orden'],
        ], $galerias);

        return $this->responderJson(['galerias' => $resultado]);
    }

    public function mostrar(string $sitioSlug, int $galeriaId)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $galeria = (new GaleriaModel())->where('sit_id', $sitId)->find($galeriaId);
        if (! $galeria) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => 'Galeria no encontrada']);
        }

        $imagenes = (new ImagenModel())->obtenerPorGaleria($galeriaId);

        return $this->responderJson([
            'galeria' => [
                'id'          => (int) $galeria['gal_id'],
                'titulo'      => $galeria['gal_titulo'],
                'descripcion' => $galeria['gal_descripcion'],
            ],
            'imagenes' => array_map(fn($i) => [
                'id'      => (int) $i['ima_id'],
                'archivo' => $i['ima_archivo'],
                'titulo'  => $i['ima_titulo'],
                'alt'     => $i['ima_alt'],
                'orden'   => (int) $i['ima_orden'],
            ], $imagenes),
        ]);
    }
}
