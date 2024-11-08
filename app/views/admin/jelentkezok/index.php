<?php
require APPROOT . '/views/includes/head.php';
require APPROOT . '/views/includes/adminNavigation.php';
?>


</head>

<body>

    <div class="main">
        <p style="align-self: flex-start; margin-left: 15%;">Jelentkezők Száma: <?php echo $data["szam"]->jelentkezok_szama ?></p>
        <div>
            <input id="searchBoxAdmin" type="text" class="kereses" placeholder="Keresés..." onkeyup="keresesAdmin()">
        </div>
    </div>

    <span id="keresesiEredmenyek"></span>


    <table class="customers" id="torlesAdmin">
        <tr>
            <th>Látogató neve</th>
            <th>Látogató email címe</th>
            <?php if (count($data["idopontok"]) > 0) : ?>
                <?php foreach ($data["idopontok"] as $sor): ?>

                    <th><?php echo $sor->idopont ?></th>

                <?php endforeach; ?>
            <?php endif; ?>
            <th>Műveletek</th>
        </tr>
        <?php if (count($data["jelentkezok"]) > 0) : ?>
            <?php foreach ($data["jelentkezok"] as $sor): ?>
                <tr>
                    <td><?php echo $sor->jelentkezo ?></td>
                    <td><?php echo $sor->email ?></td>
                    <?php foreach ($data["idopontok"] as $sor2): ?>
                        <td>
                            <?php
                            if (isset($sor->idopont_terem) && !empty($sor->idopont_terem)) {
                                $idopontTeremParts = explode(',', $sor->idopont_terem);

                                $matchFound = false;

                                foreach ($idopontTeremParts as $part) {
                                    $idopontTeremArray = explode(';', $part);

                                    if (count($idopontTeremArray) > 1) {
                                        if ($idopontTeremArray[0] == $sor2->idopont) {
                                            echo htmlspecialchars($idopontTeremArray[1]);
                                            echo "<br>";
                                            $matchFound = true;
                                        }
                                    }
                                }
                                if (!$matchFound) {
                                    echo "";
                                }
                            } else {
                                echo "";
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>

                    <td>
                        <?php if ($sor->megjelent == 0) : ?>
                            <a class="jelentkezoTorles" onclick="return confirm('Biztos megjelent?')" href="<?php echo URLROOT ?>/admin/felhasznaloEngedelyezese/<?php echo $sor->jelentkezo_id ?>"><i class='bx bxs-user-check'></i></a>
                        <?php endif; ?>

                        <a class="jelentkezoTorles" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/felhasznaloTorlese/<?php echo $sor->jelentkezo_id ?>"><i class='bx bxs-trash'></i></a></h3>
                    </td>

                </tr>

            <?php endforeach; ?>
        <?php endif; ?>


    </table>

    <form class="export" action="<?= URLROOT; ?>/admin/exportPDF/" method="post">
        <button type="submit" class="export_gomb export2">Felhasználók exportálása</button>
    </form>

    <script src="<?php echo URLROOT ?>/public/js/script.js"></script>