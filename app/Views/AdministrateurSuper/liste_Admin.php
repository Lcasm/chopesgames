<div>
    <br>
    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
    <br>
    <ul class="list-group">
    <?php foreach($admins as $admin){ ?>
       <li class="list-group-item">
            <?= $admin['IDENTIFIANT'] ?> &emsp; &emsp;
            <a class="btn btn-primary" href="<?= site_url('AdministrateurSuper/modifier_admin/'.$admin['IDENTIFIANT']) ?>">Modifier</a> &emsp; &emsp;
            <a class="btn btn-primary" href="<?= site_url('AdministrateurSuper/supprimer_admin/'.$admin['IDENTIFIANT']) ?>">Supprimer</a>
       </li> 
    <?php } ?>
    </ul>
</div>