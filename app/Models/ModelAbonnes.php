<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAbonnes extends Model
{
    protected $table = 'abonnes';
    protected $allowedFields = ['NOABONNES','email'];
    protected $primaryKey = 'NOABONNES';

    public function returnAbonnes($user='all')
    {
        if($user=='all'){
            return $this->findAll();
        }else{
            return $this->where('email',$user)->findAll();
        }
    }
}