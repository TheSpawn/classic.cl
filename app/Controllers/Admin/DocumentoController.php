<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentoModel;

class DocumentoController extends BaseController
{
    protected DocumentoModel $modelo;

    public function __construct()
    {
        $this->modelo = new DocumentoModel();
        helper('cms');
    }

    public function index()
    {
        $sitId = sitio_activo_id();
        if (! $sitId) {
            return redirect()->to('/')->with('error', 'Selecciona un sitio primero.');
        }

        $documentos = $this->modelo->where('sit_id', $sitId)->orderBy('doc_categoria')->orderBy('doc_orden')->paginate(20, 'default');

        return view('admin/documentos/listar', [
            'tituloPagina' => 'Documentos',
            'documentos'   => $documentos,
            'pager'        => $this->modelo->pager,
        ]);
    }

    public function crear()
    {
        return view('admin/documentos/formulario', [
            'tituloPagina' => 'Nuevo Documento',
            'documento'    => null,
        ]);
    }

    public function guardar()
    {
        $datos = $this->request->getPost([
            'doc_titulo', 'doc_categoria', 'doc_descripcion', 'doc_orden', 'doc_activo',
        ]);
        $datos['sit_id'] = sitio_activo_id();

        // Upload del archivo
        $archivo = $this->request->getFile('doc_archivo');
        if ($archivo && $archivo->isValid() && ! $archivo->hasMoved()) {
            $sitio = session()->get('sitio_activo');
            $carpeta = 'uploads/' . ($sitio['sit_slug'] ?? 'general') . '/documentos';
            $rutaCompleta = FCPATH . $carpeta;
            if (! is_dir($rutaCompleta)) {
                mkdir($rutaCompleta, 0755, true);
            }
            $nuevoNombre = $archivo->getRandomName();
            $archivo->move($rutaCompleta, $nuevoNombre);
            $datos['doc_archivo'] = $carpeta . '/' . $nuevoNombre;
        } else {
            return redirect()->back()->withInput()->with('error', 'Debes subir un archivo.');
        }

        if (! $this->modelo->insert($datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/documentos')->with('exito', 'Documento creado correctamente.');
    }

    public function editar(int $id)
    {
        $documento = $this->modelo->find($id);
        if (! $documento) {
            return redirect()->to('/documentos')->with('error', 'Documento no encontrado.');
        }

        return view('admin/documentos/formulario', [
            'tituloPagina' => 'Editar Documento',
            'documento'    => $documento,
        ]);
    }

    public function actualizar(int $id)
    {
        $datos = $this->request->getPost([
            'doc_titulo', 'doc_categoria', 'doc_descripcion', 'doc_orden', 'doc_activo',
        ]);

        // Upload nuevo archivo (opcional)
        $archivo = $this->request->getFile('doc_archivo');
        if ($archivo && $archivo->isValid() && ! $archivo->hasMoved()) {
            $sitio = session()->get('sitio_activo');
            $carpeta = 'uploads/' . ($sitio['sit_slug'] ?? 'general') . '/documentos';
            $rutaCompleta = FCPATH . $carpeta;
            if (! is_dir($rutaCompleta)) {
                mkdir($rutaCompleta, 0755, true);
            }
            $nuevoNombre = $archivo->getRandomName();
            $archivo->move($rutaCompleta, $nuevoNombre);
            $datos['doc_archivo'] = $carpeta . '/' . $nuevoNombre;

            // Eliminar archivo anterior
            $docAnterior = $this->modelo->find($id);
            if ($docAnterior && is_file(FCPATH . $docAnterior['doc_archivo'])) {
                unlink(FCPATH . $docAnterior['doc_archivo']);
            }
        }

        if (! $this->modelo->update($id, $datos)) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->modelo->errors()));
        }

        return redirect()->to('/documentos')->with('exito', 'Documento actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->modelo->delete($id);
        return redirect()->to('/documentos')->with('exito', 'Documento eliminado correctamente.');
    }
}
