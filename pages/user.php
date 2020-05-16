
  <?php include ('./tags/header/top-header.php') ?>

<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/favorite.css" />

<?php include ('./tags/header/bottom-header.php') ?>
<?php include ("funkcije.inc.php"); ?>


  <?php 
  //favoriti od trenutnog korisnika
    $idsDB = array();
    array_push($idsDB,provjeri_id($konekcija));

//favoriti od drugih korisnika
  $userName= $_SESSION['userInfoName'] ;
   $userArr =  $_SESSION['userInfoArr'];
   $korisnik = $_SESSION['kor_ime'];

 $checkSend =   getSendRequest($korisnik,$konekcija);
 $friendsList = getFriends($korisnik,$konekcija);
  
?>




<section id="movies" class="omiljeniFilm">
  
<div class="container">
    
    <h2 class="head-2" id="fav-h">Korisnik: <span id="currUser"><?php  echo $userName; ?></span>
    <div class="prijatelji fr-req" > Prijatelji</div>
    <div class="poslano fr-req">Zahtjev poslan</div>
    <div class="dodaj fr-req">Dodaj za prijatelja</div>
  </h2>
   

    
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



  

let userArr = (<?php  echo  ($userArr); ?>).split(',');

Ctrl.userFavorites(userArr);



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

const userForm = document.getElementById('form2');
      const userValue = document.getElementById('ime-korisnika');
    document.addEventListener('click',e=>e.target.id !== "ime-korisnika" ? userValue.style.width = '0px':  userValue.style.width = '250px');


//friend request
const addReq = document.querySelector('.dodaj');
const sendReq = document.querySelector('.poslano');
const friend = document.querySelector('.prijatelji');

const sendTo = ( <?php  echo json_encode($userName); ?>);
const sendFrom = ( <?php  echo json_encode($korisnik); ?>);

addReq.addEventListener('click',e=>{
  addReq.style.display = 'none';
  sendReq.style.display = 'inline-block';

  $.ajax({
    url:'friendReqSystem.php',
    method:'post',
    data:{from:sendFrom,to:sendTo},
    success: function(data){
      console.log(data);
    }          
  });
})
  //give class based on event
  const getSend = ( <?php  echo json_encode($checkSend); ?>).to_user;
  const currentUser = document.getElementById('currUser').textContent;

if(getSend){
  getSend.split(',').forEach(item=>{
    if(item === currentUser){
    addReq.style.display = 'none';
    sendReq.style.display = 'inline-block';
  } 
  })
}

  const friendsList = ( <?php  echo json_encode($friendsList); ?>);


  if(friendsList){
    friendsList.friends.split(',').forEach(fr=>{
      
      if(fr === currentUser ){
        addReq.style.display = 'none';
        sendReq.style.display = 'none';
        friend.style.display = 'inline-block';

      }
    })
  }
 
 const userNot = document.querySelector('.user-notification');
 const notifphp = ( <?php  echo json_encode($check); ?>);
      
      (notifphp) ? userNot.classList.add('user-active'): false;
      userNot.addEventListener('click',()=> location.href='friends.php');




</script>

</body>
</html>


