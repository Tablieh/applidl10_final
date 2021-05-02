<?php
    $products = $data['products'];
?>

<h1>LES PRODUITS</h1>
<main id="product-list" class="uk-grid-match uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
<?php
    foreach($products as $product){
    ?>
        <article class="uk-card uk-card-default uk-card-body">
            <h5 class="uk-card-title">
                <a href="?ctrl=store&action=voirProduit&id=<?= $product->getId() ?>">
                    <?= $product->getName() ?>
                </a>
            </h5>
            <p class=""><?= $product->getPrice() ?>&nbsp;€</p>
           
            <a href="?ctrl=cart&action=incart&id=<?= $product->getId() ?>" 
                class="uk-button uk-button-small uk-button-primary">
                Ajouter au panier
            </a>

        </article>
    <?php
    }
?>
</main>
   