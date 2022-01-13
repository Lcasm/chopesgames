<?php
namespace App\Controllers;

use App\Models\ModeleAdministrateur;
use App\Models\ModeleProduit;
use App\Models\ModeleCategorie;
use App\Models\ModeleIdentifiant;
use App\Models\ModeleMarque;
use App\Models\ModelNouvelles;
use App\Models\ModelAbonnes;
use app\Config\Email;

helper(['url', 'assets', 'form','email']);

class AdministrateurSuper extends BaseController
{
    public function saisie_lettre_info()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelnouv = new ModelNouvelles();
        $rules = ['txtobjet' => 'required','txttitre' => 'required','txtmessage' => 'required'];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                $data['TitreDeLaPage'] = 'Saisie lettre d\'information';

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/saisie_lettre_info');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'objet' => $this->request->getPost('txtobjet'),
                'titre' => $this->request->getPost('txttitre'),
                'message' => $this->request->getPost('txtmessage')
            );
            $modelnouv->save($donneesAInserer);
            $this->sendEmail($modelnouv->getInsertID());
            //return redirect()->to('AdministrateurSuper/sendEmail');
        }
    }

    public function saveAbonnes()
    {
        $modelabonnes = new ModelAbonnes();
        $rules = ['txtmail' => 'required|trim|is_unique[abonnes.email]|valid_email'];
        if (!$this->validate($rules)) {
        }else{
            $modelabonnes->save(['email' => $this->request->getPost('txtmail')]);
            $this->sendEmail('nouveau',$this->request->getPost('txtmail'));
        }
        return redirect()->to('visiteur/lister_les_produits');
    }

    public function sendEmail($idData = 'nouveau',$user = 'all')
    {
        $modelabonnes = new ModelAbonnes();
        $modelnouv = new ModelNouvelles();
        $email = \Config\Services::email();
        
        if($idData == 'nouveau'){
            $DataMail = $modelnouv->nouvelle();
        }else{
            $DataMail = $modelnouv->nouvelle($idData);
        }
        foreach($modelabonnes->returnAbonnes($user) as $abonne){
            $email->setFrom('shop.game0911@gmail.com', 'Chopes Game');
            $email->setSubject($DataMail['objet']);
            $email->setMessage($DataMail['message']);
            $email->setTo($abonne['email']);
            if ($email->send()) 
            {
                echo 'Email successfully sent :'.$abonne['email'];
            } 
            else 
            {
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }
        }
        
        return redirect()->to('visiteur/lister_les_produits');
    }

    public function ajouter_un_produit($prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['TitreDeLaPage'] = 'Ajouter un produit';

        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg]',
                'max_size[image,1024]',
            ]
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if($prod==false) {
                    $data['TitreDeLaPage'] = 'Ajouter un produit';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }
                
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_un_produit');
            echo view('templates/footer');
        } else // si formulaire valide
        {


            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'NOMIMAGE' => pathinfo($this->request->getPost('txtNomimage'), PATHINFO_FILENAME), // on n'insère que le nom du fichier dans la BDD
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'DATEAJOUT' => date("Y-m-d"),
                'DISPONIBLE' => 0,
            );

            if ($this->request->getPost('txtQuantite') > 0) $donneesAInserer['DISPONIBLE'] = 1;

            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $this->request->getPost('txtNomimage') . '.jpg';
                    $img->move('assets/images/', $newName);
                    print_r($donneesAInserer);
                    $modelProd = new ModeleProduit();
                    $modelProd->save($donneesAInserer);
                    
                    return redirect()->to('visiteur/lister_les_produits');
                }
            }
            //else redirecte ??
        }
    }
    public function ajouter_une_categorie()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $rules = ['txtcategorie' => 'required'];

        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                $data['TitreDeLaPage'] = 'Ajouter une catégorie';

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_une_categorie');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'LIBELLE' => $this->request->getPost('txtcategorie')
            );
            $modelCat->save($donneesAInserer);

            return redirect()->to('visiteur/lister_les_produits');
        }
    }
    public function ajouter_une_marque()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $rules = ['txtmarque' => 'required'];

        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                $data['TitreDeLaPage'] = 'Ajouter une marque';

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_une_marque');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'NOM' => $this->request->getPost('txtmarque')
            );
            $modelMarq->save($donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }

    }
    public function ajouter_un_admin()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelAdmin = new ModeleAdministrateur();
        $rules = [
            'txtIdentifiant' => 'required',
            'txtMdp' => 'required',
            'txtEmail' => 'required'
        ];

        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                $data['TitreDeLaPage'] = 'Ajouter un administrateur';

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_un_admin');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'IDENTIFIANT' => $this->request->getPost('txtIdentifiant'),
                'EMAIL' => $this->request->getPost('txtEmail'),
                'MOTDEPASSE' => $this->request->getPost('txtMdp'),
                'PROFIL' => 'Employé'
            );
            $modelAdmin->insert($donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }
    }
    public function rendre_indisponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }

        $donneesAInserer = array(
            'DISPONIBLE' => 0
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function rendre_disponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }
        $donneesAInserer = array(
            'DISPONIBLE' => 1
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function modifier_produit($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelProd = new ModeleProduit();
        $data['TitreDeLaPage'] = 'Modifier un produit';

        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'vitrine' => '',
        ];

        if (!$this->validate($rules)) {
            if($_POST)$data['TitreDeLaPage'] = 'Corriger votre formulaire';
            $produit =  $modelProd->retourner_produits($noProduit);
            $data['noProduit'] = $produit['NOPRODUIT'];
            $data['Categorie'] = $produit['NOCATEGORIE'];
            $data['Marque'] = $produit['NOMARQUE'];
            $data['txtLibelle'] = $produit['LIBELLE'];
            $data['txtDetail'] = $produit['DETAIL'];
            $data['txtPrixHT'] = $produit['PRIXHT'];
            $data['txtNomimage'] = $produit['NOMIMAGE'];
            $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
            $data['vitrine'] = $produit['VITRINE'];
            
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifier_produit');
            echo view('templates/footer');
        } else {

            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE ' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'DATEAJOUT' => date("Y-m-d"),
                'NOMIMAGE' => $this->request->getPost('txtNomimage'),
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'VITRINE' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {$donneesAInserer['VITRINE']=1;} 
            
            $modelProd->update($noProduit, $donneesAInserer);

            return redirect()->to('visiteur/lister_les_produits');
        }
    }

    public function lister_admin()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelAdmin = new ModeleAdministrateur();
        $data['admins'] = $modelAdmin->retourner_administrateurs_employes();
        $data['TitreDeLaPage'] = 'Liste des administrateurs';
        echo view('templates/header', $data);
        echo view('AdministrateurSuper/liste_Admin');
        echo view('templates/footer');
    }

    public function modifier_admin($id)
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelAdmin = new ModeleAdministrateur();
        $data['admin'] = $modelAdmin->retourner_administrateur_par_id($id);
        $rules = [
            'txtMdp' => 'required',
            'txtEmail' => 'required'
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                $data['TitreDeLaPage'] = 'Modifier un administrateur';
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifier_admin');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'EMAIL' => $this->request->getPost('txtEmail'),
                'MOTDEPASSE' => $this->request->getPost('txtMdp'),
            );
            $modelAdmin->update($id,$donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }
    }

    public function supprimer_admin($id)
    {
        $modelAdmin = new ModeleAdministrateur();
        $modelAdmin->delete($id);
        return redirect()->to('AdministrateurSuper/lister_admin');
    }

    function modifier_identifiants_bancaires_site()
    {
        $modelIdent = new ModeleIdentifiant();
        $data['identifiant'] = $modelIdent->retourner_identifiant();

        $rules = [ //régles de validation creation
            'txtSite' => 'required',
            'txtRang' => 'required',
            'txtIdentifiant' => 'required',
            'txtHmac'    => 'required',
        ];


        if (!$this->validate($rules)) {
            $modelCat = new ModeleCategorie();
            $data['categories'] = $modelCat->retourner_categories();
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifier_identifiants_bancaires_site');
            echo view('templates/footer');
        } else {

            $donneesAInserer = array(
                'SITE' => $this->request->getPost('txtSite'),
                'RANG' => $this->request->getPost('txtRang'),
                'IDENTIFIANT' => $this->request->getPost('txtIdentifiant'),
                'CLEHMAC' => $this->request->getPost('txtHmac'),
                'SITEENPRODUCTION' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {
                $donneesAInserer['SITEENPRODUCTION'] = 1;
            }

            $modelIdent->update(1, $donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }
    }
 
}
