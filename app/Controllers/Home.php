<?php

namespace App\Controllers;

use App\Models\EstudianteModel;

class Home extends BaseController
{
    protected $estudianteModel;

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
        return view('view_student');

    }

    public function menu(): string
    {
        return view('view_menu');

    }

    public function validar(){

        //instancia de modelo 
        $this -> estudianteModel= new EstudianteModel();
        //obtener los valores de los campos
        $usuarioEnviado = $this->request->getPost("usuario");
        $passwEnviado= $this->request->getPost("password");

        //obtener el resultado desde la base de datos 
        $usuarioBD= $this->estudianteModel->getUsuario($usuarioEnviado); //devolver el registro encontrado

        //revisar si el usuario no es null y si el password coinciden 
        if($usuarioBD){
            $passwBD= $usuarioBD->password;
            if($passwBD == $passwEnviado){
                //variables de sesion
                $datos = [
                    'name'=>$usuarioBD->name,
                    'lastName'=>$usuarioBD->lastName,
                    'id'=>$usuarioBD->id
                ];


                session()->set($datos); //sesion abierta para el sistema 
                return redirect()->to('/menu');
                //return view('view_menu');

                //return redirect()->to(base_url().'menu');
            }else{
                $respuesta = [
                    'tipo'=> 'danger',
                    'mensaje'=>'Password no existe'
                ];
                return view('view_login', $respuesta);
            }
        }else{
            $respuesta = [
                'tipo'=> 'danger',
                'mensaje'=>'Usuario o password no existe'
            ];
            return view('view_login', $respuesta);

        }

    }

}
