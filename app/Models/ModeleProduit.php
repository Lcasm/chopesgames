<?php

namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Model;
use mysqli;

class ModeleProduit extends Model
{

    protected $table = 'produit';
    protected $allowedFields = ['NOPRODUIT ', 'NOCATEGORIE', 'NOMARQUE', 'LIBELLE', 'DETAIL', 'PRIXHT', 'TAUXTVA', 'NOMIMAGE', 'QUANTITEENSTOCK', 'DATEAJOUT', 'DISPONIBLE', 'VITRINE'];
    protected $primaryKey = 'NOPRODUIT';

    public function retourner_produits($pNoArticle = false)
    {
        

        if ($pNoArticle === false) {
            return $this->findAll();
        }

        return $this->where(['NOPRODUIT' => $pNoArticle])->first();
    }

    public function retourner_vitrine()
    {
        return $this->where(['VITRINE' => 1])
            ->findAll();
    }

    public function update_vitrine($id)
    {
        $bool = $this->select("VITRINE")->where(['NOPRODUIT' => $id])->first()["VITRINE"];
        echo $bool;
        if($bool == 0 || $bool == null){
            $bool = 1;
        }else{
            $bool = 0;
        }
        return $this->update($id,['VITRINE' => $bool]);
    }

    public function produits_search($match)
    {
        return $this->like('LIBELLE', $match, 'both');
    }

    public function inserer_un_produit($pDonneesAInserer)
    {
        return $this->insert($pDonneesAInserer);
    }

    public function retouner_produits_marque($nomarque)
    {
        return $this->where(['NOMARQUE' => $nomarque]);
    }

    public function retouner_produits_categorie($categorie)
    {
        return $this->where(['NOCATEGORIE' => $categorie]);
    }

    public function retournerSlug($id)
    {
        return $this->select('NOMIMAGE,NOM')
        ->join('marque','marque.NOMARQUE=produit.NOMARQUE')
        ->where(['NOPRODUIT' => $id])->first();
    }

    public function retournerId($slug)
    {
        return $this->select('NOPRODUIT')->where(['NOMIMAGE' => $slug])->first();
    }


}