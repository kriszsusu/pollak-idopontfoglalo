<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

    <div class="minimain">
        <div class="miniimage">
            
            <h1>Jelentkezők</h1>
            <hr>
            <?php if (count($data["versenyJelentkezok"]) > 0) : ?>
                <?php $i = 0; ?>
                    <?php foreach ($data["versenyJelentkezok"] as $sor): ?>
                        <div class="versenylista">
                            <div class="helyezet">
                                <?php $i++; echo $i; ?>.
                            </div>
                            <div class="nev">
                                <h3><?php echo $sor->kod?></h3>
                            </div>
                            <div class="pontszam">
                                <h3><?php echo $sor->pontszam?></h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php else:?>
                        <h3>Még nincsenek jelentkezők!</h3>
            <?php endif; ?>

        </div>

            <div class="text">
                <div class="kepBoxVersenyek">
                    <img id="img" src="<?php echo URLROOT ?>/public/img/PAJIV_2024_jelentkezes.png" alt="">
                </div>

                <h2 class="esemeny"><?php echo $data["Versenyreszletek"]->versenynev; ?></h2>
                <hr>
                <h3 class="idopont">Verseny időpontja: <?php $datum = new DateTime($data["Versenyreszletek"]->idopont); echo $datum->format('Y.m.d. H:i');?></h3>
                <br><br><br>
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["Versenyreszletek"]->leiras));  ?></p>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <p>Sikeresen jelentkeztél az előadásra</p>
    </div>

</div>

<script src="<?php echo URLROOT ?>/public/js/script.js"></script>
