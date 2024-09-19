<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<a class="hozzadas" href="<?php echo URLROOT; ?>/admin/hozzaadas">Esemény hozzáadása</a>

<div class="container">
    <?php if (count($data["main"]) > 0) : ?>
            <?php foreach ($data["main"] as $sor): ?>
                <div class="box">
                    <div class="kep-box">
                         <img src="" alt="" class="kep">
                    </div>
                    <br>
                    <div class="adatok">
                        <p class="cim"><?php echo $sor->cim?></p>
                        <br>
                        <p class="oktato">Oktató neve: <?php echo $sor->nev?></p>
                        <br>
                        <p class="leiras"><?php echo $sor->leiras?></p>
                        <br>
                        <p class="idopont">Esemény időpontja: <?php echo $sor->datum?></p>
                        <a class="edit" href="<?php echo URLROOT ?>/admin/szerkesztes/<?php echo $sor->esemeny_id ?>" ><i class='bx bxs-edit-alt'></i></a>
                        <a class="delete" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/torles/<?php echo $sor->esemeny_id ?>"><i class='bx bxs-trash' ></i></a>
                    </div>

                </div>
            <?php endforeach; ?>
    <?php endif; ?>
</div>