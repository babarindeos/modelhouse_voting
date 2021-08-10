<?php
    $link = "../config/init_wp.php";
    //$config_path = str_replace("\\","/", ((substr(realpath($link), (strpos(realpath($link),"workforce_ogun")+9)))));

    // require_once("../".$config_path);
    //require_once($link);
    $config_path = str_replace("\\","/", ((substr(realpath($link), (strpos(realpath($link),"siwes")+5)))));
    require_once("../".$config_path);

 ?>
