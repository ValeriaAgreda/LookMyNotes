<?php

namespace App\Controllers;

use App\Models\MateriaModel;
use CodeIgniter\Controller;

class Materia extends Controller
{
    public function index()
    {
        // Cargar el modelo de Materia
        $materiaModel = new MateriaModel();

        // Obtener todas las asignaturas
        $data['assignments'] = $materiaModel->findAll();

        // Cargar la vista de reportes de Materia
        echo view('materia_reportes', $data);
    }
}
