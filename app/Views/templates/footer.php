</main>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<div class='container-fluid '>

        	<div class="col-md-3 col-sm-6">
            	<img class="navbar-brand" style="height:64px;" src="<?= base_url().'/assets/images/logo.jpg'?>" alt="Logo">
                <a href="<?php echo site_url('Visiteur/flux_rss') ?>">
                <img class="navbar-brand" style="height:60px;" src="<?= base_url().'/assets/images/rss.png'?>" width="60">
                </a>
                <BR>© Adrien Lorin, 2020 - D. Boucard and co
            </div>
        	<div class="col-md-3 col-sm-6">
            	<h4>Nous contacter</h4>
                <a href='https://www.google.fr/maps/place/Lyc%C3%A9e+Rabelais/@48.5042205,-2.7503218,17z/data=!4m13!1m7!3m6!1s0x480e1d185a2011d3:0xca3c59f0bff91073!2s8+Rue+Rabelais,+22000+Saint-Brieuc!3b1!8m2!3d48.5042205!4d-2.7481331!3m4!1s0x480e1d18e9d8109d:0x739b07353bbf2d23!8m2!3d48.5042841!4d-2.7468056'><i class="fas fa-map-marker-alt"></i> 8 Rue Rabelais, 22000 Saint-Brieuc</a>
                <a href='mailto:master@chopesgames.com'><i class="fas fa-envelope"></i> master@chopesgames.com</a>
                <a href="#"><i class="fas fa-phone"></i> 02 96 00 00 00</a><br/>
            </div>
        	<div class="col-md-3 col-sm-6">
            	<h4>Nous suivre</h4>
                	<a href="https://www.facebook.com/ChopesGamesShop"><i class="fab fa-facebook-square"></i> Facebook</a>
                	<a href="https://www.twitter.com/ChopesGamesShop"><i class="fab fa-twitter-square"></i> Twitter</a>
                	<a href="https://www.Instagram.com/ChopesGamesShop"><i class="fab fa-instagram"></i> Instagram</a><br/>
            </div>
            
        	<div class="col-md-3 col-sm-6">
            	<h4>Lettre d'information</h4>
                <p>Abonnez vous à notre lettre d'inforation pour ne rater aucune nouveauté</p>
                <form action="<?= site_url('AdministrateurSuper/saveAbonnes') ?>" method="post" class="d-flex">
                    <div>
                        <input type="email" name="txtmail" class="form-control" placeholder="votre mail">
                        <?php ?>
                    </div>
                    <div>
                        <button type="submit" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        
        </div>
</nav>
</body>

</html>