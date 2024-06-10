<?php

namespace App\Controllers;

use App\Models\ArchivoModel;
use App\Models\MateriaModel;

class Archivo extends BaseController
{
    public function index(): string
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

    }
}
}
