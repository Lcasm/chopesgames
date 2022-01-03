<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/images/favicon.ico' ?>">
  <title>ChopesGames</title>

</head>

<body>

  <div class="container">

    <h2>Oups!</h2>
    <h1>404</h1>

    <?php if (!empty($message) && $message !== '(null)') : ?>
      <?= esc($message) ?>
    <?php else : ?>
      Désolé ! Page inconnue.
    <?php endif ?>
<br><br>
    <a href="<?php echo site_url('Visiteur/accueil') ?>">Retouner à l'accueil</a>

  </div>

</body>

</html>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: "montserrat", sans-serif;
    min-height: 100vh;
    background-image: linear-gradient(125deg, #6a89cc, #b8e994);
  }



  .container {
    width: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    color: #343434
  }

  .container h1 {
    font-size: 160px;
    margin: 0;
    font-weight: 900;
    letter-spacing: 20px;
    background: url(<?= base_url() . '/assets/images/404.jpg' ?>) center no-repeat;
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
  }


  .container a {
    text-decoration: none;
    background: #e55039aa;
    color: #fff;
    padding: 12px 24px;
    display: inline-block;
    border-radius: 25px;
    font-size: 14px;
    text-transform: uppercase;
    transition: 0.4s;
  }



  .container a:hover {
    background: #e55039;
  }
</style>