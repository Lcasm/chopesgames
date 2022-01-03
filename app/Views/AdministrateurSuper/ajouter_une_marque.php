<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <br>
                    <?= form_open('AdministrateurSuper/ajouter_une_marque') ?>
                        <label class="text-primary" for="txtcategorie">Nom de la marque</label>
                        <input class="form-control" type="input" name="txtmarque" value="<?php //echo set_value('txtcategorie', $txtcategorie); ?>" /><br />
                        <input class="btn btn-primary btn-md" type="submit" value="Ajouter la marque"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>