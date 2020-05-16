
  <?php include ('./tags/header/top-header.php') ?>

<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/favorite.css" />

<?php include ('./tags/header/bottom-header.php') ?>
<?php include ("funkcije.inc.php"); ?>


  <?php 
  //favoriti od trenutnog korisnika
    // $idsDB = array();
    // array_push($idsDB,provjeri_id($konekcija));

//favoriti od drugih korisnika
//   $userName= $_SESSION['userInfoName'] ;
//    $userArr =  $_SESSION['userInfoArr'];
$korisnik = $_SESSION['kor_ime'];
$receivedRequest = getRequest($korisnik,$konekcija);
$friendsList = getFriends($korisnik,$konekcija);

  
?>




<section id="movies" class="omiljeniFilm">
  
<div class="container">
    
    
<div class="obavjesti">
  <h2 class="head-2" >Zahtjev za prijateljstvo:</h2>
  <!-- <div class="obavjesti-box">
      <div class="zahtjev"></div>
      <div class="potvrdi">Potvrdi</div>
      <div class="odbij">Odbij</div>
  </div> -->
</div>
<div class="friend-list">
<h2 class="head-2">Prijatelji:</h2>

<ul class="friend-list-ul">
    
</ul>

</div>
    
   

    
   

    
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

//notification
const userNot = document.querySelector('.user-notification');
const notifphp = ( <?php  echo json_encode($check); ?>);
(notifphp) ? userNot.classList.add('user-active'): false;


//response on notification
const obBox = document.querySelectorAll('.obavjesti-box');
const obavj = document.querySelector('.obavjesti');
const listaPrijatelja = document.querySelector('.friend-list-ul');

//received request's
const userFromPhp = ( <?php  echo json_encode($receivedRequest); ?>);

const friendsList = ( <?php  echo json_encode($friendsList); ?>);
const korisnik = ( <?php  echo json_encode($korisnik); ?>);



if(userFromPhp){
  userFromPhp.from_user.split(',').forEach(user=>{
    const box = document.createElement('div');
    box.classList = 'obBoxContainer';
   
      box.innerHTML = `
    <div class="zahtjev">${user}</div>
      <div class="potvrdi">Potvrdi</div>
      <div class="odbij">Odbij</div>
    `;
    obavj.append(box);

  })
}



//ako odbije ili potvrdi
obavj.addEventListener('click',e=>{
    if(e.target.classList == 'odbij'){
       const friendUser = e.target.previousElementSibling.previousElementSibling.innerHTML;
       const userFromPhp2 = userFromPhp.from_user.split(',')
      const removeIndex = userFromPhp2.indexOf(friendUser);
      userFromPhp2.splice(removeIndex,1);
      const newReqData =  userFromPhp2.join(',');

        $.ajax({
        url:'deleteFriendReq.php',
        method:'post',
        data:{reqUser:newReqData},
        success: function(data){
            console.log(data);
        }          
        });

      
        $.ajax({
        url:'deleteFriendReq.php',
        method:'post',
        data:{sendUser:friendUser},
        success: function(data){
            console.log(data);
        }          
        });
        
        location.reload();
      
    }else if(e.target.classList == 'potvrdi'){
      const friendUser = e.target.previousElementSibling.innerHTML;
      const userFromPhp2 = userFromPhp.from_user.split(',')
      const removeIndex = userFromPhp2.indexOf(friendUser);
      userFromPhp2.splice(removeIndex,1);
      const newReqData =  userFromPhp2.join(',');

      const li = document.createElement('li');
        li.innerHTML = friendUser;
        listaPrijatelja.appendChild(li);

        $.ajax({
        url:'deleteFriendReq.php',
        method:'post',
        data:{reqUser:newReqData},
        success: function(data){
            console.log(data);
        }          
        });

      
        $.ajax({
        url:'deleteFriendReq.php',
        method:'post',
        data:{sendUser:friendUser},
        success: function(data){
            console.log(data);
        }          
        });

        $.ajax({
        url:'makeFriends.php',
        method:'post',
        data:{friend:friendUser},
        success: function(data){
            console.log(data);
        }          
        });

       e.target.parentElement.remove();
       location.reload();
    }


});




if(friendsList){
  friendsList['friends'].split(',').forEach(fr=>{
    const li = document.createElement('li');
    li.classList = 'user-list';
        li.innerHTML = fr;
        listaPrijatelja.appendChild(li);
  })
   
}

//find user
const userForm = document.getElementById('form2');
      const userValue = document.getElementById('ime-korisnika');
      document.addEventListener('click',e=>e.target.id !== "ime-korisnika" ? userValue.style.width = '0px':  userValue.style.width = '250px');

      userForm.addEventListener('submit',e=>{
       const findUser = (userValue.value);
       
       $.ajax({
            url:'checkUser.php',
            method:'post',
            data:{userName:findUser},
            success: function(data){
              location.href = 'user.php';
            }          
          });

      });


      //check friend

      document.addEventListener('click',e=>{
        if(e.target.className === 'user-list'){
        const li = e.target.textContent;
        $.ajax({
            url:'checkUser.php',
            method:'post',
            data:{userName:li},
            success: function(data){
              location.href = 'user.php';
            }          
          });
    }
      })
    

     

</script>

</body>
</html>


