<?php

namespace App\Models;

use CodeIgniter\Model;

class Career extends Model
{
    protected $table = 'career';  // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id';  // Clave primaria de la tabla

    protected $allowedFields = ['name'];  // Campos permitidos para operaciones de inserción/actualización
    protected $returnType = 'object';  // Devolver los resultados como objetos
    protected $useTimestamps = false;  // Desactivar el uso automático de timestamps

    // Si necesitas agregar validaciones para los campos
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
    ];

    // Opcional: mensajes personalizados para las validaciones
    protected $validationMessages = [
        'name' => [
            'required' => 'El campo nombre es obligatorio',
            'min_length' => 'El nombre debe tener al menos 3 caracteres',
            'max_length' => 'El nombre no puede tener más de 255 caracteres',
        ],
    ];

    // Para permitir operaciones con Soft Deletes (opcional)
    protected $useSoftDeletes = true;
}
