<?php

if ($_GET['module'] == "staticpage") {

   $m = $staticpage['module'] ;

       switch ($m) {
           case $staticpage['module'] == $m:
              CORE::$META['title']= strtoupper($m);

              $tpl =   $m.".tpl" ;
              $tpl = ta($tpl);
             include $tpl ;
          break;
   }


    //wtf($_GET,1);
}
?>