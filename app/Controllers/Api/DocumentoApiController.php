<?php

namespace App\Controllers\Api;

use App\Models\DocumentoModel;

class DocumentoApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $documentos = (new DocumentoModel())->obtenerPorSitio($sitId);

        $resultado = array_map(fn($d) => [
            'id'          => (int) $d['doc_id'],
            'titulo'      => $d['doc_titulo'],
            'categoria'   => $d['doc_categoria'],
            'archivo'     => $d['doc_archivo'],
            'descripcion' => $d['doc_descripcion'],
            'orden'       => (int) $d['doc_orden'],
        ], $documentos);

        return $this->responderJson(['documentos' => $resultado]);
    }
}
