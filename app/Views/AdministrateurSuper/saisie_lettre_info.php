<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <br>
                    <?= form_open('AdministrateurSuper/saisie_lettre_info') ?>
                        <label class="text-primary" for="txtobjet">Objet:</label>
                        <input class="form-control" type="input" name="txtobjet" value="<?php //echo set_value('txtobjet', $txtcategorie); ?>" /><br />
                        <label class="text-primary" for="txttitre">Titre:</label>
                        <input class="form-control" type="input" name="txttitre" value="<?php //echo set_value('txtobjet', $txtcategorie); ?>" /><br />
                        <label class="text-primary" for="txtmessage">Message:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="txtmessage"><?php //echo set_value('txtobjet', $txtcategorie); ?></textarea><br>
                        <input class="btn btn-primary btn-md" type="submit" value="Ajouter la catégorie"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>