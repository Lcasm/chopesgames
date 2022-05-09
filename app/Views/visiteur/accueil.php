<h2 class='text-center'>Accueil</h2>
<hr />
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-sm categorie">
      <h3>Catégorie:</h3>
      <?php foreach ($categories as $categorie) {
        echo '<h4 >' . anchor('Visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"], "class=\"text-decoration-none\"") . '</h4>'; ?><?php } ?>
      <hr />
    </div>
    <div id="carousel" class="col-sm-6">
      <div class="container" style="width:320px;height:380px;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <?php $countcarousel = 0;
            foreach ($vitrines as $vitrine) : $countcarousel++; ?>
              <button type="button" data-bs-target="#carouselExampleIndicators" <?php if ($countcarousel === 1) : ?> class="active" <?php endif ?> data-bs-slide-to="<?php echo $countcarousel - 1 ?>"></button>
            <?php endforeach; ?>
          </div>
          <div class="carousel-inner">
            <?php $count = 0;
            $indicators = '';
            foreach ($vitrines as $vitrine) :
              $count++;
              if ($count === 1) {
                $class = 'active';
              } else {
                $class = '';
              } ?>
              <div class="carousel-item <?php echo $class; ?>">
                <a href="<?= base_url() . '/Visiteur/voir_un_produit/' . $vitrine["NOPRODUIT"] ?>">
                  <?= img_class($vitrine["NOMIMAGE"] . '.jpg', $vitrine["LIBELLE"], 'd-block'); ?>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </button>
          <button class="carousel-control-next" data-bs-target="#carouselExampleIndicators" type="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </button>
        </div>
      </div>
    </div>
    <div class="col-sm-3 marque">
      <h3>Marque:</h3>
      <?php foreach ($marques as $marque) {
        echo '<h4 >' . anchor('Visiteur/lister_les_produits_parmarque/' . $marque["NOMARQUE"], $marque["NOM"], "class=\"text-decoration-none\"") . '</h4>'; ?><?php } ?>
      <hr />
    </div>
  </div>

</div>