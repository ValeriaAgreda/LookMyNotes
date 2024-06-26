<?php

namespace App\Controllers;

use App\Models\EstudianteModel;
use CodeIgniter\Controller;

class Estudiante extends Controller
{

    public function __construct()
    {
        $this->estudianteModel = new EstudianteModel();
    }

    public function index()
    {
        // Cargar el modelo de Estudiante
        $estudianteModel = new EstudianteModel();

        // Obtener todos los estudiantes
        $data['students'] = $estudianteModel->findAll();

        // Cargar la vista de reportes de Estudiante
        echo view('estudiante_reportes', $data);
    public function principal()
    {
        return view('admin/view_principal_admin');
    }

    public function reporteEstudiantesPorCarrera()
    {
        $data['estudiantes_por_carrera'] = $this->estudianteModel->getEstudiantesPorCarrera();
        return view('admin/view_reporte_carrera', $data);
    }
}
