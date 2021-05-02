<?php 
    if(!Session::getCart()){
        echo "<p>Aucun produit en session...</p>";
    }
    else{
        echo "<table class='uk-table'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                        "<th>Suppr.</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
        $totalGeneral = 0;
        foreach(Session::getCart() as $index => $line){
            echo "<tr>",
                    "<td>".($index + 1)."</td>",
                    "<td>".$line["product"]->getName()."</td>",
                    "<td>".$line["product"]->getPrice()."&nbsp;€</td>",
                    "<td>",
                        "<a href='?ctrl=cart&action=updateqtt&id=$index&decr'>-</a>&nbsp;",
                            $line['qtt'],
                        "&nbsp;<a href='?ctrl=cart&action=updateqtt&id=$index&incr'>+</a>",
                    "</td>",
                    "<td>".number_format(($line["product"]->getPrice(false) * $line['qtt']), 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='?ctrl=cart&action=deletecart&id=$index'>&times;</a></td>",
                "</tr>";
            $totalGeneral+= $line["product"]->getPrice(false) * $line['qtt'];
        }
        echo "<tr>",
                "<td colspan=4>Total général : </td>",
                "<td colspan=2><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
            "</tbody>",
        "</table>",
    "<p>",
        "<a href='?ctrl=cart&action=erasecart' onclick='return confirm(\"Etes-vous sûr de vouloir effacer tout?\")'>Effacer tout le panier !</a>",
    "</p>";

    }
?>
