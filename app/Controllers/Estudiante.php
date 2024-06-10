<?php

namespace App\Controllers;

use App\Models\EstudianteModel;

class Estudiante extends BaseController
{
    protected $estudianteModel;
    public function index()
    {
        return view('admin/view_usuarios');
    }

   
    public function principal(){
        return view('admin/view_principal_admin');

    }


}
