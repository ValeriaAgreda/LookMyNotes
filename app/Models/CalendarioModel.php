<?php

namespace App\Models;

use CodeIgniter\Model;

class CalendarioModel extends Model
{
    protected $table      = 'reminder';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'description', 'date', 'color', 'idStudent', 'idAssignment'];

    public function getAllReminders() {
        return $this->findAll();
    }

    public function insertReminder($data) {
        return $this->insert($data);
    }

    public function updateReminder($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteReminder($id) {
        return $this->delete($id);
    }
}
