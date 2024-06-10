<?php

namespace App\Models;

use CodeIgniter\Model;

class EstudianteModel extends Model
{
    protected $table      = 'student';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['user', 'password', 'name', 'lastName'];


    public function getUsuario($usuarioEnviado){
        return $this->where('user', $usuarioEnviado)->first();
    }
   
}