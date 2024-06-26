<?php

namespace App\Controllers;

use App\Models\EstudianteModel;
use App\Models\RecordatorioModel;
use CodeIgniter\Controller;

class ReportesEstudiantes extends Controller
{
    public function index()
    {
        // Cargar el modelo de Estudiante
        $estudianteModel = new EstudianteModel();
        $recordatorioModel = new RecordatorioModel();

        // Obtener todos los estudiantes
        $data['students'] = $estudianteModel->findAll();

        // Obtener cantidad de recordatorios por estudiante
        foreach ($data['students'] as $student) {
            $student->num_reminders = $recordatorioModel->where('idStudent', $student->id)->countAllResults();
        }

        // Cargar la vista de reportes de Estudiantes
        echo view('reportes_estudiantes', $data);
    }
}
