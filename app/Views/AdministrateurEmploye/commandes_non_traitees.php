
    <div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                    <div class="container col-md-5">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    
                                <th width="25%">Date de commande</th>
                                <th width="20%">Client</th>
                                <th width="15%">Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($commandes as $commande){?>
                                    <tr onclick="window.location.href = '<?= site_url('AdministrateurEmploye/details_commande/'.$commande['NOCOMMANDE']) ?>'">
                                        <td><?= $commande['DATECOMMANDE'] ?></td>
                                        <td><?= $commande['NOM']; echo ' '.$commande['PRENOM'];?></td>
                                        <td> <?= $commande['TOTALTTC'].'€';?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>