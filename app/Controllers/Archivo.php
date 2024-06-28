<?php

namespace App\Controllers;

use App\Models\ArchivoModel;
use App\Models\MateriaModel;

class Archivo extends BaseController
{
    public function index(): string
    {
        $materiaId = $this->request->getGet('materia'); // Obtener el ID de la materia del parámetro GET

        $archivoModel = new ArchivoModel();

        if ($materiaId) {
            $archivos = $archivoModel->where('idAssignment', $materiaId)->findAll();
        } else {
            $archivos = $archivoModel->findAll();
        }

        $materiaModel = new MateriaModel();
        $materias = $materiaModel->findAll();

        // Crear un mapeo de IDs de materias a nombres
        $materiasMap = [];
        foreach ($materias as $materia) {
            $materiasMap[$materia->id] = $materia->name;
        }

        // Enviar la materia seleccionada de vuelta a la vista para mantener la selección
        $materiaSeleccionada = $materiaId;

        return view('registros_view', [
            'archivos' => $archivos,
            'materiasMap' => $materiasMap,
            'materiaSeleccionada' => $materiaSeleccionada
        ]);
    }
    


    public function index2(): string
    {
        $materiaModel = new MateriaModel();
        $assignments = $materiaModel->findAll();

        return view('view_apuntes', ['assignments' => $assignments]);
    }

    public function upload()
    {
        helper(['form', 'url']);

        $file = $this->request->getFile('file');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $idAssignment = $this->request->getPost('subject');
        $idStudent = 2; // Valor predeterminado para idStudent

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);

            $data = [
                'title' => $title,
                'description' => $description,
                'idAssignment' => $idAssignment,
                'idStudent' => $idStudent,
                'archive' => WRITEPATH . 'uploads/' . $newName // Ruta completa del archivo
            ];

            $model = new ArchivoModel();
            $model->insert($data);

            return redirect()->to(base_url().'apuntes')->with('message', 'Archivo subido exitosamente');
        } else {
            return redirect()->to(base_url().'apuntes')->with('message', 'Error al subir el archivo');
        }        }
    
    
        public function view($id)
        {
            $archivoModel = new ArchivoModel();
            $archivo = $archivoModel->find($id);
        
            if (!$archivo) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado');
            }
        
            $materiaModel = new MateriaModel();
            $materias = $materiaModel->findAll();
        
            // Crear un mapeo de IDs de materias a nombres
            $materiasMap = [];
            foreach ($materias as $materia) {
                $materiasMap[$materia->id] = $materia->name;
            }
        
            return view('detalle_view', [
                'archivo' => $archivo,
                'materiasMap' => $materiasMap
            ]);
        }
        

    public function edit($id)
    {
        $archivoModel = new ArchivoModel();
        $archivo = $archivoModel->find($id);

        if (!$archivo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado');
        }

        return view('edit_view', ['archivo' => $archivo]);
    }

    public function update($id)
    {
        helper(['form', 'url']);

        $archivoModel = new ArchivoModel();
        $archivo = $archivoModel->find($id);

        if (!$archivo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado');
        }

        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $idAssignment = $this->request->getPost('subject');
        $file = $this->request->getFile('file');

        $data = [
            'title' => $title,
            'description' => $description,
            'idAssignment' => $idAssignment,
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $data['archive'] = WRITEPATH . 'uploads/' . $newName;
        }

        $archivoModel->update($id, $data);

        return redirect()->to(base_url().'apuntes')->with('message', 'Archivo actualizado exitosamente');
    }

    public function delete($id)
    {
        $archivoModel = new ArchivoModel();
        $archivo = $archivoModel->find($id);

        if (!$archivo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado');
        }

        $archivoModel->delete($id);

        return redirect()->to(base_url().'apuntes')->with('message', 'Archivo eliminado exitosamente');
    }
}
