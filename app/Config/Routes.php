<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Visiteur');
$routes->setDefaultMethod('accueil');
$routes->setTranslateURIDashes(false);
//$routes->set404Override();
// Would execute the show404 method of the App\Errors class
$routes->set404Override(function( $message = null )
{
    $data = [
        'title' => '404 - Page not found',
        'message' => $message,
    ];
    echo view('my404', $data);
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Visiteur::accueil');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


//route jeux definis
$routes->add('Visiteur/voir_un_produit/(:num)', 'Route::prodById/$1');
$routes->get('jeux/(:any)', 'Route::prodBySlug/$1');

//route categorie
$routes->add('Visiteur/lister_les_produits_par_categorie/(:num)', 'Route::categorieName/$1');
$routes->get('categorie/(:any)', 'Route::categorie/$1');

//route marque
$routes->get('Visiteur/lister_les_produits_parmarque/(:num)', 'Route::marqueName/$1');
$routes->get('marque/(:any)', 'Route::marque/$1');

//route tous les jeux 
$routes->get('Visiteur/lister_les_produits','Route::allProd');
$routes->get('nos-jeux', 'Visiteur::lister_les_produits');

//route acceuil
$routes->add('Visiteur/accueil','Route::accueil');
$routes->add('accueil', 'Visiteur::accueil');

//route se connecter
$routes->get('Visiteur/se_connecter','Route::se_connecter');
$routes->get('connection', 'Visiteur::se_connecter');

//route s'enregistrer
$routes->get('Visiteur/s_enregistrer','Route::s_enregistrer');
$routes->get('s_enregistrer', 'Visiteur::s_enregistrer');

//route pannier
$routes->add('Visiteur/afficher_panier','Route::panier');
$routes->add('panier','Visiteur::afficher_panier');

//filter url superAdmin
$routes->add('AdministrateurSuper/saisie_lettre_info','AdministrateurSuper::saisie_lettre_info',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/sendEmail','AdministrateurSuper::sendEmail',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/sendEmail/(:any)','AdministrateurSuper::sendEmail/$1',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/sendEmail/(:any)/(:any)','AdministrateurSuper::sendEmail/$1/$2',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/ajouter_un_produit','AdministrateurSuper::ajouter_un_produit',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/ajouter_un_produit/(:any)','AdministrateurSuper::ajouter_un_produit',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/ajouter_une_categorie','AdministrateurSuper::ajouter_une_categorie',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/ajouter_une_marque','AdministrateurSuper::ajouter_une_marque',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/ajouter_un_admin','AdministrateurSuper::ajouter_un_admin',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/rendre_indisponible/(:any)','AdministrateurSuper::rendre_indisponible/$1',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/rendre_disponible/(:any)','AdministrateurSuper::rendre_disponible/$1',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/modifier_produit/(:any)','AdministrateurSuper::modifier_produit/$1',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/lister_admin','AdministrateurSuper::lister_admin',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/modifier_admin/(:any)','AdministrateurSuper::modifier_admin/$1',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/supprimer_admin/(:any)','AdministrateurSuper::supprimer_admin/$1',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/modifier_identifiants_bancaires_site','AdministrateurSuper::modifier_identifiants_bancaires_site',['filter' => 'superAdmin']);
$routes->add('AdministrateurSuper/Vitrine/(:any)','AdministrateurSuper::Vitrine/$1',['filter' => 'superAdmin']);

//filter route admin
$routes->add('AdministrateurEmploye/afficher_les_clients','AdministrateurEmploye::afficher_les_clients',['filter' => 'admin']);
$routes->add('AdministrateurEmploye/historique_des_commandes','AdministrateurEmploye::historique_des_commandes',['filter' => 'admin']);
$routes->add('AdministrateurEmploye/historique_des_commandes/(:any)','AdministrateurEmploye::historique_des_commandes/$1',['filter' => 'admin']);
$routes->add('AdministrateurEmploye/details_commande','AdministrateurEmploye::details_commande',['filter' => 'admin']);
$routes->add('AdministrateurEmploye/details_commande/(:any)','AdministrateurEmploye::details_commande/$1',['filter' => 'admin']);
$routes->add('AdministrateurEmploye/commandes_non_traitees','AdministrateurEmploye::commandes_non_traitees',['filter' => 'admin']);
$routes->add('AdministrateurEmploye/commande_traitee/(:any)','AdministrateurEmploye::commande_traitee/$1',['filter' => 'admin']);

//filter client
$routes->add('Client/se_de_connecter','Client::se_de_connecter',['filter' => 'client']);
$routes->add('Client/validation_commande','Client::validation_commande',['filter' => 'client']);
$routes->add('Client/paiement_refuse','Client::paiement_refuse',['filter' => 'client']);
$routes->add('Client/paiement_annule','Client::paiement_annule',['filter' => 'client']);
$routes->add('Client/paiement_accepte','Client::paiement_accepte',['filter' => 'client']);
$routes->add('Client/historique_des_commandes','Client::historique_des_commandes',['filter' => 'client']);
$routes->add('Client/details_commande','Client::details_commande',['filter' => 'client']);
$routes->add('Client/details_commande/(:any)','Client::details_commande/$1',['filter' => 'client']);
