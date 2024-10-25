<?php
require APPROOT . '/views/includes/head.php';
require APPROOT . '/views/includes/navigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

    <div class="minimain">
        <div class="miniimage">
            <div class="tab">
                <h1>Jelentkezők</h1>
                <div>
                    <button class="tablinks buttony activeTab" onclick="openCity(event, '56')">5-6. Évfolyam</button>
                    <button class="tablinks buttony" onclick="openCity(event, '78')">7-8. Évfolyam</button>
                </div>
            </div>
            <!-- versenylista, helyezet, nev, pontszam -->
            <div class="tablazatbox">
                <div class="tabcontent fade" id="56"><?php if (count($data["versenyJelentkezok56"]) > 0) : ?>
                        <?php $i = 0; ?>
                        <table class="versenylista eredmenytabla">
                            <thead>
                                <tr>
                                    <th>
                                        <h3 class="helyezet">Helyezet</h3>
                                    </th>
                                    <th>
                                        <h3 class="nev">Kód</h3>
                                    </th>
                                    <th>
                                        <h3 class="pontszam">Pontszám</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["versenyJelentkezok56"] as $sor): ?>
                                    <tr>
                                        <td>
                                            <h3 class="helyezet">
                                                <?php $i++; ?>
                                                <?php echo $i; ?>.
                                            </h3>
                                        </td>
                                        <td <?php echo $sor->latszodik == 1 ? '' : 'class="text-blur"'; ?>>
                                            <h3 class="nev"><?php echo $sor->latszodik == 1 ? $sor->kod : 'Nice Try'; ?></h3>
                                        </td>
                                        <td>
                                            <h3 class="pontszam"><?php echo $sor->latszodik == 1 ? $sor->pontszam : 0; ?></h3>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h3></h3>
                    <?php endif; ?>
                </div>

                <div class="tabcontent fade" id="78" style="display:none"><?php if (count($data["versenyJelentkezok78"]) > 0) : ?>
                        <?php $i = 0; ?>
                        <table class="versenylista eredmenytabla">
                            <thead>
                                <tr>
                                    <th>
                                        <h3 class="helyezet">Helyezet</h3>
                                    </th>
                                    <th>
                                        <h3 class="nev">Kód</h3>
                                    </th>
                                    <th>
                                        <h3 class="pontszam">Pontszám</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["versenyJelentkezok78"] as $sor): ?>
                                    <tr>
                                        <td>
                                            <h3 class="helyezet">
                                                <?php $i++; ?>
                                                <?php echo $i; ?>.
                                            </h3>
                                        </td>
                                        <td <?php echo $sor->latszodik == 1 ? '' : 'class="text-blur"'; ?>>
                                            <h3 class="nev"><?php echo $sor->latszodik == 1 ? $sor->kod : 'Nice Try'; ?></h3>
                                        </td>
                                        <td>
                                            <h3 class="pontszam"><?php echo $sor->latszodik == 1 ? $sor->pontszam : 0; ?></h3>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h3></h3>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <div class="text">
            <div class="kepBoxVersenyek">
                <img id="img" src="<?php echo URLROOT; ?>/public/img/<?php echo $data['Versenyreszletek']->kep; ?>" alt="">
            </div>

            <h2 class="esemeny"><?php echo $data['Versenyreszletek']->versenynev; ?></h2>
            <hr>
            <br>
            <h3 class="idopont">Verseny időpontja:
                <?php $datum = new DateTime($data['Versenyreszletek']->idopont);
                echo $datum->format('Y.m.d. H:i');
                ?>
            </h3>
            <br>
            <br>
            <br>
            <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data['Versenyreszletek']->leiras)); ?></p>
            <br>
            <div class>
                <?php $datum = new DateTime($data['Versenyreszletek']->jelentkezesiHatarido); ?>
                <h3 class="datetime">Jelentkezés</h3><br>
                <h3 class="datetime"><?php echo $data['isTheDeadlinePassed'] ? "A jelentkezési határidő lejárt" : "Határidő: " . $datum->format('Y.m.d. H:i'); ?></h3>
            </div>
            <div>
                <form class="jelentkezes<?php echo $data['isTheDeadlinePassed'] ? ' jelentkezes-blur"' : '"method="post"'; ?> id=" teszt">

                    <input type="hidden" name="versenyID" value="<?php echo $data['Versenyreszletek']->esemeny_id; ?>">

                    <input type="text" class="input" name="tanuloNeve" placeholder="Név" <?php echo $data['isTheDeadlinePassed'] ? 'disabled' : ''; ?>>

                    <input type="text" class="input" name="tanarNeve" placeholder="Felkészítő tanár neve"
                        <?php echo $data['isTheDeadlinePassed'] ? 'disabled' : ''; ?>>

                    <input type="email" class="input" onkeyup="validate()" id="input" name="email"
                        placeholder="Felkészítő tanár e-mail címe" <?php echo $data['isTheDeadlinePassed'] ? 'disabled' : ''; ?>>

                    <select name="iskola" id="id-iskolak" class="input" style="height: 35px; width: 360px;"
                        onchange="iskolak(this)" <?php echo $data['isTheDeadlinePassed'] ? 'disabled' : ''; ?>>
                        <option value="-1">Válassz Iskolát!</option>
                        <?php foreach ($data['iskolak'] as $fajta): ?>
                            <option class="marka" value="<?php echo $fajta->id; ?>"><?php echo $fajta->nev; ?></option>
                        <?php endforeach; ?>
                        <option value="egyeb">Egyéb</option>
                    </select>

                    <input type="text" class="input" name="iskolaNeve" id="iskolaNeve" placeholder="Iskola megnevezése"
                        style="display: none;" <?php echo $data['isTheDeadlinePassed'] ? 'disabled' : ''; ?>>

                    <select name="evfolyamok" id="id-evfolyamok" class="input" style="height: 35px; width: 360px;"
                        <?php echo $data['isTheDeadlinePassed'] ? 'disabled' : ''; ?>>
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
</div>
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <p>Sikeresen jelentkeztél az előadásra</p>
    </div>

</div>

<script src="<?php echo URLROOT; ?>/public/js/script.js"></script>