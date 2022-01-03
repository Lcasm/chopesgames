<?php
namespace App\Controllers;

use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\Modele_commande;
use App\Models\ModeleLigne;

helper(['url', 'assets']);

class AdministrateurEmploye extends BaseController
{
    public function afficher_les_clients()
    {
        $modelCli = new ModeleClient();
        $data['clients'] = $modelCli->retourner_clients();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/afficher_les_clients');
        echo view('templates/footer');
    }

    public function historique_des_commandes($noclient = null)
    {
        // if ($noclient == null) {
        //     return redirect()->to('AdministrateurEmploye/afficher_les_clients');
        // }
        $modelCli = new ModeleClient();
        $data['client'] = $modelCli->retourner_client_par_no($noclient);
        $modelComm = new Modele_commande();
        $data['commandes'] = $modelComm->retourner_commandes_client($noclient);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/historique_des_commandes');
        echo view('templates/footer');
    }

    public function details_commande($noCommande = false)
    {
        if (empty($noCommande)) {
            return redirect()->to('AdministrateurEmploye/historique_des_commandes');
        }
        $modelComm = new Modele_commande();
        $data['commande'] = $modelComm->retourner_commande($noCommande);
        $modelLig = new ModeleLigne();
        $data['lignes'] = $modelLig->retourner_lignes($noCommande);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/details_commande');
        echo view('templates/footer');
    }
}
