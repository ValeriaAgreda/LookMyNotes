<?php

namespace App\Models;

use CodeIgniter\Model;

class ReminderModel extends Model
{
    protected $table = 'reminder';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'title', 'description', 'date', 'color', 'idStudent', 'idAssignment'];

    // Aquí puedes definir validaciones, configuraciones adicionales, etc.
}
