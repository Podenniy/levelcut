<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title><?php echo hc(Core::$META['title']); ?></title>

    <!-- Bootstrap core CSS -->


    <!-- Custom styles for this template -->
    <link href='/skins/<?php echo Core::$SKIN ; ?>/css/style.css' rel="stylesheet">

 <body>

    <div class="header">

      <div id="logo">
        <img src="./skins/default/img/logo.png" alt="LevelCut"><br>
        <span class="logo-text">DAS VOLUMENWUNDER</span><br>
        &nbsp;<span class="logo-text" id="tr">VON VOLLEREM HAAR</span>
      </div>
     <?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] = 5) { ?>
        <a href="/admin/articles" class=" href_admin">перейти в админку</a>

     <?php } ?>
    <ul class="lang-menu">
        <li>Für Friseure:</li>
        <li><a href="ihr.php">Ihr Weg zu Levelcut</a></li>
        <li><a href="#">Deutsch</a></li>
        <li><a href="#">English</a></li>
        <li><a href="#">Niederländisch</a></li>
      </ul>

      <ul class="main-menu">
        <li><a href="/">Home</a></li>
        <li><a href="/video">Video</a></li>
        <li><a href="/stimmen">Stimmen</a></li>
        <li><a href="/galerie">Galerie</a></li>
        <li><a href="/salons">Salons</a></li>
        <li><a href="/Presse">Presse</a></li>
        <li><a href="/Jobs">Jobs</a></li>
      </ul>

    </div>
    </div>

        <?php echo $content ;?>


        <div class="footer">
      <ul class="footer-menu">
        <li> <a href="/kontakt">Kontakt</a> </li>
        <li> <a href="#">Sonstiges</a> </li>
        <li> <a href="#">Facebook</a> </li>
        <li> <a href="#">Sonstiges</a> </li>
        <li> <a href="#">Sonstiges</a> </li>
        <li> <a href="#">Sonstiges</a> </li>
        <li> <a href="impressum.php">Impressum</a> </li>
      </ul>
    </div>

      </body>

</html>