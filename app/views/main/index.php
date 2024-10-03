<?php
  require APPROOT . '/views/includes/head.php';
  require APPROOT . '/views/includes/navigation.php';
?>
<main>
  <div class="slide">
    <div class="slideshow-container">
      <div class="mySlides fade">
        <div class="slideshow-img-box" style="background-image: url('<?php echo URLROOT ?>/public/img/slide1.jpg');"></div>
        <div class="slide_text">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>

      <div class="mySlides fade">
        <div class="slideshow-img-box" style="background-image: url('<?php echo URLROOT ?>/public/img/slide2.jpg');"></div>
        <div class="slide_text">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>

      <div class="mySlides fade">
        <div class="slideshow-img-box" style="background-image: url('<?php echo URLROOT ?>/public/img/slide3.jpg');"></div>
        <div class="slide_text">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>

      <a class="prev" onclick="plusSlides(-1)">❮</a>
      <a class="next" onclick="plusSlides(1)">❯</a>
    </div>
  </div>

  <div class="search_wrap search_wrap_3">
        <div class="search_box">
            <input id="searchBox" type="text" class="input" placeholder="Keresés...">
        </div>
    </div>
  <h2>Szűrők</h2>
  <ul>

  <li>
    <div class="dropdown">
      <button class="dropbtn" onclick="dropdown()">Kezdési Időpont</button>
      <div class="dropdown-content" id="dropdown">
      <a href="">asdasd</a>
    </div>
    </div>
  </li>

  <li>
    <div class="dropdown">
    <button class="dropbtn" onclick="dropdown()">Szak</button>
    <div class="dropdown-content" id="dropdown">
    </div>
  </li>

  <li>
  <div class="dropdown">
  <button class="dropbtn" onclick="dropdown()">Oktató</button>
  <div class="dropdown-content" id="dropdown">
  </div>
  </li>

  <li>
  <div class="dropdown">
  <button class="dropbtn" onclick="dropdown()">Terem</button>
  <div class="dropdown-content" id="dropdown">
  </div>
  </li>
  </ul>

  <span id="keresesiEredmenyek"></span>
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
                          <h1 class="cim"><?php echo $sor->cim?></h1>
                          <br>
                          <p class="oktato">Oktató neve: <b><?php echo $sor->nev?></b></p>
                          <br>
                          <p class="tanterem">Helyszin neve: <b><?php echo $sor->neve?></b></p>
                          <br>
                          <p class="helyek">Hátralévő helyek szama: <b><?php echo $sor->ferohely - $sor->jelentkezok?></b></p>
                          <br>
                          <p class="idopont">Esemény időpontja: <br> <?php echo str_replace("-", " ", $sor->datum)?></p>
                          <a class="tovabb"  href="<?php echo URLROOT . "/reszletek/" . $sor->esemeny_id; ?>">Tovább</a>
                      </div>
                  </div>
              <?php endforeach; ?>
      <?php endif; ?>

  </div>
  <script src="<?php echo URLROOT ?>/public/js/script.js"></script>
</main>