<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>
<main>
</div>

  <div class="container" id="torles">

      <?php if (count($data["verseny"]) > 0) : ?>
              <?php foreach ($data["verseny"] as $sor): ?>
                  <div class="box">
                      <div class="kep-box">
                        <img src="<?php echo URLROOT ?>/public/img/<?php echo $sor->kep; ?>" alt="" class="kep">
                      </div>
                      <br>
                      <div class="adatok">
                            <h1 class="cim"><?php echo $sor->versenynev?></h1>
                            <br>
                            <p class="helyek">Téma: <b><?php echo $sor->tema?></b></p>
                            <br>
                            <p class="idopont">Esemény időpontja: <br> <?php $datum = new DateTime($sor->idopont); echo $datum->format('Y.m.d.');?></p>
                            <a class="edit" href="<?php echo URLROOT ?>/admin/versenyszerkesztes/<?php echo $sor->id ?>" ><i class='bx bxs-edit-alt'></i></a>
                            <a class="delete" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/versenyTorles/<?php echo $sor->id ?>"><i class='bx bxs-trash' ></i></a>
                            <a class="tovabb"  href="<?php echo URLROOT . "/admin/adminversenyreszletek/" . $sor->id; ?>">Tovább</a>
                        
                      </div>
                  </div>
              <?php endforeach; ?>
      <?php endif; ?>

      <a class="hozzadas" href="<?php echo URLROOT; ?>/admin/versenyhozzaadas"><i class='bx bx-plus'></i></a>
  </div>
  <script src="<?php echo URLROOT ?>/public/js/script.js"></script>
</main>