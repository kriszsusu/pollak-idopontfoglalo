<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<!-- telefon kártya padding
     count back
     font-family
-->

<form action="" method="post" enctype="multipart/form-data">
     <div class="kontener">
     
          <div class="pirulak">
               <div class="pill-1 rotate-45"></div>
               <div class="pill-2 rotate-45"></div>
               <div class="pill-3 rotate-45"></div>
               <div class="pill-4 rotate-45"></div>
          </div>
          <div class="login">

               <h3 class="title">Verseny hozzáadása</h3>
               <div class="text-input">
                    <i class='bx bxs-captions'></i>
                    <input type="text" name="versenynev" placeholder="Versenynév" maxlength="100" required>
               </div>

               <div class="text-input">
                    <i class='bx bxs-photo-album'></i>
                    <input type="file" name="kep" placeholder="Kép" maxlength="500" required>
               </div>

               <div class="versenyido">Időpont</div>
               <div class="text-input">
                    <i class='bx bxs-time' ></i>
                    <input type="datetime-local" name="idopont" placeholder="Időpont" required>
               </div>

               <div class="versenyido">Jelentkezési határidő</div>
               <div class="text-input">
                    <i class='bx bxs-time' ></i>
                    <input type="datetime-local" name="jelentkezesiHatarido" placeholder="Jelentkezési határidő" required>
               </div>
 
               <div>
                    <textarea name="leiras" id="" cols="40" rows="4" placeholder="Leírás" maxlength="1024" required></textarea>
               </div>

               <div>
                    <textarea name="tema" id="" cols="40" rows="4" placeholder="Téma" maxlength="1024" required></textarea>
               </div>

               <button type="submit" class="login-btn">Feltöltés</button>
          </div>
     </div>
</form>

