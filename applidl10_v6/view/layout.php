<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/css/uikit.min.css" />

    <link rel="stylesheet" href="../public/css/style.css">
    <title>Boutique <?= isset($data['title']) ? "- ".$data['title'] : "" ?></title>
</head>
<body> 
    <nav class="uk-navbar-container" uk-navbar>
        <a class="uk-navbar-item uk-logo" href="/">MABOUTIK</a>

        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <?php
                    if(Session::hasRole("ROLE_ADMIN")){
                        ?>
                        <li class="uk-navbar-item">
                            <a href='?ctrl=admin'>Administration</a>
                        </li>
                        <?php
                    }
                ?>
                <li class="uk-navbar-item">
                <?php
                    if(Session::getUser()){
                        ?>
                            <a href='?ctrl=security&action=profile'><?= Session::getUser()->getEmail() ?></a>
                            <a href='?ctrl=security&action=logout'>Déconnexion</a>
                        <?php
                    }
                    else{
                        ?>
                            <a href='?ctrl=security&action=register'>Inscription</a>
                            <a href='?ctrl=security&action=login'>Connexion</a>
                        <?php
                    }
                ?>
                </li>
                <li class="uk-navbar-item">
                    <a href='?ctrl=cart'>Panier (<?= Session::getCartQtt() ?>)</a>
                </li>
            </ul>
        </div>  
    </nav>

    <div class="uk-container">
        <section id="messages" uk-alert class="uk-padding-remove">
            <?= Session::getFlashes() ?>
        </section>
    </div>

    <div class="uk-container">
        <?= $page //ici s'intègrera la page que le contrôleur aura renvoyé !!?> 
    </div>

    <footer>
        <p class='uk-text-center'>&copy; 2021 - ELAN !!</p>
    </footer>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/js/uikit-icons.min.js"></script>
</body>
</html>
    