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
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    public function getReminder($id)
    {
        $model = new CalendarioModel();
        $data = $model->find($id);
        return $this->response->setJSON($data);
    }

    public function addReminder()
    {
        $model = new CalendarioModel();

        $data = $this->request->getJSON(true); // Obtener datos en formato JSON

        if ($model->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Evento guardado exitosamente']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al guardar el evento']);
        }
    }

    public function updateReminder($id)
    {
        $model = new CalendarioModel();
        $data = $this->request->getJSON(true); // Obtener datos en formato JSON

        if ($model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al actualizar el evento']);
        }
    }

    public function deleteReminder($id)
    {
        $model = new CalendarioModel();
        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al eliminar el evento']);
        }
    }
}
?>
