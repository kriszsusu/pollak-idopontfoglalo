<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

    <div class="minimain">
        <div class="miniimage">
            
            <h1 class="kozepre">Jelentkezők</h1>
            <hr>
            <!-- versenylista, helyezet, nev, pontszam -->
            <?php if (count($data["versenyJelentkezok"]) > 0) : ?>
                <?php $i = 0; ?>
                <table class="versenylista">
                    <?php foreach ($data["versenyJelentkezok"] as $sor): ?>
                       <tr>
                        <td><h3 class="helyezet"> <?php $i++; echo  $sor->latszodik == 1 ? $i : 0;  ?></h3></td>
                        <td><h3 class="nev"><?php echo $sor->latszodik == 1 ? $sor->kod : "Név"?></h3></td>
                        <td><h3 class="pontszam"><?php echo $sor->latszodik == 1 ?  $sor->pontszam : 0?></h3></td>
                       </tr>
                    <?php endforeach; ?>
                    </table>
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
                <div>
                    <p class="blur">A határidő lejárt!</p>
                </div>
                <form  class="jelentkezes <?php $datum = new DateTime($data["Versenyreszletek"]->jelentkezesiHatarido); if ($datum <= new DateTime()) {echo 'jelentkezes-blur';} ?>" id="teszt" method="post">
                    <input type="hidden" name="versenyID" value="<?php echo $data['Versenyreszletek']->esemeny_id ?>">
                    <input type="text" class="input" name="tanuloNeve" placeholder="Név" <?php $datum = new DateTime($data["Versenyreszletek"]->jelentkezesiHatarido); if ($datum <= new DateTime()) {echo 'disabled';} ?>>
                    <input type="text" class="input" name="tanarNeve" placeholder="Felkészítő tanár neve" <?php $datum = new DateTime($data["Versenyreszletek"]->jelentkezesiHatarido); if ($datum <= new DateTime()) {echo 'disabled';} ?>>
                    <input type="email" class="input" onkeyup="validate()" id="input" name="email" placeholder="Felkészítő tanár e-mail címe" <?php $datum = new DateTime($data["Versenyreszletek"]->jelentkezesiHatarido); if ($datum <= new DateTime()) {echo 'disabled';} ?>>
                    <select name="iskola" id="id-iskolak" class="input" style="height: 35px; width: 360px;" onchange="iskolak(this)" <?php $datum = new DateTime($data["Versenyreszletek"]->jelentkezesiHatarido); if ($datum <= new DateTime()) {echo 'disabled';} ?>>
                        <option value="-1">Válassz Iskolát!</option>
                        <?php foreach ($data['iskolak'] as $fajta): ?>
                            <option class="marka" value="<?php echo $fajta->id; ?>"><?php echo $fajta->nev; ?></option>
                        <?php endforeach; ?>
                        <option value="egyeb">Egyéb</option>
                    </select>
                    <input type="text" class="input" name="iskolaNeve" id="iskolaNeve" placeholder="Iskola megnevezése" style="display: none;">

                    <select name="evfolyamok" id="id-evfolyamok" class="input" style="height: 35px; width: 360px;" <?php $datum = new DateTime($data["Versenyreszletek"]->jelentkezesiHatarido); if ($datum <= new DateTime()) {echo 'disabled';} ?>>
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
