
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  
<?php  

include ("../backend/includes/funkcije.inc.php"); 

$korisnik = $_SESSION['kor_ime'];
$check = getRequest($korisnik,$konekcija);

?>
<title>MMDB</title>
    <script
      src="https://kit.fontawesome.com/ad2a351d60.js"
      crossorigin="anonymous"
    ></script>

  </head>

  <body>
    <!--Header-->
    <header class="header">
      <div class="logo">
        <a href="index.php"><img src="../img/logo.png"/></a>
      </div>

      <form action="#" class="form" id="form">
        <input type="text" placeholder="Pretražite filmove " id="ime-filma" />
        <button class="btn"><i class="fas fa-search  search"></i></button>
        
      </form>
     
      <form action="#" class="form2" id="form2">
        <input type="text" placeholder="Pretraži korisnika" id="ime-korisnika" />
        <button class="btn"><i class="fas fa-user"></i></button>
        
      </form>
      
      

      <nav class="navigation">
        <ul class="nav-ul">
          <li class="user-list">
            <div class="acc-info">
            <!-- user-active -->
            <i class="fas fa-user-friends  user-notification"></i>
            
              <i class="fas fa-user-circle user-icon"></i>
              <a href="#" class="user"><?php korisničko_ime(); ?>  </a>
              <i class="fas fa-chevron-left down"></i>
            </div>

            <ul>
              
              <li>
                <a href="favorite.php"
                  ><i class="fas fa-heart"> Omiljeni sadržaj</i></a
                >
              </li>
              <li>
                <a href="friends.php"
                  ><i class="fas fa-user-friends">Prijatelji</i></a
                >
              </li>
              <li>
                <a href="../backend/login/logout.php"><i class="fas fa-sign-out-alt"> Odjava</i></a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <!--Header End-->

   