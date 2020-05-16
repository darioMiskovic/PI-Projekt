<?php
 
include ("../backend/includes/funkcije.inc.php"); 

$from = $_POST["from"];
$to = $_POST["to"];

$reqArr = getRequest($to,$konekcija);
$sendArr = getSendRequest($from,$konekcija);



if($reqArr == null || $reqArr == false){
    requested($to,$from,$konekcija);
}else{
    $arr = array();
    array_push($arr,$reqArr[0]);
    array_push($arr,$_POST["from"]);

    //arr -> str
    $strArr = implode(",",$arr);
    
    updatetRequest($strArr,$to,$konekcija);
}

if($sendArr == null || $sendArr == false){

    sendRequest($from,$to,$konekcija);
}else{
    

    $arr = array();
    array_push($arr, $sendArr[0]);
    array_push($arr,$_POST["to"]);

    //arr -> str
    $strArr = implode(",",$arr);
    updatetSendRequest($strArr,$from,$konekcija);
}






