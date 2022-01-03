 <div class="container">
     <div class="row justify-content-center align-items-center">
         <div class="container col-md-5">
             <h5>Cliquer sur le client pour lister ses commandes.</h5>
             <table class="table table-hover">
                 <thead>
                     <tr>
                         <th width="10%">N° client</th>
                         <th width="15%">Client</th>

                     </tr>
                 </thead>
                 <?php
                    foreach ($clients as $client) { 
                        $id =$client['NOCLIENT']; ?>
                     <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/historique_des_commandes/' . $id) ?>'" class="hover">
                         <td><?php echo $id; ?> </td>
                         <td> <?php echo $client['NOM'];
                                echo ' ' . $client['PRENOM']; ?> </td>
                     </tr>
                 <?php } ?>
             </table>
         </div>
     </div>
 </div>