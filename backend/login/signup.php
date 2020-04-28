 
 <?php
include ("../includes/funkcije.inc.php");

if ( !empty($_POST["ime"])&&!empty($_POST["prezime"])&&!empty($_POST["kor_ime"])&&!empty($_POST["email"])&&!empty($_POST["lozinka"])) {
    dodaj_korisnika(
        $_POST["ime"],
        $_POST["prezime"],
        $_POST["kor_ime"],
        $_POST["email"],
        $_POST["lozinka"],
        $konekcija
    );

    header("Location: index.php");
}


include ('../header.php') 
?>
 
 <div class="landing-page">
 <div class="logo-w">
       <img src="../../img/logo-w.png" alt="">
     </div>
      
    <div class="login-field">
         <form action="signup.php" id="form-reg" method="post">
          <h2 class="register">Registrirajte se</h2>

          <div class="form-gr">
            <label for="ime">Ime</label>
            <input type="text" id="ime" name="ime" />
          </div>

          <div class="form-gr">
            <label for="prezime">Prezime</label>
            <input type="text" id="prezime" name="prezime" />
          </div>
          <div class="form-gr">
            <label for="kor-ime">Korisničko ime</label>
            <input type="text" id="kor-ime" name="kor_ime" />
          </div>

          <div class="form-gr">
            <label for="Email">Email</label>
            <input type="email" id="email" name="email" />
          </div>

          <div class="form-gr">
            <label for="lozinka">Lozinka</label>
            <input type="password" id="lozinka" name="lozinka" />
          </div>

          <input type="submit" value="Potvrdi" name="potvrdi" id="potvrdi" />
        </form> 

        <ul class="loginOrReg">
           Imate račun?
        <li id="prijava">Prijavite se</li>
        
      </ul>

</div>
<span class = "copy">Copyright &copy; 2020 Mišković Movie Database | MMDb</span>

    </div> 
    <?php include('../footer.php') ?>
    



