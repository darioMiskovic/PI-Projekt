<?php
session_start();
include ("dbh.inc.php");


function dodaj_korisnika ($ime, $prezime,$kor_ime, $email, $lozinka, $konekcija){
    $sql = "INSERT INTO users VALUES (null,?,?, ?, ?, ?)";
    $upit = $konekcija->prepare($sql);
    
    return $upit->execute([$ime, $prezime,$kor_ime, $email, md5($lozinka)]);
}

function prijavi_korisnika ($kor_ime, $lozinka, $konekcija) {
    $sql = "SELECT * FROM users WHERE kor_ime=? AND lozinka=?";
    $upit = $konekcija->prepare($sql);
    $upit->execute([$kor_ime, md5($lozinka)]);
    $korisnik = $upit->fetch();
    if(!isset($korisnik["kor_ime"])) return false;
    $_SESSION["kor_ime"] = $kor_ime;
    $_SESSION["lozinka"] = md5($lozinka);
   
    return true;
}

function provjeri_korisnika($konekcija){
    $sql = "SELECT * FROM users WHERE kor_ime=? AND lozinka=?";
    $upit = $konekcija->prepare($sql);
    if (!isset($_SESSION["lozinka"])) return false;
    $upit->execute(
        [$_SESSION["kor_ime"], $_SESSION["lozinka"]]
    );
    $korisnik = $upit->fetch();
    if(!isset($korisnik["kor_ime"])) return false;
    return $korisnik;
}

function korisničko_ime(){
   echo($_SESSION['kor_ime']);
   
}

/*Friend Requests */


function sendRequest($sendFrom,$sendTo,$konekcija){
    $sql = "INSERT INTO sendreq VALUES (null, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$sendFrom, $sendTo]);

}
function requested($sendTo,$sendFrom,$konekcija){
    $sql = "INSERT INTO received VALUES (null, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$sendTo, $sendFrom]);
}

//get data

function getRequest($toUser,$konekcija){
    $sql = "SELECT from_user FROM received WHERE to_user = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$toUser]);
     $friendReq = $upit->fetch();
     return $friendReq;
}

function getSendRequest($sendFrom,$konekcija){
    $sql = "SELECT to_user FROM sendreq WHERE from_user = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$sendFrom]);
     $friendReq = $upit->fetch();
     return $friendReq;
}

//delete
function deleteReceived($toUser,$konekcija){
    $sql = "DELETE  FROM received WHERE to_user = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$toUser]);
     
}

function deleteSendRequest($fromUser,$konekcija){
    $sql = "DELETE  FROM sendreq WHERE from_user = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$fromUser]);
     
}

//update
function updatetRequest($sendFrom,$toUser,$konekcija){
    $sql = "UPDATE received SET from_user= ? WHERE to_user = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$sendFrom,$toUser]);
    
}

function updatetSendRequest($toUser,$sendFrom,$konekcija){
    $sql = "UPDATE  sendreq SET to_user= ? WHERE from_user = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$toUser,$sendFrom]);
     
}




function addFriend($mainUser,$newFriend,$konekcija){
    $sql = "INSERT INTO friends_list VALUES (null,?,?)";
    $upit = $konekcija->prepare($sql);
    
     $upit->execute([$mainUser,$newFriend]);
}

function getFriends($korisnik,$konekcija){
    $sql = "SELECT friends FROM  friends_list  WHERE kor_ime = ?";
    $upit = $konekcija->prepare($sql);
    
     $upit->execute([$korisnik]);
     $friendList = $upit->fetch();
     return $friendList;
}

function updateFriendsList($newFriend,$korisnik,$konekcija){
    $sql = "UPDATE  friends_list SET friends= ? WHERE kor_ime = ?";
    $upit = $konekcija->prepare($sql);
     $upit->execute([$newFriend,$korisnik]);
}




?>



