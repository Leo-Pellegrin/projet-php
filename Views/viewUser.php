<!DOCTYPE html>
<html lang="fr">
<?php displayHead("Utilisateur");?>
<body>

    <?php
        displayHeader();
        if($errorMsg != null)
            echo '<h2 id="err_h2">'.$errorMsg.'</h2>';
    ?>

        <?php if($_SESSION['role'] = 1){ ?>
            <?php foreach($users as $user): ?>
                <div class="div_campagne">
                    <h1><?= $user['username'] ?></h1>
                    <h2><?= $user['roleDisplay'] ?></h2>
                </div>
            <?php endforeach; ?>
            
        <?php }else{ ?>
            <?php foreach($users as $user): ?>
                <div class="div_campagne">
                    <h1><?= $user['username'] ?></h1>
                    <h2><?= $user['roleDisplay'] ?></h2>
                </div>
            <?php endforeach; ?>
        <?php } ?>

    <footer>
        <a href=""><img src="../images/html5.png" alt="Valid XHTML5"></a>
        <a class="css" href=""><img src="../images/css3.png" alt="Valid CSS3"></a>
        <a href="mailto:projet.phpiutaix@gmail.com">Contactez nous par mail !</a>
        <p>©e-event.io 2022</p>    </footer>
</body>
</html>