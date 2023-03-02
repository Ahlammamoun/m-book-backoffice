<div class="container my-4">
        <a href="<?= $router->generate('product-list')?>" class="btn btn-dark float-end">Retour</a>
        <h2>Ajouter un produit</h2>
        
        <form action="" method="POST" class="mt-5">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" placeholder="Nom du produit" required name="name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label"  >Description</label>
                <textarea id="description" class="form-control" placeholder="Description du produit" name="description"></textarea>
                <small id="subtitleHelpBlock" class="form-text text-muted">
                    Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Image</label>
                <input type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" name="picture">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Le prix du Produit" required name="price">
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Note</label>
                <input type="number" class="form-control"min="1" max="5" id="rate" placeholder="La note du produit" required name="rate">
            </div>
            <div class="mb-3">
                <label class="form-label" >Status du produit</label >
                <label for="status_available" class="form-label">Disponible</label>
                <input type="radio" id="status_available" name="status" value="1" checked required>
                <label for="status_not_available" class="form-label" >Indisponible</label>
                <input type="radio" id="status_not_available" name="status" value="0" required>  
            </div>
            <div class="mb-3">
                <label for="language_id">Langue</label>
            <select  class="form-select" name="language_id" id="language_id" required>
                <option disabled>--Choix de la langue--</option>
                <option value="2">Français</option>
                <option value="3">Anglais</option>
                <option value="1">Allemand</option>
                <option value="2">Arabe </option>
            </select>
            </div>
            <div class="mb-3">
                <label for="category_id">Categorie</label>
            <select  class="form-select" name="category_id" id="category_id">
                <option value="">--Choix de la categorie--</option>
                <option value="2">Romance</option>
                <option value="3">Asie</option>
                <option value="1">Recherche</option>
            </select>
            </div>
            <div class="mb-3">
                <label for="etat_id">Etat</label>
            <select  class="form-select" name="etat_id" id="etat_id" required>
                <option disabled>--Choix de l'état--</option>
                <option value="2">Bon état</option>
                <option value="3">Correct</option>
                <option value="1">Très bon état</option>
            </select>
            </div>


            <div class="row">
                <button type="submit" class="btn btn-dark mt-5">Valider</button>
            </div>
        </form>
    </div>
