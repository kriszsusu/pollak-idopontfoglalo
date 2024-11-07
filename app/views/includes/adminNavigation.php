<div class="navbar" id="navbarID">
  <?php
    $current_page = basename($_SERVER['REQUEST_URI']);
  ?>
  <a href="<?php echo URLROOT?>/admin" class="<?php echo $current_page == '' || $current_page == 'admin' ? 'active' : ''; ?>">Események</a>
  <a href="<?php echo URLROOT?>/admin/jelentkezok" class="<?php echo $current_page == 'jelentkezok' ? 'active' : ''; ?>">Jelentkezők</a>
  <a href="<?php echo URLROOT?>/admin/verseny" class="<?php echo $current_page == 'verseny' ? 'active' : ''; ?>">Versenyek</a>
  <a href="<?php echo URLROOT?>/admin/pontozas" class="<?php echo $current_page == 'pontozas' ? 'active' : ''; ?>">Pontozás</a>
  <a href="<?php echo URLROOT?>/admin/adminhozzadas" class="<?php echo $current_page == 'adminhozzadas' ? 'active' : ''; ?>">Admin hozzáadás</a>
  <a class="bejelentkezes" href="<?php echo URLROOT?>/user/logout">Kijelentkezés</a>

  <a href="javascript:void(0);" class="icon" onclick="navbar()">
    <i class="fa fa-bars"></i>
  </a>
</div>