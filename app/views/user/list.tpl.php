<div class="container my-4 ">
    <a href="<?= $router->generate('user-add') ?>" class="btn btn-dark float-end">Ajouter</a>
    <h2>Liste des utilisateurs</h2>
    <table class="table table-hover mt-4 text-light">
        <thead>
           
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($users_list as $userObject) : ?>
                <tr>
                    <th scope="row"><?= $userObject->getId() ?></th>
                    <td><?= $userObject->getfirstName() ?></td>
                    <td><?= $userObject->getLastName() ?></td>
                    <td><?= $userObject->getEmail() ?></td>
                    <td><?= $userObject->getRole() ?></td>
                    <td><?php
                        if ($userObject->getStatus() === 1) {
                            echo 'Actif';
                        } else {
                            echo 'Désactivé/bloqué';
                        }
                        ?></td>
                      
                
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-dark">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="<?= $router->generate('user-delete', ['id' => $userObject->getId()]) ?>" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>