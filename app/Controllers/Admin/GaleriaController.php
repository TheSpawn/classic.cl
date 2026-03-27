<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriaModel;
use App\Models\ImagenModel;

class GaleriaController extends BaseController
{
    protected GaleriaModel $modelo;

    public function __construct()
    {
        $this->modelo = new GaleriaModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        return view('admin/galeria/listar', [
            'tituloPagina' => 'Galerias',
            'galerias'     => $this->modelo->where('sit_id', $sitId)->orderBy('gal_orden')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/galeria/formulario', [
            'tituloPagina' => 'Nueva Galeria',
            'galeria'      => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost(['gal_titulo', 'gal_descripcion', 'gal_orden', 'gal_activo']);
        $datos['sit_id'] = sitio_activo_id();

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/galeria')->with('exito', 'Galeria creada correctamente.');
    }

    public function editar(int $id)
    {
        $galeria = $this->modelo->find($id);
        if (! $galeria) {
            return redirect()->to('/galeria')->with('error', 'Galeria no encontrada.');
        }

        return view('admin/galeria/formulario', [
            'tituloPagina' => 'Editar Galeria',
            'galeria'      => $galeria,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost(['gal_titulo', 'gal_descripcion', 'gal_orden', 'gal_activo']);

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/galeria')->with('exito', 'Galeria actualizada correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/galeria')->with('exito', 'Galeria eliminada correctamente.');
    }

    public function imagenes(int $galeriaId)
    {
        $galeria = $this->modelo->find($galeriaId);
        if (! $galeria) {
            return redirect()->to('/galeria')->with('error', 'Galeria no encontrada.');
        }

        $imagenModel = new ImagenModel();
        $imagenes = $imagenModel->where('gal_id', $galeriaId)->orderBy('ima_orden')->findAll();

        return view('admin/galeria/imagenes', [
            'tituloPagina' => 'Imagenes: ' . $galeria['gal_titulo'],
            'galeria'      => $galeria,
            'imagenes'     => $imagenes,
        ]);
    }

    public function subirImagen(int $galeriaId)
    {
        $archivo = $this->request->getFile('imagen');

        if (! $archivo || ! $archivo->isValid() || $archivo->hasMoved()) {
            return redirect()->back()->with('error', 'Error al subir la imagen.');
        }

        $sitio = session()->get('sitio_activo');
        $carpeta = 'uploads/' . ($sitio['sit_slug'] ?? 'general') . '/galeria';
        $rutaCompleta = FCPATH . $carpeta;

        if (! is_dir($rutaCompleta)) {
            mkdir($rutaCompleta, 0755, true);
        }

        $nuevoNombre = $archivo->getRandomName();
        $archivo->move($rutaCompleta, $nuevoNombre);

        $imagenModel = new ImagenModel();
        $imagenModel->insert([
            'gal_id'      => $galeriaId,
            'ima_archivo' => $carpeta . '/' . $nuevoNombre,
            'ima_titulo'  => $this->request->getPost('ima_titulo') ?? '',
            'ima_alt'     => $this->request->getPost('ima_alt') ?? '',
            'ima_orden'   => (int) $this->request->getPost('ima_orden'),
        ]);

        return redirect()->to("/galeria/{$galeriaId}/imagenes")->with('exito', 'Imagen subida correctamente.');
    }

    public function eliminarImagen(int $imagenId)
    {
        $imagenModel = new ImagenModel();
        $imagen = $imagenModel->find($imagenId);

        if ($imagen) {
            $ruta = FCPATH . $imagen['ima_archivo'];
            if (is_file($ruta)) {
                unlink($ruta);
            }
            $imagenModel->delete($imagenId, true);
            return redirect()->back()->with('exito', 'Imagen eliminada.');
        }

        return redirect()->back()->with('error', 'Imagen no encontrada.');
    }
}
