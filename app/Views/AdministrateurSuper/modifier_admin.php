<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <br>
                    <?= form_open('AdministrateurSuper/modifier_admin/'.$admin['IDENTIFIANT']) ?>
                        <label class="text-primary" for="txtIdentifiant">Identifiant</label>
                        <input class="form-control" type="input" name="txtIdentifiant" value="<?= $admin['IDENTIFIANT'] ?>" readonly/>

                        <label class="text-primary" for="txtMdp">Mot de passe</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control me-2" type="password" name="txtMdp" value="">
                            <div class="input-group-addon d-flex align-items-center">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        
                        <label class="text-primary" for="txtEmail">email</label>
                        <input class="form-control" type="input" name="txtEmail" value="<?= $admin['EMAIL'] ?>" /><br>

                        <input class="btn btn-primary btn-md" type="submit" value="Valider">
                        <a class="btn btn-primary btn-md float-right" type="button" href="<?= site_url('AdministrateurSuper/lister_admin') ?>">Retour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>