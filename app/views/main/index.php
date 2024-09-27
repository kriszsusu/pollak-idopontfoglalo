<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>
<main>
<div class="slide">
<div class="slideshow-container">

<div class="mySlides fade">

  <img src="<?php echo URLROOT ?>/public/img/asd.jpg" style="width:100%">
  <div class="text"><span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span></div>
</div>

<div class="mySlides fade">

  <img src="<?php echo URLROOT ?>/public/img/asd.jpg" style="width:100%">
   <div class="text"><span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span></div>
</div>

<div class="mySlides fade">

  <img src="<?php echo URLROOT ?>/public/img/asd.jpg" style="width:100%">
	<div class="text"><span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span></div>
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>
<button id="myBtn" style="display: none"></button>
</div>
<br>
</div>
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
<script src="<?php echo URLROOT ?>/public/js/script.js"></script>
</main>