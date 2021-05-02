<?php
    $categories = $data['categories'];
?>
<h1 id="form-title">Ajouter un produit</h1>

<form class="uk-form-stacked" action="?ctrl=admin&action=addprod" method="post">
    <p>
        <label class="uk-form-label">Catégorie du produit:</label>
        <div class="uk-form-controls">  
            <select class="uk-select" name="category">
                <option value="null">Choisir...</option>
            <?php
                foreach($categories as $category){
                    ?>
                    <option value="<?= $category->getId() ?>">
                        <?= $category->getName() ?>
                    </option>
                    <?php
                }
            ?>
            </select>
        </div>
    </p>
        
    <p> 
        <label class="uk-form-label">Nom du produit :</label>
        <div class="uk-form-controls">  
            <input class="uk-input" type="text" name="name">
        </div>
    </p>
    <p>
        <label class="uk-form-label">Prix du produit :</label>
        <div class="uk-form-controls"> 
            <input class="uk-input" type="number" step="any" name="price">
        </div>
    </p>
    <p>
        <label>Description du produit :</label> 
        <div class="uk-form-controls">     
            <textarea class="uk-textarea" name="descr"></textarea>
        </div>
    </p>
    
    <p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input class="uk-button uk-button-primary" type="submit" name="submit" value="Ajouter le produit">
    </p>
</form>
