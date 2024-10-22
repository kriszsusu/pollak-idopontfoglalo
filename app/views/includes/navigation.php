<div class="navbar" id="navbarID">
  <?php
    $current_page = basename($_SERVER['REQUEST_URI']);
  ?>
  <a href="<?php echo URLROOT?>" class="<?php echo $current_page == '' || $current_page == 'pollak-idopontfoglalo' ? 'active' : ''; ?>">Főoldal</a>
  <a href="<?php echo URLROOT?>/verseny" class="<?php echo $current_page == 'verseny' ? 'active' : ''; ?>">Versenyek</a>
  <a href="<?php echo URLROOT?>/kapcsolat" class="<?php echo $current_page == 'kapcsolat' ? 'active' : ''; ?>">Kapcsolat</a>
  <a class="bejelentkezes" href="<?php echo URLROOT?>/admin">Bejelentkezés</a>

  <a href="javascript:void(0);" class="icon" onclick="navbar()">
    <i class="fa fa-bars"></i>
  </a>
</div>