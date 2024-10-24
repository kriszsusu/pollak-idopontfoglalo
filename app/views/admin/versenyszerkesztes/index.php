<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<form action="<?php echo URLROOT; ?>/admin/versenyszerkesztes/<?php echo $data['verseny']->id ?>" method="post" enctype="multipart/form-data">
     <div class="kontener">
     
          <div class="pirulak">
               <div class="pill-1 rotate-45"></div>
               <div class="pill-2 rotate-45"></div>
               <div class="pill-3 rotate-45"></div>
               <div class="pill-4 rotate-45"></div>
          </div>
          <div class="login">

               <h3 class="title">Esemény szerkesztése</h3>

               <input type="hidden" name="id" value="<?php echo $data['verseny']->id ?>">

               <div class="text-input">
                    <i class='bx bxs-captions'></i>
                    <input type="text" name="versenynev" placeholder="Versenynév" maxlength="100" value="<?php echo htmlspecialchars($data['verseny']->versenynev); ?>" required>
               </div>

               <div class="text-input">
                    <i class='bx bxs-photo-album'></i>
                    <input type="file" name="kep" placeholder="Kép" maxlength="500" >
               </div>

               <div class="versenyido">Időpont</div>
               <div class="text-input">
                    <i class='bx bxs-time' ></i>
                    <input type="datetime-local" name="idopont" placeholder="Időpont" value="<?php echo $data['verseny']->idopont; ?>" required>
               </div>

               <div class="versenyido">Jelentkezési határidő</div>
               <div class="text-input">
                    <i class='bx bxs-time' ></i>
                    <input type="datetime-local" name="jelentkezesiHatarido" placeholder="Jelentkezési határidő" value="<?php echo $data['verseny']->jelentkezesiHatarido; ?>" required>
               </div>
 
               <div>
                    <textarea name="leiras" id="" cols="40" rows="4" placeholder="Leírás" maxlength="1024" required><?php echo htmlspecialchars($data['verseny']->leiras); ?></textarea>
               </div>

               <div>
                    <textarea name="tema" id="" cols="40" rows="4" placeholder="Téma" maxlength="1024" required><?php echo htmlspecialchars($data['verseny']->tema); ?></textarea>
               </div>


               <button type="submit" class="login-btn">Feltöltés</button>
          </div>
     </div>
</form>
