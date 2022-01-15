<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-event.io | Utilisateurs</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
</head>
<body>
    <header>
        <div id="main_div">
            <h1><a href="<?= URL ?>">e-event.io</a></h1>
            <p>Bienvenue, <?= $_SESSION['username'] ?> !</p>
        </div>
    </header>

    <?php
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
        <p>©e-event.io 2022</p>
    </footer>
</body>
</html>