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
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/images/favicon.ico' ?>">
    <link rel="alternate" type="application/rss+XML" title="ChopesGames" href="<?php echo site_url('AdministrateurSuper/flux_rss') ?>" />

    <link rel="stylesheet" href="<?= css_url('bootstrap.min') ?>">
    <link rel="stylesheet" href="<?= css_url('style') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?= js_url('bootstrap.min') ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?= js_url('myJs') ?>"></script>
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand" href="<?php echo site_url('Visiteur/accueil') ?>">
                <img class="d-block" style="width:60px;height:38px;'" src="<?= base_url() . '/assets/images/logo.jpg' ?>" alt="Logo">
            </a>
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a href="<?= site_url('Visiteur/accueil') ?>" class="btn btn-info">
                        <span class="fas fa-home"></span>Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-primary" href="<?= site_url('Visiteur/lister_les_produits') ?>">Lister tous les Produits</a>
                </li>
                <li class="nav-item dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Catégory
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach($categories as $category){ ?> 
                            <li><a class="dropdown-item" href="<?= site_url('Visiteur/lister_les_produits_par_categorie/'.$category['NOCATEGORIE']) ?>"><?= $category['LIBELLE'] ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>


        <div class="mx-auto order-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class=" w-75 order-2 ">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <form class="form-inline" method="post" action="<?php echo site_url('Visiteur/lister_les_produits') ?>">
                        <input class="form-control mr-sm-2" type="text" name="search" id='search' placeholder="Search">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>




        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?php echo site_url('Visiteur/afficher_panier') ?>" class="btn btn-info btn-md">
                        <span class="fas fa-shopping-cart"><?php if ($nb > 0) echo "($nb)" ?></span>
                    </a>
                </li>

                <?php if ($session->get('statut') == 2 or $session->get('statut') == 3) : ?>
                    <li class="nav-item dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Administration
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/afficher_les_clients') ?>">Clients->Commandes</a>
                            <a class="dropdown-item" href="">(2Do) Commandes non traitées</a>
                            <?php if ($session->get('statut') == 3) { ?>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/lister_admin') ?>">Liste des administrateurs</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_produit') ?>">Ajouter un produit</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_une_categorie') ?>">Ajouter une catégorie</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_une_marque') ?>">Ajouter une marque</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_admin') ?>">Ajouter un administrateur</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/modifier_identifiants_bancaires_site') ?>">Modifier identifiants bancaires site</a>
                            <?php } ?>
                        </div>
                    </li>
                <?php endif; ?>


                <li class="nav-item dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Mon compte
                    </button>
                    <div class="dropdown-menu">
                        <?php if (!is_null($session->get('statut'))) { ?>
                            <?php if ($session->get('statut') == 1) { ?>
                                <a class="dropdown-item" href="<?php echo site_url('Client/historique_des_commandes') ?>">Mes commandes</a>
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Modifier son compte</a>
                            <?php } elseif ($session->get('statut') == 3) { ?>
                                <a class="dropdown-item" href="<?= site_url('AdministrateurSuper/modifier_admin/'.$session->get('identifiant')) ?>">(2Do) Modifier son compte</a>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo site_url('Client/se_de_connecter') ?>">Se déconnecter</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                            <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">S'enregister</a>
                        <?php } ?>
                    </div>
                </li>

                <li>
                </li>
                <li>
                </li>
                <?php if (empty($session->get('statut'))) : ?>
                    <li class="nav-item droite">
                        <a href="<?php echo site_url('Visiteur/connexion_administrateur') ?>" class="fas fa-lock"></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <main>