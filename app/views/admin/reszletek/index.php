<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

        <div class="kismain">
            <div class="image">
                <div class="jelentkezok">
                    <h3 class="jelentkezokszama"> Szabad helyek száma: <?php echo $data["reszletek"]->ferohely - $data["reszletek"]->jelentkezok; ?></h3>
                </div>
                <div class="kepBox">
                    <img id="img" src="<?php echo URLROOT ?>/public/img/<?php echo $data["reszletek"]->kep; ?>" alt="">
                </div>


            </div>
            <div class="text">
                <h2 class="esemeny"><?php echo $data["reszletek"]->cim; ?></h2>
                <hr>
                <h3 class="terem">Tanterem: <?php echo $data["reszletek"]->neve; ?></h3>
                <h3 class="oktato">Oktató neve: <?php echo $data["reszletek"]->nev; ?></h3>
                <h3 class="idopont"><?php $datum = new DateTime($data['reszletek']->datum); echo $datum->format('Y.m.d. H:i'); ?></h3>
                <br><br><br>
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["reszletek"]->leiras));  ?></p>
                <?php if($data["reszletek"]->ferohely - $data["reszletek"]->jelentkezok > 0) {?>
                <form  class="jelentkezes" id="teszt" method="post">
                    <input type="hidden" name="esemenyID" value="<?php echo $data['reszletek']->esemeny_id ?>">
                    <input type="text" class="input" name="neve" placeholder="Név">
                    <input type="email" class="input" onkeyup="validate()" id="input" name="email" placeholder="példa@példa.com">
                    <button type="submit" disabled id="myBtn" class="buttony buttony-disabled">Jelentkezés</button>
                </form><?php 
                }else{?>
                    <div class="jelentkezes" id="teszt">
                        <h3>NINCS HELY!</h3>
                    </div>
               <?php } ?>
            </div>
            
        </div>
    </div>

<div class="keret">
     
    <h1>Jelentkezők email címei:</h1>
    <hr>
    <?php if (count($data["jelentkezok"]) > 0) : ?>
            <?php foreach ($data["jelentkezok"] as $sor): ?>
                <div class="lista">
                <h3 >Neve: <?php echo $sor->neve?>, Email címe: <?php echo $sor->email?>
                    <?php if ($sor->megjelent == 0) : ?>
                        <a class="jelentkezoTorles" onclick="return confirm('Biztos engedélyezni szeretnéd?')" href="<?php echo URLROOT ?>/admin/felhasznaloEngedelyezes/<?php echo  $data["reszletek"]->esemeny_id ?>/<?php echo $sor->jelentkezoID ?>"><i class='bx bxs-user-check' ></i></a>
                    <?php endif; ?>
                    
                    <a class="jelentkezoTorles" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/felhasznaloTorles/<?php echo  $data["reszletek"]->esemeny_id ?>/<?php echo $sor->jelentkezoID ?>"><i class='bx bxs-trash' ></i></a></h3>

                <hr>
                </div>
            <?php endforeach; ?>
            <?php else:?>
                <h3>Még nincsenek jelentkezők!</h3>
    <?php endif; ?>
                
            <!-- Export gomb -->
             <br>
            <form class="export" action="<?= URLROOT; ?>/admin/exportToPdf/<?php echo $data["reszletek"]->esemeny_id ?>" method="post">
            <button type="submit" class="export_gomb">Felhasználók exportálása</button>
        </form>

 </div>



    
    
    <div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <p>Sikeresen jelentkeztél az előadásra</p>
    </div>