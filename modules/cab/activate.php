<?php
    if (isset($_GET['hash'], $_GET['id'])) {
      q("
            UPDATE  `users` SET
            `active` = 1
            WHERE `hash` = '".es($_GET['hash'])."' and `id` = '".(int)$_GET['id']."'

        ");

       $_SESSION["info"]  = "Поздравляем вы активировали свой аккаун можете заходить под своим поролем и логином";
       $_SESSION["inf_class"] = $alerts['info'];
      header("Location:");

    }else {
      $info ="<div class='alert alert-danger'>Вы прошли по неверной ссылке</div>";
    }
?>