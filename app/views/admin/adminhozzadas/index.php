<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>


<form action="" method="post" enctype="multipart/form-data">
     <div class="kontener">
     
          <div class="pirulak">
               <div class="pill-1 rotate-45"></div>
               <div class="pill-2 rotate-45"></div>
               <div class="pill-3 rotate-45"></div>
               <div class="pill-4 rotate-45"></div>
          </div>
          <div class="login">

               <h3 class="title">Admin hozzáadás</h3>
               <div class="text-input">
                    <i class='bx bxs-captions'></i>
                    <input type="text" name="felhasznalonév" placeholder="felhasználónév:" maxlength="30" required>
               </div>

               <div class="text-input">
                    <i class='bx bxs-photo-album'></i>
                    <input type="password" name="jelszo" placeholder="jelszó:" maxlength="500" required>
               </div>

               <button type="submit" class="login-btn">Hozzáadás</button>
          </div>
     </div>
</form>

