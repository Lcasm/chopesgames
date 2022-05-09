<?php $session = session(); ?>
<h2 class='text-center'><?php echo $TitreDeLaPage ?></h2>
<hr />

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 categorie">   
            <h3>Catégorie:</h3>
            <?php foreach ($categories as $categorie) {
                echo '<h4 >' . anchor('Visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"], "class=\"text-decoration-none\"") . '</h4>'; ?><?php } ?>
            <hr />
        </div>
        <div id="produits" class="col-sm-10">
           <div class="d-flex flex-wrap justify-content-center"> <!-- container -->
                <!-- <div class="row"> -->
                    <?php if ($lesProduits == null) {
                        echo '<h3>Aucun produit correspondant à cette recherche</h3>';
                    } ?>
                    <?php $count = 0;
                    foreach ($lesProduits as $unProduit) {
                        $count++; ?>


                         <div class="m-2"><!-- class="col-md-3 col-sm-6" -->
                            <div class="product-grid img-size d-flex flex-column">
                                <div class="product-image">
                                    <a href="<?= base_url() . '/Visiteur/voir_un_produit/' . $unProduit["NOPRODUIT"] ?>">
                                        <?php
                                        if (!empty($unProduit["NOMIMAGE"])) echo img_class($unProduit["NOMIMAGE"] . '.jpg', $unProduit["LIBELLE"], 'img-thumbnail img-size');
                                        else echo img_class('nonimage.jpg', $unProduit["LIBELLE"], 'img-thumbnail ');
                                        ?>
                                    </a>
                                </div>
                                <div class="product-content flex-grow-1 d-flex flex-column">
                                    <h3><a class="text-decoration-none" href="<?= base_url() . '/Visiteur/voir_un_produit/' . $unProduit["NOPRODUIT"] ?>"><?php echo $unProduit["LIBELLE"] ?></a>
                                        <?php if ($session->get('statut') == 3) { ?>
                                            <a href="<?php echo site_url('AdministrateurSuper/Vitrine/' . $unProduit["NOPRODUIT"]);  ?>"><?php if ($unProduit['VITRINE'] == 1) {
                                                                                                                                            echo "<i class='fas fa-star fav'></i>";
                                                                                                                                        } else {
                                                                                                                                            echo "<i class='far fa-star fav'></i>";
                                                                                                                                        } ?> </a>
                                        <?php } ?>
                                    </h3>
                                    <div class="price">
                                        <?php echo number_format((($unProduit["PRIXHT"]) + ($unProduit["TAUXTVA"])), 2, ",", ' '), '€' ?>
                                    </div>
                                    <?php if ($session->get('statut') == 3) {
                                        if ($unProduit["DISPONIBLE"] == 0) {
                                    ?>
                                            <a class="disponible mt-auto" href="<?php echo site_url('AdministrateurSuper/rendre_disponible/' . $unProduit["NOPRODUIT"]);  ?>">Rendre disponible</a>
                                        <?php } else { ?>

                                            <a class="indisponible mt-auto" href="<?php echo site_url('AdministrateurSuper/rendre_indisponible/' . $unProduit["NOPRODUIT"]);  ?>">Rendre indisponible</a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if ($unProduit["DISPONIBLE"] == 0) {
                                            echo 'Rupture de stock..';
                                        } ?>
                                        <!-- <br /> -->
                                        <a class="add-to-cart btn btn btn-primary mt-auto <?php if ($unProduit["DISPONIBLE"] == 0) {
                                                                                                                echo 'disabled';
                                                                                                            } ?>" href="<?php echo site_url('Visiteur/ajouter_au_panier/' . $unProduit["NOPRODUIT"]);  ?>">Ajouter au panier</a>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>


                     <?php //if ($count % 4 == 0) {
                            //echo '</div><br/><hr/><br/><div class="row">';
                        //}
                    } ?>
                <!-- </div> -->

            </div>

            <p><?= $pager->links() ?></p>

        </div>



    </div>
</div>