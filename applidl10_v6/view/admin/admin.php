<?php
    $products = $result['data']['products'];

    if(!$products){
        echo "<p>Aucun produit en base de données...</p>";
    }else{
        echo "<table class='uk-table'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Image</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Description</th>",
                        "<th>Disponible</th>",
                        "<th>Suppr.</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
                foreach($products as $product){
                    echo "<tr>",
                            "<td>", $product->getId(), "</td>",
                            "<td>", $product->getImage(), "</td>",
                            "<td>", $product->getName(), "</td>",
                            "<td>", $product->getPrice(), "</td>",
                            "<td>", $product->getDescription(), "</td>",
                            "<td>",
                                "<a href='?ctrl=admin&action=available&id=", $product->getId(),"'>",
                                    $product->getAvailable() ? "Activé" : "Désactivé",
                                "</a>",
                            "</td>",
                            "<td><a href='?ctrl=admin&action=deleteprod&id=", $product->getId(),"'>Supprimer</a></td>",
                        "</tr>";
                }
            echo "</tbody>",
        "</table>";
    }

    include "form.php";
?>