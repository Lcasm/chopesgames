<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleIdentifiant extends Model
{
    protected $table = 'identifiants_site';
    protected $allowedFields = ['SITE', 'RANG', 'IDENTIFIANT', 'CLEHMAC','SITEENPRODUCTION'];
    protected $primaryKey = 'NOIDENTIFIANT';

    public function retourner_identifiant()
    {
        return $this->first();
    }


} 