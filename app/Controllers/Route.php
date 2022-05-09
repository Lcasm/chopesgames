<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeleProduit;
use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\ModeleMarque;
use App\Models\ModeleAdministrateur;
//use App\Models\ModeleAdministrateur;
//$pager = \Config\Services::pager();
helper(['url', 'assets']);
class Route extends BaseController
{
    public function prodById(int $id){
        $modelProd = new ModeleProduit();
        $slug= $modelProd->retournerSlug($id);
        //redirection   
        if ($slug != null){ 
        return redirect()->to('jeux/'.$slug['NOMIMAGE']);
        }
        //else redirect 404 ?
    }
      
    public function prodBySlug($slug){
        $visiteur = new Visiteur();
        $modelProd = new ModeleProduit();
        $id= $modelProd->retournerId($slug);
        //pas de redirection mais invocation de la méthode déjà programmée     
        if ($id != null){ 
            $visiteur->voir_un_produit($id);
        }
        //else redirect 404 ?
    }

    public function categorieName($idCateg)
    {
        $modelCategorie = new ModeleCategorie();
        $nomCateg = $modelCategorie->retourner_categories($idCateg)["LIBELLE"];
        return redirect()->to("categorie/".$nomCateg);
    }

    public function categorie($nameCateg)
    {
        $visiteur = new Visiteur();
        $modelCategorie = new ModeleCategorie();
        $noCateg = $modelCategorie->retourner_categories_Id($nameCateg)["NOCATEGORIE"];
        $visiteur->lister_les_produits_par_categorie($noCateg);
    }

    public function marqueName($idMarque){
        $modelMarque = new ModeleMarque();
        $nomMarque = $modelMarque->retourner_marques($idMarque);
        return redirect()->to("marque/".str_replace(' ','-',$nomMarque["NOM"]) );
    }

    public function marque($marqueName)
    {
        $visiteur = new Visiteur();
        $modelMarque = new ModeleMarque();
        $noMarque = $modelMarque->retourner_marques_id(str_replace('-'," ",$marqueName));
        $visiteur->lister_les_produits_parmarque($noMarque["NOMARQUE"]);
    }

    public function allProd(){
        return redirect()->to("nos-jeux");
    }

    public function accueil(){
        return redirect()->to("accueil");
    }

    public function se_connecter()
    {
        return redirect()->to("connection");
    }

    public function s_enregistrer()
    {
        return redirect()->to("s_enregistrer");
    }

    public function panier()
    {
        return redirect()->to("panier");
    }
}