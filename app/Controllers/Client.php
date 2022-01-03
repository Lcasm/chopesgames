<?php
namespace App\Controllers;

use App\Models\ModeleProduit;
use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\ModeleIdentifiant;
use App\Models\Modele_commande;
use App\Models\ModeleLigne;

helper(['url', 'assets']);
class client extends BaseController
{
    public function se_de_connecter()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('Visiteur/accueil');
    }
    function validation_commande()
    {


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*
ATTENTION bien renseigner $config['base_url'] = 'http://localhost/chopesgames';
Sinon possiblement remplacement de localhost par "[::1]" (loopback address in ipv6, equal to 127.0.0.1 in ipv4)
ET PROBLEME AVEC IDENTIFIANT SITE SYSTEMATIQUE ! ! ! 
*/
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        helper(['form']);
        $session = session();
        $modelIdent = new ModeleIdentifiant();
        $identifiantsite = $modelIdent->retourner_identifiant();
        $modelCli = new ModeleClient();
        $Utilisateur = $modelCli->retourner_client_par_no($session->get('id'));
        // Identifiant de votre site de eCommerce (fournies par votre banque en production)
        $pbx_site = $identifiantsite["SITE"];         // Test (voir Compte de test)
        $pbx_rang = $identifiantsite["RANG"];              // Test
        $pbx_identifiant = $identifiantsite["IDENTIFIANT"];   // Test

        // Identifiant de la transaction (doit être unique en prod., a générer)
        $pbx_cmd = date("d-m-Y-H-i-s") . "-" . $session->get('id') . "-cmd";   // forcé ici

        // Identifiant client du site qui souhaite faire le paiement = mail client
        $pbx_porteur = $Utilisateur["EMAIL"];  // Valeur de test ici, en prod. = mail client

        // Somme à débiter de la Carte Bancaire, en centimes (forcée à 100 ici = 1 euros)
        $items =  array_values(session('cart'));
        $pbx_total =  0;

        for ($i = 0; $i < count($items); $i++) {
            $pbx_total += $items[$i]['qty'] * $items[$i]['price'];
        }
        $pbx_total *= 100;

        // Suppression des points ou virgules dans le montant                      
        $pbx_total = str_replace(",", "", $pbx_total);
        $pbx_total = str_replace(".", "", $pbx_total);

        //// Paramétrage des urls de redirection après paiement ////

        // $pbx_effectue = Page renvoyée si paiement accepté (voir ex. Annexe : accepte.php)
        $pbx_effectue = site_url('Client/paiement_accepte');
        // $pbx_annule = Page renvoyée si paiement annulé, par le client (voir ex. Annexe : annule.php)
        $pbx_annule = site_url('Client/paiement_annule');
        // $pbx_refuse = Page renvoyée si paiement refuse, par PayBox (voir ex. Annexe : refuse.php)
        $pbx_refuse = site_url('Client/paiement_refuse');


        /* url de retour back office site : $pbx_repondre_a
      Cette URL est appelée de serveur à serveur dès que le client valide son paiement (que ce dernier soit autorisé ou refusé). Cela permet ainsi de valider automatiquement le bon de commande correspondant même si le client coupe la connexion ou décide de ne pas revenir sur la boutique, car cet appel ne transite pas par le navigateur du porteur de carte.
      NOTA BENE : impossible d'appeler une méthode CodeIgniter ici !
      Dans ce script, on aura donc pas accès aux variables de session ! (l'id de session n'est pas renvoyé par le serveur PayBox)
        Pour que l'URL $pbx_repondre_a puisse être appelée, il faut que le site soit hébergé ! ! ! ! 
      */
        $pbx_repondre_a = php_url('traitement_retour_paybox.php'); // php_url ajouté dans helper 'assets_helper.php'
        // emplacement retenu ici (asset) : à voir en terme de sécurité

        // Paramétrage du retour back office site
        $pbx_retour = 'Montant:M;Reference:R;Auto:A;Erreur:E';
        /*
      M : Montant de la transaction (précisé dans PBX_TOTAL).
      R : Référence commande (précisée dans PBX_CMD)
      A : Numéro d’autorisation délivré par le centre d’autorisation de la banque du commerçant
      si le paiement est accepté
      E : Code réponse de la transaction
      */

        /* $keyTest : clé secrète HMAC. En prod. : générée depuis le back office mise à dispo. par votre banque puis stockée dans BBD par exemple. Ici on l’a mise en dur, pour test */
        $keyTest = $identifiantsite["CLEHMAC"];


        /* --------------- TESTS DE DISPONIBILITE DES SERVEURS ---------------
      PayBox dispose de plusieurs serveurs, dans ce qui suit on cherche un serveur de prod. Opérationnel pour répondre à notre demande */
        $serveurs = array(
            'tpeweb.paybox.com', //serveur primaire
            'tpeweb1.paybox.com'
        ); //serveur secondaire
        $serveurOK = "";
        foreach ($serveurs as $serveur) {
            $doc = new \DOMDocument();
            $doc->loadHTMLFile('https://' . $serveur . '/load.html');
            $server_status = "";
            $element = $doc->getElementById('server_status');
            if ($element) {
                $server_status = $element->textContent;
            }
            if ($server_status == "OK") {
                // Le serveur est prêt et les services opérationnels
                $serveurOK = $serveur;
                break;
            }
            // else : La machine est disponible mais les services ne le sont pas.
        }
        if (!$serveurOK) {
            die("Erreur : Aucun serveur n'a été trouvé");
        }
        // Activation de l'univers de préproduction (CAS LORSQU’ON VA TRAVAILLER EN TEST)
        // On remplace le serveur de prod. trouvé ci-dessus par :
        $serveurOK = 'preprod-tpeweb.paybox.com'; // Ligne à commenter si on veut passer en prod.

        //Création de l'url cgi paybox – vers laquelle on enverra nos données (encryptées)
        $serveurOK = 'https://' . $serveurOK . '/cgi/MYchoix_pagepaiement.cgi';

        // --------------- TRAITEMENT DES VARIABLES à envoyer vers serveur PayBox ---------------
        // On récupère la date au format ISO-8601
        $dateTime = date("c");

        // On crée la chaîne à hacher sans URLencodage
        $msg = "PBX_SITE=" . $pbx_site .
            "&PBX_RANG=" . $pbx_rang .
            "&PBX_IDENTIFIANT=" . $pbx_identifiant .
            "&PBX_TOTAL=" . $pbx_total .
            "&PBX_DEVISE=978" .
            "&PBX_CMD=" . $pbx_cmd .
            "&PBX_PORTEUR=" . $pbx_porteur .
            "&PBX_REPONDRE_A=" . $pbx_repondre_a .
            "&PBX_RETOUR=" . $pbx_retour .
            "&PBX_EFFECTUE=" . $pbx_effectue .
            "&PBX_ANNULE=" . $pbx_annule .
            "&PBX_REFUSE=" . $pbx_refuse .
            "&PBX_HASH=SHA512" .
            "&PBX_TIME=" . $dateTime;

        // Si la clé est en ASCII, On la transforme en binaire
        $binKey = pack("H*", $keyTest);

        // On calcule l’empreinte (à renseigner dans le paramètre PBX_HMAC) grâce à la fonction hash_hmac et //
        // la clé binaire / On envoi via la variable PBX_HASH l'algorithme de hachage qui a été utilisé (SHA512 dans ce cas)
        // Pour afficher la liste des algorithmes disponibles sur votre environnement, décommentez la ligne //
        // suivante
        // print_r(hash_algos());
        $hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));

        $DonneesInjectees['serveurOK'] = $serveurOK;
        $DonneesInjectees['pbx_site'] = $pbx_site;
        $DonneesInjectees['pbx_rang'] = $pbx_rang;
        $DonneesInjectees['pbx_identifiant'] = $pbx_identifiant;
        $DonneesInjectees['pbx_total'] = $pbx_total;
        $DonneesInjectees['pbx_cmd'] = $pbx_cmd;
        $DonneesInjectees['pbx_porteur'] = $pbx_porteur;
        $DonneesInjectees['pbx_repondre_a'] = $pbx_repondre_a;
        $DonneesInjectees['pbx_retour'] = $pbx_retour;
        $DonneesInjectees['pbx_effectue'] = $pbx_effectue;
        $DonneesInjectees['pbx_annule'] = $pbx_annule;
        $DonneesInjectees['pbx_refuse'] = $pbx_refuse;
        $DonneesInjectees['dateTime'] = $dateTime;
        $DonneesInjectees['hmac'] = $hmac;


        $DonneesInjectees['client'] =  $modelCli->retourner_client_par_no($session->get('id'));
        $modelCat = new ModeleCategorie();
        $DonneesInjectees['categories'] = $modelCat->retourner_categories();

        echo view('templates/header', $DonneesInjectees);
        echo view('Client/validation_commande');
        echo view('templates/footer');
    }

    function paiement_refuse() // simple redirection
    {
        echo '<script language=javascript>
      alert("Votre paiement a été refusé");
      </script> ';
        return redirect()->to('client/validation_commande');
    }

    function paiement_annule() // simple redirection
    {
        return redirect()->to('client/validation_commande');
    }

    function paiement_accepte()
    /* Simple redirection ici, la session n'est pas perdue
   MAIS EN PRODUCTION les traitements ci-après doivent être faits dans le script traitement_retour_paybox.php
   et en PHP simple, sans l'API CodeIgniter : traitement_retour_paybox.php est directement appelé par le serveur PayBox et, 
   donc, les informations sessions sont perdues.
   ! ! ! LE CODE CI-DESSOUS NE PEUT PAS ETRE UTILISE DANS LE SCRIPT DE RETOUR EN PRODUCTION ! ! ! 
   */

    /* NOTA BENE : ERREUR SI PAS DE SERVEUR SMTP (OU PAPERCUT...) ! ! ! ! ! ! !  */


    {
        $session = session();
        $totalht = 0;

        foreach (array_values(session('cart')) as $item) {
            $totalht += $item['ht'] * $item['qty'];
        }
        $totalttc = $totalht * 1.2;
        $noclient = $session->get('id');

        $data = array(
            'NOCLIENT' => intval($noclient),
            'DATECOMMANDE' => date("c"),
            'TOTALHT' => $totalht,
            'TOTALTTC' => $totalttc
        );
        
        $modelComm = new Modele_commande();
        $modelComm->save($data);
        $insertid = $modelComm->getInsertID();
        foreach (array_values(session('cart')) as $item) {
            $donneesAInsererLi = array(
                'NOCOMMANDE' => $insertid,
                'NOPRODUIT' => $item['id'],
                'QUANTITECOMMANDEE' =>  $item['qty']
            );
            $modelLig = new ModeleLigne();
            $modelLig->ajouter_ligne($donneesAInsererLi);
            $modelProd = new ModeleProduit();
            $infoproduit= $modelProd->retourner_produits($item['id']);
            $donneesAModifier = null;
            if ($infoproduit["QUANTITEENSTOCK"] == $item['qty']) {
                $donneesAModifier = array(
                    'QUANTITEENSTOCK' => (($infoproduit["QUANTITEENSTOCK"]) - $item['qty']),
                    'DISPONIBLE ' => 0
                );
                
                $modelProd->update($item['id'], $donneesAModifier);
            } else {
                $donneesAModifier = array(
                    'QUANTITEENSTOCK' => (($infoproduit["QUANTITEENSTOCK"]) - $item['qty'])
                );
                $modelProd->update($item['id'], $donneesAModifier);
            }
        }

        
        $email = \Config\Services::email();
        $modelCli = new ModeleClient();
        
        $user = $modelCli->retourner_client_par_no($session->get('id'));

        $email->setSubject('Paiement Test');
        $email->setMailType('html'); 
        $email->setFrom('master@chopesgames.com', 'ChopesGames');
        $email->setTo($user["EMAIL"]);
        $email->setSubject('Merci de votre commande');
        $message = '
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
  </head>
  <body>
    <header class="clearfix">
    <div id="logo">
    <img class="d-block" style="height:64px;" src="' . base_url() . "/assets/images/logo" . '" alt="Logo">
      </div>
      <div id="company">
        <h2 class="name">ChopesGames</h2>
        <div>8, Rue Rabelais, 22000 Saint Brieuc</div>
        <div>02 96 00 00 00</div>
        <div><a href="mailto:master@chopesgames.com">master@chopesgames.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">Facturer à:</div>
          <h2 class="name">' . $user["NOM"] . ' ' . $user["PRENOM"] . '</h2>
          <div class="address">' . $user["ADRESSE"] . ' ' . $user["VILLE"] . ' ' . $user["CODEPOSTAL"] . '</div>
          <div class="email">' . $user["EMAIL"] . '</div>
        </div>
        <div id="invoice">
          <h1>FACTURE</h1>
          <div class="date">Facture n°' . $insertid . '</div>
          <div class="date">Date de commande: ' . date("d-m-Y") . '</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">PRODRUIT</th>
            <th class="unit">PRIX UNITAIRE</th>
            <th class="qty">QUANTITE</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>';
        $i = 1;
        foreach (array_values(session('cart')) as $item) {
            $message = $message . '<tr>
           <td class="no">' . $i . '</td>
           <td class="desc"><h3>' . $item['name'] . '</h3></td>
           <td class="unit">' . $item['price'] . '€</td>
           <td class="qty">' . $item['qty'] . '</td>
           <td class="total">' . $item['qty']*$item['price'] . '€</td>
         </tr>
           ';
            $i++;
        }
        $message = $message . '
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>' . $totalttc . '</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Merci!</div>
      <div id="notices">
    </main>
  </body>
</html>
<style>
@font-face {
   font-family: SourceSansPro;
   src: url(SourceSansPro-Regular.ttf);
 }
 
 .clearfix:after {
   content: "";
   display: table;
   clear: both;
 }
 
 a {
   color: #0087C3;
   text-decoration: none;
 }
 
 body {
   position: relative;
   width: 21cm;  
   height: 29.7cm; 
   margin: 0 auto; 
   color: #555555;
   background: #FFFFFF; 
   font-family: Arial, sans-serif; 
   font-size: 14px; 
   font-family: SourceSansPro;
 }
 
 header {
   padding: 10px 0;
   margin-bottom: 20px;
   border-bottom: 1px solid #AAAAAA;
 }
 
 #logo {
   float: left;
   margin-top: 8px;
 }
 
 #logo img {
   height: 70px;
 }
 
 #company {
   float: right;
   text-align: right;
 }
 
 
 #details {
   margin-bottom: 50px;
 }
 
 #client {
   padding-left: 6px;
   border-left: 6px solid #0087C3;
   float: left;
 }
 
 #client .to {
   color: #777777;
 }
 
 h2.name {
   font-size: 1.4em;
   font-weight: normal;
   margin: 0;
 }
 
 #invoice {
   float: right;
   text-align: right;
 }
 
 #invoice h1 {
   color: #0087C3;
   font-size: 2.4em;
   line-height: 1em;
   font-weight: normal;
   margin: 0  0 10px 0;
 }
 
 #invoice .date {
   font-size: 1.1em;
   color: #777777;
 }
 
 table {
   width: 100%;
   border-collapse: collapse;
   border-spacing: 0;
   margin-bottom: 20px;
 }
 
 table th,
 table td {
   padding: 20px;
   background: #EEEEEE;
   text-align: center;
   border-bottom: 1px solid #FFFFFF;
 }
 
 table th {
   white-space: nowrap;        
   font-weight: normal;
 }
 
 table td {
   text-align: right;
 }
 
 table td h3{
   color: #57B223;
   font-size: 1.2em;
   font-weight: normal;
   margin: 0 0 0.2em 0;
 }
 
 table .no {
   color: #FFFFFF;
   font-size: 1.6em;
   background: #57B223;
 }
 
 table .desc {
   text-align: left;
 }
 
 table .unit {
   background: #DDDDDD;
 }
 

 
 table .total {
   background: #57B223;
   color: #FFFFFF;
 }
 
 table td.unit,
 table td.qty,
 table td.total {
   font-size: 1.2em;
 }
 
 table tbody tr:last-child td {
   border: none;
 }
 
 table tfoot td {
   padding: 10px 20px;
   background: #FFFFFF;
   border-bottom: none;
   font-size: 1.2em;
   white-space: nowrap; 
   border-top: 1px solid #AAAAAA; 
 }
 
 table tfoot tr:first-child td {
   border-top: none; 
 }
 
 table tfoot tr:last-child td {
   color: #57B223;
   font-size: 1.4em;
   border-top: 1px solid #57B223; 
 
 }
 
 table tfoot tr td:first-child {
   border: none;
 }
 
 #thanks{
   font-size: 2em;
   margin-bottom: 50px;
 }';
        $email->setMessage($message);
        $email->send();

        unset($_SESSION['cart']);
        return redirect()->to('Visiteur/lister_les_produits');
    }

    public function historique_des_commandes()
    {
      $session = session();
        if ($session->get('statut') == null) {
            return redirect()->to('Visiteur/lister_les_produits');
        }
        $modelCli = new ModeleClient();
        $DonneesInjectees['client'] = $modelCli->retourner_client_par_no($session->get('id'));
        $modelComm = new Modele_commande();
        $DonneesInjectees['commandes'] = $modelComm->retourner_commandes_client($session->get('id'));
        $modelCat = new ModeleCategorie();
        $DonneesInjectees['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $DonneesInjectees);
        echo view('Client/historique_des_commandes');
        echo view('templates/footer');
    }

    public function details_commande($nocommande = false)
    {
        if (empty($nocommande)) {
          return redirect()->to('Visiteur/lister_les_produits');
        }
        $modelComm = new Modele_commande();
        $DonneesInjectees['commande'] = $modelComm->retourner_commande($nocommande);
        $modelLig = new ModeleLigne();
        $DonneesInjectees['lignes'] = $modelLig->retourner_lignes($nocommande);
        $modelCat = new ModeleCategorie();
        $DonneesInjectees['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $DonneesInjectees);
        echo view('Client/details_commande');
        echo view('templates/footer');
    }
}