<?php

namespace App\Controllers;

use App\Models\EstudianteModel;

class Estudiante extends BaseController
{
    protected $estudianteModel;

    public function __construct()
    {
        $this->estudianteModel = new EstudianteModel();
    }

    public function index()
    {
        return view('admin/view_usuarios');
    }

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
