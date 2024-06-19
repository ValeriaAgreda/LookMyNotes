<?php

namespace App\Controllers;

use App\Models\CalendarioModel;
use App\Models\MateriaModel;

class Calendario extends BaseController
{

    public function index()
    {
        $materiaModel = new MateriaModel();
        $assignments = $materiaModel->findAll();

        return view('view_calendario', ['assignments' => $assignments]);
    }

    public function getReminders()
    {
        $model = new CalendarioModel();
        $data = $model->findAll(); // Cambiado a findAll() para obtener todos los recordatorios
        return $this->response->setJSON($data);
    }

    public function addReminder() {
        $model = new CalendarioModel();
    
        // Obtener datos del formulario
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date'),
            'color' => $this->request->getPost('color'),
            'idStudent' => $this->request->getPost('idStudent'),
            'idAssignment' => $this->request->getPost('idAssignment')
        ];
    
        // Insertar en la base de datos
        if($model->insert($data)) {
            // Devolver respuesta JSON de éxito
            return $this->response->setJSON(['status' => 'success', 'message' => 'Evento guardado exitosamente']);
        } else {
            // Devolver respuesta JSON de error
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al guardar el evento']);
        }
    }
    



    public function updateReminder($id)
    {
        $model = new CalendarioModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date'),
            'color' => $this->request->getPost('color'),
            'idStudent' => $this->request->getPost('idStudent'),
            'idAssignment' => $this->request->getPost('idAssignment')
        ];
        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteReminder($id)
    {
        $model = new CalendarioModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}
