<table class="customers">
    <tr>
    <th>Látogató neve</th>
    <?php if (count($data["idopontok"]) > 0) : ?>
        <?php foreach ($data["idopontok"] as $sor): ?>

            <th><?php echo $sor->idopont?></th>

        <?php endforeach; ?>
    <?php endif; ?>
    <th>Műveletek</th>
    </tr>
    <?php if (count($data["termekek"]) > 0) : ?>
                <?php foreach ($data["termekek"] as $sor): ?>
                    <tr>
                        <td><?php echo $sor->jelentkezo?></td>
                        <?php foreach ($data["idopontok"] as $key=>$sor2): ?>
                            <td><?php echo explode(';' ,  isset(explode(',',  $sor->idopont_terem )[$key]) ? explode(',',  $sor->idopont_terem )[$key] : "")[0] == $sor2->idopont ?  explode(';' ,  explode(',',  $sor->idopont_terem )[$key])[1] : ""?></td>
                        <?php endforeach; ?>

                        <td>
                        <?php if ($sor->megjelent == 0) : ?>
                            <a class="jelentkezoTorles" onclick="return confirm('Biztos megjelent?')" href="<?php echo URLROOT ?>/admin/felhasznaloEngedelyezese/<?php echo $sor->jelentkezo_id ?>"><i class='bx bxs-user-check' ></i></a>
                        <?php endif; ?>
                                    
                        <a class="jelentkezoTorles" onclick="return confirm('Biztos törölni szeretnéd?')" href="<?php echo URLROOT ?>/admin/felhasznaloTorlese/<?php echo $sor->jelentkezo_id ?>"><i class='bx bxs-trash' ></i></a></h3>
                        </td>

                    </tr>

                <?php endforeach; ?>
        <?php endif; ?>
 

</table>
