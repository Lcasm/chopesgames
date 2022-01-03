<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleAdministrateur extends Model
{

    protected $table = 'administrateur';
    protected $allowedFields = ['IDENTIFIANT', 'EMAIL', 'PROFIL', 'MOTDEPASSE'];
    protected $primaryKey = 'IDENTIFIANT';

    public function retourner_administrateur($identifiant, $MotdePasse)
    {
        return $this->where(['IDENTIFIANT' => $identifiant, 'MOTDEPASSE' => $MotdePasse])
            ->first();
    }

    public function retourner_administrateur_par_id($idadmin)
    {
        return $this->where(['IDENTIFIANT' => $idadmin])
            ->first();
    }


    function retourner_administrateurs_employes()
    {
        return $this->where(['PROFIL' => 'Employé'])
            ->findAll();
    }

    function retourner_administrateur_par_email($mail)
    {
        return $this->where(['EMAIL' => $mail])
            ->first();
    }
}
