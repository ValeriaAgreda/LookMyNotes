<?php

namespace App\Controllers;

use App\Models\ReminderModel;
use CodeIgniter\Controller;

class Reminder extends Controller
{
    public function index()
    {
        $reminderModel = new ReminderModel();
        $data['reminders'] = $reminderModel->findAll(); // Cargar todos los recordatorios
    
        echo view('reminder/index', $data); // Pasar datos a la vista
    }

    public function create()
    {
        echo view('reminder/create');
    }

    public function store()
    {
        $reminderModel = new ReminderModel();

        $data = [
            'id' => $this->request->getPost('id'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date'),
            'color' => $this->request->getPost('color'),
            'idStudent' => $this->request->getPost('idStudent'),
            'idAssignment' => $this->request->getPost('idAssignment'),
        ];

        $reminderModel->insert($data);

        return redirect()->to('/reminder')->with('success', 'Recordatorio creado correctamente');
    }

    public function edit($id)
    {
        $reminderModel = new ReminderModel();
        $data['reminder'] = $reminderModel->find($id);

        echo view('reminder/edit', $data);
    }

    public function update($id)
    {
        $reminderModel = new ReminderModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date'),
            'color' => $this->request->getPost('color'),
            'idStudent' => $this->request->getPost('idStudent'),
            'idAssignment' => $this->request->getPost('idAssignment'),
        ];

        $reminderModel->update($id, $data);

        return redirect()->to('/reminder')->with('success', 'Recordatorio actualizado correctamente');
    }

    public function delete($id)
    {
        $reminderModel = new ReminderModel();

        $reminderModel->delete($id);

        return redirect()->to('/reminder')->with('success', 'Recordatorio eliminado correctamente');
    }
}
