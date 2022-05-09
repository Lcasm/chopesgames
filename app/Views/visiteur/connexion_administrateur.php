<div  class='container'>
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
      <br>
      <h2 class="text-center text-primary"><?php echo $TitreDeLaPage ?></h2>
      <?php
        $attributes = [
            'class' => 'text-primary',
        ];
        echo service('validation')->listErrors();
        echo form_open('visiteur/connexion_administrateur');
        echo form_label('Identifiant','txtIdentifiant', $attributes);
        echo form_input('txtIdentifiant', set_value('txtIdentifiant'), "class='col-md-3 form-control'");    
        echo form_label('Mot de passe','txtMotDePasse', $attributes);
        echo form_password('txtMotDePasse', set_value('txtMotDePasse'), "class='form-control col-md-3'"); 
      ?>
      <br>
      <?= form_submit('submit', 'Se connecter', "class='btn btn-primary'"); ?> 
      <br/><br/>
      <?= form_close();?>
    </div>
  </div>
</div>