<?php

namespace App\Models;

use CodeIgniter\Model;

class EstudianteModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = ['user', 'password', 'name', 'lastName', 'idCareer'];

    public function getUsuario($usuarioEnviado)
    {
        return $this->where('user', $usuarioEnviado)->first();
    }

    public function getEstudiantesPorCarrera()
    {
        return $this->select('career.name as career_name, COUNT(student.id) as student_count')
                    ->join('career', 'student.idCareer = career.id')
                    ->groupBy('career.id')
                    ->findAll();
    }
}
