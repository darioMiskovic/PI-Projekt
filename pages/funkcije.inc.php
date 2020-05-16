<?php 

include("../backend/includes/dbh.inc.php");


function dodaj_imdbid ($kor_ime, $movie_id, $konekcija){
    $sql = "INSERT INTO imdbid VALUES (null, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$kor_ime, $movie_id]);
}

function update_imdbid ( $movie_id,$kor_ime, $konekcija){
    $sql = "UPDATE imdbid SET movie_id= ? WHERE kor_ime = ?";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([ $movie_id,$kor_ime]);
}

function userInfo($userName,$konekcija){
    $sql = "SELECT  movie_id FROM imdbid WHERE kor_ime =?" ;
    $upit = $konekcija->prepare($sql);
    $upit->execute([$userName]);
    $korisnik = $upit->fetch();
    return $korisnik[0];
    
}


function provjeri_korisnika2($konekcija){
    $sql = "SELECT id FROM imdbid WHERE kor_ime =?" ;
    $upit = $konekcija->prepare($sql);
    $upit->execute([$_SESSION['kor_ime']]);
    $korisnik = $upit->fetch();
    return $korisnik;
    
}

function provjeri_id($konekcija){
    $checkID = provjeri_korisnika2($konekcija);
    if($checkID >= 1){
    $sql = "SELECT movie_id FROM imdbid WHERE kor_ime =?" ;
    $upit = $konekcija->prepare($sql);
    $upit->execute([$_SESSION['kor_ime']]);
    $id = $upit->fetch();
    
   return $id[0];
    }else{
        return 'noID';
    }
   
    
    
}

function provjeriDuplikat($id,$str){
    
    return $pos=strpos($str,$id);

    
}



?>