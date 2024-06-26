<?php

namespace App\Controllers;

use App\Models\EstudianteModel;
use CodeIgniter\Controller;

class Estudiante extends Controller
{
    public function index()
    {
        // Cargar el modelo de Estudiante
        $estudianteModel = new EstudianteModel();

        // Obtener todos los estudiantes
        $data['students'] = $estudianteModel->findAll();

        // Cargar la vista de reportes de Estudiante
        echo view('estudiante_reportes', $data);
    }
}
