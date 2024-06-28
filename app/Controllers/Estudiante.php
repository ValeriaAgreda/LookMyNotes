<?php

namespace App\Controllers;

use App\Models\EstudianteModel;
use App\Models\Career;
use CodeIgniter\Controller;

class Estudiante extends Controller
{
    protected $estudianteModel;
    protected $careerModel;

    public function __construct()
    {
        $this->estudianteModel = new EstudianteModel();
        $this->careerModel = new Career();
    }

    // Método para listar todos los estudiantes junto con sus carreras
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Obtener todos los estudiantes y las carreras
        $data['students'] = $this->estudianteModel->getStudentsWithCareerName();
        $data['careers'] = $this->careerModel->findAll();

        // Cargar la vista de reportes de Estudiante
        return view('view_reportes', $data);
    }

    // Método para mostrar la vista principal del administrador
    public function principal()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        return view('admin/view_principal_admin');
    }

    // Método para generar el reporte de estudiantes por carrera
    public function reporteEstudiantesPorCarrera()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data['estudiantes_por_carrera'] = $this->estudianteModel->getEstudiantesPorCarrera();
        return view('admin/view_reporte_carrera', $data);
    }

    // Método para mostrar el formulario de creación de un nuevo estudiante
    public function create()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data['careers'] = $this->careerModel->findAll();
        return view('admin/estudiante_create', $data);
    }

    // Método para almacenar un nuevo estudiante
    public function store()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Obtener los datos del formulario
        $data = [
            'user' => $this->request->getPost('user'),
            'password' => $this->request->getPost('password'),
            'name' => $this->request->getPost('name'),
            'lastName' => $this->request->getPost('lastName'),
            'idCareer' => $this->request->getPost('idCareer')
        ];

        // Insertar el nuevo estudiante en la base de datos
        $this->estudianteModel->insert($data);
        return redirect()->to('/estudiante');
    }

    // Método para mostrar el formulario de edición de un estudiante existente
    public function edit($id)
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data['student'] = $this->estudianteModel->find($id);
        $data['careers'] = $this->careerModel->findAll();
        return view('admin/estudiante_edit', $data);
    }

    // Método para actualizar la información de un estudiante
    public function update($id)
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Obtener los datos actualizados del formulario
        $data = [
            'user' => $this->request->getPost('user'),
            'password' => $this->request->getPost('password'),
            'name' => $this->request->getPost('name'),
            'lastName' => $this->request->getPost('lastName'),
            'idCareer' => $this->request->getPost('idCareer')
        ];

        // Actualizar el estudiante en la base de datos
        $this->estudianteModel->update($id, $data);
        return redirect()->to('/estudiante');
    }

    // Método para eliminar un estudiante
    public function delete($id)
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Eliminar el estudiante de la base de datos
        $this->estudianteModel->delete($id);
        return redirect()->to('/estudiante');
    }

    // Método para mostrar la información del estudiante autenticado
    public function view()
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Obtener el ID del usuario autenticado
        $userId = session()->get('id');

        // Obtener el estudiante autenticado y su carrera
        $data['student'] = $this->estudianteModel->select('student.*, career.name as career_name')
                                                 ->join('career', 'student.idCareer = career.id')
                                                 ->where('student.id', $userId)
                                                 ->first();

        // Verificar si el estudiante fue encontrado
        if (empty($data['student'])) {
            // Redirigir o manejar el caso donde no se encuentra el estudiante
            return redirect()->to('/error'); // Suponiendo que tienes una ruta de error
        }

        $data['careers'] = $this->careerModel->findAll();

        // Cargar la vista con los datos
        return view('view_student', $data);
    }

    // Método para mostrar la información de un estudiante específico por ID
    public function viewStudent($id)
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Obtener el estudiante y las carreras
        $data['student'] = $this->estudianteModel->select('student.*, career.name as career_name')
                                                 ->join('career', 'student.idCareer = career.id')
                                                 ->where('student.id', $id)
                                                 ->first();
        $data['careers'] = $this->careerModel->findAll();
        return view('admin/estudiante_view', $data);
    }
}
