<?php

namespace App\Controllers;

use App\Models\Career;

class CareerController extends BaseController
{
    public function index()
    {
        $careerModel = new Career();

        // Obtener todas las carreras
        $data['career'] = $careerModel->findAll();

        return view('career/index', $data);
    }

    public function create()
    {
        return view('career/create');
    }

    public function store()
    {
        $careerModel = new Career();

        // Validar y guardar la nueva carrera
        if ($this->validate($careerModel->validationRules)) {
            $careerModel->save([
                'name' => $this->request->getPost('name')
            ]);

            return redirect()->to('/careers');
        } else {
            return view('career/create', [
                'validation' => $this->validator
            ]);
        }
    }

    public function edit($id)
    {
        $careerModel = new Career();

        $data['career'] = $careerModel->find($id);

        return view('career/edit', $data);
    }

    public function update($id)
    {
        $careerModel = new Career();

        // Validar y actualizar la carrera
        if ($this->validate($careerModel->validationRules)) {
            $careerModel->update($id, [
                'name' => $this->request->getPost('name')
            ]);

            return redirect()->to('/careers');
        } else {
            return view('career/edit', [
                'validation' => $this->validator,
                'career' => $careerModel->find($id)
            ]);
        }
    }

    public function delete($id)
    {
        $careerModel = new Career();

        // Eliminar la carrera
        $careerModel->delete($id);

        return redirect()->to('/careers');
    }
}
