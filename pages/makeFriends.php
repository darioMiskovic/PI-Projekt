<?php
 
include ("../backend/includes/funkcije.inc.php"); 

$friend = $_POST["friend"];
$korisnik = $_SESSION['kor_ime'];

$korFriends = getFriends($korisnik,$konekcija);
$friendFriends = getFriends($friend,$konekcija);

if($korFriends == null){
   addFriend($korisnik,$friend,$konekcija);
}else{
    $friendArr = explode(',',$korFriends['friends']);
    array_push($friendArr,$friend);
    $newFriendsList = implode(',',$friendArr);
    updateFriendsList($newFriendsList,$korisnik,$konekcija);
    
    
}

if($friendFriends == null){
    addFriend($friend,$korisnik,$konekcija);
 }else{
    $friendArr = explode(',',$friendFriends['friends']);
     array_push($friendArr,$korisnik);
     $newFriendsList = implode(',',$friendArr);
    updateFriendsList($newFriendsList,$friend,$konekcija);
    
 }

