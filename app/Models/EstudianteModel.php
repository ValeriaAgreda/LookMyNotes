<?php

namespace App\Models;

use CodeIgniter\Model;

class EstudianteModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = ['user', 'password', 'name', 'role', 'lastName', 'idCareer'];

    // Método para obtener un usuario específico por nombre de usuario
    public function getUsuario($usuarioEnviado)
    {
        return $this->where('user', $usuarioEnviado)->first();
    }

    // Método para obtener el conteo de estudiantes por carrera
    public function getEstudiantesPorCarrera()
    {
        return $this->select('career.name as career_name, COUNT(student.id) as student_count')
                    ->join('career', 'student.idCareer = career.id')
                    ->groupBy('career.id')
                    ->findAll();
    }

    // Método para obtener todos los estudiantes con el nombre de su carrera
    public function getStudentsWithCareerName()
    {
        return $this->select('student.*, career.name as career_name')
                    ->join('career', 'student.idCareer = career.id')
                    ->findAll();
    }
}
?>
