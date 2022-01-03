<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <?php if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors();
                    echo form_open_multipart('AdministrateurSuper/ajouter_un_produit');
                    ?>
                    <br>
                    <label class="text-primary" for="Categorie">Categorie:</label>
                    <select name="Categorie">
                        <?php foreach ($categories as $uneCategorie) : ?>
                            <option value="<?php echo $uneCategorie['NOCATEGORIE']; ?>" <?php if (set_value('Categorie') == $uneCategorie['NOCATEGORIE']) echo 'selected'; ?>><?php echo $uneCategorie['LIBELLE'] ?></option>
                        <?php endforeach;
                        ?>
                    </select> <br />

                    <label class="text-primary" for="Marque">Marque:</label>
                    <select name="Marque">
                        <?php foreach ($marques as $uneMarque) : ?>
                            <option Value="<?php echo $uneMarque['NOMARQUE']; ?>" <?php if (set_value('Marque') == $uneMarque['NOMARQUE']) echo 'selected'; ?>><?php echo $uneMarque['NOM'] ?></option>

                        <?php endforeach; ?>

                    </select> <br />

                    <label class="text-primary" for="txtLibelle">Libelle:</label>
                    <input class="form-control" type="input" name="txtLibelle" value="<?php echo set_value('txtLibelle'); ?>" /><br />

                    <label class="text-primary" for="txtDetail">Detail:</label>
                    <textarea class="form-control" type="input" class="form-control" name="txtDetail"><?php echo set_value('txtDetail'); ?></textarea><br />

                    <label class="text-primary" for="txtPrixHT">Prix HT:</label>
                    <input class="form-control" type="input" name="txtPrixHT" value="<?php echo set_value('txtPrixHT'); ?>" /><br />

                    <label class="text-primary" for="txtNomimage">Nom image:</label>
                    <input class="form-control" type="input" name="txtNomimage" value="<?php echo set_value('txtNomimage'); ?>" /><br />

                    <label class="text-primary" for="fileimage">Image: </label><br />
                    <input type="file" name="image" /><br />
                    <label class="text-primary" for="txtQuantite">Quantite:</label>
                    <input class="form-control" type="input" name="txtQuantite" value="<?php echo set_value('txtQuantite'); ?>" /><br />

                    <input class="btn btn-primary btn-md" type="submit" name="submit" value="Ajouter un produit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>