<body style='font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;text-align: left;'>
    <div style="height:2px; background-color:black;"></div>
    <h1 style="text-align: center !important;font-size: 2.5rem;font-weight: 500;line-height: 1.2;"><?= $titre ?></h1>
    <div style="height:3px; background-color:black;margin-bottom:5px;"></div>
    <div style="margin-bottom: 1rem !important;display: flex !important;">
        <div style="width:5px;margin: .25rem !important;background-color: #007bff !important;"></div>
        <div style="margin-right: auto !important;padding-top: .5rem !important;">
            <div>
                <p style="margin: 0 !important;">Facturer à:</p>
                <p style="margin: 0 !important;"><?= $client['NOM'].' '.$client['PRENOM']?></p>
                <p style="margin: 0 !important;"><?= $client['ADRESSE'].' '.$client['VILLE'].' '.$client['CODEPOSTAL'] ?></p>
                <p style="margin: 0 !important;"><?= $client['EMAIL'] ?></p>
            </div>
        </div>
        <div class="p-2 bd-highlight" style="padding: .5rem !important;">
            <h1 style="margin: 0px;color: #007bff !important;font-size: 2.5rem;font-weight: 500;line-height: 1.2;">FACTURE</h1>
            <p style="margin: 0 !important;">Facture n°<?= $commande['NOCOMMANDE'] ?></p>
            <p style="margin: 0 !important;">Date de commande <?= $commande['DATECOMMANDE'] ?></p>
        </div>
    </div>
    <div style="max-width: 540px;width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
        <div style="display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #28a745 !important;-webkit-box-flex: 0;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                #
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #6c757d !important;-webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                Produit
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;-webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                Prix HT
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #6c757d !important;-webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                Quantité
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #28a745 !important;-webkit-box-flex: 0;-ms-flex: 0 0 16.666667%;flex: 0 0 16.666667%;max-width: 16.666667%;    position: relative;    width: 100%;    min-height: 1px;    padding-right: 15px;    padding-left: 15px;">
                Total
            </div>
        </div>
        <?php $total=0;$compteur=1; foreach($produits as $produit){ ?>
        <div style="display: -webkit-box;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #28a745 !important;-webkit-box-flex: 0;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                #<?= $compteur ?>
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #6c757d !important;-webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                <?= $produit['LIBELLE'] ?>
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;-webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                <?= number_format($produit['PRIXHT'], 2, ",", ' '), '€' ?>
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #6c757d !important;-webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                <?= $produit['QUANTITECOMMANDEE'] ?>
            </div>
            <div style="box-sizing: border-box;border-color: #343a40 !important;border: 1px solid #dee2e6 !important;background-color: #28a745 !important;-webkit-box-flex: 0;-ms-flex: 0 0 16.666667%;flex: 0 0 16.666667%;max-width: 16.666667%;    position: relative;    width: 100%;    min-height: 1px;    padding-right: 15px;    padding-left: 15px;">
                <?= number_format((($produit["PRIXHT"]) + ($produit["TAUXTVA"]))*$produit['QUANTITECOMMANDEE'], 2, ",", ' '), '€' ?>
            </div>
        </div>
        <?php $compteur++; $total+=(($produit["PRIXHT"]) + ($produit["TAUXTVA"]))*$produit['QUANTITECOMMANDEE']; } ?>
    </div>


    <div style="max-width: 540px;width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
        <div style="display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div style="box-sizing: border-box;-webkit-box-flex: 0;-ms-flex: 0 0 75%;flex: 0 0 75%;max-width: 75%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
            </div>
            <div style="box-sizing: border-box;-webkit-box-flex: 0;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                Total
            </div>
            <div style="box-sizing: border-box;-webkit-box-flex: 0;-ms-flex: 0 0 16.666667%;flex: 0 0 16.666667%;max-width: 16.666667%;position: relative;width: 100%;min-height: 1px;padding-right: 15px;padding-left: 15px;">
               <?= number_format($total, 2, ",", ' '), '€' ?> 
            </div>
        </div>
    </div>
    Merci !
</body>
