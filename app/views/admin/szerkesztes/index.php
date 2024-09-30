<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<form action="<?php echo URLROOT; ?>/admin/szerkesztes/<?php echo $data['esemeny']->id ?>" method="post" enctype="multipart/form-data">
     <div class="kontener">
     
          <div class="pirulak">
               <div class="pill-1 rotate-45"></div>
               <div class="pill-2 rotate-45"></div>
               <div class="pill-3 rotate-45"></div>
               <div class="pill-4 rotate-45"></div>
          </div>
          <div class="login">

               <h3 class="title">Esemény szerkesztése</h3>

               <input type="hidden" name="id" value="<?php echo $data['esemeny']->$id ?>">

               <div class="text-input">
                    <i class="ri-user-fill"></i>
                    <input type="text" name="cim" placeholder="Cím" value="<?php echo $data['esemeny']->cim ?>">
               </div>

               <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="file" name="kep" placeholder="Kép" value="<?php echo $data['esemeny']->kep ?>" >
               </div>
               <div class="text-input">
                    <i class="ri-lock-fill"></i>
                    <input type="datetime-local" name="datum" placeholder="Időpont" value="<?php echo $data['esemeny']->datum ?>">
               </div>

               <div>
                    <select name="tanteremID" id="id-tanterem">
                        <?php foreach ($data['terem'] as $fajta): ?>
                            <option class="marka" value="<?php echo $fajta->id; ?>"><?php echo $fajta->neve; ?></option>
                        <?php endforeach; ?>
                    </select>
               </div>

               <div>
                    <textarea name="leiras" id="" cols="40" rows="8"><?php echo $data['esemeny']->leiras ?></textarea>
               </div>


               
               <button type="submit" class="login-btn">Feltöltés</button>
          </div>
     </div>
</form>