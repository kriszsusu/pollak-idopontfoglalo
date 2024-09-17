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

               <h3 class="title">Esemény hozzáadása</h3>
               <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="text" name="cim" placeholder="Cím">
               </div>
               <div class="">
                    <i class="ri-user-fill"></i>
                    <textarea name="leiras" id="" cols="30" rows="10"></textarea>
               </div>
               <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="file" name="kep" placeholder="Kép">
               </div>
               <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="datetime-local" name="datum" placeholder="Időpont">
               </div>

               <div class="text-input">
               <i class="ri-lock-fill"></i>
                    <select name="terem" id="id-tanterem">
                        <?php foreach ($data['terem'] as $fajta): ?>
                            <option class="marka" value="<?php echo $fajta->id; ?>"><?php echo $fajta->neve; ?></option>
                        <?php endforeach; ?>
                    </select>
               </div>


               
               <button type="submit" class="login-btn">Feltöltés</button>
          </div>
     </div>
</form>

