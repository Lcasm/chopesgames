 <div class="row">
     <div class="col-sm-1">
     </div>
     <div class="col">

         <div class="row align-items-center">
             <h2>Commande</h2>
             <table class="table">

                 <tr>
                     <th></th>
                     <th width="30%">Produit</th>
                     <th width="15%">Prix</th>
                     <th width="13%">Quantité</th>
                     <th width="25%">Total produit</th>
                 </tr>
                 <?php 
                 $session = session();
                 if ($session->has('cart')) {
                     $items =  array_values(session('cart'));
                     
                 if (count($items) > 0) {
                   $total=0;  
                        foreach ($items as $item) : ?>


                         <tr>
                             <td>
                                 <?php if (!empty($item['image'])) { ?>
                                     <img src="<?= base_url() . '/assets/images/' . $item['image'] . '.jpg' ?>" width="80" />
                                 <?php } else { ?>
                                     <img src="<?= base_url() . '/assets/images/nonimage.jpg' ?>" width="80" />
                                 <?php } ?>
                             </td>
                             <td><?php echo $item['name']; ?></td>
                             <td><?php echo $item['price']; ?>€</td>
                             <td><?php echo  $item['qty']; ?></td>
                             <td><?php echo $item['price']* $item['qty']; $total += $item['price']* $item['qty']; ?>€</td>
                         </tr>


                 <?php endforeach;
                    } }?>
                 <tr>
                     <td><a href="<?php echo site_url('visiteur/afficher_panier'); ?>" class="btn btn-warning">Modifier la commande</a></td>
                     <td colspan="2"></td>
                     <?php if ($total > 0) { ?>
                         <td>
                             <h4>Total: <?php echo $total . '€'; ?></h4>
                         </td>
                         <?php if (!empty($session->get('statut'))) { ?>
                             <td>

                                 <form method="POST" action="<?php echo $serveurOK; ?>">
                                     <input type="hidden" name="PBX_SITE" value="<?php echo $pbx_site; ?>">
                                     <input type="hidden" name="PBX_RANG" value="<?php echo $pbx_rang; ?>">
                                     <input type="hidden" name="PBX_IDENTIFIANT" value="<?php echo $pbx_identifiant; ?>">
                                     <input type="hidden" name="PBX_TOTAL" value="<?php echo $pbx_total; ?>">
                                     <input type="hidden" name="PBX_DEVISE" value="978">
                                     <input type="hidden" name="PBX_CMD" value="<?php echo $pbx_cmd; ?>">
                                     <input type="hidden" name="PBX_PORTEUR" value="<?php echo $pbx_porteur; ?>">
                                     <input type="hidden" name="PBX_REPONDRE_A" value="<?php echo $pbx_repondre_a; ?>">
                                     <input type="hidden" name="PBX_RETOUR" value="<?php echo $pbx_retour; ?>">
                                     <input type="hidden" name="PBX_EFFECTUE" value="<?php echo $pbx_effectue; ?>">
                                     <input type="hidden" name="PBX_ANNULE" value="<?php echo $pbx_annule; ?>">
                                     <input type="hidden" name="PBX_REFUSE" value="<?php echo $pbx_refuse; ?>">
                                     <input type="hidden" name="PBX_HASH" value="SHA512">
                                     <input type="hidden" name="PBX_TIME" value="<?php echo $dateTime; ?>">
                                     <input type="hidden" name="PBX_HMAC" value="<?php echo $hmac; ?>">
                                     <input class="btn btn-success" type="submit" value="Procéder au paiement">
                                 </form>

                             </td>
                     <?php }
                        } ?>
                 </tr>

             </table>
         </div>
     </div>
     <span style="display:inline-block; width: 40px;"></span>
     <div class="col-md-3">
         <div class="border border-secondary">
             <h3 class="text-center top">Information de livraison</h3>
             <table class="table">
                 <tr>
                     <th>Nom:</th>
                     <td><?php echo $client["NOM"]; ?></td>
                 </tr>
                 <tr>
                     <th>Prénom:</th>
                     <td><?php echo $client["PRENOM"]; ?></td>
                 </tr>
                 <tr>
                     <th>Adresse:</th>
                     <td><?php echo $client["ADRESSE"]; ?></td>
                 </tr>
                 <tr>
                     <th>Ville:</th>
                     <td><?php echo $client["VILLE"]; ?></td>
                 </tr>
                 <tr>
                     <th>Code Postal:</th>
                     <td><?php echo $client["CODEPOSTAL"]; ?></td>
                 </tr>
                 <tr>
                     <td class="text-center" colspan="2"><a class="btn btn-info text-center" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Modifier</a></td>
                 </tr>
             </table>
         </div>
     </div>
     <div class="col-sm-1">
     </div>
 </div>