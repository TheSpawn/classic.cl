<?php

namespace App\Controllers\Api;

use App\Models\ContenidoModel;

class ContenidoApiController extends BaseApiController
{
    public function index(string $sitioSlug)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $contenidos = (new ContenidoModel())->obtenerPorSitio($sitId);

        // Agrupar por sección
        $agrupado = [];
        foreach ($contenidos as $c) {
            $seccion = $c['con_seccion'];
            if (! isset($agrupado[$seccion])) {
                $agrupado[$seccion] = [];
            }
            $valor = $c['con_valor'];
            if ($c['con_tipo'] === 'JSON') {
                $valor = json_decode($c['con_valor'], true) ?? $c['con_valor'];
            }
            $agrupado[$seccion][$c['con_clave']] = $valor;
        }

        return $this->responderJson(['contenido' => $agrupado]);
    }

    public function porSeccion(string $sitioSlug, string $seccion)
    {
        if ($error = $this->verificarAuth()) return $error;

        $sitId = $this->obtenerSitioId($sitioSlug);
        if (! $sitId) return $this->responderSitioNoEncontrado();

        $contenidos = (new ContenidoModel())->obtenerPorSeccion($sitId, $seccion);

        $resultado = [];
        foreach ($contenidos as $c) {
            $valor = $c['con_valor'];
            if ($c['con_tipo'] === 'JSON') {
                $valor = json_decode($c['con_valor'], true) ?? $c['con_valor'];
            }
            $resultado[$c['con_clave']] = $valor;
        }

        return $this->responderJson(['seccion' => $seccion, 'contenido' => $resultado]);
    }
}
