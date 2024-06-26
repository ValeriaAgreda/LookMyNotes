<?php

namespace App\Controllers;

use App\Models\MateriaModel;
use App\Models\NotasModel;
use App\Models\EstudianteModel;
use App\Models\RecordatorioModel;
use CodeIgniter\Controller;

class Reportes extends Controller
{
    public function index()
    {
        // Cargar el modelo de Materia y Notas
        $materiaModel = new MateriaModel();
        $notasModel = new NotasModel();

        // Obtener todas las asignaturas y cantidad de notas por materia
        $assignments = $materiaModel->findAll();
        foreach ($assignments as $assignment) {
            $assignment->num_notes = $notasModel->where('idAssignment', $assignment->id)->countAllResults();
        }

        // Cargar el modelo de Estudiante y Recordatorio
        $estudianteModel = new EstudianteModel();
        $recordatorioModel = new RecordatorioModel();

        // Obtener todos los estudiantes y cantidad de recordatorios por estudiante
        $students = $estudianteModel->findAll();
        foreach ($students as $student) {
            $student->num_reminders = $recordatorioModel->where('idStudent', $student->id)->countAllResults();
        }

        // Cargar la vista de reportes con ambos conjuntos de datos
        echo view('reportes', [
            'assignments' => $assignments,
            'students' => $students
        ]);
    }
}
