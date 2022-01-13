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

    public function commandes_non_traitees()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelComm = new Modele_commande();
        $data['commandes'] = $modelComm->retourner_commandes_non_traiter();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/commandes_non_traitees');
        echo view('templates/footer');
    }

    public function commande_traitee($nocommande)
    {
        helper('date');
        $modelClient = new ModeleClient();
        $modelComm = new Modele_commande();
        $modelLigne = new ModeleLigne();
        //$modelComm->update($nocommande,array('DATETRAITEMENT' => @date('Y-m-d H:i:s')));
        $data['produits'] = $modelLigne->retourner_lignes($nocommande);
        $data['commande'] = $modelComm->retourner_commande($nocommande);
        $data['client'] = $modelClient->retourner_client_par_no($data['commande']['NOCLIENT']);
        $data['titre'] = 'Votre commande vient d\'être expédiée';
        //echo view('AdministrateurEmploye/commande_traitee',$data);
        $message = view('AdministrateurEmploye/commande_traitee',$data);
        $email = \Config\Services::email();
        $email->setFrom('shop.game0911@gmail.com', 'Chopes Game');
        $email->setTo($data['client']['EMAIL']);
        $email->setSubject('Facture Chopes Game');
        $email->setMessage($message);
        $email->send();
        return redirect()->to('AdministrateurEmploye/commandes_non_traitees');
    }
}
