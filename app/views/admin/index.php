<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>



<div class="container">
    <?php if (count($data["main"]) > 0) : ?>
            <?php foreach ($data["main"] as $sor): ?>
                <div class="box">
                    <div class="kep-box">
                         <img src="<?php echo URLROOT ?>/public/img/<?php echo $sor->kep; ?>" alt="" class="kep">
                    </div>
                    <br>
                    <div class="adatok">
                        <h1 class="cim"><?php echo $sor->cim?></h1>
                        <br>
                        <p class="oktato">Oktató neve: <b><?php echo $sor->nev?></b></p>
                        <br>
                        <p class="tanterem">Helyszín neve: <b><?php echo $sor->neve?></b></p>
                        <br>
                        <p class="helyek">Hátralévő helyek száma: <b><?php echo $sor->ferohely - $sor->jelentkezok?></b></p>
                        <br>
                        <p class="helyek">Téma: <b><?php echo $sor->tema?></b></p>
                        <br>
                        <p class="idopont">Esemény időpontja: <br> <?php $datum = new DateTime($sor->datum); echo $datum->format('Y.m.d H:i');?></p>
                        <a class="edit" href="<?php echo URLROOT ?>/admin/szerkesztes/<?php echo $sor->esemeny_id ?>" ><i class='bx bxs-edit-alt'></i></a>
                        <a class="delete" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/torles/<?php echo $sor->esemeny_id ?>"><i class='bx bxs-trash' ></i></a>
                        <a class="tovabb"  href="<?php echo URLROOT . "/admin/reszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                        <a class="duplikalas" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/duplikalas/<?php echo $sor->esemeny_id ?>">Duplikálás</a>
                    </div>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>

    <a class="hozzadas" href="<?php echo URLROOT; ?>/admin/hozzaadas"><i class='bx bx-plus'></i></a>

</div>