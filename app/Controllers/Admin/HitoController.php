<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HitoModel;

class HitoController extends BaseController
{
    protected HitoModel $modelo;

    public function __construct()
    {
        $this->modelo = new HitoModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        return view('admin/hitos/listar', [
            'tituloPagina' => 'Hitos / Timeline',
            'hitos'        => $this->modelo->where('sit_id', $sitId)->orderBy('hit_orden')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/hitos/formulario', [
            'tituloPagina' => 'Nuevo Hito',
            'hito'         => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'hit_anio', 'hit_titulo', 'hit_descripcion',
            'hit_icono', 'hit_orden', 'hit_activo',
        ]);
        $datos['sit_id'] = sitio_activo_id();

        $imagen = cms_subir_archivo('hit_imagen', 'hitos');
        if ($imagen) {
            $datos['hit_imagen'] = $imagen;
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/hitos')->with('exito', 'Hito creado correctamente.');
    }

    public function editar(int $id)
    {
        $hito = $this->modelo->find($id);
        if (! $hito) {
            return redirect()->to('/hitos')->with('error', 'Hito no encontrado.');
        }

        return view('admin/hitos/formulario', [
            'tituloPagina' => 'Editar Hito',
            'hito'         => $hito,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'hit_anio', 'hit_titulo', 'hit_descripcion',
            'hit_icono', 'hit_orden', 'hit_activo',
        ]);

        $actual = $this->modelo->find($id);
        $imagen = cms_subir_archivo('hit_imagen', 'hitos', $actual['hit_imagen'] ?? null);
        if ($imagen) {
            $datos['hit_imagen'] = $imagen;
        }

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/hitos')->with('exito', 'Hito actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/hitos')->with('exito', 'Hito eliminado correctamente.');
    }
}
