<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContenidoModel;

class ContenidoController extends BaseController
{
    protected ContenidoModel $modelo;

    public function __construct()
    {
        $this->modelo = new ContenidoModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        return view('admin/contenido/listar', [
            'tituloPagina' => 'Contenido',
            'contenidos'   => $this->modelo->where('sit_id', $sitId)->orderBy('con_seccion')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/contenido/formulario', [
            'tituloPagina' => 'Nuevo Contenido',
            'contenido'    => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'con_seccion', 'con_clave', 'con_valor', 'con_tipo',
        ]);
        $datos['sit_id'] = sitio_activo_id();

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/contenido')->with('exito', 'Contenido creado correctamente.');
    }

    public function editar(int $id)
    {
        $contenido = $this->modelo->find($id);
        if (! $contenido) {
            return redirect()->to('/contenido')->with('error', 'Contenido no encontrado.');
        }

        return view('admin/contenido/formulario', [
            'tituloPagina' => 'Editar Contenido',
            'contenido'    => $contenido,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'con_seccion', 'con_clave', 'con_valor', 'con_tipo',
        ]);

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/contenido')->with('exito', 'Contenido actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id, true);
        return redirect()->to('/contenido')->with('exito', 'Contenido eliminado correctamente.');
    }
}
