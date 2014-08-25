<?php
    if (isset($_GET['hash'], $_GET['id'])) {
      q("
            UPDATE  `users` SET
            `password` = '".myHash($_SESSION['reset_pass'])."'
            WHERE `hash` = '".es($_GET['hash'])."' AND `id` = '".(int)$_GET['id']."'

        ");
       unset($_SESSION["reset_pass"]);

         $_SESSION["info"]  = "Вы успешно обновили свой пароль";
         $_SESSION["inf_class"] = $alerts['info'];
    }
?>
