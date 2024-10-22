<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

    <div class="minimain">
        <div class="miniimage">
            
            <h1>Jelentkezők: <b><?php echo count($data["versenyJelentkezok"]) ?></b> </h1>
            <hr>
            <?php if (count($data["versenyJelentkezok"]) > 0) : ?>
                <?php $i = 0; ?>
                    <?php foreach ($data["versenyJelentkezok"] as $sor): ?>
                        <div class="versenylista">
                            <div class="helyezet">
                                <?php $i++; echo $i; ?>.
                            </div>
                            <div class="nev">
                                <h3 ><?php echo $sor->tanuloNeve?></h3>
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
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["Versenyreszletek"]->tema));  ?></p>
                <form  class="jelentkezes" id="teszt" method="post">
                    <input type="hidden" name="versenyID" value="<?php echo $data['Versenyreszletek']->esemeny_id ?>">
                    <input type="text" class="input" name="tanuloNeve" placeholder="Név">
                    <input type="email" class="input" onkeyup="validate()" id="input" name="email" placeholder="E-mail cím">
                    <input type="text" class="input" name="tanarNeve" placeholder="Felkészítő tanár neve">
                    <select name="iskola" id="id-iskolak" class="input" style="height: 35px; width: 360px;" onchange="iskolak(this)">
                        <option value="-1">Válassz Iskolát!</option>
                        <?php foreach ($data['iskolak'] as $fajta): ?>
                            <option class="marka" value="<?php echo $fajta->id; ?>"><?php echo $fajta->nev; ?></option>
                        <?php endforeach; ?>
                        <option value="egyeb">Egyéb</option>
                    </select>
                    <input type="text" class="input" name="iskolaNeve" id="iskolaNeve" placeholder="Iskola megnevezése" style="display: none;">

                    <select name="evfolyamok" id="id-evfolyamok" class="input" style="height: 35px; width: 360px;">
                        <option value="-1">Válassz Évfolyamot!</option>
                        <?php foreach ($data['evfolyamok'] as $fajta): ?>
                            <option class="marka" value="<?php echo $fajta->id; ?>"><?php echo $fajta->nev; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" disabled id="myBtn" class="buttony buttony-disabled">Jelentkezés</button>
                </form>
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
