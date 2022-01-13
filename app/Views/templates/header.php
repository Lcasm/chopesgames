<!DOCTYPE html>
<html>
<?php $session = session();
if ($session->has('cart')) {
    $cart = session('cart');
    $nb = count($cart);
} else $nb = 0; ?>

<head>
    <title>ChopesGames</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/images/favicon.ico' ?>">
    <link rel="alternate" type="application/rss+XML" title="ChopesGames" href="<?php echo site_url('AdministrateurSuper/flux_rss') ?>" />

    <!-- <link rel="stylesheet" href="<?php //= css_url('bootstrap.min') ?>"> bootstrap 4-->
    <!-- <link rel="stylesheet" href="<?php //= css_url('style') ?>"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- bootstrap 5 -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> bootstrap 4 -->
    <!-- <script src="<?php //echo js_url('bootstrap.min') ?>"></script> bootstrap 4 -->
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="navbar navbar-expand-xl navbar-dark bg-dark">
        <div class="container-fluid">

            <a class="navbar-brand order-0" href="<?php echo site_url('Visiteur/accueil') ?>">
                <img class="d-block" style="width:60px;height:38px;'" src="<?= base_url() . '/assets/images/logo.jpg' ?>" alt="Logo">
            </a>     


            <div class="navbar-collapse collapse order-2" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">

                    <li class="nav-item m-2">
                        <a class="btn btn-primary" href="<?= site_url('Visiteur/lister_les_produits') ?>">Lister tous les Produits</a>
                    </li>

                    <li class="nav-item dropdown m-2">
                        <a class="dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégorie 
                        </a>
                            
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <?php foreach($categories as $category){ ?> 
                                <li><a class="dropdown-item" href="<?= site_url('Visiteur/lister_les_produits_par_categorie/'.$category['NOCATEGORIE']) ?>"><?= $category['LIBELLE'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>

                </ul>
            </div>

            <form id="formSearch" class="d-flex order-3" method="post" action="<?php echo site_url('Visiteur/lister_les_produits') ?>">
                <input class="form-control me-2" type="search" name="search" id='search' placeholder="Search">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form> 
<!--  onclick="order_menu()" -->
             <button id="burger-menu" class="navbar-toggler order-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse order-4 right" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <?php if ($session->get('statut') == 2 or $session->get('statut') == 3) : ?>
                        <li class="nav-item dropdown m-2">
                            <a class="dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administration
                            </a>
                                
                            <div class="dropdown-menu dropdown-menu-dark">
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/afficher_les_clients') ?>">Clients->Commandes</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/commandes_non_traitees') ?>">Commandes non traitées</a>
                                <?php if ($session->get('statut') == 3) { ?>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/lister_admin') ?>">Liste des administrateurs</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/saisie_lettre_info') ?>">Saisie lettre d'information</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_produit') ?>">Ajouter un produit</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_une_categorie') ?>">Ajouter une catégorie</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_une_marque') ?>">Ajouter une marque</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_admin') ?>">Ajouter un administrateur</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/modifier_identifiants_bancaires_site') ?>">Modifier identifiants bancaires site</a>
                                <?php } ?>
                            </div>
                        </li>
                    <?php endif; ?>


                    <li class="nav-item dropdown m-2">
                        <a class="dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mon compte
                        </a>
                            
                        <div class="dropdown-menu dropdown-menu-dark">
                            <?php if (!is_null($session->get('statut'))) { ?>
                                <?php if ($session->get('statut') == 1) { ?>
                                    <a class="dropdown-item" href="<?php echo site_url('Client/historique_des_commandes') ?>">Mes commandes</a>
                                    <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Modifier son compte</a>
                                <?php } elseif ($session->get('statut') == 3) { ?>
                                    <a class="dropdown-item" href="<?= site_url('AdministrateurSuper/modifier_admin/'.$session->get('identifiant')) ?>">Modifier son compte</a>
                                <?php } ?>
                                <a class="dropdown-item" href="<?php echo site_url('Client/se_de_connecter') ?>">Se déconnecter</a>
                            <?php } else { ?>
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">S'enregister</a>
                            <?php } ?>
                        </div>

                        <a href="<?php echo site_url('Visiteur/afficher_panier') ?>" class="btn btn-info btn-md">
                            <span class="fas fa-shopping-cart"><?php if ($nb > 0) echo "($nb)" ?></span>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </header>
    <main class="flex-grow-1">