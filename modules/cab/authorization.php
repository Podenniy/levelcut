<?php
if (isset($_POST['auth']) ){
        if (empty($_POST["login"])) {
            $errors["login"] = "<div class=' ath_error alert alert-danger'>Füllen Sie das Login-Feld</div>";
        }

        if (empty($_POST["password"])) {
            $errors["password"] = "<div class=' ath_error alert alert-danger'>Füllen Sie das Passwortfeld</div>";
        }

          $res = q( "
              SELECT  *
              FROM `users` WHERE
              `login`        = '".es($_POST['login'])."' AND
              `password` = '".myHash($_POST['password'])."' AND
              `active`      = 1
              LIMIT 1
            ");


            if (!$res->num_rows) {
              $res->close();
              $_SESSION["info"] = "Wir haben kein solches Recht User-Login oder registrieren !!!!";

            }else{
              if (!isset($_POST['save_cooce'])) {
                  $_SESSION['user'] = $res->fetch_assoc();
                  $res->close();
                  $_SESSION["info"]  = "Вы успешно авторизировались";
                  $_SESSION["inf_class"] = $alerts["info"];
                  header("Location: /admin");
                  exit();
              }else{
                  $user = $res->fetch_assoc();
                  setcookie("us_id", $user['id'], time()+3600 *20, "/");
                  $_COOKIE["us_id"] = $user['id'];
                  $hash_us = myHash($user['password'].$user['login'].$user['email']);
                  setcookie("us_hash", $hash_us, time()+3600 *20, "/");
                   $_COOKIE["us_hash"] = $hash_us;
                  $res_up = q( "
                     UPDATE  `users` SET
                    `hash` = '".es($hash_us)."'
                     WHERE `id` = '".(int)$_COOKIE["us_id"]."'

                   ");

                    $_SESSION["info"]  = "Вы успешно авторизировались";
                    $_SESSION["inf_class"] = $alerts["info"];
                     header("Location: /admin");
                     exit();
                 }
             }
    }
?>