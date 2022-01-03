<?php $session = session(); ?>
<div class="container toppro">
    <div class="row">
        <div class="col-md-5">

            <?php
            if (!empty($unProduit["NOMIMAGE"])) echo img_class($unProduit["NOMIMAGE"] . '.jpg', $unProduit["LIBELLE"], 'img-responsive image');
            else echo img_class('nonimage.jpg', $unProduit["LIBELLE"], 'img-responsive image');
            ?>


        </div>
        <div class="col-md-6">
            <div>
                <h3><?php echo $unProduit["LIBELLE"] ?></h3>
                <hr />
                <?php echo anchor('Visiteur/lister_les_produits_parmarque/' . $marque["NOMARQUE"], $marque["NOM"]);
                echo '<hr/>';
                echo anchor('Visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"]);
                echo '<hr/>'; ?>
                <div>
                    <?php echo number_format((($unProduit["PRIXHT"]) + ($unProduit["TAUXTVA"])), 2, ",", ' '), '€' ?>
                </div><br />
                <?php if ($session->get('statut') == 3) { ?>
                    <a class="btn btn-warning" href="<?php echo site_url('AdministrateurSuper/modifier_produit/' . $unProduit["NOPRODUIT"]);  ?>">Modifier</a>
                    <?php if ($unProduit["DISPONIBLE"] == 0) {
                    ?>
                        <a class="btn btn-warning" href="<?php echo site_url('AdministrateurSuper/rendre_disponible/' . $unProduit["NOPRODUIT"]);  ?>">Rendre disponible</a>
                    <?php } else { ?>

                        <a class="btn btn-danger" href="<?php echo site_url('AdministrateurSuper/rendre_indisponible/' . $unProduit["NOPRODUIT"]);  ?>">Rendre indisponible</a>
                    <?php }
                } else { ?>
                    <?php if ($unProduit["DISPONIBLE"] == 0) {
                        echo 'Rupture de stock..';
                    } ?><br />
                    <span class="produit"> <a class="btn ajoutpanier <?php if ($unProduit["DISPONIBLE"] == 0) {
                                                                            echo 'disabled';
                                                                        } ?>" href="<?php echo site_url('Visiteur/ajouter_au_panier/' . $unProduit["NOPRODUIT"]);  ?>">Ajouter au panier</a></span>
                <?php } ?>


            </div>
        </div>
        <div class="product-info-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" role="tab" aria-controls="description" aria-selected="true">Description</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <?php echo $unProduit["DETAIL"] ?></div>

            </div>
        </div>


    </div>