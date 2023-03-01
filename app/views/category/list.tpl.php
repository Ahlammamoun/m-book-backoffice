<div class="container my-4">
    <a href="<?= $router->generate('category-add') ?>" class="btn btn-dark float-end">Ajouter</a>
    <h2>Liste des catégories</h2>
    <table class="table table-hover mt-4 text-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Sous-titre</th>
                <th scope="col">Home order</th>
            </tr>
        </thead>
        <!--<?php dump($category_list) ?>-->
        <tbody>
            <?php foreach ($category_list as $CategoryObject) : ?>
                <tr>
                    <th scope="row"><?= $CategoryObject->getId() ?></th>
                    <td><?= $CategoryObject->getName() ?></td>
                    <td><?= $CategoryObject->getSubtitle() ?></td>
                    <td><?= $CategoryObject->getHomeOrder() ?></td>
                    <td class="text-end">
                        <a href="<?= $router->generate('category-update', ['id' => $CategoryObject->getId()]) ?>" class="btn btn-sm btn-dark">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="<?= $router->generate('category-delete', ['id' => $CategoryObject->getId()]) ?>" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-o"aria-hidden="true"></i>
                        </a>


                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>