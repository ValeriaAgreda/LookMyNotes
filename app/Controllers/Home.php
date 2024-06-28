<?php

namespace App\Controllers;

use App\Models\EstudianteModel;

class Home extends BaseController
{
    protected $estudianteModel;

    public function __construct()
    {
        $this->estudianteModel = new EstudianteModel();
    }

    public function index(): string
    {
        return view('view_login');
    }

    public function indexReportes(): string
    {
        return view('view_reportes');
    }

    public function informacion(): string
    {
        // Verificar si el usuario está autenticado


        return view('view_student');
    }

    public function menu(): string
    {


        $rol = session()->get('role');
        
        if ($rol === 'Administrador') {
            return view('admin/view_menu_admin');
        } else {
            return view('view_menu');
        }
    }

    public function validar()
    {
        $usuarioEnviado = $this->request->getPost("usuario");
        $passwEnviado = $this->request->getPost("password");

        // Obtener el usuario desde la base de datos
        $usuarioBD = $this->estudianteModel->getUsuario($usuarioEnviado);

        if ($usuarioBD) {
            $passwBD = $usuarioBD->password;
            if ($passwBD == $passwEnviado) {
                // Variables de sesión
                $datos = [
                    'name' => $usuarioBD->name,
                    'lastName' => $usuarioBD->lastName,
                    'user' => $usuarioBD->user,
                    'idCareer' => $usuarioBD->idCareer,
                    'id' => $usuarioBD->id,
                    'role' => $usuarioBD->role  
                ];

                session()->set($datos);

                // Redirigir al menú correspondiente
                return redirect()->to('/menu');
            } else {
                $respuesta = [
                    'tipo' => 'danger',
                    'mensaje' => 'Password incorrecto'
                ];
                return view('view_login', $respuesta);
            }
        } else {
            $respuesta = [
                'tipo' => 'danger',
                'mensaje' => 'Usuario no existe'
            ];
            return view('view_login', $respuesta);
        }
    }
}
