<?php

namespace App\Controllers;

use App\Models\MateriaModel;
use App\Models\NotasModel;
use CodeIgniter\Controller;

class ReportesMaterias extends Controller
{
    public function index()
    {
        // Cargar el modelo de Materia
        $materiaModel = new MateriaModel();
        $notasModel = new NotasModel();

        // Obtener todas las asignaturas
        $data['assignments'] = $materiaModel->findAll();

        // Obtener cantidad de notas por materia
        foreach ($data['assignments'] as $assignment) {
            $assignment->num_notes = $notasModel->where('idAssignment', $assignment->id)->countAllResults();
        }

        // Cargar la vista de reportes de Materias
        echo view('reportes_materias', $data);
    }
}
