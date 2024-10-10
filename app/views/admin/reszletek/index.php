<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/adminNavigation.php';
?>

<!-- A reszletek oldal tartalma -->
<div class="main">

        <div class="kismain">
            <div class="image">
                <div class="jelentkezok">
                    <h3 class="jelentkezokszama"> Hátralévő helyek: <?php echo $data["reszletek"]->ferohely - $data["reszletek"]->jelentkezok; ?></h3>
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
                <h3 class="idopont"><?php echo $data["reszletek"]->datum; ?></h3>
                <br><br><br>
                <p class="leiras"><?php echo nl2br(str_replace('&#13;&#10;', "\n", $data["reszletek"]->leiras));  ?></p>
            
            </div>
            
        </div>
    </div>

<div class="keret">
    <h1>Jelentkezők email címei:</h1>
    <hr>
    <?php if (count($data["jelentkezok"]) > 0) : ?>
            <?php foreach ($data["jelentkezok"] as $sor): ?>
                <div class="lista">
                <h3 >Neve: <?php echo $sor->neve?>, Email címe: <?php echo $sor->email?></h3>
                <hr>
                </div>
            <?php endforeach; ?>
            <?php else:?>
                <h3>Még nincsenek jelentkezők!</h3>
    <?php endif; ?>

 </div>
    
    
    <div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <p>Sikeresen jelentkeztél az előadásra</p>
    </div>