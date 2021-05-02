<?php
    $product = $result["data"]['product'];
?>

<h1><?= $product->getName() ?></h1>
<p><?= $product->getDescription() ?></p>
<p>
    <?= $product->getPrice() ?> 
    <a href="?ctrl=cart&action=incart&id=<?= $product->getId() ?>" 
        class="uk-button uk-button-small uk-button-primary">
        Ajouter au panier
    </a>
</p>