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
                        <p class="cim"><?php echo $sor->cim?></p>
                        <br>
                        <p class="oktato">Oktató neve: <?php echo $sor->nev?></p>
                        <br>
                        <p class="idopont">Esemény időpontja: <br> <?php echo $sor->datum?></p>
                        <a class="edit" href="<?php echo URLROOT ?>/admin/szerkesztes/<?php echo $sor->esemeny_id ?>" ><i class='bx bxs-edit-alt'></i></a>
                        <a class="delete" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/torles/<?php echo $sor->esemeny_id ?>"><i class='bx bxs-trash' ></i></a>
                        <a class="tovabb"  href="<?php echo URLROOT . "/admin/reszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                    </div>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>

    <a class="hozzadas" href="<?php echo URLROOT; ?>/admin/hozzaadas"><i class='bx bx-plus'></i></a>

</div>