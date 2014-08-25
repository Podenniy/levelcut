<?php
if (isset($_SESSION['user'])) {
  $res = q("
        SELECT *
        FROM `users`
        WHERE `id` = ".$_SESSION['user']['id']."
        LIMIT 1

    ");

    $_SESSION['user'] = mysqli_fetch_assoc($res);

    if ($_SESSION['user']['active'] != 1 ) {
       header("Location: index.php?module=cab&page=exit");
        exit();
     }

} elseif (isset($_COOKIE["us_hash"]) ){
   $res = q("
        SELECT *
        FROM `users`
        WHERE `id` = ".$_COOKIE["us_id"]." AND  `hash` = '".$_COOKIE["us_hash"]."'
        LIMIT 1
    ");

    if (!mysqli_num_rows($res)){
      $_SESSION["info"]  = "Видимо что то случилось напишите админу и он с вами свяжеться";
      $_SESSION["inf_class"] = $alerts["warning"];
      setcookie("us_hash", "", time() -3600, "/" );
      setcookie("us_id", "", time() -3600, "/" );
      header("Location: index.php?module=cab&page=exit");
      exit();
    }else {
      $_SESSION['user'] = mysqli_fetch_assoc($res);
      $_SESSION["info"]  = "Вы успешно авторизировались";
      $_SESSION["inf_class"] = $alerts["info"];

    }

}

/////////////////////////////////////////////////////////////////////////////
?>