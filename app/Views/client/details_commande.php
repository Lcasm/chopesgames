

    
    <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-md-7 col-sm-12">
    
        <div class="row align-items-center">
        <h2>Commande n°<?php echo $commande["NOCOMMANDE"]; ?></h2>
            <table class="table">

                <tr>
                        <th></th>
                        <th width="30%">Produit</th>
                        <th width="15%">Prix HT</th>
                        <th width="15%">TVA</th>
                        <th width="13%">Quantité</th>
                        <th width="25%">Total produit</th>
                </tr>
                <?php if(!empty($lignes)){foreach ($lignes as $produit):?>
        <tr>
        <td>
                <?php if(!empty($produit["NOMIMAGE"])){ ?>
                <a href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit["NOPRODUIT"]?>"><img src="<?= base_url().'/assets/images/'.$produit["NOMIMAGE"].'.jpg'?>" width="80"/></a>
                <?php } else{?>
                    <a href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit["NOPRODUIT"]?>"><img src="<?= base_url().'/assets/images/nonimage.jpg'?>" width="80"/></a>
                <?php } ?>
            </td>
                <td><a  href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit["NOPRODUIT"]?>"><?php echo $produit["LIBELLE"]; ?></a></td>
                <td><?php echo $produit["PRIXHT"]; ?>€</td>
                <td><?php echo $produit["TAUXTVA"]; ?></td>
                <td><?php echo $produit["QUANTITECOMMANDEE"]; ?></td>
                <td><?php echo (($produit["PRIXHT"] + $produit["TAUXTVA"]) *$produit["QUANTITECOMMANDEE"]) ; ?>€</td>
                 </tr>

<?php endforeach; } ?>
<tr>
<td colspan='6' class='text-right'><h4>Total: <?php echo $commande["TOTALTTC"]; ?>€</h4></td></tr>
                </table>
            </div>
            </div>
                <span style="display:inline-block; width: 40px;"></span>
                <div class="col-md-3">
                    <div class="border border-secondary">
                    <h3 class="text-center top">Informations client</h3>
                    <table class="table">
                    <tr>
                        <th>Nom:</th>
                        <td><?php echo $commande["NOM"];?></td>
                    </tr>
                    <tr>
                        <th>Prénom:</th>
                        <td><?php echo $commande["PRENOM"];?></td>
                    </tr>
                    <tr>
                        <th>Adresse:</th>
                        <td><?php echo $commande["ADRESSE"];?></td>
                    </tr>
                    <tr>
                        <th>Ville:</th>
                        <td><?php echo $commande["VILLE"];?></td>
                    </tr>
                    <tr>
                        <th>Code Postal:</th>
                        <td><?php echo $commande["CODEPOSTAL"];?></td>
                    </tr>
                    </table>
             </div>
    <div class="col-sm-1">
    </div>
           
        
        
    </div>
</div>
