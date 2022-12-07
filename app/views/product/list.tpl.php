<div class="container my-4">
    <a href="<?= $router->generate('product-add') ?>" class="btn btn-dark float-end">Ajouter</a>
    <h2>Liste des produits</h2>
    <table class="table table-hover mt-4">
        <thead>
          <!--<?php dump($product_list) ?> -->
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Decription</th>
                <th scope="col">Prix</th>
                <th scope="col">Status</th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($product_list as $productObject) : ?>
                <tr>
                    <th scope="row"><?= $productObject->getId() ?></th>
                    <td><?= $productObject->getName() ?></td>
                    <td><?= $productObject->getDescription() ?></td>
                    <td><?= $productObject->getPrice() ?> £</td>
                    <td><?php
                        if ($productObject->getStatus() === 1) {
                            echo 'disponible';
                        } else {
                            echo 'indisponible';
                        }
                        ?></td>
                      
                    <td class="text-end">
                        <a href="<?= $router->generate('product-update', ['id' => $productObject->getId()]) ?>" class="btn btn-sm btn-dark">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="<?= $router->generate('product-delete', ['id' => $productObject->getId()]) ?>" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>