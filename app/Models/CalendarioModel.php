<?php

namespace App\Models;

use CodeIgniter\Model;

class CalendarioModel extends Model
{
    protected $table      = 'reminder';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['title', 'description', 'date', 'color', 'idStudent', 'idAssignment'];

    // Añadir reglas de validación
    protected $validationRules = [
        'title' => 'required',
        'date' => 'required|valid_date'
    ];
}
?>
