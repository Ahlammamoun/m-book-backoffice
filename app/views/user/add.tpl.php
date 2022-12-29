<div class="container my-4">
    <a href="<?= $router->generate('user-list') ?>" class="btn btn-dark float-end">Retour</a>
    <h2>Ajouter un Utilisateur</h2>



    <?php if (isset($errors_list)): ?>
        <?php foreach ($errors_list as $error): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <form action="" method="POST" class="mt-5">
    <input type="hidden" name="token" value="<?= $token ?>">
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom de l'utilisateur" value="<?php if (isset($userToInsert)) {
                echo $userToInsert->getFirstname();} ?>"required>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom de l'utilisateur" value="<?php if (isset($userToInsert)) {
                echo $userToInsert->getLastname();} ?>"required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="truc@gmail.com" value="<?php if (isset($userToInsert)) {
                echo $userToInsert->getEmail();} ?>" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" min="1" max="5" id="password" placeholder="Mot de passe de l'utilisateur" value="<?php if (isset($userToInsert)) {
                echo $userToInsert->getPassword();} ?>" required name="password">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">status</label>
            <select class="form-select" name="status" id="status"  required>
                <option disabled>----</option>
                <option value="1" <?php if (isset($userToInsert) && $userToInsert->getstatus() == 1) { echo ' selected'; }?>>Actif</option>
                <option value="2" <?php if (isset($userToInsert) && $userToInsert->getstatus() == 2) { echo ' selected'; }?>>Desactif</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" id="role" value="<?php if (isset($userToInsert)) {
                echo $userToInsert->getRole();} ?>" required>
                <option disabled>----</option>
                <option value="catalog-manager"><?php if (isset($userToInsert) && $userToInsert->getstatus() == 'catlaog-manager') { echo ' selected'; }?>Gestionnaire de catalogue</option>
                <option value="admin"><?php if (isset($userToInsert) && $userToInsert->getstatus() == 1) { echo ' admin'; }?>administrateur</option>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-dark mt-5">Valider</button>
        </div>
    </form>
</div>