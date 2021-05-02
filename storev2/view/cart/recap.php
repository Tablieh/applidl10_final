<?php 
    use App\Core\Session;

    if(Session::get("cart")->isEmpty()){
        ?>
        <p>Votre panier est vide...</p>
        <?php
    }
    else{
        ?>
        <table class='uk-table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Suppr.</th>
                </tr>
            </thead>
            <tbody>
            <?php
               
                foreach(Session::get("cart")->getLines() as $index => $line){
                    ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $line["product"]->getName() ?></td>
                        <td><?= $line["product"]->getPrice() ?>&nbsp;€</td>
                        <td>
                            <a href='?ctrl=cart&action=updateqtt&id=<?= $index ?>&decr'>-</a>
                            &nbsp;
                            <?= $line['qtt'] ?>
                            &nbsp;
                            <a href='?ctrl=cart&action=updateqtt&id=<?= $index ?>&incr'>+</a>
                        </td>
                        <td>
                            <?= Session::get("cart")->getTotalOfLine($index) ?>
                            &nbsp;€
                        </td>
                        <td><a href='?ctrl=cart&action=deletecart&id=<?= $index ?>'>&times;</a></td>
                    </tr>
                    <?php 
                   
                }
                ?>
                <tr>
                    <td colspan=4>Total général : </td>
                    <td colspan=2>
                        <strong>
                            <?= Session::get("cart")->getTotalAmount() ?>&nbsp;€
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>
            <a href='?ctrl=cart&action=erasecart' 
            onclick='return confirm("Etes-vous sûr de vouloir supprimer votre panier?")'>
                Effacer tout le panier !
            </a>
        </p>
    <?php
    }
?>
