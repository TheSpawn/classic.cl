<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SitioModel;

class SitioController extends BaseController
{
    protected SitioModel $modelo;

    public function __construct()
    {
        $this->modelo = new SitioModel();
        helper('cms');
    }

    public function index()
    {
        return view('admin/sitios/listar', [
            'tituloPagina' => 'Sitios',
            'sitios'       => $this->modelo->orderBy('sit_nombre')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/sitios/formulario', [
            'tituloPagina' => 'Nuevo Sitio',
            'sitio'        => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'sit_nombre', 'sit_slug', 'sit_dominio', 'sit_email', 'sit_color_primario', 'sit_activo',
        ]);

        $logo = cms_subir_archivo_global('sit_logo', 'sitios');
        if ($logo) {
            $datos['sit_logo'] = $logo;
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/sitios')->with('exito', 'Sitio creado correctamente.');
    }

    public function editar(int $id)
    {
        $sitio = $this->modelo->find($id);
        if (! $sitio) {
            return redirect()->to('/sitios')->with('error', 'Sitio no encontrado.');
        }

        return view('admin/sitios/formulario', [
            'tituloPagina' => 'Editar Sitio',
            'sitio'        => $sitio,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'sit_nombre', 'sit_slug', 'sit_dominio', 'sit_email', 'sit_color_primario', 'sit_activo',
        ]);
        $datos['sit_id'] = $id;

        $actual = $this->modelo->find($id);
        $logo = cms_subir_archivo_global('sit_logo', 'sitios', $actual['sit_logo'] ?? null);
        if ($logo) {
            $datos['sit_logo'] = $logo;
        }

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        $sitioActivo = session()->get('sitio_activo');
        if ($sitioActivo && (int) $sitioActivo['sit_id'] === $id) {
            session()->set('sitio_activo', $this->modelo->find($id));
        }

        return redirect()->to('/sitios')->with('exito', 'Sitio actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/sitios')->with('exito', 'Sitio eliminado correctamente.');
    }
}
