

<h2 class='titrepage'>Accueil</h2><hr/> 
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-10">
    <div class="container">
<div class="container" style="width:300px;height:380px;">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php $countcarousel=0; foreach($vitrines as $vitrine): $countcarousel++;?>
        <li data-target="#carouselExampleIndicators" <?php if($countcarousel===1): ?> data-slide-to="0" class="active" <?php else: ?> data-slide-to="<?php echo $countcarousel-1 ?>"<?php endif ?>></li>
        <?php endforeach;?>
      </ol>
      <div class="carousel-inner">
          <?php $count = 0; 
              $indicators = ''; 
              foreach ($vitrines as $vitrine): 
              $count++; 
              if ($count === 1) 
              { 
                  $class = 'active'; 
              } 
              else 
              { 
                  $class = ''; 
              }?> 
          <div class="carousel-item <?php echo $class; ?>">
            <a href="<?= base_url().'/index.php/Visiteur/voir_un_produit/'.$vitrine["NOPRODUIT"]?>">
            <?= img_class($vitrine["NOMIMAGE"] . '.jpg', $vitrine["LIBELLE"], 'd-block'); ?>
            </a>
          </div>
          <?php endforeach;?> 
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        
  </div>
</div>

</div>
</div>
<div class="col-sm-2 marque">
<h3>Marque:</h3>
<?php foreach ($marques as $marque){ echo '<h4>'.anchor('Visiteur/lister_les_produits_parmarque/'.$marque["NOMARQUE"],$marque["NOM"]). '</h4>'; ?><?php } ?>
<hr/> 
</div>
</div>

</div>



