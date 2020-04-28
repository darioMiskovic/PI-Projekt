<?php
    session_start();
    include ("funkcije.inc.php");
    
    
        $lastIDs = (provjeri_id($konekcija));
        if($lastIDs){
           
            //pretvori string u array 
            $ids = explode(",",$lastIDs);
   
            $index = array_search($_POST["imdbID"],$ids);
            array_splice($ids, $index, 1);
            //arr -> str
            $strIds = implode(",",$ids);

            update_imdbid(
            $strIds,
            $_SESSION['kor_ime'],
            $konekcija
            );
           
        }
    
?>