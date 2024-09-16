<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>
<div class="container">
     <?php if (count($data) > 0) : ?>
          <?php foreach ($data["main"] as $sor): ?>
               <a href="" class="box">
                    <div class="kep-box">
                         <img src="" alt="" class="kep">
                    </div>
                    <br>
                    <div class="adatok">
                         <p class="cim"><?php echo $sor->cim?></p>
                         <br>
                         <p class="oktato">Oktató neve: <?php echo $sor->nev?></p>
                         <br>
                         <p class="leiras"><?php echo $sor->leiras?></p>
                         <br>
                         <p class="idopont">Esemény időpontja: <?php echo $sor->datum?></p>
                    </div>
               </a>
          <?php endforeach; ?>
     <?php endif; ?>
</div>

