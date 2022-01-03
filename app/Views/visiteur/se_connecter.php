<div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="col-md-12 container">
                        <?php  echo form_open('Visiteur/se_connecter') ?>
                        <br>
                            <h3 class="text-center text-primary"><?php echo $TitreDeLaPage ?></h3>
                            <?PHP if($TitreDeLaPage=='Corriger votre formulaire') echo service('validation')->listErrors(); ?>
                            <div>
                                <label for="txtEmail" class="text-primary">Email</label><br>
                                <input class="form-control" type="input" name="txtEmail" value="<?php echo set_value('txtEmail'); ?>" />
                            </div>
                            <div>
                                <label for="txtMdp" class="text-primary">Mot de passe</label><br>
                                <input class="form-control" type="password" name="txtMdp" id="mdp" value="<?php echo set_value('txtMdp'); ?>" />
                                <input type="checkbox" onclick="Affichermasquermdp()"> Afficher le mot de passe
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary btn-md" value="Valider">
                            <div class="text-primary right">   
                            <a class="btn btn-primary" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Crée un compte</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language=javascript>
     function Affichermasquermdp() {
  var x = document.getElementById("mdp");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 
      </script> 