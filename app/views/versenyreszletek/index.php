<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
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
                                <?php $i++; echo $sor->latszodik == 1 ? $i : 0; ?>.
                            </div>
                            <div class="nev">
                                <h3><?php echo $sor->latszodik == 1 ? $sor->kod : "Név"?></h3>
                            </div>
                            <div class="pontszam">
                                <h3><?php echo $sor->latszodik == 1 ?  $sor->pontszam : 0?></h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php else:?>
                        <h3>Még nincsenek jelentkezők!</h3>
            <?php endif; ?>

        </div>

            <div class="text">
                <div class="kepBoxVersenyek">
                    <img id="img" src="<?php echo URLROOT ?>/public/img/<?php echo $data["Versenyreszletek"]->kep; ?>" alt="">
                </div>

                <h2 class="esemeny"><?php echo $data["Versenyreszletek"]->versenynev; ?></h2>
                <hr>
                <br><h3 class="idopont">Verseny időpontja: <?php $datum = new DateTime($data["Versenyreszletek"]->idopont); echo $datum->format('Y.m.d. H:i');?></h3><br>
                <br><br>
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["Versenyreszletek"]->leiras));  ?></p>
                <br><div class><h3 class="datetime">Jelentkezés</h3> </div>
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
