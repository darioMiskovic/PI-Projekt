<?php
include ("../includes/funkcije.inc.php");

if (isset($_POST["prijava"])) {
    $status = prijavi_korisnika(
        $_POST["kor_ime"],
        $_POST["lozinka"],
        $konekcija
    );

    if ($status == false) {
        $greska = "Neispravni korisnički podaci.";
    } else {
        header("Location: ../../pages/index.php");
        
    }
}


include ('../header.php') 
?>

<div class="landing-page">
     <div class="logo-w">
       <img src="../../img/logo-w.png" alt="">
     </div>

      <div class="login-field">
        
        <form action="index.php" id="form-login" method="POST">
          <h2 class="login">Prijavite se</h2>

          <div class="form-gr">
            <label for="kor-ime">Korisničko ime</label>
            <input type="text" id="kor-ime" name="kor_ime" />
          </div>

          <div class="form-gr">
            <label for="lozinka">Lozinka</label>
            <input type="password" id="lozinka" name="lozinka" />
          </div>

          <input type="submit" value="Potvrdi" name="prijava" id="potvrdi" />
        </form>

        <ul class="loginOrReg">
       
       Nemate račun?<li id="registracija">Registrirajte se</li>
     </ul>
      </div>

      <span class = "copy">Copyright &copy; 2020 Mišković Movie Database | MMDb</span>

    </div> 
   
    <?php include('../footer.php') ?>
    
    
