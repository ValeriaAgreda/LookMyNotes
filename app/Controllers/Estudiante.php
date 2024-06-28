<?php

namespace App\Controllers;

use App\Models\Career;
use App\Models\EstudianteModel;
use CodeIgniter\Controller;

class Estudiante extends Controller
{
    protected $estudianteModel;
    protected $careerModel;

    public function __construct()
    {
        $this->estudianteModel = new EstudianteModel();
        $this->careerModel = new Career(); // Asegúrate de que Career es el modelo correcto
    }

    // Método para listar todos los estudiantes junto con sus carreras
    public function index()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data['students'] = $this->estudianteModel->getStudentsWithCareerName();
        $data['careers'] = $this->careerModel->findAll();

        return view('Crud_Users', $data);
    }

    // Método para almacenar un nuevo estudiante
    public function store()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data = [
            'user' => $this->request->getPost('user'),
            'password' => $this->request->getPost('password'),
            'name' => $this->request->getPost('name'),
            'lastName' => $this->request->getPost('lastName'),
            'idCareer' => $this->request->getPost('idCareer'),
            'role' => $this->request->getPost('role') // Agregar el campo de rol
        ];

        $this->estudianteModel->insert($data);
        session()->setFlashdata('success', 'El estudiante ha sido agregado exitosamente.');
        return redirect()->to('/estudiante');
    }

    // Método para actualizar un estudiante existente
    public function update($id)
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data = [
            'user' => $this->request->getPost('user'),
            'password' => $this->request->getPost('password'),
            'name' => $this->request->getPost('name'),
            'lastName' => $this->request->getPost('lastName'),
            'idCareer' => $this->request->getPost('idCareer'),
            'role' => $this->request->getPost('role') // Agregar el campo de rol
        ];

        $this->estudianteModel->update($id, $data);
        session()->setFlashdata('success', 'El estudiante ha sido actualizado exitosamente.');
        return redirect()->to('/estudiante');
    }

    // Método para mostrar el formulario de edición de un estudiante existente
    public function edit($id)
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data['student'] = $this->estudianteModel->find($id);
        return $this->response->setJSON($data['student']);
    }

    // Método para eliminar un estudiante
    public function delete($id)
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        if ($this->estudianteModel->find($id)) {
            $this->estudianteModel->delete($id);
            session()->setFlashdata('success', 'El estudiante ha sido eliminado exitosamente.');
        } else {
            session()->setFlashdata('error', 'El estudiante no fue encontrado.');
        }

        return redirect()->to('/estudiante');
    }

    // Método para mostrar la información del estudiante autenticado
    public function view()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $userId = session()->get('id');

        $data['student'] = $this->estudianteModel->select('student.*, career.name as career_name')
                                                 ->join('career', 'student.idCareer = career.id')
                                                 ->where('student.id', $userId)
                                                 ->first();

        if (empty($data['student'])) {
            return redirect()->to('/error');
        }

        $data['careers'] = $this->careerModel->findAll();

        return view('view_student', $data);
    }

    // Método para mostrar la información de un estudiante específico por ID
    public function viewStudent($id)
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $data['student'] = $this->estudianteModel->select('student.*, career.name as career_name')
                                                 ->join('career', 'student.idCareer = career.id')
                                                 ->where('student.id', $id)
                                                 ->first();
        $data['careers'] = $this->careerModel->findAll();
        return view('admin/estudiante_view', $data);
    }
    public function reporteEstudiantesPorCarrera()
    {
        $data['estudiantes_por_carrera'] = $this->estudianteModel->getEstudiantesPorCarrera();
        return view('admin/view_reporte_carrera', $data);
    }
}
?>
