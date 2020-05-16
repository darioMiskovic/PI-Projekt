
  <?php include ('./tags/header/top-header.php') ?>

    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/favorite.css" />

    <?php include ('./tags/header/bottom-header.php') ?>
    <?php include ("funkcije.inc.php"); ?>
    
      <?php 
      $idsDB = array();
      array_push($idsDB,provjeri_id($konekcija));
      
      
    ?>
    
    
   

    <section id="movies" class="omiljeniFilm">
      
    <div class="container">
        <!-- <div class="menu-icons">
          <ul>
            <li>
              <a href="#"><i class="fas fa-home" id="home"></i></a>
              <p>POČETNA</p>
            </li>
            <li>
              <a href="#"
                ><img
                  src="../img/movie.png"
                  id="movies"
                  class="logo-menu"
                  alt=""
              /></a>
              <p>FILMOVI</p>
            </li>

            <li>
              <a href="#"
                ><img
                  src="../img/series.png"
                  id="series"
                  class="logo-menu"
                  alt=""
              /></a>
              <p>TV SERIJE</p>
            </li>

          
          </ul>
        </div> -->
        <h2 class="head-2" id="fav-h">Vaš omiljeni sadržaj</h2>
        
      </div>
    </section>

    <footer>
      Copyright &copy; 2020 Mišković Movie Database | MMDb
      <div class="social-media ">
      <a href="https://www.facebook.com/fpmoz.ba/"  target="_blank"><i class="fab fa-facebook sm"></i></a>
        <a href="https://www.instagram.com/fpmoz.mostar/"  target="_blank"><i class="fab fa-instagram sm" ></i></a>
        <a href="https://www.youtube.com/watch?v=QAADpHsh6cM"  target="_blank"><i class="fab fa-youtube sm" ></i></a>
      </div>
    </footer>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    

    <script src="../scripts/view.js"></script>
    <script src="../scripts/model.js"></script>
    <script src="../scripts/controller.js"></script>
    

    <script type="text/javascript" >
     const userForm = document.getElementById('form2');
      const userValue = document.getElementById('ime-korisnika');
    document.addEventListener('click',e=>e.target.id !== "ime-korisnika" ? userValue.style.width = '0px':  userValue.style.width = '250px');
    


      const arrayFromPHP = (<?php echo json_encode($idsDB); ?>)[0].split(",");
       arrayFromPHP.forEach(id => {Ctrl.updateFavorite(id)});
       


       document.addEventListener("click", e=> {

            if(e.target.id === 'posterInfo'){
              
              const arrayFromPHP = (<?php echo json_encode($idsDB); ?>)[0].split(",");
          
              Ctrl.cardInfo(arrayFromPHP);

            }else if (e.target.classList.contains("unliked")) {

              //add liked class and update db
              e.target.classList = "liked";
              let infoID = View.loadinfoID();
            
              $.ajax({
                url:'imdbID.php',
                method:'post',
                data:{imdbID:infoID},
                success: function(data){
                  console.log(data);
                }          
              });

              
            }else if (e.target.classList.contains("liked")) {
              //add unliked class and update db
              e.target.classList = "unliked";
              const infoID = View.loadinfoID();

             

              $.ajax({
                url:'delete.php',
                method:'post',
                data:{imdbID:infoID},
                success: function(data){
                  console.log(data);
                }          
              });

              document.location.reload(true);
          
        }
});

      
const userNot = document.querySelector('.user-notification');
      const notifphp = ( <?php  echo json_encode($check); ?>);
      console.log(notifphp);
      (notifphp) ? userNot.classList.add('user-active'): false;
    </script>
   
  </body>
</html>


