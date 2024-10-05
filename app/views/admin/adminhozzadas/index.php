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
                    <input type="text" name="felhasznalonev" placeholder="felhasználónév:" maxlength="30" required>
               </div>

               <div class="text-input">
                    <i class='bx bxs-captions'></i>
                    <input type="text" name="nev" placeholder="Teljes Név:" maxlength="100" required>
               </div>

               <div class="text-input">
                    <i class='bx bxs-photo-album'></i>
                    <input id="password" type="password" name="jelszo" placeholder="jelszó:" maxlength="500" onkeyup="checkPassword()" required>
               </div>

               <div class="text-input">
                    <i class='bx bxs-photo-album'></i>
                    <input id="re-password" type="password" name="jelszo-ujra" placeholder="jelszó újra:" maxlength="500" onkeyup="checkPassword()" required>
                    <span id="password-error" style="color: red;"></span>
               </div>

               <button id="add-btn" style="cursor: not-allowed;" type="submit" class="login-btn" disabled>Hozzáadás</button>
          </div>
     </div>
</form>

<script>
     function checkPassword() {
          const password = document.getElementById('password').value;
          const rePassword = document.getElementById('re-password').value;
          const passwordError = document.getElementById('password-error');
          const addBtn = document.getElementById('add-btn');

          if (password != rePassword) {
               passwordError.innerHTML = "A két jelszó nem egyezik meg.";
               addBtn.disabled = true;
               addBtn.style.cursor = "not-allowed";
          }
          else {
               passwordError.innerHTML = "";
               addBtn.disabled = false;
               addBtn.style.cursor = "pointer";
          }
     }
</script>