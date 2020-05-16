<?php
 
include ("../backend/includes/funkcije.inc.php"); 

// $reqUser = $_POST["reqUser"];
$korisnik = $_SESSION['kor_ime'];

if(isset($_POST["reqUser"])){
    $reqUser = $_POST["reqUser"];
    updatetRequest($reqUser,$korisnik,$konekcija);

    $checkReq = getRequest($korisnik,$konekcija);
    $usersArr = explode(',',$checkReq['from_user']);

    if($usersArr[0]==null){
        deleteReceived($korisnik,$konekcija);
    };
    

}

if(isset($_POST["sendUser"])){
    $sendUser = $_POST["sendUser"];
   $users =  getSendRequest($sendUser,$konekcija);
   $usersArr = explode(',',$users['to_user']);
   $key = array_search($korisnik, $usersArr);
   array_splice($usersArr,$key,1);
   $usersString = implode(',',$usersArr);
//    print_r ($usersString);
    updatetSendRequest($usersString,$sendUser,$konekcija);

    $checkReq = getSendRequest($sendUser,$konekcija);
    $usersArr = explode(',',$checkReq['to_user']);

    if($usersArr[0]==null){
        deleteSendRequest($sendUser,$konekcija);
    };
}

 

 
