<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
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
                        <a class="tovabb"  href="<?php echo URLROOT . "/reszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                    </div>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>

</div>

