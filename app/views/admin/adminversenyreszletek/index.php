<?php
require APPROOT . '/views/includes/head.php';
require APPROOT . '/views/includes/adminNavigation.php';
?>

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
                                            <button class="buttony" onclick="reveal('<?php echo URLROOT; ?>', <?php echo htmlspecialchars($sor->jelentkezoID, ENT_QUOTES, 'UTF-8'); ?>)">
                                                <h3 class="helyezet">
                                                    <?php $i++; ?>
                                                    <?php echo $i; ?>.
                                                </h3>
                                            </button>
                                        </td>
                                        <td id="blured-kod-<?php echo $sor->jelentkezoID; ?>" <?php echo $sor->latszodik == 1 ? '' : 'class="text-blur"'; ?>>
                                            <h3 class="nev"><?php echo $sor->kod; ?></h3>
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
                                            <button class="buttony" onclick="reveal('<?php echo URLROOT; ?>', <?php echo htmlspecialchars($sor->jelentkezoID, ENT_QUOTES, 'UTF-8'); ?>)">
                                                <h3 class="helyezet">
                                                    <?php $i++; ?>
                                                    <?php echo $i; ?>.
                                                </h3>
                                            </button>
                                        </td>
                                        <td id="blured-kod-<?php echo $sor->jelentkezoID; ?>" <?php echo $sor->latszodik == 1 ? '' : 'class="text-blur"'; ?>>
                                            <h3 class="nev"><?php echo $sor->kod; ?></h3>
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
        </div>
    </div>
</div>

<script src="<?php echo URLROOT ?>/public/js/script.js"></script>