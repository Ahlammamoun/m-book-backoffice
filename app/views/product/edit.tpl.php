<div class="container my-4 bg-dark text-light">
        <a href="<?= $router->generate('product-list')?>" class="btn btn-dark float-end">Retour</a>
        <h2>Modifier un produit</h2>
     
        <form action="" method="POST" class="mt-5">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" placeholder="Nom du produit" required name="name" value="<?= $product->getName() ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label"  >Description</label>
                <textarea id="description"  name="description"   class="form-control" placeholder="Description du produit" >value="<?= $product->getDescription() ?>"</textarea>
                <small id="subtitleHelpBlock" class="form-text text-muted">
                    Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Image</label>
                <input type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" name="picture"value="<?= $product->getPicture() ?>" >
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Le prix du Produit" required name="price" value="<?= $product->getPrice() ?>">
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Note</label>
                <input type="number" class="form-control"min="1" max="5" id="rate" placeholder="La note du produit" required name="rate" value="<?= $product->getRate() ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" >Status du produit</label >
                <label for="status_available" class="form-check-label">Disponible</label>
                <input class="form-check-input" type="radio" id="status_available" name="status" value="1" required<?php if ($product->getStatus() == 1) {
                    echo ' checked';
                }
                    ?>>
                <label for="status_not_available" class="form-check-label" >Indisponible</label>
                <input class="form-check-input " type="radio" id="status_not_available" name="status" value="0" required<?php if ($product->getStatus() == 0) {
                    echo ' checked';
                }
                    ?>> 
            </div>
            <!--<?php dump($languages_list)?>-->
            <div class="mb-3">
                <label for="language_id">Langue</label>
            <select  class="form-select" name="language_id" id="language_id" required>
                <option disabled>--Choix de la langue--</option>
                <?php foreach($languages_list as $languages): ?>
                <option value="<?= $languages->getId()?>"><?= $languages->getName()?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="mb-3">
            <!--<?php dump($categories_list)?>-->
                <label for="category_id">Categorie</label>
            <select  class="form-select" name="category_id" id="category_id">
                <option value="">--Choix de la categorie--</option>
                <?php foreach($categories_list as $category):?>
                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <!--<?php dump($etats_list)?>-->
            <div class="mb-3">
                <label for="etat_id">Etat</label>
            <select  class="form-select" name="etat_id" id="etat_id" required >
                <option disabled  >--Choix de l'état--</option>
                <?php foreach($etats_list as $etat):?>
                <option value="<?= $etat->getId() ?>"><?= $etat->getName() ?></option>
                <?php endforeach; ?>
            </select>
            </div>
           <!--<?php dump($tags_list) ;?>-->
            <div class="mb-3">
                <label for="tag_id">Tags</label>
            <select  class="form-select" name="tag_id" id="tag_id" require multiple size="8" >
                <option disabled  >--Choix des tags--</option>
                <?php foreach($tags_list as $tag): ?>
                <option value="<?= $tag->getId()?>"><?= $tag->getName()?></option>
                <?php endforeach; ?>
            </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-secondary mt-5">Valider</button>
            </div>
        </form>
    </div>
