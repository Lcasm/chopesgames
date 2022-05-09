<div class="d-flex flex-column align-items-center">
    <br>
    <h2 class="text-primary text-center"><?php echo $TitreDeLaPage ?></h2>
    <br>
    <ul class="list-group col-6">
    <?php $nb = 0; foreach($admins as $admin){ ?>
       <li class="d-flex align-items-center flex-column flex-md-row text-center text-md-start list-group-item <?php if($nb%2 == 0){echo 'list-group-item-dark';} ?>">
            <label class="col-sm-3 m-2"><?= $admin['IDENTIFIANT'] ?></label>
            <a class="btn btn-primary col-sm-4 m-2" href="<?= site_url('AdministrateurSuper/modifier_admin/'.$admin['IDENTIFIANT']) ?>">Modifier</a>
            <a class="btn btn-primary col-sm-4 m-2" href="<?= site_url('AdministrateurSuper/supprimer_admin/'.$admin['IDENTIFIANT']) ?>">Supprimer</a>
       </li> 
    <?php $nb++; } ?>
    </ul>
</div>