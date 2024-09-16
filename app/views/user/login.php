<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>
<form action="<?php echo URLROOT; ?>/user/login" method="post">
     <div class="kontener">
     
          <div class="pirulak">
               <div class="pill-1 rotate-45"></div>
               <div class="pill-2 rotate-45"></div>
               <div class="pill-3 rotate-45"></div>
               <div class="pill-4 rotate-45"></div>
          </div>
          <div class="login">

               <h3 class="title">Bejelentkezés</h3>
               <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="text" name="felhasznalonev" placeholder="Felhasználónév">
               </div>
               <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="password" name="jelszo" placeholder="Jelszó">
               </div>
               <button type="submit" class="login-btn">Bejelentkezés</button>
          </div>
     </div>
</form>