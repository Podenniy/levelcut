<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Kiev');
session_start();
//// Kонфиг
include_once "./config.php";
include_once './libs/defoult.php';

include_once './variables.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
ob_start();
    include "./".Core::$CONT."/all_pages.php";
    include "./modules/cab/authorization.php";
    if (!file_exists("./modules/".$_GET['module']."/".$_GET['page'].".php" ) || !file_exists("./skins/".Core::$SKIN."/".$_GET['module']."/".$_GET['page'].".tpl")) {
      header("Location: /404");
      exit();
    }
    include "./".Core::$CONT."/".$_GET['module']."/".$_GET['page'].".php";
    include "./skins/".Core::$SKIN."/".$_GET['module']."/".$_GET['page'].".tpl";
    $content = ob_get_contents();
ob_get_clean();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
include "./skins/".Core::$SKIN."/index.tpl";

?>
