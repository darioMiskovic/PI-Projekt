<?php
     session_start();
    include ("funkcije.inc.php");

    $userName = ($_POST["userName"]);

   $getInfo =  userInfo($userName, $konekcija);
  

   $_SESSION["userInfoName"] =  $userName;
   $_SESSION["userInfoArr"] = json_encode($getInfo);

   