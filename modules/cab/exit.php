<?php
session_unset();
session_destroy();
if (isset($_COOKIE['us_hash'])) {
  setcookie("us_hash", "", time() -3600, "/" );
  setcookie("us_id", "", time() -3600, "/" );
}
header("Location: / ");
exit();
?>