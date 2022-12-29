<div class="container my-4">

    <form action="" method="POST" class="mt-5">



        <div class="row">
        <?php for ($numberEmplacement = 1 ; $numberEmplacement <= 5 ; $numberEmplacement ++): ?>

            <div class="col">
                <div class="form-group">
                    <label for="emplacement<?= $numberEmplacement ?>">Emplacement <?= $numberEmplacement ?></label>
                    <select class="form-control" id="emplacement1<?= $numberEmplacement ?>" name="emplacement[]">
                        <option value="">choisissez :</option>
                        <?php foreach ($categories_list as $category) : ?>
                            <?php

                            if ($category->getHomeOrder() ==  $numberEmplacement ) {
                                $isSelected = ' selected';
                            } else {
                                $isSelected = '';
                            }
                            ?>
                            <option value="<?= $category->getId() ?>"<?= $isSelected ?>><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php if($numberEmplacement == 2): ?>
        </div> <!--fermeture div 1ère ligne(row)-->
        <div class="row"><!--ouverture div 2ème ligne(row)-->
            <?php endif;?>

            <?php endfor;?>
        </div>
<div class="row"><button type="submit" class="btn btn-dark btn-block mt-5">valider</div>
</form>

</div>