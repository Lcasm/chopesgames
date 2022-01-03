<div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="col-md-12 container"><br>
                    <h2 class="text-primary">Modifier les identifiants du site</h2>
<br>
<?php
  echo service('validation')->listErrors();
  echo form_open('AdministrateurSuper/modifier_identifiants_bancaires_site');

  echo form_label('Site','txtSite',["text-primary"]);
  echo form_input('txtSite', $identifiant['SITE'],'class="form-control"');  ?> <br /><?php 

  echo form_label('Rang','txtRang',["text-primary"]);
  echo form_input('txtRang', $identifiant['RANG'],'class="form-control"');    ?> <br /><?php

  echo form_label('Identifiant','txtIdentifiant',["text-primary"]);
  echo form_input('txtIdentifiant', $identifiant['IDENTIFIANT'],'class="form-control"'); ?> <br /><?php

  echo form_label('Clé Hmac','txtHmac',["text-primary"]);
  echo form_textarea('txtHmac', $identifiant['CLEHMAC'],'class="form-control textareaidentifiant"');    ?> <br /><?php

  echo form_label('Production', 'CheckboxProduction',["text-primary"]);?><br/>
 
  <label class="switch">
          <input type="checkbox" class="primary" name="checkbox" value="1" <?php if($identifiant['SITEENPRODUCTION']==1){echo 'checked';}?>>
          <span class="slider"></span>
        </label><br/> 
  
  
<?php
  echo form_submit('submit', 'Modifier','class="btn btn-primary btn-md"');
  ?> <br/><br/> <?php
  echo form_close();
  
?>
            </div>
                </div>
            </div>
        </div>
    </div>