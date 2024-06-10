<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriaModel extends Model
{
    protected $table = 'assignment';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'status'];
}
