<h1>Ajouter un produit</h1>
<form action="?ctrl=admin&action=addprod" method="post">
    <p> 
        <label>
            Nom du produit: 
            <input type="text" name="name">
        </label>
    </p>
    <p>
        <label>
            Prix du produit : 
            <input type="number" step="any" name="price">
        </label>
    </p>
    <p>
        <label>
            Description du produit : 
            <textarea name="descr"></textarea>
        </label>
    </p>
    
    <p>
        <input type="submit" name="submit" value="Ajouter le produit">
    </p>
</form>
