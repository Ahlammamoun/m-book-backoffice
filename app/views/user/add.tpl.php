<div class="container my-4">
    <a href="<?= $router->generate('user-list') ?>" class="btn btn-dark float-end">Retour</a>
    <h2>Ajouter un Utilisateur</h2>

    <form action="" method="POST" class="mt-5">
        <div class="mb-3">
            <label for="lastname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="lastname" placeholder="Prénom de l'utilisateur" required>
        </div>

        <div class="mb-3">
            <label for="firstname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="firstname" placeholder="Nom de l'utilisateur" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="truc@gmail.com" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" min="1" max="5" id="password" placeholder="Mot de passe de l'utilisateur" required name="rate">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">status</label>
            <select class="form-select" name="status" id="status" required>
                <option disabled>----</option>
                <option value="1">Actif</option>
                <option value="2">Désactivé</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" id="role" required>
                <option disabled>----</option>
                <option value="catalog-manager">Gestionnaire du catalogue</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-dark mt-5">Valider</button>
        </div>
    </form>
</div>