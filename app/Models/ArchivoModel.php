<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchivoModel extends Model
{
    protected $table      = 'notes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'description', 'archive', 'idStudent','idAssignment'];

   
}