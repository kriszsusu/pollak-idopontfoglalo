<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>


</head>
<body>

<div class="main">
    <div>
      <input id="searchBoxAdmin" type="text" class="kereses" placeholder="Keresés..." onkeyup="keresesAdmin()">
    </div>
</div>

<span id="keresesiEredmenyek"></span>


<table class="customers" id="torlesAdmin" >
    <tr>
    <th>Látogató neve</th>
    <?php if (count($data["idopontok"]) > 0) : ?>
        <?php foreach ($data["idopontok"] as $sor): ?>

            <th><?php echo $sor->idopont?></th>

        <?php endforeach; ?>
    <?php endif; ?>
    <th>Műveletek</th>
    </tr>
    <?php if (count($data["jelentkezok"]) > 0) : ?>
                <?php foreach ($data["jelentkezok"] as $sor): ?>
                    <tr>
                        <td><?php echo $sor->jelentkezo?></td>
                        <?php foreach ($data["idopontok"] as $key=>$sor2): ?>
                            <td><?php echo explode(';' ,  isset(explode(',',  $sor->idopont_terem )[$key]) ? explode(',',  $sor->idopont_terem )[$key] : "")[0] == $sor2->idopont ?  explode(';' ,  explode(',',  $sor->idopont_terem )[$key])[1] : ""?></td>
                        <?php endforeach; ?>

                        <td>
                        <?php if ($sor->megjelent == 0) : ?>
                            <a class="jelentkezoTorles" onclick="return confirm('Biztos megjelent?')" href="<?php echo URLROOT ?>/admin/felhasznaloEngedelyezese/<?php echo $sor->jelentkezo_id ?>"><i class='bx bxs-user-check' ></i></a>
                        <?php endif; ?>
                                    
                        <a class="jelentkezoTorles" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/felhasznaloTorlese/<?php echo $sor->jelentkezo_id ?>"><i class='bx bxs-trash' ></i></a></h3>
                        </td>

                    </tr>

                <?php endforeach; ?>
        <?php endif; ?>
 

</table>

<form class="export" action="<?= URLROOT; ?>/admin/exportPDF/" method="post">
    <button type="submit" class="export_gomb export2">Felhasználók exportálása</button>
</form>

<script src="<?php echo URLROOT ?>/public/js/script.js"></script>