<?php
  if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
     include './skins/default/cab/authorization.tpl';
  //echo myHash("levelcutlevelcutneo123");
 //echo $_SESSION['info'];
 } else {
 ?>


  <div class="container">

    <div class="jumbotron">
        <h1>JVerwaltungs-Panel</h1>
        <p class="lead">Verwaltungsbereich für die Bearbeitung während nur Seiten in der Zukunft ist es möglich, dass noch etwas anderes hinzufügen</p>
        <p><a class="btn btn-lg btn-success" href="/admin/articles" role="button">gehen, um Web-Seiten zu bearbeiten</a></p>
      </div>
  </div>






























 <?php }?>
