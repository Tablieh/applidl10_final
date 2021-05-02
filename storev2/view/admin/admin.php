<?php
    $products = $data['products'];

    if(!$products){
        ?>
        <p>Aucun produit en base de données...</p>
        <?php
    }else{
        ?>
        <table class='uk-table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Disponible</th>
                    <th>Catégorie</th>
                    <th>Suppr.</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($products as $product){
                    ?>
                    <tr>
                        <td><?= $product->getId() ?></td>
                        <td><img src="<?= $product->getImage()?>"></td>
                        <td><?= $product->getName() ?></td>
                        <td><?= $product->getPrice() ?></td>
                        <td><?= $product->getDescription() ?></td>
                        <td>
                            <a href='?ctrl=admin&action=available&id=<?= $product->getId() ?>'>
                                <?= $product->getAvailable() ? "Activé" : "Désactivé" ?>
                            </a>
                        </td>
                        <td><?= $product->getCategory()->getName() ?></td>
                        <td><a href='?ctrl=admin&action=deleteprod&id=<?= $product->getId() ?>'>Supprimer</a></td>
                    </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
    <?php
    }

    include "form.php";
?>