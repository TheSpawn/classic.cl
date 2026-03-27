<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlianzaModel;

class AlianzaController extends BaseController
{
    protected AlianzaModel $modelo;

    public function __construct()
    {
        $this->modelo = new AlianzaModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        return view('admin/alianzas/listar', [
            'tituloPagina' => 'Alianzas',
            'alianzas'     => $this->modelo->where('sit_id', $sitId)->orderBy('ali_tipo')->orderBy('ali_orden')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/alianzas/formulario', [
            'tituloPagina' => 'Nueva Alianza',
            'alianza'      => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'ali_nombre', 'ali_descripcion', 'ali_ubicacion',
            'ali_fechas', 'ali_tipo', 'ali_invitaciones', 'ali_orden', 'ali_activo',
        ]);
        $datos['sit_id'] = sitio_activo_id();
        $datos['ali_stats'] = $this->procesarStats();

        $logo = cms_subir_archivo('ali_logo', 'alianzas');
        if ($logo) {
            $datos['ali_logo'] = $logo;
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/alianzas')->with('exito', 'Alianza creada correctamente.');
    }

    public function editar(int $id)
    {
        $alianza = $this->modelo->find($id);
        if (! $alianza) {
            return redirect()->to('/alianzas')->with('error', 'Alianza no encontrada.');
        }

        return view('admin/alianzas/formulario', [
            'tituloPagina' => 'Editar Alianza',
            'alianza'      => $alianza,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'ali_nombre', 'ali_descripcion', 'ali_ubicacion',
            'ali_fechas', 'ali_tipo', 'ali_invitaciones', 'ali_orden', 'ali_activo',
        ]);

        $datos['ali_stats'] = $this->procesarStats();

        $actual = $this->modelo->find($id);
        $logo = cms_subir_archivo('ali_logo', 'alianzas', $actual['ali_logo'] ?? null);
        if ($logo) {
            $datos['ali_logo'] = $logo;
        }

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/alianzas')->with('exito', 'Alianza actualizada correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/alianzas')->with('exito', 'Alianza eliminada correctamente.');
    }

    private function procesarStats(): string
    {
        $labels = $this->request->getPost('stat_label') ?? [];
        $valores = $this->request->getPost('stat_valor') ?? [];
        $stats = [];
        foreach ($labels as $i => $label) {
            if (trim($label) !== '' && trim($valores[$i] ?? '') !== '') {
                $stats[] = ['label' => $label, 'valor' => $valores[$i]];
            }
        }
        return json_encode($stats, JSON_UNESCAPED_UNICODE);
    }
}
