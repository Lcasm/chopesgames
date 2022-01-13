<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNouvelles extends Model
{
    protected $table = 'nouvelles';
    protected $allowedFields = ['NONOUVELLES', 'objet', 'titre', 'message'];
    protected $primaryKey = 'NONOUVELLES';

    public function nouvelle($id = 1)
    {
        return $this->where('NONOUVELLES',$id)->first();
    }
}