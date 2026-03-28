<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventoModel;
use App\Models\EventoMetaModel;
use App\Models\EventoHighlightModel;

class EventoController extends BaseController
{
    protected EventoModel $modelo;

    public function __construct()
    {
        $this->modelo = new EventoModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        $eventos = $this->modelo->where('sit_id', $sitId)->orderBy('eve_orden')->paginate(20, 'default');
        $pager = $this->modelo->pager;

        return view('admin/eventos/listar', [
            'tituloPagina' => 'Eventos',
            'eventos'      => $eventos,
            'pager'        => $pager,
        ]);
    }

    public function crear()
    {
        return view('admin/eventos/formulario', [
            'tituloPagina' => 'Nuevo Evento',
            'evento'       => null,
            'metas'        => [],
            'highlights'   => [],
        ]);
    }

    public function guardar()
    {
        $sitId = sitio_activo_id();
        $datos = $this->request->getPost([
            'eve_titulo', 'eve_slug', 'eve_fecha', 'eve_fecha_fin', 'eve_hora', 'eve_hora_fin',
            'eve_ubicacion', 'eve_venue', 'eve_estado', 'eve_descripcion_corta',
            'eve_descripcion', 'eve_icono', 'eve_video', 'eve_vende_entradas', 'eve_orden', 'eve_activo',
        ]);
        $datos['sit_id'] = $sitId;

        $imagen = cms_subir_archivo('eve_imagen', 'eventos');
        if ($imagen) {
            $datos['eve_imagen'] = $imagen;
        }

        $video = cms_subir_archivo('eve_video_archivo', 'videos');
        if ($video) {
            $datos['eve_video'] = $video;
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        $eventoId = $this->modelo->getInsertID();
        $this->guardarMetas($eventoId);
        $this->guardarHighlights($eventoId);

        return redirect()->to('/eventos')->with('exito', 'Evento creado correctamente.');
    }

    public function editar(int $id)
    {
        $evento = $this->modelo->find($id);
        if (! $evento) {
            return redirect()->to('/eventos')->with('error', 'Evento no encontrado.');
        }

        $db = \Config\Database::connect();
        $metas = $db->table('cms_evento_meta')->where('eve_id', $id)->orderBy('met_orden')->get()->getResultArray();
        $highlights = $db->table('cms_evento_highlight')->where('eve_id', $id)->orderBy('hig_orden')->get()->getResultArray();

        return view('admin/eventos/formulario', [
            'tituloPagina' => 'Editar Evento',
            'evento'       => $evento,
            'metas'        => $metas,
            'highlights'   => $highlights,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'eve_titulo', 'eve_slug', 'eve_fecha', 'eve_fecha_fin', 'eve_hora', 'eve_hora_fin',
            'eve_ubicacion', 'eve_venue', 'eve_estado', 'eve_descripcion_corta',
            'eve_descripcion', 'eve_icono', 'eve_video', 'eve_vende_entradas', 'eve_orden', 'eve_activo',
        ]);
        $datos['eve_id'] = $id;

        $actual = $this->modelo->find($id);
        $imagen = cms_subir_archivo('eve_imagen', 'eventos', $actual['eve_imagen'] ?? null);
        if ($imagen) {
            $datos['eve_imagen'] = $imagen;
        }

        // Video: priorizar archivo subido sobre URL
        $videoArchivo = cms_subir_archivo('eve_video_archivo', 'videos', null);
        if ($videoArchivo) {
            // Si había un video archivo anterior, eliminarlo
            $videoAnterior = $actual['eve_video'] ?? '';
            if ($videoAnterior && preg_match('/\.(mp4|webm)$/i', $videoAnterior) && is_file(FCPATH . $videoAnterior)) {
                unlink(FCPATH . $videoAnterior);
            }
            $datos['eve_video'] = $videoArchivo;
        }

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        $this->guardarMetas($id);
        $this->guardarHighlights($id);

        return redirect()->to('/eventos')->with('exito', 'Evento actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/eventos')->with('exito', 'Evento eliminado correctamente.');
    }

    private function guardarMetas(int $eventoId): void
    {
        $db = \Config\Database::connect();
        $db->table('cms_evento_meta')->where('eve_id', $eventoId)->delete();

        $iconos = $this->request->getPost('met_icono') ?? [];
        $textos = $this->request->getPost('met_texto') ?? [];

        foreach ($textos as $i => $texto) {
            if (trim($texto) === '') continue;
            $db->table('cms_evento_meta')->insert([
                'eve_id'    => $eventoId,
                'met_icono' => $iconos[$i] ?? '',
                'met_texto' => $texto,
                'met_orden' => $i,
            ]);
        }
    }

    private function guardarHighlights(int $eventoId): void
    {
        $db = \Config\Database::connect();
        $db->table('cms_evento_highlight')->where('eve_id', $eventoId)->delete();

        $textos = $this->request->getPost('hig_texto') ?? [];

        foreach ($textos as $i => $texto) {
            if (trim($texto) === '') continue;
            $db->table('cms_evento_highlight')->insert([
                'eve_id'    => $eventoId,
                'hig_texto' => $texto,
                'hig_orden' => $i,
            ]);
        }
    }
}
