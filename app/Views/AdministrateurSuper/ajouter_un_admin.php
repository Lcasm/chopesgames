<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <br>
                    <?= form_open('AdministrateurSuper/ajouter_un_admin') ?>
                        <label class="text-primary" for="txtIdentifiant">Identifiant</label>
                        <input class="form-control" type="input" name="txtIdentifiant" value="<?php //echo set_value('txtcategorie', $txtcategorie); ?>" /><br />

                        <label class="text-primary" for="txtMdp">Mot de passe</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="txtMdp" value="<?php //echo set_value('txtcategorie', $txtcategorie); ?>">
                            <div class="input-group-addon d-flex align-items-center">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a><br>
                            </div>
                        </div>
                        
                        <label class="text-primary" for="txtEmail">email</label>
                        <input class="form-control" type="input" name="txtEmail" value="<?php //echo set_value('txtcategorie', $txtcategorie); ?>" /><br />

                        <input class="btn btn-primary btn-md" type="submit" value="Valider"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>