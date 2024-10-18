<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>
<main>
</div>

  <div class="container" id="torles">

      <?php if (count($data["verseny"]) > 0) : ?>
              <?php foreach ($data["verseny"] as $sor): ?>
                  <div class="box">
                      <br>
                      <div class="adatok">
                          <h1 class="cim"><?php echo $sor->versenynev?></h1>
                          <br>
                          <p class="helyek">Téma: <b><?php echo $sor->tema?></b></p>
                          <br>
                          <p class="idopont">Esemény időpontja: <br> <?php $datum = new DateTime($sor->idopont); echo $datum->format('Y.m.d.');?></p>
                          <a class="tovabb"  href="<?php echo URLROOT . "/versenyreszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                          
                      </div>
                  </div>
              <?php endforeach; ?>
      <?php endif; ?>

  </div>
  <script src="<?php echo URLROOT ?>/public/js/script.js"></script>
</main>