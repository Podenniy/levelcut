<?php
if (isset($_POST['email'])) {
  $errors = array();
  if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
     $errors['email'] = "<div class='alert alert-danger'>Заполните поле email</div>";
  }

  $res = q( "
              SELECT  *
              FROM `users` WHERE
              `email`        = '".es($_POST['email'])."' AND
              `active`      = 1
              LIMIT 1
            ");
   if (!$res->num_rows ) {
          $_SESSION["info"]  = "У нвс   нет пользователя с  таким  email";
            $_SESSION["inf_class"] = $alerts["warning"];
          header("location:/cab/reset_password");
          exit();
        }else {
            $row = $res->fetch_assoc();
          if (!count($errors)) {
           $res_pass = "";
           $res_pass = genpass($res_pass);
             $_SESSION["reset_pass"] = $res_pass;
            Mail::$to           = $row['email'];
            Mail::$subject   = "Востановление пароля";
            Mail::$message =' Ваш новый пароль ' .$_SESSION["reset_pass"]. ' Пройдите по ссылке для активации вашего нового пароля http// '.Core::$DOMAIN.'/cab/activate_new_pass&id='.$row['id'].'&hash='.$row['hash'];
            Mail::send();
            $res->close();
          }

        }
}

?>