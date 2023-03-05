<div class="form-group">
                    <label for="emplacement<?= $numberEmplacement ?>">Emplacement <?= $numberEmplacement ?></label>
                    <select class="form-control" id="emplacement<?= $numberEmplacement ?>" name="emplacement[]">
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