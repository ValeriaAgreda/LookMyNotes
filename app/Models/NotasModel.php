<?php

namespace App\Models;

use CodeIgniter\Model;

class NotasModel extends Model
{
    protected $table = 'notes'; // Nombre de tu tabla de notas
    protected $primaryKey = 'id'; // Clave primaria de la tabla

    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['idAssignment', 'note'];
}
